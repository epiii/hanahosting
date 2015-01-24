var dir='server/p_mkecamatan.php';
	
	function combomkecamatan(id_mkota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mkecamatan',
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					//$('#id_kegTB').html('<option value="">anda telah mengambil semua kegiatan ini</option>');
				}else{
					var optiony ='';
					$.each(data, function (id,item){
						if(item.id_mkota==id_mkota){
							optiony+='<option selected="selected" value='+item.id_mkota+'>'+item.mkota+' </option>';
						}else{
							optiony+='<option value='+item.id_mkota+'>'+item.mkota+' </option>';
						}
					});
					$('#id_mkotaTB').html('<option value="">pilih kota..</option>'+optiony);
					//combopt(id_pt);
				}
			}
		});
	}

	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'aksi=tampil';
		var cari ='&mkecamatanS='+$('#mkecamatanTS').val()
				 +'&mkotaS='+$('#mkotaTS').val();

		$.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR MASTER KECAMATAN');
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
		
		var id_mkecamatan = +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_mkecamatan='+id_mkecamatan;
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
	function hapusGol(id){
		if(confirm('melanjutkan untuk menghapus data?'))
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=hapus&id_mkecamatan='+id,
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
	function editGol(id){
		//alert('id: '+id);
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=ambiledit&id_mkecamatan='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
					$('#idformTB').val(id); 
					$('#id_mkotaTB').val(data.id_mkota);
					$('#mkecamatanTB').val(data.mkecamatan);					
					combomkecamatan(data.id_mkota);
					
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
		$('#id_mkotaTB').val('');
		$('#mkecamatanTB').val('');
	}
	//end of kosongkan form

		
	//function pagination(page,aksix,menux,carix){
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari ='&mkecamatanS='+$('#mkecamatanTS').val()
				 +'&mkotaS='+$('#mkotaTS').val();
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
		
		//panggil fungsi submit form 
		$('#id_mkecamatanTB').on('change', function(){
			var idmkecamatan 	= $(this).val();
			//var idgol	= $('#golTB').val();
			combomkecamatan(idmkecamatan,'');
		});
		
		$('form').on('submit', submitForm);
	
		//panggil fungsi cekPoin (validasi)
		$('#pointTB').on('input paste',function(){
			cekPoin($(this).val());
		});
		
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			combomkecamatan('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH GOLONGAN').fadeIn();
		});
			$('#mkecamatanTS').on('keyup',loadData);
			$('#mkotaTS').on('keyup',loadData);
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
	