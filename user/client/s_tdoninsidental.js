var dir='server/p_tdoninsidental.php';
	
	function combodkatdonatur(id_dkatdonatur){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=dkatdonatur',
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_dkatdonaturTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_dkatdonatur==id_dkatdonatur){
							optiony+='<option selected="selected" value='+item.id_dkatdonatur+'>'+item.dtipebayar+' ('+item.no_rek+') </option>';
						}else{
							optiony+='<option value='+item.id_dkatdonatur+'>'+item.dtipebayar+' ('+item.no_rek+')</option>';
						}
					});
					$('#id_dkatdonaturTB').html('<option value="">pilih Bank (no. rek) ..</option>'+optiony);
				}
			}
		});
	}

	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'aksi=tampil';
		var cari  =	'&nom_akhirS='+$('#nom_akhirTS').val()
					+'&dtipebayarS='+$('#dtipebayarTS').val()
					+'&no_rekS='+$('#no_rekTS').val()
					+'&isLunasS='+$('#isLunasTS').val();
	 $.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR DONASI SUKARELA');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
		
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari  =	'&nom_akhirS='+$('#nom_akhirTS').val()
					+'&dtipebayarS='+$('#dtipebayarTS').val()
					+'&no_rekS='+$('#no_rekTS').val()
					+'&isLunasS='+$('#isLunasTS').val();
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
	
	//validasi poin (harus angka)
	function isNumeric(poin){
		if( $('#pointTB').val() != $('#pointTB').val().replace(/[^0-9]/g, '')){ // cek hanya angka 
			$('#pointTB').val($('#pointTB').val().replace(/[^0-9]/g, ''));
		}
	}
	
	//hapus record kegiatan
	function hapustdonasi(id){
		if(confirm('melanjutkan untuk menghapus data?'))
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=hapus&id_tdonasi='+id,
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
	function edittdonasi(id,tipe){
		// alert(tipe);
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=ambiledit&id_tdonasi='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();

					$('#idformTB').val(id); 
					$('#typeH').val(tipe); 
					$('#id_ddonaturH').val(data.id_ddonatur); 

					$('#nom_akhirTB').val(data.nom_akhir); 
					if (tipe=='konfirmasi') { //upload bukti bayar
						$('#nom_akhirTB').attr('readonly',true);
						$('#id_dkatdonaturTB').html('<option selected="selected" value="'+data.id_dkatdonatur+'">'+data.dtipebayar+'('+data.no_rek+')</option>').attr('readonly',true);
						$('#buktiDV').removeAttr('style'); //tampilkan 
						$('#buktiTB').attr('required',true);
					}else{ // ubah biasa
						$('#buktiDV').attr('style','display:none'); //sembunyikan
						$('#buktiTB').removeAttr('required');
						combodkatdonatur(data.id_dkatdonatur);
					}
										
					$('#loadarea').html('<i class="icon-edit"></i> UBAH DONASI SUKARELA').fadeIn();
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
		$('#buktiTB').val('');
		$('#typeH').val('');
		$('#id_dkatdonaturTB').removeAttr('readonly');
		$('#nom_akhirTB').removeAttr('readonly');
		$('#id_dkatdonaturTB').val('');
		$('#nom_akhirTB').val('');
		$('#id_ddonaturH').val('');
	}
	//end of kosongkan form
	
	// panggil fungsi2 di ready function ==============================================================
	$(document).ready(function(){
		//load data saat refresh halaman
		loadData();
		
		$('#isLunasTS').on('change',function(){
			loadData();
		});

		$('#dtipebayarTS').on('keyup',function(){
			loadData();
		});

		$('#no_rekTS').on('keyup',function(){
			loadData();
		});

		$('#nom_akhirTS').on('keyup',function(){
			loadData();
		});
		
		$('form').on('submit', submitForm);
	
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			$('#buktiTB').removeAttr('required');
			$('#buktiDV').attr('style','display:none'); //sembunyikan
			combodkatdonatur('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH DONASI SUKARELA').fadeIn();
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
	
	function statddonatur (id_ddonatur) {
		$.ajax({
			url:dir,
			cache:false,
			data:'aksi=cek&id_ddonatur='+id_ddonatur,
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

	//fungsi tooltip_______________________________________________________________
	function tooltipx(event){
		$("[data-toggle=tooltip]").tooltip({ 
			//placement: 'right'
		});
	}
//end of fungsi tooltip________________________________________________________

	// function PreviewImage(par,x){
	function PreviewImage(par){
		var typex 	= par.files[0].type;
		var sizex	= par.files[0].size;
		var namex	= par.files[0].name;
		
		if(typex =='image/png'||typex =='image/jpg'||typex =='image/jpeg'|| typex =='image/gif'){ //validasi format
			if(sizex>(900*900)){ //validasi size
				alert('size max 1 MB');
				// $('#viewimg_'+x).html('<span class="label label-important">ukuran max 1 MB</span>');
				$('#buktiTB').val('');
				return false;	
			}
		}else{ // format salah
			alert('hanya image : .jpg,png,gif  ');
			// $('#viewimg_'+x).html('<img src="../img/loader.gif">');
			// $('#viewimg_'+x).html('<span class="label label-important">hanya file gambar(.jpg,.jpeg,.png,.gif)</span>');
			$('#buktiTB').val('');
			return false;
		}
	}

	function submitForm(event){
		event.stopPropagation();
		event.preventDefault();

		//add image
		var files =new Array();
		$("input:file").each(function() {
			files.push($(this).get(0).files[0]); 
		});
		
		//cek ada ada upload gambar / tidak
			var isUpload;
			if($("input:file").val()==''){
				isUpload = 0;
				console.log(isUpload);
			}else{
				isUpload = 1;
				console.log(isUpload);
			}
		//end of cek ada ada upload gambar / tidak
		 
		// Create a formdata object and add the files
		var filesAdd = new FormData();
		$.each(files, function(key, value){
			filesAdd.append(key, value);
		});
		//console.log(filesAdd);return false;
		
		//tipe submit (add or edit )
		var idform= $('#idformTB').val();
		var tipex = $('#typeH').val();
		// alert(tipex);return false;
		if(idform!=''){ //edit / konfrmasi
			if(tipex=='konfirmasi'){ //konfr
				uploadFiles('edit',filesAdd,idform);
				console.log('edit : + -');
			}else{ //edit
				if($('#buktiTB').val()!=''){ // ganti gambar 

				}else{// gak ganti gambar 

				}
				uploadFiles('edit','',idform);
				console.log('edit : 0 0');
			}
		}else{ // add data
			saveData('add','','');
			console.log('add : + 0');	// + 0
		}
	}

	function uploadFiles(tipe,dataAdd,id){
		$('#loadarea').html('<img src="../img/loader.gif"> ').fadeIn();
		if(dataAdd!=''){ // add / edit : +
			$.ajax({
				// url: dir2+'?files&tipe='+tipe+'&idform='+id,
				url: dir+'?aksi=uploadimg&tipe='+tipe+'&id_tdonasi='+id,
				type: 'POST',
				data: dataAdd,
				cache: false,
				dataType: 'json',
				processData: false,// Don't process the files
				contentType: false,//Set content type to false as jq 'll tell the server its a query string request
				success: function(data, textStatus, jqXHR){
					if(typeof data.error === 'undefined'){ //gak error
						saveData(tipe,data,id);
						console.log('sukses upload');
					}else{ //error
						console.log('ERRORS upload : ' + data.error);
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					console.log('ERRORS upload2: ' + textStatus);
					$('#loadarea').html('<img src="../img/loader.gif"> ').fadeOut();
				}
			});
		}else{ // add / edit : 0
			saveData(tipe,'',id);
		}
    }
	
	// simpan data ke database
	function saveData(typ,add,idx){
		var datax='';
		
		var formData = $('form').serialize();
		if(add!=''){ // ada upload file nya
			$.each(add.files, function(key, value){
				formData +='&fileadd[]=' + value ;
			});
		}else{ // tanpa upload file nya
			formData  += formData;
		}

		if(typ=='add'){ //add 
			aksi='tambah';
		}else{ // konf
			aksi='uploadsave&id_tdonasi='+idx;
		}
		// alert(aksi);return false;

		$.ajax({
			url: dir+'?aksi='+aksi,
            type:'POST',
            data:formData,
            cache:false,
            dataType: 'json',
            success: function(data, textStatus, jqXHR){
            	if(typeof data.error === 'undefined'){
            		// Success so call function to process the format
            		// idkatx += formData.kategoriTB;

					console.log('SUCCESS savedata1: ' + data);
            	}else{
					// Handle errors here
            		console.log('ERRORS savedata1: ' + data.error);
            	}
            },
            error: function(jqXHR, textStatus, errorThrown){
            	// Handle errors here
            	console.log('ERRORS savedata2: ' + textStatus);
            },
            complete: function(){
   				// STOP LOADING SPINNER
            	$('#loadarea').html('<img src="../img/loader.gif"> ').fadeOut();
				alert('data tersimpan');
				$('#i_kegPN').toggle(1000);
				$('#v_kegPN').toggle();
				$('#addBC').toggle();
				$('#viewBC').toggle();
				// console.log(idkatx);
				//return false;
				//loadData('tampil',idkatx,'');
				loadData('');
            	$('#loadarea').html('DAFTAR DONASI SUKARELA').fadeIn();
				kosongkan();
			}
		});
	}
