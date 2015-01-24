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

	function combobulan(){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=bulan',
			dataType:'json',
			success:function(data){
				var optiony ='';
				$.each(data, function (id,item){
					var d = new Date();
					var bln = d.getMonth()+1;
					// alert(bln);
					if(id==bln){
						optiony+='<option selected="selected" value='+id+'>'+item+' </option>';
					}else{
						optiony+='<option value='+id+'>'+item+' </option>';
					}
				});
				$('#bulanTS').html('<option value="">semua</option>'+optiony);
			}
		});
	}

	function combotahun(thn){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=tahun',
			dataType:'json',
			success:function(data){
				var optiony ='';
				var d = new Date();
				var thnx,blnx;

				if (thn!='') {
					thnx = d.getFullYear();
					blnx = d.getMonth();
				} else{
					thnx=$('#tahunTS').val();
					blnx=$('#bulanTS').val();
				}

				$.each(data, function (id,item){
					if(item==thnx){
						optiony+='<option selected="selected" value='+item+'>'+item+' </option>';
					}else{
						optiony+='<option value='+item+'>'+item+' </option>';
					}
				});
				$('#tahunTS').html('<option value="">semua</option>'+optiony);
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
			urlx += 'aksi=ubah&id_tdonasi='+id_tdonasi;

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
					loadData('','','');
				}else{
					alert(data.status);
				}
			}
		});
	}
	
	//edit record kegiatan
	function edittdonasi(id,tipe){
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
					var href,src;
					if (data.bukti!='') {
						src='../upload/bukti/'+data.bukti;
						href = 'javascript:loadbukti("'+src+'");';
					} else{
						src='../img/no_image.jpg';
						href='#';
					}

					if (data.isLunas=='y') {
						$('#isLunasTB').attr('checked',true);
					} else{
						$('#isLunasTB').removeAttr('checked');
					}

					$('#buktiA').attr('href',href);
					$('#buktiTB').attr('src',src);
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
										
					$('#loadarea').html('<i class="icon-edit"></i> KONFIRMASI DONASI SUKARELA').fadeIn();
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
	
	function tot(){
		$.ajax({
			url:dir,
			dataType:'json',
			data:'aksi=total',
			success:function(data){
				if (data.status!='sukses') {
					alert(data.status);
				}else{
					$('#inTotalSP').html(data.tot);					
				}
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

	function loadbukti(src){
		var x = '<img src="'+src+'" alt="'+src+'" />';
		$('#popHeader').text('Bukti Pmbayaran (struk transfer Bank)');
		$('#popMeDV').html(x);
		popUP();
	}

	function popUP () {
		$('#popMe').modal('show');
	}

	function loadData(nma,thn,sem){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var th,sm,nm,datax,cari;
		if (thn=='') {
			nm='&namaS='+$('#namaTS').val();
			th='&tahunS='+$('#tahunTS').val();
			sm='&semesterS='+$('#semesterTS').val();
		} else{
			nm='&namaS='+nma;
			th='&tahunS='+thn;
			sm='&semesterS='+sem;
		}

		datax = 'aksi=tampil';
		cari  = nm+th+sm
				+'&nm_lengkapS='+$('#nm_lengkapTS').val()
				+'&mjenjangS='+$('#mjenjangTS').val()
				+'&kelasS='+$('#kelasTS').val()
				+'&nominalS='+$('#nominalTS').val()
				+'&semesterS='+$('#semesterTS').val()
				+'&tahunS='+$('#tahunTS').val();
	 	$.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR PENYALURAN DANA (beasiswa) ');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
		

	function pagination(page,aksix,menux){
	// function loadData(nma,thn,bln){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var th,bl,nm,datax,cari;
		var d 	= new Date();
		var bln = d.getMonth()+1;
		var thn = d.getFullYear();

		if (thn=='') {
			nm ='&namaS='+$('#namaTS').val();
			th ='&tahunS='+$('#tahunTS').val();
			bl ='&bulanS='+$('#bulanTS').val();
		} 
		// else {
		// 	nm ='&namaS='+nma;
		// 	th ='&tahunS='+thn;
		// 	bl ='&bulanS='+bln;
		// }

		datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		cari  = nm+th+bl
				+'&nm_lengkapS='+$('#nm_lengkapTS').val()
				+'&mjenjangS='+$('#mjenjangTS').val()
				+'&kelasS='+$('#kelasTS').val()
				+'&nominalS='+$('#nominalTS').val()
				+'&semesterS='+$('#semesterTS').val()
				+'&tahunS='+$('#tahunTS').val();

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
		tot();
		var d 	= new Date();
		var bln = d.getMonth()+1;
		var thn = d.getFullYear();
		combotahun(thn);
		combobulan(bln);
		loadData($('#namaTS').val(),thn,bln);

		$('#cetakBC').on('click',function(){
			var href='report/r_tdoninsidentil.php'
					+'?tipe=pdf'
					+'&isLunas='+$('#isLunasTS').val()
					+'&nom_akhir='+$('#nom_akhirTS').val()
					+'&no_rek='+$('#no_rekTS').val()
					+'&dtipebayar='+$('<div id="dtipebayarTS"></div>').val()
					+'&nama='+$('#namaTS').val()
					+'&tahun='+$('#tahunTS').val()
					+'&bulan='+$('#bulanTS').val()
					+'&ruwet='+encode64($('#idsesiH').val()+$('#id_mloginH').val()+$('#idsesiH').val() );
			window.open(href);
		})

		$('#tahunTS').on('change',loadData);
		$('#bulanTS').on('change',loadData);

		$('#isLunasTS').on('change',loadData);
		$('#namaTS').on('keyup',loadData);
		$('#dtipebayarTS').on('keyup',loadData);
		$('#no_rekTS').on('keyup',loadData);
		$('#nom_akhirTS').on('keyup',loadData);
		$('#isLunasTS').on('change',loadData);

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
