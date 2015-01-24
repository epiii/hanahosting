var dir='server/p_mdonatur.php';
// panggil fungsi2 di ready function ==============================================================
	$(document).ready(function(){
		//load data saat refresh halaman
		loadData();
		$('form').on('submit', submitForm);
		//panggil fungsi cekPoin (validasi)
		$('#pointTB').on('input paste',function(){
			cekPoin($(this).val());
		});

		$('#id_mkotaTB').on('change',function(){
			combomdonatur('',$(this).val());
		});

		$('#namaTS').on('keyup',loadData);
		$('#j_kelaminTS').on('change',loadData);
		$('#alamatTS').on('keyup',loadData);
		$('#kode_posTS').on('keyup',loadData);
		$('#mpropinsiTS').on('keyup',loadData);
		$('#mkotaTS').on('keyup',loadData);
		$('#mkecamatanTS').on('keyup',loadData);
		$('#telpTS').on('keyup',loadData);
		$('#hpTS').on('keyup',loadData);
		$('#emailTS').on('keyup',loadData);
		$('#mkatdonaturTS').on('keyup',loadData);
		$('#mtipebayarTS').on('keyup',loadData);

		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			combomkota('');
			// combomdonatur('');
			// combombukeg('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH DONATUR').fadeIn();
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
	
	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var aksi ='aksi=tampil';
		var cari ='&namaS='+$('#namaTS').val()
				 +'&j_kelaminS='+$('#j_kelaminTS').val()
				 +'&alamatS='+$('#alamatTS').val()
				 +'&kode_posS='+$('#kode_posTS').val()
				 +'&mpropinsiS='+$('#mpropinsiTS').val()
				 +'&mkotaS='+$('#mkotaTS').val()
				 +'&mkecamatanS='+$('#mkecamatanTS').val()
				 +'&telpS='+$('#telpTS').val()
				 +'&hpS='+$('#hpTS').val()
				 +'&emailS='+$('#emailTS').val()
				 +'&mkatdonaturS='+$('#mkatdonaturTS').val()
				 +'&mtipebayarS='+$('#mtipebayarTS').val();

		$.ajax({
			url	: dir,
			type: 'get',
			data: aksi+cari,
			// data: $('#cariFR').serialize(),
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR DONATUR');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
	
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari ='&namaS='+$('#namaTS').val()
				 +'&j_kelaminS='+$('#j_kelaminTS').val()
				 +'&alamatS='+$('#alamatTS').val()
				 +'&kode_posS='+$('#kode_posTS').val()
				 +'&propinsiS='+$('#propinsiTS').val()
				 +'&mkotaS='+$('#mkotaTS').val()
				 +'&kecamatanS='+$('#kecamatanTS').val()
				 +'&telpS='+$('#telpTS').val()
				 +'&hpS='+$('#hpTS').val()
				 +'&emailS='+$('#emailTS').val()
				 +'&maktdonaturS='+$('#maktdonaturTS').val();
 				 +'&mtipebayarS='+$('#mtipebayarTS').val();

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

	function combomkota(id_mkota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mkota',
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
				}
			}
		});
	}

	function combomdonatur(id_mdonatur,id_mkota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mdonatur&id_mkota='+id_mkota+'&id_mdonatur='+id_mdonatur,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					$('#id_mdonaturTB').html('<option value="">kosong</option>');
				}else{
					var optiony ='';
					$.each(data, function (id,item){
						if(item.id_mdonatur==id_mdonatur){
							optiony+='<option selected="selected" value='+item.id_mdonatur+'>'+item.mdonatur+' </option>';
						}else{
							optiony+='<option value='+item.id_mdonatur+'>'+item.mdonatur+' </option>';
 						}
					});
					$('#id_mdonaturTB').html('<option value="">pilih kecamatan ..</option>'+optiony);
				}
			}
		});
	}

	function combombukeg(id_mbukeg){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mbukeg',
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					//$('#id_kegTB').html('<option value="">anda telah mengambil semua kegiatan ini</option>');
				}else{
					var optiony ='';
					$.each(data, function (id,item){
						if(item.id_mbukeg==id_mbukeg){
							optiony+='<option selected="selected" value='+item.id_mbukeg+'>'+item.mbukeg+' </option>';
						}else{
							optiony+='<option value='+item.id_mbukeg+'>'+item.mbukeg+'</option>';
 						}
					});
					$('#id_mbukegTB').html('<option value="">pilih Bukti Kegiatan ..</option>'+optiony);
				}
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
		
		var id_mdonatur = +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_mdonatur='+id_mdonatur;
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
	function hapusmdonatur(id){
		if(confirm('melanjutkan untuk menghapus data?'))
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=hapus&id_mdonatur='+id,
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
	function editmdonatur(id){
		kosongkan();
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=ambiledit&id_mdonatur='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					$('#idformTB').val(id); 
					$('#mdonaturTB').val(data.mdonatur);
					
					combomkota(data.id_mkota);

					$('#loadarea').html('<i class="icon-edit"></i> UBAH DONATUR').fadeIn();
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
		$('#malamatTB').val('');
		$('#subkatkegTB').val('');
		$('#mbukegTB').val('');
		$('#batutTB').val('');
		$('#jumbatutTB').val('');
		$('#poinTB').val('');
	}
	//end of kosongkan form

	function poShow(x,y){
		$('#po'+y+'_'+x).popover('show');
	}

	function poHide(x,y){
		$('#po'+y+'_'+x).popover('hide');
	}
		
	// function cari(){
	// 	loadData('');
	// }
	
	