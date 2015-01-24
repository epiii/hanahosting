var dir='server/p_mperiode.php';
	function combotahun(tahun){ //diganti
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=tahun', //diganti
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#tahunTS').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					// var cury = (new Date).getFullYear();
					// alert(cury);
					$.each(data.datax, function (id,item){
						// if(item==cury){ //edit
						// 	optiony+='<option selected="selected" value='+item+'>'+item+' </option>'; //diganti
						// }else{ //add
							optiony+='<option value='+item+'>'+item+' </option>'; //diganti
						// }
					});
					$('#tahunTS').html('<option value="">semua</option>'+optiony); //diganti
				}
			}
		});
	}

	function combotahun2(tahun){ //diganti
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=tahun2', //diganti
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#tahunTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					var cury = (new Date).getFullYear();
					// alert(cury);
					$.each(data.datax, function (id,item){
						if(item==cury){ //edit
							optiony+='<option selected="selected" value='+item+'>'+item+' </option>'; //diganti
						}else{ //add
							optiony+='<option value='+item+'>'+item+' </option>'; //diganti
						}
					});
					$('#tahunTB').html('<option value="">semua</option>'+optiony); //diganti
				}
			}
		});
	}

	function combosemester(id_semester){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=semester',
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					//$('#id_kegTS').html('<option value="">anda telah mengambil semua kegiatan ini</option>');
				}else{
					var optiony ='';
					$.each(data, function (id,item){
						if(item.id_semester==id_semester){
							optiony+='<option selected="selected" value='+item.id_semester+'>'+item.semester+' </option>';
						}else{
							optiony+='<option value='+item.id_semester+'>'+item.semester+' </option>';
						}
					});
					$('#id_semesterTB').html('<option value="">pilih propinsi..</option>'+optiony);
					//combopt(id_pt);
				}
			}
		});
	}

	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'aksi=tampil';
		var cari ='&tahunS='+$('#tahunTS').val()
				 +'&semesterS='+$('#semesterTS').val();

		$.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR PERIODE');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
	
	//validasi poin (harus angka)
	function cekPoin(poin){
		if( $('#pointTB').val() != $('#pointTB').val().replace(/[^0-9]/g, '')){ // cek hanya angka 
			$('#pointTB').val($('#pointTB').val().replace(/[^0-9]/g, ''));
		}
	}
	
	//submit form
	function submitForm(event){
		event.stopPropagation();
		event.preventDefault();
		
		var id_mperiode = +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_mperiode='+id_mperiode;
		}
		//console.log(urlx);
		//return false;
		$.ajax({
			url:urlx,
			type:'post',
			dataType:'json',
			data:$('form').serialize(),
			success:function(data){
				if(data.status=='sukses'){
					kosongkan();
					$('#i_kegPN').toggle();
					$('#v_kegPN').toggle();
					$('#addBC').toggle();
					$('#viewBC').toggle();
					loadData();
				}else{
					alert(data.status);
				}
			}
		});
	}
	
	//hapus record kegiatan
	function hapusmperiode(id){
		if(confirm('melanjutkan untuk menghapus data?'))
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=hapus&id_mperiode='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('gagal menghapus data');
				}else{
					loadData();
				}
			}
		});
	}
	//end of hapus record kegiatan
	
	//edit record kegiatan
	function editmperiode(id){
		//alert('id: '+id);
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=ambiledit&id_mperiode='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
					var id_semestery		= data.id_semester;
					var kota		= data.mkota;
					
					$('#idformTB').val(id); 
					$('#id_semesterTB').val(id_semestery);
					$('#mkotaTB').val(kota);
					
					combosemester(id_semestery);
					
					$('#loadarea').html('<i class="icon-edit"></i> UBAH GOLONGAN').fadeIn();
					$('#i_kegPN').toggle(1000);
					$('#v_kegPN').toggle();
					$('#viewBC').toggle();
					$('#addBC').toggle();
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				console.log('ERRORS: ' + errorThrown);
			}
		});
	}
	
	//kosongkan form
	function kosongkan(){
		$('#idformTB').val('');
		$('#id_semesterTB').val('');
		$('#mkotaTB').val('');
	}
	//end of kosongkan form

		
	//function pagination(page,aksix,menux,carix){
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari ='&tahunS='+$('#tahunTS').val()
				 +'&semesterS='+$('#semesterTS').val();

		$.ajax({
			url:dir,
			type:"GET",
			data: datax,
			success:function(data){
				$("#loadtabel").fadeOut();
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
	
	// panggil fungsi2 di ready function ==============================================================
	$(document).ready(function(){
		//load data saat refresh halaman
		loadData();
		combotahun();
		//panggil fungsi submit form 
		$('#id_semesterTB').on('change', function(){
			var idsemester 	= $(this).val();
			combosemester(idsemester,'');
		});
		
		$('form').on('submit', submitForm);
		$('#tahunTS').on('change', loadData);
		$('#semesterTS').on('change', loadData);
	
		//panggil fungsi cekPoin (validasi)
		$('#pointTB').on('input paste',function(){
			cekPoin($(this).val());
		});
		
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			combotahun2('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH GOLONGAN').fadeIn();
		});
			$('#tahunTS').on('keyup',loadData);
			$('#semesterTS').on('keyup',loadData);
		//masuk halaman "VIEW DATA"
		$('#viewBC').click(function(){
			kosongkan();
			$(this).toggle();
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#addBC').toggle();
			loadData();	
		});
		
	});	
	