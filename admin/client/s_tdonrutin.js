var dir='server/p_tdonrutin.php';
	
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

	function loadData(nma,thn,bln){
		$('#isi').html('<img src="../img/loader.gif"> ').fadeIn();
		var th,bl,nm,datax,cari;
		if (thn=='') {
			nm='&namaS='+$('#namaTS').val();
			th='&tahunS='+$('#tahunTS').val();
			bl='&bulanS='+$('#bulanTS').val();
		} else{
			nm='&namaS='+nma;
			th='&tahunS='+thn;
			bl='&bulanS='+bln;
		}

		datax = 'aksi=tampil';
		cari  = nm+th+bl;
					
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
		var cari  =	'&bulanS='+$('#bulanTS').val()
					+'&tahunS='+$('#tahunTS').val()
					+'&namaS='+$('#namaTS').val();
					
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
		var d 	= new Date();
		var bln = d.getMonth()+1;
		var thn = d.getFullYear();
		combotahun(thn);
		combobulan(bln);
		loadData($('#namaTS').val(),thn,bln);

		$('#cetakBC').on('click',function(){
			var href='report/r_tdonrutin.php'
					+'?tipe=pdf'
					+'&nama='+$('#namaTS').val()
					+'&tahun='+$('#tahunTS').val()
					+'&bulan='+$('#bulanTS').val()
					+'&ruwet='+encode64($('#idsesiH').val()+$('#id_mloginH').val()+$('#idsesiH').val() );
			window.open(href);
		})

		$('#tahunTS').on('change',function () {
			loadData('','');
		});

		$('#bulanTS').on('change',function () {
			loadData('','');
		});

		$('#namaTS').on('keyup',function () {
			loadData('','');
		});

	});	
	
