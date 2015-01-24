var dir='server/p_madmin.php';
	
	function combomadmin(id_mlogin){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=madmin',
			dataType:'json',
			success:function(data){
				if(data.status=='S gagal'){
					//$('#id_kegTB').html('<option value="">anda telah mengambil semua kegiatan ini</option>');
				}else{
					var optiony ='';
					$.each(data, function (id,item){
						// if(item.username==id_mlogin){
						if(item.id_mlogin==id_mlogin){
							optiony+='<option selected="selected" value='+item.id_mlogin+'>'+item.username+' </option>';
						}else{
							optiony+='<option value='+item.id_mlogin+'>'+item.username+' </option>';
						}
					});
					$('#id_mloginTB').html('<option value="">Pilih Username..</option>'+optiony);
					//combopt(id_pt);
				}
			}
		});
	}

	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'aksi=tampil';
		var cari ='&namaS='+$('#namaTS').val()
				 +'&no_telpS='+$('#no_telpTS').val()
				 +'&emailS='+$('#emailTS').val();
		$.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR ADMINISTRATOR');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
	
	//submit form
	function submitForm(event){
		event.stopPropagation();
		event.preventDefault();
		
		var id_madmin = +$('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_madmin='+id_madmin;
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
	function hapusmadmin(id){
		if(confirm('melanjutkan untuk menghapus data?'))
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=hapus&id_madmin='+id,
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
	function editmadmin(id){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=ambiledit&id_madmin='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
					
					$('#idformTB').val(id); 
					$('#id_mloginH').val(data.id_mlogin);
					$('#namaTB').val(data.nama);
					$('#no_telpTB').val(data.no_telp);
					$('#emailTB').val(data.email);
					
					$('#loadarea').html('<i class="icon-edit"></i> UBAH ADMINISTRATOR').fadeIn();
					$('#i_kegPN').toggle(1000);
					$('#v_kegPN').toggle();
					$('#viewBC').toggle();
					$('#addBC').toggle();
					// alert('asem');
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
		$('#id_mloginTB').val('');
		$('#namaTB').val('');
		$('#notelTB').val('');
		$('#emailTB').val('');
	}
	//end of kosongkan form

		
	//function pagination(page,aksix,menux,carix){
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari ='&namaS='+$('#namaTS').val()
				 +'&no_telpS='+$('#no_telpTS').val()
				 +'&emailS='+$('#emailTS').val();
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
		
		$('form').on('submit', submitForm);
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			combomadmin('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH ADMINISTRATOR').fadeIn();
		});
		
			$('#namaTS').on('keyup',loadData);
			$('#no_telpTS').on('keyup',loadData);
			$('#emailTS').on('keyup',loadData);
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
		//fungsi tooltip_______________________________________________________________
	function tooltipx(event){
		$("[data-toggle=tooltip]").tooltip({ 
			//placement: 'right'
		});
	}

	function statmadmin(id_madmin,isActive) {
		$.ajax({
			url:dir,
			cache:false,
			data:'aksi=cek&id_madmin='+id_madmin+'&isActive='+isActive,
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					alert(data.status);
				}else{
					loadData();
				}
			}
		});
	}

