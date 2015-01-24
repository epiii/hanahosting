var dir='server/p_profil.php';

$(document).ready(function(){
	loadData('tampil');
    $('form').on('submit',simpanData);

	$('#editBC').click(function(){
		loadData('ambiledit');
		$('input:submit').toggle();
		$('#cancelBC').toggle();
		$(this).toggle();
		$('#gantiDV').append('<td width="25%" colspan="3">'
								+'<label class="control-label">'
								+'<input type="checkbox" id="gantiTB" onclick="cekganti(gantiTB);"/>'
								+'Ganti Password</label>'
							+'</td>');
	});
});	

//fungsi untuk hapus akun user(dosen) secara kesluruhan (profil + kegiatan + bukeg )
function hapusAkun(){
	if(confirm('Anda yakin akan menghapus akun secara permanen?')){
		$.ajax({
			url:dir,
			dataType:'json',
			data:'aksi=hapusAkun',
			success:function(data){
				alert(data.status); // notif sebelum logout
				location.href='../logout.php'; //otomatis akan logout ketika berhasil hapus akun 
			}
		});
	}
}


//fungsi untuk  mengecek ulang  password baru (sama/tidak) 
function cekpass(){
	var p2 = $('#passBTB2').val();
	var p1 = $('#passBTB1').val();
	if(p2==p1){ // notif ketika sama
		$('#passinfo').html('<span class="label label-success">password sesuai</span>'); 
	}else{ //notif ketika beda/salah
		$('#passinfo').html('<span class="label label-important">password harus sama</span>');
	}
}

//fungsi ketika checkbox dicentang (saat edit profil) => menampilkan textbox2 ganti  password  
function cekganti(x){
	$('#pass1').toggle(1000);
	$('#pass2').toggle(1000);
	$('#pass3').toggle(1000);
	$('#passLTB').val('');
	$('#passBTB1').val('');
	$('#passBTB2').val('');

	//fungsi ketika event keyUp  pada textbox password1
	$('#passBTB1').keyup(function(){
		cekpass();
	});
	//fungsi ketika event keyUp  pada textbox password2
	$('#passBTB2').keyup(function(){
		cekpass();
	});
}
	

function loadData(aksix){
	$('#loadarea').html('<img src="../img/loader.gif">loading..').fadeIn();
	$.ajax({
		url	: dir,
		type: "GET",
		data: "aksi=tampil",
		dataType:"json",
		success:function(data){
			if(data.status=='kosong'){
				alert('kosong');
			}else{
				//view
				if(aksix=='tampil'){
					if(data.j_kelamin=='L')
						var j_kelamin ='Laki-Laki'; 
					else
						var j_kelamin ='Perempuan';  
					
					$('a#editBC').fadeIn();
					$('a#cancelBC').fadeOut();
					$('input:submit').fadeOut();
					$('#loadarea').html('<h3>PROFIL DONATUR</h3>');
					
					$('#emailTD').html(data.email);
						var nama,j_kelamin,mkecamatan,malamat,pre_malamat,telp,hp,temp,mkota;
						if(data.nama==''){nama='[kosong]';}else{nama=data.nama;}
						if(data.j_kelamin==''){j_kelamin='[kosong]';}else{j_kelamin=j_kelamin;}
						if(data.kode_pos==''){kode_pos='[kosong]';}else{kode_pos=data.kode_pos;}
						if(data.mpropinsi==''){mpropinsi='[kosong]';}else{mpropinsi=data.mpropinsi;}
						if(data.mkota==''){mkota='[kosong]';}else{mkota=data.mkota;}
						if(data.mkecamatan==''){mkecamatan='[kosong]';}else{mkecamatan=data.mkecamatan;}
						if(data.malamat==''){malamat='[kosong]';}else{malamat=data.malamat;}
						if(data.pre_malamat==''){pre_malamat='[kosong]';}else{pre_malamat=data.pre_malamat;}
						if(data.telp==''){telp='[kosong]';}else{telp=data.telp;}
						if(data.hp==''){hp='[kosong]';}else{hp=data.hp;}
						if(data.temp==''){temp='[kosong]';}else{temp=data.temp;}
						// alert(malamat);
					
					$('#namaTD').html(nama);
					$('#j_kelaminTD').html(j_kelamin);
					$('#kode_posTD').html(kode_pos);
					$('#id_mkecamatanTD').html(mkecamatan);
					$('#id_mkotaTD').html(mkota);
					$('#id_mpropinsiTD').html(mpropinsi);
					$('#malamatTD').html(malamat);
					$('#pre_malamatTD').html(pre_malamat);
					$('#telpTD').html(telp);
					$('#hpTD').html(hp);
					$('#gantiDV').html('');
				}else{ //edit 
					$('#loadarea').html('<h3>EDIT PROFIL</h3>');
					//user
					$('#id_malamatH').val(data.id_malamat);	
					$('#namaTD').html('<input required name="namaTB" type="text" value="'+data.nama+'">');
					$('#j_kelaminTD').html('<select required name="j_kelaminTB" id="j_kelaminTB" >'
											+'<option value="">Pilih Jenis Kelamin ..</option>'
											+'<option value="L">Laki - Laki</option>'
											+'<option value="P">Perempuan</option>'
										+'</select>');
					$('#j_kelaminTB').val(data.j_kelamin).attr('selected',true);
					$('#malamatTD').html('<input name="malamatTB" required type="text" value="'+data.malamat+'">');
					$('#tipeTD').html('<select required name="tipeTB" id="tipeTB" >'
										+'<option value="">Pilih Tempat Penagihan ..</option>'
										+'<option value="rumah">Rumah</option>'
										+'<option value="kantor">Kantor</option>'
									+'</select>');
					$('#pre_malamatTD').html('<input name="pre_malamatTB" type="text" value="'+data.pre_malamat+'">');
					$('#kode_posTD').html('<input name="kode_posTB" size="5" minlength="5" maxlength="5" type="number" max="99999" min="00000" value="'+data.kode_pos+'">');
					$('#telpTD').html('<input name="telpTB" type="text" value="'+data.telp+'">');
					$('#hpTD').html('<input name="hpTB" type="text" value="'+data.hp+'">');
					//histjab		
					// combokecamatan(data.id_mkota,data.id_mkecamatan);
					// combokota(data.id_mpropinsi,data.id_mkota);
					combopropinsi(data.id_mpropinsi);
					combokota(data.id_mpropinsi,data.id_mkota);
					combokecamatan(data.id_mkota,data.id_mkecamatan);
					// alert(data.id_mpropinsi);
				}
			}
		},
		error: function(jqXHR, textStatus, errorThrown){
			console.log('ERRORS: ' + textStatus);
		}
	});
}

function combopropinsi(id_mpropinsi){
	// alert(id_mpropinsi);return false;t
	$.ajax({
		url:dir,
		type:'get',
		dataType:'json',
		cache:false,
		data:'aksi=combo&menu=mpropinsi',
		success:function(data){
			var optiony ='';
			if(data.status!='sukses'){
				optiony+='<option value="">'+data.status+'</option>';
			}else{
				$.each(data.datax, function (id,item){
					if(id_mpropinsi==item.id_mpropinsi){
						optiony+='<option value="'+item.id_mpropinsi+'" selected="selected">'+item.mpropinsi+' </option>';
					}else{
						optiony+='<option value="'+item.id_mpropinsi+'">'+item.mpropinsi+' </option>';
					}
				});
			}
			$('#id_mpropinsiTD').html('<select onchange="combokota(\'\',\'\');" id="id_mpropinsiTB" name="id_mpropinsiTB" required>'
										+'<option value="">Propinsi  ..</optionn>'
										+optiony
									+'</select>');
		}
	}); 
}	

function combokota(id_mpropinsi,id_mkota){
	var id_p, id_k;
	if (id_mpropinsi=='') { // add mode
		id_p=$('#id_mpropinsiTB').val();
		id_k=$('#id_mkotaTB').val();
	}else{ //edit mode
		id_p=id_mpropinsi;
		id_k=id_mkota;
	}
	// alert(id_p+','+id_k);return false;
	$.ajax({
		url:dir,
		type:'get',
		dataType:'json',
		cache:false,
		data:'aksi=combo&menu=mkota&id_mpropinsi='+id_p,
		success:function(data){
			var optiony ='';
			if(data.status!='sukses'){
				optiony+='<option value="">'+data.status+'</option>';
			}else{
				$.each(data.datax, function (id,item){
					if(id_k==item.id_mkota){
						optiony+='<option value="'+item.id_mkota+'" selected="selected">'+item.mkota+' </option>';
					}else{
						optiony+='<option value="'+item.id_mkota+'">'+item.mkota+' </option>';
					}
				});
			}
			$('#id_mkotaTD').html('<select  onchange="combokecamatan(\'\',\'\');" id="id_mkotaTB" name="id_mkotaTB" required>'
										+'<option value="">Kota </optionn>'+optiony
									+'</select>');
		}
	}); 
}	

function combokecamatan(id_mkota,id_mkecamatan){
	var id_k, id_c;
	if (id_mkota=='') { // add mode
		id_k=$('#id_mkotaTB').val();
		id_c=$('#id_mkecamatanTB').val();
	}else{ //edit mode
		id_k=id_mkota;
		id_c=id_mkecamatan;
	}

	$.ajax({
		url:dir,
		type:'get',
		dataType:'json',
		cache:false,
		data:'aksi=combo&menu=mkecamatan&id_mkota='+id_k,
		success:function(data){
			var optiony ='';
			if(data.status!='sukses'){
				optiony+='<option value="">'+data.status+'</option>';
			}else{
				$.each(data.datax, function (id,item){
					if(id_c==item.id_mkecamatan){
						optiony+='<option value="'+item.id_mkecamatan+'" selected="selected">'+item.mkecamatan+' </option>';
					}else{
						optiony+='<option value="'+item.id_mkecamatan+'">'+item.mkecamatan+' </option>';
					}
				});
			}
			$('#id_mkecamatanTD').html('<select id="id_mkecamatanTB" name="id_mkecamatanTB" required>'
								+'<option value="">Kecamatan..</optionn>'+optiony
							+'</select>');
		}
	}); 
}	

function simpanData(event){
    $('#loadarea').html('<img src="../img/loader.gif">loading..').fadeIn();
	event.stopPropagation(); // Stop stuff happening
    event.preventDefault(); // Totally stop stuff happening

    var datax= $(this).serialize();
    $.ajax({
        url:dir+'?aksi=ubah',
        type:'post',
        data:datax,
        dataType:'json',
        success:function(data){
	        if(data.status=='sukses'){
	            loadData('tampil');				
				$('#gantiTB').attr('checked',false); // menghilangkan centang setalah sukses simpan/update data
				$('#gantiTR').css('display','none'); // menyembunyikan textbox setelah sukses simpan/update data 
				$('#pass1').css('display','none'); 
				$('#pass2').css('display','none');
				$('#pass3').css('display','none');
				$('#passBTB1').val('');
				$('#passBTB2').val('');
			}else{
                alert(data.status);
            }
        }	
    });	
}

