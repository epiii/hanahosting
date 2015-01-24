var dir='server/p_mjenjang.php';
	
	
	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax 	= 'aksi=tampil';
		var cari 	= '&mjenjangS='+$('#mjenjangTS').val()+'&jumkelasS='+$('#jumkelasTS').val();

		$.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR JENJANG PENDIDIKAN');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
	
	
	//submit form
	function submitForm(event){
		event.stopPropagation();
		event.preventDefault();
		
		var id_mjenjang = +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_mjenjang='+id_mjenjang;
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
	function hapusmjenjang(id){
		if(confirm('melanjutkan untuk menghapus data?'))
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=hapus&id_mjenjang='+id,
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
	function editmjenjang(id){
		//alert('id: '+id);
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=ambiledit&id_mjenjang='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
									
					$('#idformTB').val(id); 
					$('#jenjangTB').val(data.mjenjang);
					$('#jmlkelasTB').val(data.jumkelas);
					
					$('#loadarea').html('<i class="icon-edit"></i> UBAH JENJANG PENDIDIKAN').fadeIn();
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
		$('#jenjangTB').val('');
		$('#jmlkelasTB').val('');
	}
	//end of kosongkan form

		
	//function pagination(page,aksix,menux,carix){
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax 	= 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari 	= '&mjenjangS='+$('#mjenjangTS').val()+'&jumkelasS='+$('#jumkelasTS').val();
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
		
		$('form').on('submit', submitForm);
	
		//panggil fungsi cekPoin (validasi)
		$('#pointTB').on('input paste',function(){
			cekPoin($(this).val());
		});
		$('#mjenjangTS').on('keyup',loadData);
		$('#jumkelasTS').on('keyup',loadData);
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
				
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH JENJANG PENDIDIKAN').fadeIn();
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
	