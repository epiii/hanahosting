var dir='server/p_dkatdonatur.php';
// var dir='server/p_mkota.php';
	
	function combomkatdonatur(id_mkatdonatur){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mkatdonatur',
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_mkatdonaturTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_mkatdonatur==id_mkatdonatur){
							optiony+='<option selected="selected" value='+item.id_mkatdonatur+'>'+item.mkatdonatur+' </option>';
						}else{
							optiony+='<option value='+item.id_mkatdonatur+'>'+item.mkatdonatur+' </option>';
						}
					});
					// alert(optiony);
					$('#id_mkatdonaturTB').html('<option value="">pilih DETAIL Kategori Donatur ..</option>'+optiony);
				}
			}
		});
	}

	function combodtipebayar(id_dtipebayar){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=dtipebayar',
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_dtipebayarTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_dtipebayar==id_dtipebayar){
							optiony+='<option selected="selected" value='+item.id_dtipebayar+'>'+item.dtipebayar+' </option>';
						}else{
							optiony+='<option value='+item.id_dtipebayar+'>'+item.dtipebayar+' </option>';
						}
					});
					// alert(optiony);
					$('#id_dtipebayarTB').html('<option value="">pilih Detail Tipe Pembayaran..</option>'+optiony);
				}
			}
		});
	}

	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'aksi=tampil';
		var cari ='&mkatdonaturS='+$('#mkatdonaturTS').val()
				 +'&dtipebayarS='+$('#dtipebayarTS').val();
				 
		$.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR DETAIL KATEGORI DONATUR');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
	//submit form
	function submitForm(event){
		event.stopPropagation();
		event.preventDefault();
		
		var id_dkatdonatur = +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_dkatdonatur='+id_dkatdonatur;
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
	function hapustombol(id){
		if(confirm('melanjutkan untuk menghapus data?'))
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=hapus&id_dkatdonatur='+id,
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
	function edittombol(id){
		//alert('id: '+id);
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=ambiledit&id_dkatdonatur='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
					
					$('#idformTB').val(id); 
					combomkatdonatur(data.id_mkatdonatur);
					combodtipebayar(data.id_dtipebayar);
					
					$('#loadarea').html('<i class="icon-edit"></i> UBAH DETAIL KATEGORI PENERIMA DONASI').fadeIn();
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
		$('#id_mkatdonaturTB').val('');
		$('#id_dtipebayarTB').val('');
	}
	//end of kosongkan form

		
	//function pagination(page,aksix,menux,carix){
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari ='&mkatdonaturS='+$('#mkatdonaturTS').val()
				 +'&dtipebayarS='+$('#dtipebayarTS').val();

		$.ajax({
			url:dir,
			type:"GET",
			data: datax+cari,
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
		$('#id_mpropinsiTB').on('change', function(){
			var idmpropinsi 	= $(this).val();
			combompropinsi(idmpropinsi,'');
		});
		
		$('form').on('submit', submitForm);
		
		$('#mkatdonaturTS').on('keyup', loadData);
		$('#dtipebayarTS').on('keyup', loadData);
				
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			combomkatdonatur('');
			combodtipebayar('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH DETAIL KATEGORI PENERIMA DONASI').fadeIn();
		});
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
	