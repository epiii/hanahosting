var dir = 'server/p_msekolah.php';
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
							//satu dari database satu dari atas
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

	function combomjenjang(id_mjenjang){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mjenjang',
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_mjenjangTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_mjenjang==id_mjenjang){
							optiony+='<option selected="selected" value='+item.id_mjenjang+'>'+item.mjenjang+' </option>';
						}else{
							optiony+='<option value='+item.id_mjenjang+'>'+item.mjenjang+' </option>';
						}
					});
					$('#id_mjenjangTB').html('<option value="">pilih jenjang ..</option>'+optiony);
				}
			}
		});
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
			urlx += 'aksi=ubah&id_msekolah='+id_mkecamatan;
		}
		
		var datax = $('form').serialize();
		//alert(datax);
		$.ajax({
			url:urlx,
			type:'post',
			dataType:'json',
			data:datax,
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
	function hapussekolah(id){
		if(confirm('melanjutkan untuk menghapus data?'))
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=hapus&id_msekolah='+id,
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
	function editsekolah(id){
		//alert('id: '+id);
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=ambiledit&id_msekolah='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
					var mloginy		= data.mlogin;
					
					$('#idformTB').val(id); 
					$('#namaTB').val(data.nama);
					$('#alamatTB').val(data.alamat);

					combompropinsi(data.id_mpropinsi);
					combomkota(data.id_mpropinsi,data.id_mkota);
					combomkecamatan(data.id_mkota,data.id_mkecamatan);
					combomjenjang(data.id_mjenjang);

					$('#loadarea').html('<i class="icon-edit"></i> UBAH MASTER TIPE BAYAR').fadeIn();
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
		$('#namaTB').val('');
		$('#alamatTB').val('');
		$('#id_mkecamatanTB').val('');
		$('#id_mkotaTB').val('');
		$('#id_mpropinsiTB').val('');
		$('#id_mjenjangTB').val('');
	}
	//end of kosongkan form
	
	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax ='aksi=tampil';
		var cari ='&namaS='+$('#namaTS').val()
				 +'&mjenjangS='+$('#mjenjangTS').val()
				 +'&alamatS='+$('#alamatTS').val()
				 +'&mkecamatanS='+$('#mkecamatanTS').val()
				 +'&mkotaS='+$('#mkotaTS').val()
				 +'&mpropinsiS='+$('#mpropinsiTS').val();

		$.ajax({
			url:dir,
			type:"GET",
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR SEKOLAH');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
	
		
	//function pagination(page,aksix,menux,carix){
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari ='&namaS='+$('#namaTS').val()
				 +'&mjenjangS='+$('#mjenjangTS').val()
				 +'&alamatS='+$('#alamatTS').val()
				 +'&mkecatmatanS='+$('#mkecatmatanTS').val()
				 +'&mkotaS='+$('#mkotaTS').val()
				 +'&mpropinsiS='+$('#mpropinsiTS').val();

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
		
		$('#id_mpropinsiTB').on('change', function(){
			combomkota($(this).val(),'');
		});

		$('#id_mkotaTB').on('change', function(){
			combomkecamatan($(this).val(),'');
		});

		$('form').on('submit', submitForm);
		$('#namaTS').on('keyup',loadData);
		$('#mjenjangTS').on('keyup',loadData);
		$('#alamatTS').on('keyup',loadData);
		$('#mkecamatanTS').on('keyup',loadData);
		$('#mkotaTS').on('keyup',loadData);
		$('#mpropinsiTS').on('keyup',loadData);

		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			combompropinsi('');
			combomjenjang('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH SEKOLAH').fadeIn();
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
	