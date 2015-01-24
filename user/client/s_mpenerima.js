var dir='server/p_mpenerima.php';
	
	function combompropinsi(el,id_mpropinsi){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mpropinsi',
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$(el).html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_mpropinsi==id_mpropinsi){
							optiony+='<option selected="selected" value='+item.id_mpropinsi+'>'+item.mpropinsi+' </option>';
						}else{
							optiony+='<option value='+item.id_mpropinsi+'>'+item.mpropinsi+' </option>';
						}
					});
					$(el).html('<option value="">pilih Propinsi ..</option>'+optiony);
				}
			}
		});
	}

	function combomkota(el,id_mpropinsi,id_mkota){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mkota&id_mpropinsi='+id_mpropinsi,
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$(el).html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_mkota==id_mkota){
							optiony+='<option selected="selected" value='+item.id_mkota+'>'+item.mkota+' </option>';
						}else{
							optiony+='<option value='+item.id_mkota+'>'+item.mkota+' </option>';
						}
					});
					$(el).html('<option value="">pilih Kota ..</option>'+optiony);
				}
			}
		});
	}

	function combomkecamatan(el,id_mkota,id_mkecamatan){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mkecamatan&id_mkota='+id_mkota,
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$(el).html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_mkecamatan==id_mkecamatan){
							optiony+='<option selected="selected" value='+item.id_mkecamatan+'>'+item.mkecamatan+' </option>';
						}else{
							optiony+='<option value='+item.id_mkecamatan+'>'+item.mkecamatan+' </option>';
						}
					});
					$(el).html('<option value="">pilih Kecamatan ..</option>'+optiony);
				}
			}
		});
	}

	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'aksi=tampil';
		var cari ='&nm_lengkapS='+$('#nm_lengkapTS').val()
					+'&nm_panggilanS ='+$('#nm_panggilanTS').val()
					+'&anak_keS      ='+$('#anak_keTS').val()
					+'&jml_sdrS      ='+$('#jml_sdrTS').val()
					+'&j_kelaminS    ='+$('#j_kelaminTS').val()
					+'&tmp_lahirS    ='+$('#tmp_lahirTS').val()
					+'&tgl_lahirS    ='+$('#tgl_lahirTS').val()
					+'&alamatpS      ='+$('#alamatpTS').val()
					+'&agamaS        ='+$('#agamaTS').val()
					+'&no_telpS      ='+$('#no_telpTS').val()
					+'&emailS        ='+$('#emailTS').val()
					+'&asramaS       ='+$('#asramaTS').val()
					+'&status_sosS   ='+$('#status_sosTS').val()
					+'&isActiveS     ='+$('#isActiveTS').val();	
	 $.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR PENERIMA');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
		
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari ='&nm_lengkapS='+$('#nm_lengkapTS').val()
					+'&nm_panggilanS ='+$('#nm_panggilanTS').val()
					+'&anak_keS      ='+$('#anak_keTS').val()
					+'&jml_sdrS      ='+$('#jml_sdrTS').val()
					+'&j_kelaminS    ='+$('#j_kelaminTS').val()
					+'&tmp_lahirS    ='+$('#tmp_lahirTS').val()
					+'&tgl_lahirS    ='+$('#tgl_lahirTS').val()
					+'&alamatpS      ='+$('#alamatpTS').val()
					+'&agamaS        ='+$('#agamaTS').val()
					+'&no_telpS      ='+$('#no_telpTS').val()
					+'&emailS        ='+$('#emailTS').val()
					+'&asramaS       ='+$('#asramaTS').val()
					+'&status_sosS   ='+$('#status_sosTS').val()
					+'&isActiveS     ='+$('#isActiveTS').val();	
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
	
	
	
	//hapus record kegiatan
		function hapuspenerima(id){
			if(confirm('melanjutkan untuk menghapus data?'))
			$.ajax({
				url:dir,
				type:'get',
				data:'aksi=hapus&id_mpenerima='+id,
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
	function editpenerima(id){
		//alert('id: '+id);
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=ambiledit&id_mpenerima='+id,
			dataType:'json',
			success:function(data){
				if(data.status=='gagal'){
					alert('database error');
				}else{
					kosongkan();
					var id_mpenerimay		= data.id_mkecamatan;
					
					$('#idformTB').val(id); 
					// $('#id_mkecamatanTB').val(data.id_mkecamatan);
					$('#nm_lengkapTB').val(data.nm_lengkap);
					$('#nm_panggilanTB').val(data.nm_panggilan);
					$('#anak_keTB').val(data.anak_ke);
					$('#jml_sdrTB').val(data.jml_sdr);
					$('#j_kelaminTB').val(data.j_kelamin);
					$('#tmp_lahirTB').val(data.tmp_lahir);
					$('#tgl_lahirTB').val(data.tgl_lahir);
					$('#malamatpTB').val(data.malamat);
					$('#agamaTB').val(data.agama);
					$('#no_telpTB').val(data.no_telp);
					$('#emailTB').val(data.email);
					$('#asramaTB').val(data.asrama);
					$('#status_sosTB').val(data.status_sos);
					$('#isActiveTB').val(data.isActive);
					$('#nm_ayahTB').val(data.nm_ayah);
					$('#job_ayahTB').val(data.job_ayah);
					$('#gaji_ayahTB').val(data.gaji_ayah);
					$('#stat_ayahTB').val(data.stat_ayah);
					$('#nm_ibuTB').val(data.nm_ibu);
					$('#job_ibuTB').val(data.job_ibu);
					$('#gaji_ibuTB').val(data.gaji_ibu);
					$('#stat_ibuTB').val(data.stat_ibu);
					$('#malamatoTB').val(data.id_malamat);
					$('#id_mpropoTB').val(data.id_mpropinsi);
					$('#id_mkotoTB').val(data.id_mkota);
					$('#id_mkecoTB').val(data.id_mkecamatan);
					$('#nm_waliTB').val(data.nm_wali);
					$('#job_waliTB').val(data.job_wali);
					$('#gaji_waliTB').val(data.gaji_wali);
					$('#malamatwTB').val(data.id_malamat);
					$('#kodeposwTB').val(data.kode_pos);
					$('#id_mprowTB').val(data.id_mpropinsi);
					$('#id_mkotwTB').val(data.id_mkota);
					$('#id_mkecwTB').val(data.id_mkecamatan);
					combomkecamatan(data.el,data.id_mkecamatan);
					combompropinsi(data.id_mpropinsi);
					combomkota(data.id_mkota);
					
					$('#loadarea').html('<i class="icon-edit"></i> UBAH PENERIMA DONASI').fadeIn();
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
		$('#nm_lengkapTB').val('');
		$('#nm_panggilanTB').val('');
		$('#anak_keTB').val('');
		$('#jml_sdrTB').val('');
		$('#j_kelaminTB').val('');
		$('#tmp_lahirTB').val('');
		$('#tgl_lahirTB').val('');
		$('#malamatpTB').val('');
		$('#agamaTB').val('');
		$('#no_telpTB').val('');
		$('#emailTB').val('');
		$('#asramaTB').val('');
		$('#status_sosTB').val('');
		$('#isActiveTB').val('');
	}
	//end of kosongkan form
	
	// panggil fungsi2 di ready function ==============================================================
	$(document).ready(function(){
		//load data saat refresh halaman
		
		loadData();
		$('#tugelTB').on('change',function(){
			if($(this).is(':checked')){ // centang
				$('.tugel').removeAttr('style');
				$('.tugel').attr('required',true);
			}else{ // g centang
				$('.tugel').attr('style','display:none');
				$('.tugelTB').removeAttr('required');
			}
		});
		$('.tugel').attr('style','display:none');
		$('#prestBC').click(function(){prestFC('add','');});

		prestFC('add',''); //menampilkan 1 input FILE bukeg

		// $('#tanggalTB').datepicker({
		// 	format:'yyyy-mm-dd',
		// 	// format:'yyyy/mm/dd',
		// });

		$('form').on('submit', submitForm);
		//masuk halaman "ADD DATA"
		$('#addBC').click(function(){
			$(this).toggle();
			kosongkan();
			combompropinsi('#id_mproppTB','');
			combompropinsi('#id_mpropoTB','');
			combompropinsi('#id_mpropwTB','');
			$('#i_kegPN').toggle(1000);
			$('#v_kegPN').toggle();
			$('#viewBC').toggle();
			$('#loadarea').html('<i class="icon-plus"></i> TAMBAH PENERIMA DONASI').fadeIn();
		});

		$('#nm_lengkapTS').on('keyup',loadData);
		$('#nm_panggilanTS').on('keyup',loadData);
		$('#anak_keTS').on('keyup',loadData);
		$('#jml_sdrTS').on('keyup',loadData);
		$('#j_kelaminTS').on('keyup',loadData);
		$('#tmp_lahirTS').on('keyup',loadData);
		$('#tgl_lahirTS').on('keyup',loadData);
		$('#alamatpTS').on('keyup',loadData);
		$('#agamaTS').on('keyup',loadData);
		$('#no_telpTS').on('keyup',loadData);
		$('#emailTS').on('keyup',loadData);
		$('#asramaTS').on('keyup',loadData);
		$('#status_sosTS').on('keyup',loadData);
		$('#isActiveTS').on('keyup',loadData);

		// kota
			$('#id_mproppTB').on('change', function(){
				combomkota('#id_mkotpTB',$(this).val(),'');
			});
			$('#id_mpropoTB').on('change', function(){
				combomkota('#id_mkotoTB',$(this).val(),'');
			});
			$('#id_mpropwTB').on('change', function(){
				combomkota('#id_mkotwTB',$(this).val(),'');
			});

		// kecamatan
			$('#id_mkotpTB').on('change', function(){
				combomkecamatan('#id_mkecpTB',$(this).val(),'');
			});
			$('#id_mkotoTB').on('change', function(){
				combomkecamatan('#id_mkecoTB',$(this).val(),'');
			});
			$('#id_mkotwTB').on('change', function(){
				combomkecamatan('#id_mkecwTB',$(this).val(),'');
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


	var i = 0;
	// prestTB('add',''); //menampilkan 1 input FILE bukeg

	//fungs untuk menampilkan bukti kegiatan (bukeg) / gambar
	function prestFC(tipe,arr){
		i+= 1;
		if(tipe=='add'){ // ketika add data
			$('#prestTB').slideDown(1000,function(){ // efek slide , munculnya element perlahan dari atas kebawah
				$('#prestTB').prepend( // prepend menambahakan element baru di awal tag
					'<tr class="prestTR" id="prestTR_add'+i+'">' 
						+'<td>'
							+'<input id="prest_' +i+ '" name="prest[]" value="'+i+'" type="hidden">'
							+'<input placeholder="instansi" xclass="span2" id="instansiTB_'+i+'" name="instansiTB[]" required>'
						+'</td>'
						+'<td>'
							+'<input placeholder="kompetisi" xclass="span2" id="kompetisiTB_'+i+'" name="kompetisiTB[]" required>'
						+'</td>'
						+'<td>'
							+'<input placeholder="tingkat" xclass="span1"  id="tingkatTB_'+i+'" name="tingkatTB[]" required>'
						+'</td>'
						+'<td>'
							+'<input placeholder="juara" class="span1"  id="juaraTB_'+i+'" name="juaraTB[]" required>'
						+'</td>'
						+'<td>'
							+'<input type="number" placeholder="tahun" maxlength="4" size="4" class="span1"  id="tahunTB_'+i+'" name="tahunTB[]" required>'
						+'</td>'
						+'<td>'
							+'<select class="span1"  id="katpresTB'+i+'" name="katpresTB[]" required>'
								+'<option value="akademik">Akademik</option>'
								+'<option value="non">Non Akademik</option>'
							+'</select>'
						+'</td>'
						// +'<td id="viewimg_'+i+'">'

						// +'</td>'
						+'<td >'
							+'<a class="hpsBC btn btn-secondary" '
							+'href="javascript:hapusTR(&quot;add&quot;,&quot;add'+i+'&quot;);">X</a>'
						+'</td>'
					+'</tr>'
				);
			});
		}else{ //ketika edit data
			var prestTR ='';
			//untuk menampilkan info status bukeg sudah divalidasi oleh admin atau belum
			$.each(arr, function(id,item){
				console.log(arr);
				var info,color;
				if(item.status=='valid'){
					info="data valid";
					color='label-info';
				}else if(item.status=='invalid'){
					info=item.keterangan;
					color='label-important';
				}else{
					info='pending';
					color='label-inverse';
				}

				prestTR+= 
					"<tr class='prestTR' id='prestTR_edit"+item.idbukeg+"'>" 
						+"<td><label class='label "+color+"'>"+info+"</label></td>"
						+"<td width='5%'>"
							+"<a class='btn btn-secondary' "
							+"href='javascript:hapusTR(&quot;edit&quot;,&quot;edit"+item.idbukeg+"&quot;);'>X</a>"
						+"</td>"
					+"</tr>";
			});
			$('#prestTB').append(prestTR); // menampilkan list bukeg ke dalam element ber-ID : imgTB
		}
	}

	//hapus gambar yang telah terpilih
	function hapusTR(tipe,id){
		if(tipe=='add'){
				$('#prestTR_'+id).fadeOut('slow',function(){$('#prestTR_'+id).remove();});
		}else{
			if(confirm('melanjutkan menghapus '+id+'?')){
				$('#prestTR_'+id).hide('slow');
			}
		}
	}
		
	//funggsi ketika submit form 
	var filesDel = new Array();
	function submitForm(event){
		event.stopPropagation(); 
		event.preventDefault(); 
		var datax        = $('form').serialize();
		var id_mpenerima = $('#idformTB').val()
		var urlx         = dir+'?';

		if($('#idformTB').val()==''){ //add
			urlx += 'aksi=tambah';
		}else{ //edit
			urlx += 'aksi=ubah&id_mpenerima='+id_mpenerima;
		}

		$.ajax({
			url: urlx,
			type: 'POST',
			data: datax,
			cache: false,
			dataType: 'json',
			success: function(data, textStatus, jqXHR){
				if(data.status=='sukses'){ //gak error
					alert('berhasil menambahkan penerima beasiswa');
					$('#i_kegPN').toggle(1000);
					$('#v_kegPN').toggle();
					$('#addBC').toggle();
					$('#viewBC').toggle();
					loadData();

					// saveData(tipe,data,dataDel,id); //run fungsi saveData untuk menyimpan data kegiatn + nama file(gambar) ke dalam db 
				}else{ //eerror
					alert(data.status);
					// console.log('ERRORS: ' + data.error);
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				console.log('ERRORS: ' + textStatus);
				$('#loadarea').html('<img src="../img/loader.gif"> ').fadeOut();
			}
		});
		// var datax=$('form').serializeArray();
		// console.log(datax);
		// console.log($('form').serialize());
		// return false;

			// $(".vwimg:hidden", "#imgTB").each(function() {
			// 	filesDel.push($(this).attr('idx')); // array menampung gambar yang telah di del (temporary)
			// });
			// var jumDel = filesDel.length; // hitung jumlah element array
			
		// //add imagew
		// 	var files =new Array();
		// 	$("input:file").each(function() {
		// 		files.push($(this).get(0).files[0]); //array menampung gambar yang telah di add (temporary)  
		// 	});
		// 	var jumAdd=files.length; //hitung jumlah element array 
			
	        // Create a formdata object and add the files
			// var prestAdd = new FormData();
			// var prestAdd = new Array();
			// $.each(files, function(key, value){
			// 	prestAdd.append(key, value); //variabel object form : menampung gambar yg telah di add / del (temporary)  
			// });

			// imgInfo(); //run fungsi imgInfo 

			//fungsi  untuk validasi + meneruskan submit ke fungsi selanjutnya
			function imgInfo(){
				var jumImg = $('.prestTR:visible','#imgTB').length; //hitung jumlah gambar bkeg bukeg  dalam form 
					$('#imgInfo').html('');
					//tipe submit (add or edit )
					var iddtk = $('#idformTB').val();
					if(iddtk>0){ //edit data
						if(jumDel==0 && jumAdd==0){ 			// 0 0
							uploadFiles('edit','','',iddtk); //panggil fungsi uploadFiles
							console.log('edit : 0 0');
						}else if (jumAdd>0 && jumDel==0){ 		// + 0
							uploadFiles('edit',prestAdd,'',iddtk);
							console.log('edit : + 0');
						}else if(jumAdd==0 && jumDel>0){ 		// 0 -
							uploadFiles('edit','',filesDel,iddtk);
							console.log('edit : 0 -');
						}else{ 									// + -
							uploadFiles('edit',prestAdd,filesDel,iddtk);
							console.log('edit : + -');
						}
					}else{ // add data
						uploadFiles('add',prestAdd,'','');
						console.log('add : + 0');				// + 0
					}
			}
		}
	//end of submit form 
	
	// fungsi untuk upload gambar (bukeg) 
	function uploadFiles(tipe,dataAdd,dataDel,id){
		$('#loadarea').html('<img src="../img/loader.gif"> ').fadeIn();
		
		if(dataAdd!=''){ // add / edit : +
			$.ajax({
				url: dir+'?aksi=tambah&tipe='+tipe+'&id_mpenerima='+id,
				type: 'POST',
				data: dataAdd,
				cache: false,
				dataType: 'json',
				// processData: false,// Don't process the files
				// contentType: false,//Set content type to false as jq 'll tell the server its a query string request
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

	//fungsi tooltip_______________________________________________________________
	function tooltipx(event){
		$("[data-toggle=tooltip]").tooltip({ 
			//placement: 'right'
		});
	}
//end of fungsi tooltip________________________________________________________

	function combomsekolah(id_msekolah){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=msekolah',
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_msekolahTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_msekolah==id_msekolah){
							optiony+='<option selected="selected" value='+item.id_msekolah+'>'+item.nama+' </option>';
						}else{
							optiony+='<option value='+item.id_msekolah+'>'+item.nama+' </option>';
						}
					});
					$('#id_msekolahTB').html('<option value="">pilih sekolah ..</option>'+optiony);
				}
			}
		});
	}

	function combomlembaga(id_mlembaga){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=mlembaga',
			dataType:'json',
			success:function(data){
				if(data.status!='sukses'){
					$('#id_mlembagaTB').html('<option value="">'+data.status+'</option>');
				}else{
					var optiony ='';
					$.each(data.datax, function (id,item){
						if(item.id_mlembaga==id_mlembaga){
							optiony+='<option selected="selected" value='+item.id_mlembaga+'>'+item.mlembaga+' </option>';
						}else{
							optiony+='<option value='+item.id_mlembaga+'>'+item.mlembaga+' </option>';
						}
					});
					$('#id_mlembagaTB').html('<option value="">pilih lembaga ..</option>'+optiony);
				}
			}
		});
	}


	function tmbhsekolah () {
		tr='<tr id="tr">'
				// +'<form id="lokasiFR" onSubmit="return simpanlokasi(this);">'
					+'<td></td>'
					+'<td><select name="id_msekolahTB" id="id_msekolahTB" required class="span1"><option value="">Silahkan Pilih Sekolah..</option></select></td>'
					+'<td><select name="id_mlembagaTB" id="id_mlembagaTB" required class="span1"><option value="">Silahkan Pilih lembaga penyalur..</option></select></td>'
					+'<td></td>'
					+'<td>'
						+'<button onclick="simpansekolah();" class="btn">'
							+'<i class="icon-ok"></i>'
						+'</button>'
						+'<button class="btn" onclick="hapusekolah(\'\');">'
							+'<i class="icon-remove"></i>'
						+'</button>'
					+'</td>'
				// +'</form>'
			+'</tr>';
		$('#isi2').prepend(tr);
		combomsekolah('');
		combomlembaga('');
		$('#addBC2').toggle();
	}

	function viewsekolah (id_mpenerima) {
		$.ajax({
			url:dir,
			cache:false,
			data:'aksi=viewsekolah&id_mpenerima='+id_mpenerima,
			dataType:'json',
			success:function(data){
				$('#id_mpenerimaH').val(id_mpenerima);
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
								+'<td>'+item.nama+'</td>'
								+'<td>'+item.mlembaga+'('+item.no_telp+')</td>'
								+'<td>'+item.koordinator+'('+item.no_telpkoord+')</td>'
								+'<td>'
									+'<a href="javascript:hapussekolah('+item.id_dpenerima+');">'
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

	function hapussekolah (id_dpenerima) {
		if(id_dpenerima===''){
			$('#tr').fadeOut('slow',function(){$('#tr').remove();});
			$('#addBC2').toggle();
		}else{
			if(confirm('melanjutkan menghapus ?')){
				$.ajax({
					url:dir,
					type:'get',
					data:'aksi=hapussekolah&id_dpenerima='+id_dpenerima,
					dataType:'json',
					success:function(data){
						if(data.status!='sukses'){
							alert(data.status);
						}else{
							viewsekolah($('#id_mpenerimaH').val());
						}
					}
				});
			}
		}
	}

	function simpansekolah(){
		if ($('#id_msekolahTB').val()=='') {
			alert('silahkan pilih sekolah');
			return false;
		}else if($('#id_mlembagaTB').val()=='') {
			alert('silahkan pilih yayasan');
			return false;
		} else{
			$.ajax({
				url:dir+'?aksi=tambahsekolah',
				// type:'post',
				type:'GET',
				dataType:'json',
				// data:$('#lokasiFR').serialize(),
				data:'id_mpenerima='+$('#id_mpenerimaH').val()+'&id_msekolah='+$('#id_msekolahTB').val()+'&id_mlembaga='+$('#id_mlembagaTB').val(),
				success:function(data){
					if(data.status=='sukses'){
						viewsekolah($('#id_mpenerimaH').val());
						$('#addBC2').toggle();
					}else{
						alert(data.status);
					}
				}
			});
		}
	}

