var dir='server/p_tdonrutin.php';
	
	function combotahun(){
		$.ajax({
			url:dir,
			type:'get',
			data:'aksi=combo&menu=tahun',
			dataType:'json',
			success:function(data){
				var optiony ='';
				$.each(data, function (id,item){
					var d = new Date();
					var thn = d.getFullYear();
					if(item==thn){
						optiony+='<option selected="selected" value='+item+'>'+item+' </option>';
					}else{
						optiony+='<option value='+item+'>'+item+' </option>';
					}
				});
				$('#tahunTS').html('<option value="">semua</option>'+optiony);
			}
		});
	}

	function loadData(){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'aksi=tampil';
		var cari  =	'&nom_akhirS='+$('#nom_akhirTS').val()
					+'&namaS='+$('#namaTS').val()
					+'&tahunS='+$('#tahunTS').val();
	 	$.ajax({
			url	: dir,
			type: 'GET',
			data: datax+cari,
			success:function(data){
				$('#loadarea').html('<i class="icon-th-list"></i> DAFTAR LAPORAN DONASI RUTIN ');
				$('#isi').hide().html(data).fadeIn(1000);
			}
		});
	}
		
	function pagination(page,aksix,menux){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var datax = 'starting='+page+'&aksi='+aksix+'&menu='+menux;
		var cari  =	'&nom_akhirS='+$('#nom_akhirTS').val()
					+'&namaS='+$('#namaTS').val()
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
		combotahun();
		loadData();
		$('#tahunTS').on('change',function () {
			loadData();
		});
		$('#tipeTB').on('change',function(){
			if($(this).val()=='kantor')
				$('#pre_malamatTB').removeAttr('readonly');
			else
				$('#pre_malamatTB').attr('readonly','readonly').val('');
		});

		$('#nom_akhirTS').on('keyup',loadData);
		$('#namaTS').on('keyup',loadData);
		
		
	});	
	
