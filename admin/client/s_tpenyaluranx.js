var dir='server/p_tpenyaluran.php';
	
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
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR DAFTAR PENYALURAN DANA (Beasiswa)');
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
	
	//submit form
	function submitForm(event){
		event.stopPropagation();
		event.preventDefault();
		
		var id_tdonasi =$('#idformTB').val()
		var urlx =dir+'?';
		
		/*if(typex =='image/png'||typex =='image/jpg'||typex =='image/jpeg'|| typex =='image/gif'){ //validasi format
			if(sizex>(900*900)){ //validasi size
				$('#viewimg_'+x).html('<span class="label label-important">ukuran max 1 MB</span>');
				$('#bukegTB_'+x).val('');
				return false;
			}else{ 
				$('#viewimg_'+x).html('<img src="../img/loader.gif">');
			}
		}else{ // format salah
			$('#viewimg_'+x).html('<img src="../img/loader.gif">');
			$('#viewimg_'+x).html('<span class="label label-important">hanya file gambar(.jpg,.jpeg,.png,.gif)</span>');
			$('#bukegTB_'+x).val('');
			return false;
		}
*/
		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit / konfirm
			urlx += 'aksi=ubah&id_tdonasi='+id_tdonasi;
		}

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
					$('#id_ddonaturH').val(data.id_ddonatur); 

					$('#nom_akhirTB').val(data.nom_akhir); 
					if (tipe=='konfirmasi') { //upload bukti bayar
						$('#nom_akhirTB').attr('readonly',true);
						$('#id_dkatdonaturTB').html('<option selected="selected" value="'+data.id_dkatdonatur+'">'+data.dtipebayar+'('+data.no_rek+')</option>').attr('readonly',true);
						$('#buktiDV').removeAttr('style'); //tampilkan 
						// $('#buktiDV').toggle();
					}else{ // ubah biasa
						$('#buktiDV').attr('style','display:none'); //sembunyikan
						combodkatdonatur(data.id_dkatdonatur);
					}
										
					$('#loadarea').html('<i class="icon-edit"></i> UBAH DAFTAR PENYALURAN DANA (Beasiswa)').fadeIn();
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
			$('#buktiDV').attr('style','display:none'); //sembunyikan
			combodkatdonatur('');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH DAFTAR PENYALURAN DANA (Beasiswa)').fadeIn();
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


	//funggsi ketika submit form 
	var filesDel = new Array();
	function submitForm(event){
		event.stopPropagation(); // mencegah reload / refresh halaman saat submit form
		event.preventDefault(); // mencegah reload / refresh halaman saat submit form
			
			$(".vwimg:hidden", "#imgTB").each(function() {
				filesDel.push($(this).attr('idx')); // array menampung gambar yang telah di del (temporary)
			});
			var jumDel = filesDel.length; // hitung jumlah element array
			
		//add imagew
			var files = new Array();
			$("input:file").each(function() {
				files.push($(this).get(0).files[0]); //array menampung gambar yang telah di add (temporary)  
			});
			var jumAdd=files.length; //hitung jumlah element array 
			
	        // Create a formdata object and add the files
			var filesAdd = new FormData();
			$.each(files, function(key, value){
				filesAdd.append(key, value); //variabel object form : menampung gambar yg telah di add / del (temporary)  
			});

			imgInfo(); //run fungsi imgInfo 

			//fungsi  untuk validasi + meneruskan submit ke fungsi selanjutnya
			function imgInfo(){
				var jumImg = $('.imgTR:visible','#imgTB').length; //hitung jumlah gambar bkeg bukeg  dalam form 
				if(jumImg==0){// ksong
					$('#imgInfo').fadeIn(function(){
						$('#imgInfo').html('minimal unggah 1 bukti kegiatan(scan/gambar)'); //notif eror =>harus browse gambar 
					});

					//efek untuk menghilangkan notif secara perlahan dalam interval 3000 milisecond = 3 detik
					setTimeout(function(){
						$('#imgInfo').fadeOut(1000,function(){
							$('#imgInfo').html(''); 
						});
					},3000);
				}else{ // ada gambar
					$('#imgInfo').html('');
					//tipe submit (add or edit )
					var iddtk = $('#idformTB').val();
					if(iddtk>0){ //edit data
						if(jumDel==0 && jumAdd==0){ 			// 0 0
							uploadFiles('edit','','',iddtk); //panggil fungsi uploadFiles
							console.log('edit : 0 0');
						}else if (jumAdd>0 && jumDel==0){ 		// + 0
							uploadFiles('edit',filesAdd,'',iddtk);
							console.log('edit : + 0');
						}else if(jumAdd==0 && jumDel>0){ 		// 0 -
							uploadFiles('edit','',filesDel,iddtk);
							console.log('edit : 0 -');
						}else{ 									// + -
							uploadFiles('edit',filesAdd,filesDel,iddtk);
							console.log('edit : + -');
						}
					}else{ // add data
						uploadFiles('add',filesAdd,'','');
						console.log('add : + 0');				// + 0
					}
				}
			}
		}
	//end of submit form 
	
	// fungsi untuk upload gambar (bukeg) 
	function uploadFiles(tipe,dataAdd,dataDel,id){
		$('#loadarea').html('<img src="../img/loader.gif"> ').fadeIn();
		
		if(dataAdd!=''){ // add / edit : +
			$.ajax({
				url: dir2+'?files&tipe='+tipe+'&iddtk='+id,
				type: 'POST',
				data: dataAdd,
				cache: false,
				dataType: 'json',
				processData: false,// Don't process the files
				contentType: false,//Set content type to false as jq 'll tell the server its a query string request
				success: function(data, textStatus, jqXHR){
					if(typeof data.error === 'undefined'){ //gak error
						saveData(tipe,data,dataDel,id); //run fungsi saveData untuk menyimpan data kegiatn + nama file(gambar) ke dalam db 
					}else{ //eerror
						console.log('ERRORS upl: ' + data.error);
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					console.log('ERRORS: ' + textStatus);
					$('#loadarea').html('<img src="../img/loader.gif"> ').fadeOut();
				}
			});
		}else{ // add / edit : 0
			saveData(tipe,'',dataDel,id); //run fungsi saveData 
		}
    }
	
	// simpan data ke database
	function saveData(typ,add,del,idx){
		var datax='';
		
		var formData = $('form').serialize();
		if(add!=''){ // ada upload file nya
			if(del!=''){ 		// edit : + -
				$.each(add.files, function(key, value){
					formData +='&fileadd[]=' + value ;
				});
				$.each(del, function(key, value){
					formData +='&filedel[]=' + value ;
				});
			}else{ 				// edit : + 0
				$.each(add.files, function(key, value){
					formData = formData + '&fileadd[]=' + value;
				});
			}
		}else{ // tanpa upload file nya
			if(del!=''){ 		// edit : 0 -
				$.each(del, function(key, value){
					formData =formData + '&filedel[]=' + value ;
				});
			}else{ 				// edit : 0 0
				formData  = formData;
			}
		}
		
		//proses simpan data (nama file upload & data form)
		var idkatx ;//= 2; 
		$.ajax({
			url: dir2,
            type: 'POST',
            data: formData,
            cache: false,
            dataType: 'json',
            success: function(data, textStatus, jqXHR){
            	if(typeof data.error === 'undefined'){
            		// Success so call function to process the form
            		idkatx = data.formData.id_katkegTB;
					console.log('SUCCESS: ' + data.success);
            	}else{
					// Handle errors here
            		console.log('ERRORS submt: ' + data.error);
            	}
            },

            error: function(jqXHR, textStatus, errorThrown){
            	// Handle errors here
            	console.log('ERRORS: ' + textStatus);
            },
            complete: function(){
   				// STOP LOADING SPINNER
            	$('#loadarea').html('<img src="../img/loader.gif"> ').fadeOut();
				alert('data tersimpan');
				$('#i_kegPN').toggle(1000);
				$('#v_kegPN').toggle();
				$('#addBC').toggle();
				$('#viewBC').toggle();
				loadData('tampil',idkatx,'');
            	$('#loadarea').html('VIEW KEGIATAN').fadeIn();
				kosongkan();
			}
		});
	}
