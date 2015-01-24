<?php
	session_start();
	require_once '../../lib/koneksi.php';
	require_once '../../lib/tglindo.php'; 

	$aksi	= isset($_GET['aksi'])?$_GET['aksi']:'';
	$menu	= isset($_GET['menu'])?$_GET['menu']:'';

	switch ($aksi){
#hapus akun user (dosen) secara keseluruhan secara paralel otomatis (user + dsn + histjab + dtk + bukeg) =====================
		case 'hapusAkun':
			$sql = 'DELETE from mlogin where id_mlogin ='.$_SESSION['id_mloginy'];
			$exe = mysql_query($sql);
			if($exe){
				echo '{"status":"berhasil_hapus"}';
			}
		break;
#hapus akun user (dosen)=======================================================================================================

#combo ========================================================================================================================
		case 'combo':
			switch($menu){
		#Kecamatan---------------------------------------------
				case 'mkecamatan':
					// $sql 	= '	SELECT * from mkecamatan where id_mkota ='.$_GET['id_mkota'].' order by mkecamatan  asc';
					$whr 	= !empty($_GET['id_mkota'])?'where id_mkota = "'.$_GET['id_mkota'].'"':'';
					$sql 	= 'SELECT * from mkecamatan  '.$whr.' order by mkecamatan  asc';
					$exe	= mysql_query($sql);
					$ambil  = array();

					// print_r($sql);exit();
					while($ambilR	= mysql_fetch_assoc($exe)){
						$ambil[]=$ambilR;
					}
					
					if(!$exe){
						$out='{"status":"error db"}';
					}else{
						if($ambil!=NULL){
							$out='{
									"status":"sukses",
									"datax":'.json_encode($ambil).'
								}';
						}else{
							$out='{"status":"kosong"}';
						}
					}
					echo $out;
				break;	
		#end of Kecamatan----------------------------------------
		#kota---------------------------------------------
				case 'mkota':
					$whr 	= !empty($_GET['id_mpropinsi'])?'where id_mpropinsi = "'.$_GET['id_mpropinsi'].'"':'';
					$sql 	= 'SELECT * from mkota  '.$whr.' order by mkota  asc';
					$exe	= mysql_query($sql);
					$ambil  = array();
					// print_r($sql);exit();
					while($ambilR	= mysql_fetch_array($exe)){
						$ambil[]=$ambilR;
					}

					if(!$exe){
						$out='{"status":"error db"}';
					}else{
						if($ambil!=NULL){
							$out='{
									"status":"sukses",
									"datax":'.json_encode($ambil).'
								}';
						}else{
							$out='{"status":"kosong"}';
						}
					}
					echo $out;
				break;	
		#end of kota----------------------------------------
		#prop---------------------------------------------
				case 'mpropinsi':
					$sql 	= "	SELECT * from mpropinsi  order by mpropinsi  asc  ";
					$exe	= mysql_query($sql);
					$ambil  = array();
					
					while($ambilR	= mysql_fetch_array($exe)){
						$ambil[]=$ambilR;
					}

					if(!$exe){
						$out='{"status":"error db"}';
					}else{
						if($ambil!=NULL){
							$out='{
									"status":"sukses",
									"datax":'.json_encode($ambil).'
								}';
						}else{
							$out='{"status":"gagal"}';
						}
					}
					echo $out;
				break;	
		#end of propinsi----------------------------------------

				}
		break;

# edit/ubah =======================================================================================================
		case 'ubah':
			#update :madmin / marketer
				$pass='';
				if(isset($_POST['passBTB2']) && !empty($_POST['passBTB2'])){
					$sql='UPDATE mlogin set password="'.md5(trim(mysql_real_escape_string($_POST['passBTB2']))).'"  WHERE id_mlogin='.$_SESSION['id_mloginy'];
					// var_dump($sql);exit();
					$exe = mysql_query($sql);
					if (!$exe) {
						$out='{"status":"gagal ubah data login"}';
					}
				}
				$tb = ($_SESSION['levely']=='kwarda')?'madmin':'mmarketer';
				$sql2 = 'UPDATE '.$tb.' set	nama	= "'.trim(mysql_real_escape_string($_POST['namaTB'])).'",
											no_telp	= "'.trim(mysql_real_escape_string($_POST['no_telpTB'])).'"
									where  	id_mlogin= '.$_SESSION['id_mloginy'];
				// var_dump($sql2);exit();
				$exe2 = mysql_query($sql2);
				if(!$exe2){
					$out='{"status":"gagal ubah admin "}';
				}else{
					$out='{"status":"sukses"}';
				}
			echo $out;
		break;
#end of ubah ================================================================================
		
#view (login + biodata + jabatan)  ==========================================================
		case 'tampil' :
			$tb=($_SESSION['levely']=='admin')?'madmin':'mmarketer';
			
			$sql = 'SELECT *
					FROM
						mlogin 
						left JOIN '.$tb.' ON '.$tb.'.id_mlogin = mlogin.id_mlogin
					WHERE
					 mlogin.id_mlogin ='.$_SESSION['id_mloginy'];
			// print_r($sql);exit();
			$exe	= mysql_query($sql);
			$res 	= mysql_fetch_assoc($exe);	
			if($exe){
				echo'{
					"email":"'.$res['email'].'",
					"no_telp":"'.$res['no_telp'].'",
					"nama":"'.$res['nama'].'"
				}';
			}else{
				echo '{"status":"kosong"}';	
			}
		break;
#end of tampil  =====================================================================================
	}
?>