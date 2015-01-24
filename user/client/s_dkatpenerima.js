var dir='server/p_dkatpenerima.php';
// var dir='server/p_mkota.php';
	
	function combomkatpenerima(id_mkatpenerima){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mkatpenerima',
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_mkatpenerimaTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_mkatpenerima==id_mkatpenerima){
							optiony+='<option selected="selected" value='+item.id_mkatpenerima+'>'+item.katpenerima+' </option>';
						}else{
							optiony+='<option value='+item.id_mkatpenerima+'>'+item.katpenerima+' </option>';
						}
					});
					// alert(optiony);
					$('#id_mkatpenerimaTB').html('<option value="">pilih DETAIL kategori penerima ..</option>'+optiony);
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
					// alert(optiony);
					$('#id_mjenjangTB').html('<option value="">pilih kategori jenjang..</option>'+optiony);
				}
			}
		});
	}

	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'aksi=tampil';
		var cari ='&katpenerimaS='+$('#katpenerimaTS').val()
				 +'&mjenjangS='+$('#mjenjangTS').val()
				 +'&nominalS='+$('#nominalTS').val()
				 +'&statusS='+$('#statusTS').val();

		$.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR DETAIL KATEGORI PENERIMA');
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
		
		var id_dkatpenerima = +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_dkatpenerima='+id_dkatpenerima;
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
			data:'aksi=hapus&id_dkatpenerima='+id,
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
			data:'aksi=ambiledit&id_dkatpenerima='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
					
					$('#idformTB').val(id); 
					// $('#id_mkatpenerimaTB').val(data.id_mkatpenerima);
					$('#nominalTB').val(data.nominal);
					$('#statusTB').val(data.status);
					
					combomkatpenerima(data.id_mkatpenerima);
					combomjenjang(data.id_mjenjang);
					
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
		$('#id_mkatpenerimaTB').val('');
		$('#id_mjenjangTB').val('');
		$('#nominalTB').val('');
		$('#statusTB').val('');
	}
	//end of kosongkan form

		
	//function pagination(page,aksix,menux,carix){
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari ='&katpenerimaS='+$('#katpenerimaTS').val()
				 +'&mjenjangS='+$('#mjenjangTS').val()
				 +'&nominalS='+$('#nominalTS').val()
				 +'&statusS='+$('#statusTS').val();

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
		
		$('#katpenerimaTS').on('keyup', loadData);
		$('#mjenjangTS').on('keyup', loadData);
		$('#nominalTS').on('keyup', loadData);
		$('#statusTS').on('keyup', loadData);
		//panggil fungsi cekPoin (validasi)
		$('#pointTB').on('input paste',function(){
			cekPoin($(this).val());
		});
		
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			combomkatpenerima('');
			combomjenjang('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH DETAIL KATEGORI PENERIMA DONASI').fadeIn();
		});
			$('#mkotaTS').on('keyup',loadData);
			$('#mpropinsiTS').on('keyup',loadData);
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
	