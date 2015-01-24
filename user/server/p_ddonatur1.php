<?php
	session_start();
	// error_reporting(0);
	include"../../lib/koneksi.php";
	include"../../lib/pagination_class.php";
	include "../../lib/tglindo.php"; 
	
 	$aksi 	=  isset($_GET['aksi'])?$_GET['aksi']:'';
	$page 	=  isset($_GET['page'])?$_GET['page']:'';
	$cari	=  isset($_GET['cari'])?$_GET['cari']:'';
	$tabel	=  isset($_GET['tabel'])?$_GET['tabel']:'';
	$menu	=  isset($_GET['menu'])?$_GET['menu']:'';
	
	switch ($aksi){
		#cek ==============================================================================================
		case 'cek':
			$sqlc = 'SELECT * 
					from ddonatur dd
						JOIN mdonatur md on md.id_mdonatur = dd.id_mdonatur  
					 where 
					 	md.id_mlogin='.$_SESSION['id_mloginy'];
			$exec = mysql_query($sqlc);
			$resc = mysql_fetch_assoc($exec);
			$jumc = mysql_num_rows($exec);

			#jika ada non aktif --
			if ($jumc>0) { // ada non aktif
				$sqls = 'UPDATE ddonatur set isActive="n" 
						 WHERE 
							id_mdonatur = '.$resc['id_mdonatur'].' AND 
							id_ddonatur !='.$_GET['id_ddonatur'];
				// print_r($sqls);exit();
				$exes = mysql_query($sqls);
				if (!$exes) {
					$out='{"status":"gagal non aktifkan"}';
				}
			}#end of jika ada non aktif --

			#aktifkan --
			$sqlu = 'UPDATE ddonatur set isActive="y" 
					 WHERE 
						id_ddonatur='.$_GET['id_ddonatur'];
			// print_r($sqls);exit();
			$exeu = mysql_query($sqlu);
			if (!$exeu) {
				$out='{"status":"gagal aktifkan"}';
			}else{
				$out='{"status":"sukses"}';
			}
			#end of aktifkan --
			echo $out;
		break;
		#end of : cek ==============================================================================================

		#combo ==============================================================================================
		case 'combo':
			switch($menu){
				case 'mpropinsi':
					$sql	= 'SELECT * FROM  mpropinsi ORDER BY mpropinsi';
					$exe	= mysql_query($sql);
					$datax	= array();
					while($res=mysql_fetch_assoc($exe)){
						$datax[]=$res;
					}

					if(!$exe){
						$out ='{"status":"error"}';	
					}else{
						if($datax!=NULL){
							$out= '{
									"status":"sukses",
									"datax":'.json_encode($datax).'
								}';
						}else{
							$out='{"status":"kosong"}';
						}
					}
					echo $out;
				break;

				case 'mkota':
					$sql	= 'SELECT * FROM  mkota where id_mpropinsi='.$_GET['id_mpropinsi'].' ORDER BY mkota';
					$exe	= mysql_query($sql);
					$datax	= array();
					while($res=mysql_fetch_assoc($exe)){
						$datax[]=$res;
					}

					if(!$exe){
						$out ='{"status":"error"}';	
					}else{
						if($datax!=NULL){
							$out= '{
									"status":"sukses",
									"datax":'.json_encode($datax).'
								}';
						}else{
							$out='{"status":"kosong"}';
						}
					}
					echo $out;
				break;

				case 'mkecamatan':
					$sql	= 'SELECT * FROM  mkecamatan where id_mkota='.$_GET['id_mkota'].' ORDER BY mkecamatan';
					$exe	= mysql_query($sql);
					$datax	= array();
					while($res=mysql_fetch_assoc($exe)){
						$datax[]=$res;
					}

					if(!$exe){
						$out ='{"status":"error"}';	
					}else{
						if($datax!=NULL){
							$out= '{
									"status":"sukses",
									"datax":'.json_encode($datax).'
								}';
						}else{
							$out='{"status":"kosong"}';
						}
					}
					echo $out;
				break;

			}
		break;
		
		#ambiledit==============================================================================================
		case 'ambiledit':
			$sql = 'SELECT *
					from 
						mdonatur md
						JOIN (
							SELECT 
								dd.id_ddonatur,
								dd.id_mdonatur,
								dd.tgl_ambil,
								dd.isActive,
								dd.nom_awal,
								al.*,
								ko.id_mkota,
								ko.mkota,
								po.*,
								kc.mkecamatan,
								dkd.*
					 
							from 
								ddonatur dd 
								JOIN malamat al on al.id_malamat = dd.id_malamat
								JOIN mkecamatan kc on kc.id_mkecamatan= al.id_mkecamatan
								JOIN mkota ko on ko.id_mkota= kc.id_mkota
								JOIN mpropinsi po on  po.id_mpropinsi= ko.id_mpropinsi
								JOIN dkatdonatur dkd on dkd.id_dkatdonatur= dd.id_dkatdonatur
							
						)tbdd on tbdd.id_mdonatur = md.id_mdonatur
						where
							tbdd.id_ddonatur='.$_GET['id_ddonatur'];

			// var_dump($sql);exit();
			$exe	= mysql_query($sql);
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_mpropinsi":"'.$res['id_mpropinsi'].'",
					"id_mkota":"'.$res['id_mkota'].'",
					"id_mkecamatan":"'.$res['id_mkecamatan'].'",
					"id_malamat":"'.$res['id_malamat'].'",
					"pre_malamat":"'.$res['pre_malamat'].'",
					"malamat":"'.$res['malamat'].'",
					"kode_pos":"'.$res['kode_pos'].'",
					"tipe":"'.$res['tipe'].'",
					"tgl_ambil":"'.$res['tgl_ambil'].'",
					"nom_awal":"'.$res['nom_awal'].'",
					"nama":"'.$res['nama'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql1 = 'UPDATE malamat set pre_malamat 	= "'.mysql_real_escape_string($_POST['pre_malamatTB']).'",
										malamat 		= "'.mysql_real_escape_string($_POST['malamatTB']).'",
										id_mkecamatan 	= '.mysql_real_escape_string($_POST['id_mkecamatanTB']).',
										kode_pos 		= '.mysql_real_escape_string($_POST['kode_posTB']).',
										tipe 			= "'.mysql_real_escape_string($_POST['tipeTB']).'"
								WHERE  	id_malamat 		= '.$_POST['id_malamatH'];

			$exe1 = mysql_query($sql1);
			$sql2 = 'UPDATE  ddonatur SET 	tgl_ambil	= "'.$_POST['tgl_ambilTB'].'", 
											nom_awal 	= "'.$_POST['nom_awalTB'].'" 
					 			WHERE id_ddonatur 		= '.$_GET['id_ddonatur'];

			$exe2	= mysql_query($sql2);
			if(!$exe1){
				echo '{"status":"gagal update alamat"}';
			}else{
				if(!$exe2){
					echo '{"status":"gagal update donatur"}';
				}else{
					echo '{"status":"sukses"}';
				}
			}
		break;
			
		#tambah  ==============================================================================================
		case 'tambah':
			$sql1 = 'INSERT into malamat set pre_malamat 	= "'.mysql_real_escape_string($_POST['pre_malamatTB']).'",
											 malamat 		= "'.mysql_real_escape_string($_POST['malamatTB']).'",
											 id_mkecamatan 	= '.mysql_real_escape_string($_POST['id_mkecamatanTB']).',
											 kode_pos 		= "'.mysql_real_escape_string($_POST['kode_posTB']).'",
											 tipe 			= "'.mysql_real_escape_string($_POST['tipeTB']).'"';

			$exe1	= mysql_query($sql1);
			$sql2 = 'INSERT INTO ddonatur SET id_mdonatur = (
												SELECT
													id_mdonatur
												FROM
													mdonatur
												WHERE
													id_mlogin = '.$_SESSION['id_mloginy'].'
											),id_dkatdonatur = (
												SELECT
													dkd.id_dkatdonatur
												FROM
													dkatdonatur dkd
													JOIN dtipebayar dt ON dt.id_dtipebayar = dkd.id_dtipebayar
													JOIN mtipebayar mt ON mt.id_mtipebayar = dt.id_mtipebayar
												WHERE
													mt.mtipebayar = "Tunai"
											),id_malamat = '.mysql_insert_id().',
											 nom_awal = '.$_POST['nom_awalTB'].',
											 tgl_ambil = "'.$_POST['tgl_ambilTB'].'",
											 isActive = "y"';

			// var_dump($sql2);exit();
			// var_dump($sql1);exit();
			$exe2	= mysql_query($sql2);
			$id_ddonatur = mysql_insert_id();
			if(!$exe1){
				$out='{"status":"gagal simpan alamat"}';
			}else{
				if(!$exe2){
					$out='{"status":"gagal simpan donatur"}';
				}else{
					$sqlc = 'SELECT * 
							from ddonatur dd
								JOIN mdonatur md on md.id_mdonatur = dd.id_mdonatur  
							 where 
							 	md.id_mlogin='.$_SESSION['id_mloginy'];
					$exec = mysql_query($sqlc);
					$resc = mysql_fetch_assoc($exec);
					$jumc = mysql_num_rows($exec);

					#cek status --
					if ($jumc>0) { // ada non aktif
						$sqls = 'UPDATE 
									ddonatur set isActive="n" 
								 WHERE 
									id_mdonatur = '.$resc['id_mdonatur'].' AND 
									id_ddonatur !='.$id_ddonatur;
						// print_r($sqls);exit();
						$exes = mysql_query($sqls);

						if (!$exes) {
							$out='{"status":"gagal update status ddonatur"}';
						}else{
							$out='{"status":"sukses"}';
						}
					}else{ // tdk ada nonaktif
						$out='{"status":"sukses"}';
					}
					#cek status ---
				}
			}
			echo $out;
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from ddonatur where id_ddonatur ='.$_GET['id_ddonatur'];
			$exe	= mysql_query($sql);
			
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';	
			}
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			$tipe        = trim($_GET['tipeS'])?$_GET['tipeS']:'';
			$pre_malamat = trim($_GET['pre_malamatS'])?$_GET['pre_malamatS']:'';
			$malamat     = trim($_GET['malamatS'])?$_GET['malamatS']:'';
			$mkecamatan  = trim($_GET['mkecamatanS'])?$_GET['mkecamatanS']:'';
			$mkota       = trim($_GET['mkotaS'])?$_GET['mkotaS']:'';
			$mpropinsi   = trim($_GET['mpropinsiS'])?$_GET['mpropinsiS']:'';
			$nom_awal    = trim($_GET['nom_awalS'])?$_GET['nom_awalS']:'';
			$tgl_ambil   = trim($_GET['tgl_ambilS'])?$_GET['tgl_ambilS']:'';
			// $nama        = trim($_GET['namaS'])?$_GET['namaS']:'';

			$sql = 'SELECT
						md.id_mlogin,
						tbdd.*
					FROM
						mdonatur md
					JOIN (
						SELECT
							dd.id_ddonatur,
							dd.id_mdonatur,
							dd.tgl_ambil,
							dd.isActive,
							dd.nom_awal,
							al.*, 
							ko.mkota,
							po.*, kc.mkecamatan,
							dkd.*
						FROM
							ddonatur dd
						JOIN malamat al ON al.id_malamat = dd.id_malamat
						JOIN mkecamatan kc ON kc.id_mkecamatan = al.id_mkecamatan
						JOIN mkota ko ON ko.id_mkota = kc.id_mkota
						JOIN mpropinsi po ON po.id_mpropinsi = ko.id_mpropinsi
						JOIN dkatdonatur dkd ON dkd.id_dkatdonatur = dd.id_dkatdonatur
					) tbdd ON tbdd.id_mdonatur = md.id_mdonatur
					WHERE
						md.id_mlogin ='.$_SESSION['id_mloginy'].' AND
						tbdd.tipe LIKE "%'.$tipe.'%" AND
						tbdd.mkecamatan LIKE "%'.$mkecamatan.'%" AND
						tbdd.mkota LIKE "%'.$mkota.'%" AND
						tbdd.mpropinsi LIKE "%'.$mpropinsi.'%" AND
						tbdd.pre_malamat LIKE "%'.$pre_malamat.'%" AND 
						tbdd.tgl_ambil LIKE "%'.$tgl_ambil.'%" AND 
						tbdd.nom_awal LIKE "%'.$nom_awal.'%" AND 
						tbdd.malamat LIKE "%'.$malamat.'%" 
					ORDER BY	
						tbdd.id_ddonatur DESC';
			/*tbdd.nama LIKE "%'.$nama.'%" AND*/
			// print_r($sql);exit();	

			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 5;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			$out='';
			$jum	= mysql_num_rows($result);	
			if($jum!=0){	
				$nox	= $starting+1;
				while($res = mysql_fetch_array($result)){	

					$kantor = empty($res['pre_malamat'])?'-':$res['pre_malamat'];
					if($res['isActive']=='y'){ //sudah aktif
						$clr = 'class="success" onmouseover="return tooltipx(this);" data-toggle="tooltip" title="aktif" data-placement="left" ';
						$btn ='<div class="btn-group">
								  	<button type="button" onclick="editddonatur(\''.$res['id_ddonatur'].'\');" class="btn btn-info"
									  	onmouseover="return tooltipx(this);" data-toggle="tooltip" title="ubah" data-placement="top" >
								  		<i class="icon-pencil"></i>
							  		</button>
								  	<button type="button" disabled class="btn" >
								  		<i class="icon-trash"></i>
							  		</button>
									<button disabled onmouseover="return tooltipx(this);" title="aktif" data-toggle="tooltip" data-placement="top" class="btn btn-success">
										<i class="icon-ok"></i>
									</button>
								</div>';
									// <button onmouseover="return tooltipx(this);" data-toggle="tooltip" title="riwayat" data-placement="top" class="btn btn-warning">
									// 	<i class="icon-">40</i>
									// </button>
					}else{ //tidak aktif
						$clr ='';
						$btn ='<div class="btn-group">
								  	<button type="button" onclick="editddonatur(\''.$res['id_ddonatur'].'\');" class="btn btn-info"
									  	onmouseover="return tooltipx(this);" data-toggle="tooltip" title="ubah" data-placement="top" >
								  		<i class="icon-pencil"></i>
							  		</button>
								  	<button type="button" onclick="hapusddonatur(\''.$res['id_ddonatur'].'\');" class="btn btn-danger"
									  	onmouseover="return tooltipx(this);" data-toggle="tooltip" title="hapus" data-placement="top" >
								  		<i class="icon-trash"></i>
							  		</button>
									<button onclick="statddonatur(\''.$res['id_ddonatur'].'\');"  
										onmouseover="return tooltipx(this);" title="aktifkan" data-toggle="tooltip" data-placement="top" class="btn">
										<i class="icon-off"></i>
									</button>
								</div>';
									// <button onmouseover="return tooltipx(this);" title="riwayat" data-toggle="tooltip" data-placement="top" class="btn btn-warning">
									// 	<i class="icon-">40X</i>
									// </button>
					}

					$out.='<tr '.$clr.'>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['tipe'].'</label></td>
							<td><label class="control-label">'.$kantor.'</label></td>
							<td><label class="control-label">'.$res['malamat'].'</label></td>
							<td><label class="control-label">'.$res['mkecamatan'].'</label></td>
							<td><label class="control-label">'.$res['mkota'].'</label></td>
							<td><label class="control-label">'.$res['mpropinsi'].'</label></td>
							<td><label class="control-label">'.$res['tgl_ambil'].'</label></td>
							<td><label class="control-label">Rp. '.number_format($res['nom_awal']).',-</label></td>
							<td>
								'.$btn.'
							</td>
						</tr>';
					// <td><label class="control-label">'.$res['nama'].'</label></td>
                	$nox++;
				}
			}
			#kosong
			else
			{
				$out.='<tr align="center">
						<td  colspan=10 ><span style="color:red;text-align:center;">
						... data masih kosong...</span></td></tr>';
			}
			#link paging
			$out.='<tr class="info"><td colspan="11">'.$obj->anchors.'</td></tr>';
			$out.='<tr class="info"><td colspan="11">'.$obj->total.'</td></tr>';
		echo $out;
	break;
	
} ?>			
