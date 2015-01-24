var dir='server/p_mlembaga.php';
	function combompropinsi(id_mpropinsi){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mpropinsi',
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_mpropinsiTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_mpropinsi==id_mpropinsi){
							optiony+='<option selected="selected" value='+item.id_mpropinsi+'>'+item.mpropinsi+' </option>';
						}else{
							optiony+='<option value='+item.id_mpropinsi+'>'+item.mpropinsi+' </option>';
						}
					});
					$('#id_mpropinsiTB').html('<option value="">pilih Propinsi ..</option>'+optiony);
				}
			}
		});
	}

	function combomkota(id_mpropinsi,id_mkota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mkota&id_mpropinsi='+id_mpropinsi,
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_mkotaTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_mkota==id_mkota){
							optiony+='<option selected="selected" value='+item.id_mkota+'>'+item.mkota+' </option>';
						}else{
							optiony+='<option value='+item.id_mkota+'>'+item.mkota+' </option>';
						}
					});
					$('#id_mkotaTB').html('<option value="">pilih Kota ..</option>'+optiony);
				}
			}
		});
	}

	function combomkecamatan(id_mkota,id_mkecamatan){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mkecamatan&id_mkota='+id_mkota,
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_mkecamatanTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_mkecamatan==id_mkecamatan){
							optiony+='<option selected="selected" value='+item.id_mkecamatan+'>'+item.mkecamatan+' </option>';
						}else{
							optiony+='<option value='+item.id_mkecamatan+'>'+item.mkecamatan+' </option>';
						}
					});
					$('#id_mkecamatanTB').html('<option value="">pilih Kota ..</option>'+optiony);
				}
			}
		});
	}

	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'aksi=tampil';
		var cari ='&mlembagaS='+$('#mlembagaTS').val()
				 +'&alamatS='+$('#alamatTS').val()
				 +'&mkecamatanS='+$('#mkecamatanTS').val()
				 +'&mkotaS='+$('#mkotaTS').val()
				 +'&mpropinsiS='+$('#mpropinsiTS').val()
				 +'&no_telpS='+$('#no_telpTS').val()
				 +'&no_telpkoordS='+$('#no_telpkoordTS').val()
				 +'&koordinatorS='+$('#koordinatorTS').val();		
	 $.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR PENYALUR');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
		
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari ='&mlembagaS='+$('#mlembagaTS').val()
				 +'&alamatS='+$('#alamatTS').val()
				 +'&mkecamatanS='+$('#mkecamatanTS').val()
				 +'&mkotaS='+$('#mkotaTS').val()
				 +'&mpropinsiS='+$('#mpropinsiTS').val()
				 +'&no_telpS='+$('#no_telpTS').val()
				 +'&no_telpkoordS='+$('#no_telpkoordTS').val()
				 +'&koordinatorS='+$('#koordinatorTS').val();

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
		
		var id_mlembaga = +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_mlembaga='+id_mlembaga;
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
			data:'aksi=hapus&id_mlembaga='+id,
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
			data:'aksi=ambiledit&id_mlembaga='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
					$('#idformTB').val(id); 
					$('#mlembagaTB').val(data.mlembaga);
					$('#alamatTB').val(data.alamat);
					$('#notelpTB').val(data.no_telp);
					$('#koorTB').val(data.koordinator);
					$('#nokoorTB').val(data.no_telpkoord);
					
					combompropinsi(data.id_mpropinsi);
					combomkota(data.id_mpropinsi,data.id_mkota);
					combomkecamatan(data.id_mkota,data.id_mkecamatan);
					
					$('#loadarea').html('<i class="icon-edit"></i> UBAH PENYALUR').fadeIn();
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
		$('#id_mkecamatanTB').val('');
		$('#id_mkotaTB').val('');
		$('#id_mpropinsiTB').val('');
		$('#alamatTB').val('');
		$('#mlembagaTB').val('');
		$('#nokoorTB').val('');
		$('#notelpTB').val('');
		$('#koorTB').val('');
	}
	//end of kosongkan form

	
	// panggil fungsi2 di ready function ==============================================================
	$(document).ready(function(){
		//load data saat refresh halaman
		loadData();
		
		
		$('#id_mpropinsiTB').on('change', function(){
			combomkota($(this).val(),'');
		});

		$('#id_mkotaTB').on('change', function(){
			combomkecamatan($(this).val(),'');
		});
		
		$('#mlembagaTS').on('keyup',loadData);
		$('#alamatTS').on('keyup',loadData);
		$('#mkecamatanTS').on('keyup',loadData);
		$('#mkotaTS').on('keyup',loadData);
		$('#mkpropinsiTS').on('keyup',loadData);
		$('#mkoordinatorTS').on('keyup',loadData);
		$('#no_telpTS').on('keyup',loadData);
		$('#no_telpkoordTS').on('keyup',loadData);
		
		$('form').on('submit', submitForm);
	
		//panggil fungsi cekPoin (validasi)
		$('#pointTB').on('input paste',function(){
			cekPoin($(this).val());
		});
		
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			combompropinsi('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH PENYALUR').fadeIn();
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
	