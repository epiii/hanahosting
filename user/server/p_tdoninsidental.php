<?php
	session_start();
	// error_reporting(0);
	include"../../lib/koneksi.php";
	include"../../lib/pagination_class.php";
	include "../../lib/tglindo.php"; 
	$upDir 	= '../../upload/bukti/';
	
 	$aksi 	=  isset($_GET['aksi'])?$_GET['aksi']:'';
	$page 	=  isset($_GET['page'])?$_GET['page']:'';
	$cari	=  isset($_GET['cari'])?$_GET['cari']:'';
	$tabel	=  isset($_GET['tabel'])?$_GET['tabel']:'';
	$menu	=  isset($_GET['menu'])?$_GET['menu']:'';
	
	switch ($aksi){
		case 'uploadsave':
			#eksekusi tambah file (loop)------------------------------------------
			$jum = count($_POST['fileadd']);
			for($i=0; $i<$jum; $i++){
				// $sql	= "INSERT into bukeg set iddtk = '$iddtk', file='".$_POST['fileadd'][$i]."'";
				$sql 	= 'UPDATE tdonasi set 	bukti 	="'.$_POST['fileadd'][$i].'",
												isLunas ="o"
						 				WHERE id_tdonasi='.$_GET['id_tdonasi'];
				$exe	= mysql_query($sql);
				if($exe){
					$data	= array(
						'success'=>'berhasil_simpan_bukeg_new',
						'formData'=>$_POST	
					);
				}else{
					$data	= array(
						'error'=>'gagal_simpan_bukeg_new',
						'formData'=>$_POST	
					);
				}
			}
			echo json_encode($data);
			#end of eksekusi tambah file (loop)----------------------------------
		break;

		case 'uploadimg':
			$error=false;
			$files=array();
			foreach($_FILES as $file){
				$tipex		= substr($file['type'],6);
				$namaAwal 	= $file['name'];
				$namaSkrg	= $_SESSION['id_mloginy'].'_'.substr((md5($namaAwal.rand())),2,10).'.'.$tipex;
				$src		= $file['tmp_name'];
				// $destix		= $upDir .basename($namaSkrg);
				$destix		= $upDir.basename($namaSkrg);

				#proses upload -------------------------
				//berhasil
				if(move_uploaded_file($src, $destix)){
					$files[] = $namaSkrg;
				}
				//gagal 
				else{ 
					$error = true;
				}
				#end of proses upload -------------------
			}#end of upload file (loop) -------------------------------------------------
		
			#pesan upload ---------------------------------------------------------------
			//gagal
			if($error){ 
				$data=array(
					'error' => 'gagal upload file'
					); 
			}
			//berhasil 
			else{
				$data=array(
					'files' => $files
					);	
			}
			echo json_encode($data);
			#pesan upload -------------------------------------------------------------
		break;
	
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
				//print_r($sqls);exit();
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
				case 'dkatdonatur':
					$sql	= 'SELECT 
									dkd.id_dkatdonatur,
									dt.dtipebayar,
									dt.no_rek
								from 
									dkatdonatur dkd 
									JOIN mkatdonatur mkd on mkd.id_mkatdonatur = dkd.id_mkatdonatur
									JOIN dtipebayar dt on dt.id_dtipebayar= dkd.id_dtipebayar
									JOIN mtipebayar mt on mt.id_mtipebayar= dt.id_mtipebayar
								WHERE	
									mt.mtipebayar != "tunai"
								ORDER BY	
									dt.dtipebayar ASC';
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
			$sql = 'SELECT 
						dkd.id_dkatdonatur,
						dt.dtipebayar,
						dt.no_rek,
						td.nom_akhir,
						dd.id_ddonatur
					from 
						tdonasi td 
						join ddonatur dd on dd.id_ddonatur = td.id_ddonatur
						join mdonatur md on md.id_mdonatur= dd.id_mdonatur
						join dkatdonatur dkd on dkd.id_dkatdonatur=dd.id_dkatdonatur
						join mkatdonatur mkd on mkd.id_mkatdonatur=dkd.id_mkatdonatur
						join dtipebayar dt on dt.id_dtipebayar=dkd.id_dtipebayar
					WHERE
						td.id_tdonasi='.$_GET['id_tdonasi']; 

			// var_dump($sql);exit();
			$exe	= mysql_query($sql);
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_dkatdonatur":"'.$res['id_dkatdonatur'].'",
					"dtipebayar":"'.$res['dtipebayar'].'",
					"no_rek":"'.$res['no_rek'].'",
					"nom_akhir":"'.$res['nom_akhir'].'",
					"id_ddonatur":"'.$res['id_ddonatur'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql1 = 'UPDATE ddonatur set id_dkatdonatur = "'.mysql_real_escape_string($_POST['id_dkatdonaturTB']).'"
									WHERE id_ddonatur 	= '.$_POST['id_ddonaturH'];
			// print_r($sql1);exit();
			$exe1	= mysql_query($sql1);
			$sql2 = 'UPDATE  tdonasi SET 	nom_akhir 	= "'.trim($_POST['nom_akhirTB']).'",
											tgl 		= NOW()
									WHERE 	id_tdonasi 	='.$_GET['id_tdonasi'];

			// var_dump($sql2);exit();
			$exe2	= mysql_query($sql2);
			if(!$exe1){
				$out='{"status":"gagal ubah  ddonatur"}';
			}else{
				if(!$exe2){
					$out='{"status":"gagal ubah tdonasi"}';
				}else{
					$out='{"status":"sukses"}';
				}
			}
			echo $out;
		break;
			
		#tambah  ==============================================================================================
		case 'tambah':
			$sql1 = 'INSERT into ddonatur set 	id_dkatdonatur 	= "'.mysql_real_escape_string($_POST['id_dkatdonaturTB']).'",
												id_mdonatur		= (
																	SELECT id_mdonatur 
																	FROM mdonatur
																	WHERE id_mlogin ='.$_SESSION['id_mloginy'].'
																)';
			// print_r($sql1);exit();
			$exe1	= mysql_query($sql1);
			$sql2 = 'INSERT INTO tdonasi SET  	id_ddonatur = '.mysql_insert_id().',
												nom_akhir 	= "'.trim($_POST['nom_akhirTB']).'",
												tgl 		= NOW()';

			// var_dump($sql1);exit();
			$exe2	= mysql_query($sql2);
			if(!$exe1){
				$out='{"status":"gagal simpan ddonatur"}';
			}else{
				if(!$exe2){
					$out='{"status":"gagal simpan tdonasi"}';
				}else{
					$out='{"status":"sukses"}';
				}
			}
			echo $out;
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sdel 	= 'SELECT bukti from tdonasi WHERE id_tdonasi='.$_GET['id_tdonasi'];
			$edel 	= mysql_query($sdel);
			$rdel 	= mysql_fetch_assoc($edel);

			$sql	= 'DELETE from tdonasi where id_tdonasi ='.$_GET['id_tdonasi'];
			if($rdel['bukti']!=''){ // db : ditemukan
				$file = $upDir.$rdel['bukti'];
				if(file_exists($file)){ // file : ada 
					unlink($file);
				}
				$exe  = mysql_query($sql);
				$out  = (!$exe)?'{"status":"gagal hapus data"}':'{"status":"sukses"}';
			}else{ // db : foto gak ada
				$exe	= mysql_query($sql);
				$out  = (!$exe)?'{"status":"gagal hapus data"}':'{"status":"sukses"}';
			}
			echo $out;
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			$nom_akhir  = trim($_GET['nom_akhirS'])?$_GET['nom_akhirS']:'';
			$no_rek 	= trim($_GET['no_rekS'])?$_GET['no_rekS']:'';
			$isLunas    = trim($_GET['isLunasS'])?$_GET['isLunasS']:'';
			$dtipebayar = trim($_GET['dtipebayarS'])?$_GET['dtipebayarS']:'';

			$sql = 'SELECT 
						td.id_tdonasi,
						td.nom_akhir,
						dt.dtipebayar,
						dt.no_rek,
						td.tgl,
						td.tgl_lunas,
						td.isLunas
					from 
						tdonasi td 
						join ddonatur dd on dd.id_ddonatur         = td.id_ddonatur
						join mdonatur md on md.id_mdonatur         = dd.id_mdonatur
						join dkatdonatur dkd on dkd.id_dkatdonatur = dd.id_dkatdonatur
						join mkatdonatur mkd on mkd.id_mkatdonatur = dkd.id_mkatdonatur
						join dtipebayar dt on dt.id_dtipebayar     = dkd.id_dtipebayar
					WHERE
						md.id_mlogin        ='.$_SESSION['id_mloginy'].' 
						AND mkd.mkatdonatur ="insidentil" 
						AND td.nom_akhir LIKE "%'.$nom_akhir.'%"
						AND dt.dtipebayar LIKE "%'.$dtipebayar.'%"
						AND dt.no_rek LIKE "%'.$no_rek.'%"
						AND isLunas LIKE "%'.$isLunas.'%"
					ORDER BY
						td.isLunas ASC';
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
			$tot = 0;
			if($jum!=0){	
				$nox	= $starting+1;
				while($res = mysql_fetch_array($result)){	
					$tgl_lunas = $res['tgl_lunas']=='0000-00-00'?'-':tgl_indo($res['tgl_lunas']);
					$kantor    = empty($res['pre_malamat'])?'-':$res['pre_malamat'];
					if($res['isLunas']=='n'){ //belum konfirmasi /upload bukti pembayaran
						$status ='<label class="label label-warning">Belum konfirmasi</label>';
						$clr = 'class="warning" onmouseover="return tooltipx(this);" data-toggle="tooltip" title="Belum konfirmasi" data-placement="left" ';
						$btn ='<div class="btn-group">
								  	<button onclick="edittdonasi('.$res['id_tdonasi'].',\'ubah\');" class="btn btn-info"
									  	onmouseover="return tooltipx(this);" data-toggle="tooltip" title="ubah" data-placement="top" >
								  		<i class="icon-pencil"></i>
							  		</button>
								  	<button onclick="hapustdonasi('.$res['id_tdonasi'].');" class="btn btn-danger"
									  	onmouseover="return tooltipx(this);" data-toggle="tooltip" title="hapus" data-placement="top" >
								  		<i class="icon-trash"></i>
							  		</button>
								  	<button onclick="edittdonasi('.$res['id_tdonasi'].',\'konfirmasi\');" class="btn btn-success"
									  	onmouseover="return tooltipx(this);" data-toggle="tooltip" title="konfirmasi" data-placement="top" >
								  		<i class="icon-ok"></i>
							  		</button>
								</div>';
					}elseif($res['isLunas']=='o'){ //sudah konfirmasi / upload bukti pembayaran
						$status ='<label class="label label-success">Pending</label>';
						$clr = 'class="success" onmouseover="return tooltipx(this);" data-toggle="tooltip" title="Pending" data-placement="left" ';
						$btn ='<div class="btn-group">
								  	<button disabled class="btn btn-default" >
								  		<i class="icon-pencil"></i>
							  		</button>
								  	<button type="button" onclick="hapustdonasi('.$res['id_tdonasi'].');" class="btn btn-danger"
									  	onmouseover="return tooltipx(this);" data-toggle="tooltip" title="hapus" data-placement="top" >
								  		<i class="icon-trash"></i>
							  		</button>
								  	<button disabled class="btn btn-default">
								  		<i class="icon-ok"></i>
							  		</button>
								</div>';
					}else{ //sudah approve oleh admin 
						$tot+=$res['nom_akhir'];
						$status ='<label class="label label-info">Sudah diperiksa</label>';
						$clr = 'class="info" onmouseover="return tooltipx(this);" data-toggle="tooltip" title="Sudah diperiksa admin" data-placement="left" ';
						$btn ='<div class="btn-group">
								  	<button disabled class="btn btn-default" >
								  		<i class="icon-pencil"></i>
							  		</button>
								  	<button disabled class="btn btn-default">
								  		<i class="icon-trash"></i>
							  		</button>
								  	<button disabled class="btn btn-default">
								  		<i class="icon-ok"></i>
							  		</button>
								</div>';
					}

					$out.='<tr '.$clr.'>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['dtipebayar'].'</label></td>
							<td><label class="control-label">'.$res['no_rek'].'</label></td>
							<td><label class="control-label">Rp. '.number_format($res['nom_akhir']).',-</label></td>
							<td><label class="control-label">'.$tgl_lunas.'</label></td>
							<td><label class="control-label">'.$status.'</label></td>
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
						<td  colspan="7"><span style="color:red;text-align:center;">
						... data masih kosong...</span></td></tr>';
			}
			#link paging
			$out.='<tr style="color:blue;font-weight:bold;">
					<td colspan="3">

						<span class="pull-right">Total :</span>
						<span class="pull-left" style="color:red;">* Hanya donasi yang telah masuk rekening [YATIM MANDIRI]</span>
					</td>
					<td colspan="4">Rp. '.number_format($tot).',-</td>
					</tr>';
			// <p class="pull-right label label-warning">Hanya donasi yang telah masuk rekening [YATIM MANDIRI] </p>
			$out.='<tr class="info"><td colspan="7">'.$obj->anchors.'</td></tr>';
			$out.='<tr class="info"><td colspan="7">'.$obj->total.'</td></tr>';
		echo $out;
	break;
	
} ?>			
