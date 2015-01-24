<?php
	session_start();
	// error_reporting(0);
	include"../../lib/koneksi.php";
	include"../../lib/pagination_class.php";
	include"../../lib/tglindo.php"; 
	
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

				case 'mjenjang':
					$sql	= 'SELECT * FROM  mjenjang ';
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
						ms.id_msekolah,
						ms.alamat,
						ms.nama,
						kc.id_mkecamatan,
						ko.id_mkota,
						po.id_mpropinsi,
						j.id_mjenjang
					FROM
						msekolah ms
						JOIN mjenjang j on j.id_mjenjang = ms.id_mjenjang
						JOIN mkecamatan kc on kc.id_mkecamatan = ms.id_mkecamatan
						JOIN mkota ko on ko.id_mkota= kc.id_mkota
						JOIN mpropinsi po on po.id_mpropinsi = ko.id_mpropinsi
					WHERE 
						ms.id_msekolah = '.$_GET['id_msekolah'];
			$exe = mysql_query($sql);
			$res = mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"nama":"'.$res['nama'].'",
					"alamat":"'.$res['alamat'].'",
					"id_mpropinsi":"'.$res['id_mpropinsi'].'",
					"id_mkota":"'.$res['id_mkota'].'",
					"id_mkecamatan":"'.$res['id_mkecamatan'].'",
					"id_mjenjang":"'.$res['id_mjenjang'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = 'UPDATE msekolah set nama 	 		= "'.mysql_real_escape_string($_POST['namaTB']).'",
										alamat 			= "'.mysql_real_escape_string($_POST['alamatTB']).'",
										id_mkecamatan 	= '.$_POST['id_mkecamatanTB'].',
										id_mjenjang 	= '.$_POST['id_mjenjangTB'].'
							where id_msekolah	 ='.$_GET['id_msekolah'];
			#var_dump($sql);exit();
			$exe	= mysql_query($sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
			
		break;
		#tambah  ==============================================================================================
		case 'tambah':
			$sql = 'INSERT into  msekolah set 	nama 	 		= "'.mysql_real_escape_string($_POST['namaTB']).'",
												alamat 			= "'.mysql_real_escape_string($_POST['alamatTB']).'",
												id_mkecamatan 	= '.$_POST['id_mkecamatanTB'].',
												id_mjenjang 	= '.$_POST['id_mjenjangTB'];
			# var_dump($sql);exit();
			$exe	= mysql_query($sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			// $sql	= "DELETE from mtipebayar where id_mtipebayar ='$_GET[id_mtipebayar]'";
			$sql	= 'DELETE from msekolah where id_msekolah ='.$_GET['id_msekolah'];
			$exe	= mysql_query($sql);
			//var_dump($sql);exit();
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';	
			}
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			$nama 		= trim($_GET['namaS'])?$_GET['namaS']:'';
			$mjenjang 	= trim($_GET['mjenjangS'])?$_GET['mjenjangS']:'';
			$alamat 	= trim($_GET['alamatS'])?$_GET['alamatS']:'';
			$mkecamatan	= trim($_GET['mkecamatanS'])?$_GET['mkecamatanS']:'';
			$mkota 		= trim($_GET['mkotaS'])?$_GET['mkotaS']:'';
			$mpropinsi 	= trim($_GET['mpropinsiS'])?$_GET['mpropinsiS']:'';

			$sql = 'SELECT
						*
					FROM
						msekolah s
						JOIN mkecamatan kc ON kc.id_mkecamatan = s.id_mkecamatan
						JOIN mkota ko ON ko.id_mkota= kc.id_mkota
						JOIN mpropinsi po ON po.id_mpropinsi= ko.id_mpropinsi
						JOIN mjenjang j ON j.id_mjenjang = s.id_mjenjang
					WHERE
						s.nama LIKE "%'.$nama.'%" AND
						j.mjenjang LIKE "%'.$mjenjang.'%" AND
						s.alamat LIKE "%'.$alamat.'%" AND
						kc.mkecamatan LIKE "%'.$mkecamatan.'%" AND
						ko.mkota LIKE "%'.$mkota.'%" AND
						po.mpropinsi LIKE "%'.$mpropinsi.'%" 
					ORDER BY
						s.id_msekolah ASC ';
			// print_r($sql);exit();
			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 5;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			if(mysql_num_rows($result)!=0)
			{
				$nox 	= $starting+1;
				while($res = mysql_fetch_array($result)){	
					$btn ='<td>
								 <a class="btn" href="javascript:editsekolah('.$res['id_msekolah'].');" 
								 role="button"><i class="icon-pencil"></i></a>
								 <a class="btn" href="javascript:hapussekolah('.$res['id_msekolah'].');" 
								 role="button"><i class="icon-remove"></i></a>
							 </td>';
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['nama'].'</label></td>
							<td><label class="control-label">'.$res['mjenjang'].'</label></td>	
							<td><label class="control-label">'.$res['alamat'].'</label></td>	
							<td><label class="control-label">'.$res['mkecamatan'].'</label></td>	
							<td><label class="control-label">'.$res['mkota'].'</label></td>							
							<td><label class="control-label">'.$res['mpropinsi'].'</label></td>							
							'.$btn.'
						</tr>';
                	$nox++;
				}
			}
			#kosong
			else
			{
				echo "<tr align='center'>
						<td  colspan=7 ><span style='color:red;text-align:center;'>
						... data masih kosong...</span></td></tr>";
			}
			#link paging
			echo "<tr class='info'><td colspan=8>".$obj->anchors."</td></tr>";
			echo "<tr class='info'><td colspan=8>".$obj->total."</td></tr>";
	break;
	
} ?>			
