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
			$sql = 'SELECT
						*
					FROM
						mlembaga l
						JOIN mkecamatan kc ON kc.id_mkecamatan = l.id_mkecamatan
						JOIN mkota ko ON ko.id_mkota= kc.id_mkota
						JOIN mpropinsi po ON po.id_mpropinsi= ko.id_mpropinsi
					where 
						l.id_mlembaga = '.$_GET['id_mlembaga'].' 
					ORDER BY
						po.mpropinsi ASC,
						ko.mkota ASC,
						kc.mkecamatan ASC';
			// print_r($sql);exit();

			$exe	= mysql_query($sql);
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_mpropinsi":"'.$res['id_mpropinsi'].'",
					"id_mkota":"'.$res['id_mkota'].'",
					"id_mkecamatan":"'.$res['id_mkecamatan'].'",
					"mlembaga":"'.$res['mlembaga'].'",
					"alamat":"'.$res['alamat'].'",
					"no_telp":"'.$res['no_telp'].'",
					"koordinator":"'.$res['koordinator'].'",
					"no_telpkoord":"'.$res['no_telpkoord'].'"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = "UPDATE mlembaga set 	id_mkecamatan	= '".mysql_real_escape_string($_POST['id_mkecamatanTB'])."',
											mlembaga 		= '".mysql_real_escape_string($_POST['mlembagaTB'])."',
											alamat			= '".mysql_real_escape_string($_POST['alamatTB'])."',
											no_telp			= '".mysql_real_escape_string($_POST['notelpTB'])."',
											koordinator		= '".mysql_real_escape_string($_POST['koorTB'])."',
											no_telpKoord	= '".mysql_real_escape_string($_POST['nokoorTB'])."'	
								where 		id_mlembaga		= ".$_GET['id_mlembaga'];
		//var_dump($sql);exit();
			$exe	= mysql_query($sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"kurang berhasil"}';
			}
			
		break;
		#tambah  ==============================================================================================
		case 'tambah':
			$sql = 'INSERT into mlembaga  set	id_mkecamatan= '.mysql_real_escape_string($_POST['id_mkecamatanTB']).',
											mlembaga		= "'.mysql_real_escape_string($_POST['mlembagaTB']).'",		
											alamat			= "'.mysql_real_escape_string($_POST['alamatTB']).'",
											no_telp			= '.mysql_real_escape_string($_POST['notelpTB']).',
											koordinator		= "'.mysql_real_escape_string($_POST['koorTB']).'",
											no_telpKoord	= '.mysql_real_escape_string($_POST['nokoorTB']);
			#var_dump($sql);exit();
			$exe	= mysql_query($sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from mlembaga where id_mlembaga ='.$_GET['id_mlembaga'];
			// var_dump($sql);exit();
			$exe	= mysql_query($sql);
			
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';	
			}
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			$mlembaga	= trim($_GET['mlembagaS'])?$_GET['mlembagaS']:'';
			$alamat 	= trim($_GET['alamatS'])?$_GET['alamatS']:'';
			$mkecamatan	= trim($_GET['mkecamatanS'])?$_GET['mkecamatanS']:'';
			$koordinator= trim($_GET['koordinatorS'])?$_GET['koordinatorS']:'';
			$no_telp 	= trim($_GET['no_telpS'])?$_GET['no_telpS']:'';
			$no_telpkoord= trim($_GET['no_telpkoordS'])?$_GET['no_telpkoordS']:'';
			$mpropinsi 	= trim($_GET['mpropinsiS'])?$_GET['mpropinsiS']:'';
			$mkota 		= trim($_GET['mkotaS'])?$_GET['mkotaS']:'';
			$mkecamatan = trim($_GET['mkecamatanS'])?$_GET['mkecamatanS']:'';

			$sql = 'SELECT
						*
					FROM
						mlembaga l
						JOIN mkecamatan kc ON kc.id_mkecamatan = l.id_mkecamatan
						JOIN mkota ko ON ko.id_mkota= kc.id_mkota
						JOIN mpropinsi po ON po.id_mpropinsi= ko.id_mpropinsi
					WHERE
						l.mlembaga like "%'.$mlembaga.'%" AND
						l.alamat like "%'.$alamat.'%" AND
						l.no_telp like "%'.$no_telp.'%" AND
						l.no_telp like "%'.$no_telp.'%" AND
						l.no_telpkoord like "%'.$no_telpkoord.'%" AND
						l.koordinator like "%'.$koordinator.'%" AND
						kc.mkecamatan like "%'.$mkecamatan.'%" AND
						ko.mkota like "%'.$mkota.'%" AND
						po.mpropinsi like "%'.$mpropinsi.'%" 
					ORDER BY
						po.mpropinsi ASC,
						ko.mkota ASC,
						kc.mkecamatan ASC';


			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 5;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			$jum	= mysql_num_rows($result);
			if($jum!=0){	
				$nox	= $starting+1;
				while($res = mysql_fetch_array($result)){	
					$btn ="	 <td>
								 <a class='btn btn-secondary' href=\"javascript:editGol('$res[id_mlembaga]');\" 
								 role='button'><i class='icon-pencil'></i></a>
								 <a class='btn btn-secondary' href=\"javascript:hapusGol('$res[id_mlembaga]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>";
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['mlembaga'].'</label></td>
							<td><label class="control-label">'.$res['alamat'].'</label></td>
							<td><label class="control-label">'.$res['mkecamatan'].'</label></td>
							<td><label class="control-label">'.$res['mkota'].'</label></td>
							<td><label class="control-label">'.$res['mpropinsi'].'</label></td>
							<td><label class="control-label">'.$res['no_telp'].'</label></td>
							<td><label class="control-label">'.$res['koordinator'].'</label></td>
							<td><label class="control-label">'.$res['no_telpkoord'].'</label></td>
							'.$btn.'
						</tr>';
                	$nox++;
				}
			}
			#kosong
			else
			{
				echo "<tr align='center'>
						<td  colspan=10 ><span style='color:red;text-align:center;'>
						... data masih kosong...</span></td></tr>";
			}
			#link paging
			echo "<tr class='info'><td colspan=10>".$obj->anchors."</td></tr>";
			echo "<tr class='info'><td colspan=10>".$obj->total."</td></tr>";
	break;
	
} ?>			
