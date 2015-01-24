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
			#cek id login di mdonatur (ada /tidak)
			$sqlc = 'SELECT * from mdonatur where id_mlogin = '.$_SESSION['id_mloginy'];
			$exec = mysql_query($sqlc);
			$jumc = mysql_num_rows($exec);
			$out ='';

			# udpate : mlogin  -------------------
				if(isset($_POST['passBTB2']) && !empty($_POST['passBTB2'])){
					$sql1='UPDATE mlogin set password="'.md5(trim(mysql_real_escape_string($_POST['passBTB2']))).'" where id_mlogin='.$_SESSION['id_mloginy'];
					$exe1 = mysql_query($sql1);
					// var_dump($exe1);exit();
				}
			#end of update : mlogin 
			
			#add / update : malamat & mdonatur
				$sqla=' malamat		= "'.trim(mysql_real_escape_string($_POST['malamatTB'])).'",
						id_mkecamatan= "'.trim(mysql_real_escape_string($_POST['id_mkecamatanTB'])).'",
						kode_pos	= '.trim(mysql_real_escape_string($_POST['kode_posTB'])).',
						tipe		= "rumah"';
				
				$sqld= ' nama			= "'.trim(mysql_real_escape_string($_POST['namaTB'])).'",
						j_kelamin		= "'.trim(mysql_real_escape_string($_POST['j_kelaminTB'])).'",
						telp			= "'.trim(mysql_real_escape_string($_POST['telpTB'])).'",											
						hp				= "'.trim(mysql_real_escape_string($_POST['hpTB'])).'"';
				if ($jumc==0) { //add
					$sql2	= 'INSERT INTO malamat set '.$sqla;
					$sql3	= 'INSERT INTO mdonatur set '.$sqld.', id_mlogin='.$_SESSION['id_mloginy'];
					// $sql3	= 'INSERT INTO mdonatur set '.$sqld.', id_malamat 	= '.mysql_insert_id();
				}else{
					$sql2	= 'UPDATE malamat set'.$sqla.'WHERE  id_malamat ='.$_POST['id_malamatH'];
					$sql3	= 'UPDATE mdonatur set'.$sqld.'WHERE  id_mlogin ='.$_SESSION['id_mloginy'];
				}

				$exe2	= mysql_query($sql2);
				if(!$exe2){
					$out='{"status":"gagal alamat"}';
				}else{
					if($jumc==0) {//add
						$sql3.=', id_malamat 	= '.mysql_insert_id();
					}

					// print_r($sql3);exit();
					$exe3	= mysql_query($sql3);
					if (!$exe3) {
						$out='{"status":"gagal donatur"}';
					} else {
						$out='{"status":"sukses"}';
					}
				}
			#add / update : malamat & mdonatur
			echo $out;
		break;
#end of ubah ================================================================================
		
#view (login + biodata + jabatan)  ==========================================================
		case 'tampil' :
			$sql = 'SELECT *
					FROM
						mlogin ml
						left JOIN mdonatur md ON md.id_mlogin         = ml.id_mlogin
						left JOIN malamat mal ON mal.id_malamat       = md.id_malamat				
						left JOIN mkecamatan mkc ON mkc.id_mkecamatan = mal.id_mkecamatan
						left JOIN mkota mko ON mko.id_mkota           = mkc.id_mkota
						left JOIN mpropinsi mpo ON mpo.id_mpropinsi   = mko.id_mpropinsi
					WHERE
						ml.id_mlogin ='.$_SESSION['id_mloginy'];
			$exe	= mysql_query($sql);
			$res 	= mysql_fetch_assoc($exe);	
			// print_r($sql);exit();

			if($exe){
				echo'{
					"email":"'.$res['email'].'",
					"nama":"'.$res['nama'].'",
					"j_kelamin":"'.$res['j_kelamin'].'",
					"id_malamat":"'.$res['id_malamat'].'",
					"malamat":"'.$res['malamat'].'",
					"pre_malamat":"'.$res['pre_malamat'].'",
					"kode_pos":"'.$res['kode_pos'].'",
					"id_mkecamatan":"'.$res['id_mkecamatan'].'",
					"mkecamatan":"'.$res['mkecamatan'].'",
					"id_mkota":"'.$res['id_mkota'].'",
					"mkota":"'.$res['mkota'].'",
					"id_mpropinsi":"'.$res['id_mpropinsi'].'",
					"mpropinsi":"'.$res['mpropinsi'].'",
					"telp":"'.$res['telp'].'",
					"hp":"'.$res['hp'].'"
				}';
			}else{
				echo '{"status":"kosong"}';	
			}
		break;
#end of tampil  =====================================================================================
	}
?>