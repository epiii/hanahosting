var dir='server/p_mmarketer.php';
	
	function combommarketer(id_mlogin){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mmarketer',
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
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR MARKETER');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
	
	//submit form
	function submitForm(event){
		event.stopPropagation();
		event.preventDefault();
		
		var id_mmarketer = $('#idformTB').val()
		var urlx =dir+'?';
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_mmarketer='+id_mmarketer;
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
	function hapusmmarketer(id){
		if(confirm('melanjutkan untuk menghapus data?'))
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=hapus&id_mmarketer='+id,
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
	function editmmarketer(id){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=ambiledit&id_mmarketer='+id,
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
					
					$('#loadarea').html('<i class="icon-edit"></i> UBAH MARKETER').fadeIn();
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
		// $('#id_mmarketerH').val('');
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
		loadData();
		
		$('#form1').on('submit', submitForm);
		// $('form#lokasiFR').on('submit', submitForm);
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			combommarketer('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH MARKETER').fadeIn();
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

	function statmmarketer(id_mmarketer,isActive) {
		$.ajax({
			url:dir,
			cache:false,
			data:'aksi=cek&id_mmarketer='+id_mmarketer+'&isActive='+isActive,
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

	function viewlokasi (id_mmarketer) {
		$.ajax({
			url:dir,
			cache:false,
			data:'aksi=viewlokasi&id_mmarketer='+id_mmarketer,
			dataType:'json',
			success:function(data){
				$('#id_mmarketerH').val(id_mmarketer);
				var tb='';
				if(data.status!='sukses'){
					tb+='<tr class="warning">'
							+'<td>-</td>'
							+'<td>-</td>'
							+'<td>-</td>'
							+'<td>-</td>'
							+'<td>-</td>'
						+'</tr>';
				}else{
					var no=1;
					$.each(data.datax,function(id,item){
						tb+='<tr>'
								+'<td>'+no+'</td>'
								+'<td>'+item.mpropinsi+'</td>'
								+'<td>'+item.mkota+'</td>'
								+'<td style="color:blue;font-weight:bold;">'+item.mkecamatan+'</td>'
								+'<td>'
									+'<a href="javascript:hapuslokasi('+item.id_dmarketer+');">'
										+'<i class="icon-remove"></i>'
									+'</a>'
								  +'</td>'
							+'</tr>';
						no++;
					});
				}
				$('#isi2').html(tb);
				poplokasi();
			}
		});
	}

	function poplokasi () {
		$('#popMe').modal('show');
	}

	function hapuslokasi (id_dmarketer) {
		if(id_dmarketer===''){
			$('#tr').fadeOut('slow',function(){$('#tr').remove();});
			$('#addBC2').toggle();
		}else{
			if(confirm('melanjutkan menghapus ?')){
				$.ajax({
					url:dir,
					type:'get',
					data:'aksi=hapuslokasi&id_dmarketer='+id_dmarketer,
					dataType:'json',
					success:function(data){
						if(data.status!='sukses'){
							alert(data.status);
						}else{
							viewlokasi($('#id_mmarketerH').val());
						}
					}
				});
			}
		}
	}

	function tmbhlokasi () {
		tr='<tr id="tr">'
				// +'<form id="lokasiFR" onSubmit="return simpanlokasi(this);">'
					+'<td></td>'
					+'<td><select onchange="combomkota(this);" name="id_mpropinsiTB" id="id_mpropinsiTB" required class="span1"><option value="">Silahkan Pilih propinsi..</option></select></td>'
					+'<td><select onchange="combomkecamatan(this);" name="id_mkotaTB" id="id_mkotaTB" required class="span1"><option value="">Silahkan Pilih propinsi dahulu..</option></select></td>'
					+'<td><select name="id_mkecamatanTB"id="id_mkecamatanTB" required class="span1"><option value="">Silahkan Pilih kota dahulu..</option></select></td>'
					+'<td>'
						+'<button onclick="simpanlokasi();" class="btn">'
							+'<i class="icon-ok"></i>'
						+'</button>'
						+'<button class="btn" onclick="hapuslokasi(\'\');">'
							+'<i class="icon-remove"></i>'
						+'</button>'
					+'</td>'
				// +'</form>'
			+'</tr>';
		$('#isi2').prepend(tr);
		combompropinsi('');
		$('#addBC2').toggle();
	}

	function simpanlokasi(){
		if ($('#id_mkecamatanTB').val()=='') {
			alert('silahkan pilih kecamatan');
			return false;
		} else{
			$.ajax({
				url:dir+'?aksi=tambahlokasi',
				type:'post',
				dataType:'json',
				data:'id_mkecamatan='+$('#id_mkecamatanTB').val()+'&id_mmarketer='+$('#id_mmarketerH').val(),
				success:function(data){
					if(data.status=='sukses'){
						viewlokasi($('#id_mmarketerH').val());
						$('#addBC2').toggle();
					}else{
						alert(data.status);
					}
				}
			});
		}
	}

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

	function combomkota(id_mpropinsi){
		$.ajax({
			url:dir,
			type:'get',
			cache:false,
			data:'aksi=combo&menu=mkota&id_mpropinsi='+$(id_mpropinsi).val(),
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_mkotaTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						optiony+='<option value='+item.id_mkota+'>'+item.mkota+' </option>';
					});
					$('#id_mkotaTB').html('<option value="">pilih kota ..</option>'+optiony);
				}
			}
		});
	}

	function combomkecamatan(id_mkota){
		$.ajax({
			url:dir,
			type:'get',
			cache:false,
			data:'aksi=combo&menu=mkecamatan&id_mkota='+$(id_mkota).val(),
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_mkecamatanTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						optiony+='<option value='+item.id_mkecamatan+'>'+item.mkecamatan+' </option>';
					});
					$('#id_mkecamatanTB').html('<option value="">pilih kecamatan ..</option>'+optiony);
				}
			}
		});
	}

