<?php
	session_start();
	error_reporting(0);
	include"../../lib/koneksi.php";
	include"../../lib/pagination_class.php";
	include "../../lib/tglindo.php"; 
	
 	$aksi 	=  isset($_GET['aksi'])?$_GET['aksi']:'';
	$page 	=  isset($_GET['page'])?$_GET['page']:'';
	$cari	=  isset($_GET['cari'])?$_GET['cari']:'';
	$tabel	=  isset($_GET['tabel'])?$_GET['tabel']:'';
	$menu	=  isset($_GET['menu'])?$_GET['menu']:'';
	
	switch ($aksi){
		case 'hapussekolah':
			$sql	= 'DELETE from dpenerima where id_dpenerima ='.$_GET['id_dpenerima'];
			$exe	= mysql_query($sql);
			
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';	
			}
		break;

		case 'tambahsekolah':
			$sql= 'INSERT into dpenerima set id_msekolah 	='.$_GET['id_msekolahTB'].',
											  id_mlembaga 	='.$_GET['id_mlembagaTB'].',
											  id_mpenerima 	='.$_GET['id_mpenerimaH'].',
											  status 		="aktif"';
		  	var_dump($sql);exit();
		  	$exe = mysql_query($sql);
		  	$out = $exe?'{"status":"sukses"}':'{"status":"gagal simpan"}';
		  	echo $out;
		break;
		#view==============================================================================================
		case 'viewsekolah':
			$sql =' SELECT
						*
					FROM
						dpenerima dp
						JOIN msekolah s on s.id_msekolah= dp.id_msekolah
						JOIN mlembaga lb on lb.id_mlembaga = dp.id_mlembaga
					where
						dp.id_mpenerima='.$_GET['id_mpenerima'];
			// print_r($sql);exit();
			$exe = mysql_query($sql);
			$datax=array();
			while ($res=mysql_fetch_assoc($exe)) {
				$datax[]=$res;
			}

			if(!$exe){
				$out='{"status":"error db"}';
			}else{
				if ($datax==NULL) {
					$out='{"status":"kosong"}';
				} else {
					$out='{"status":"sukses","datax":'.json_encode($datax).'}';
				}
			}
			echo $out;
		break;

		#combo ==============================================================================================
		case 'combo':
			switch($menu){
				case 'msekolah':
					$sql	= 'SELECT * FROM  msekolah ORDER BY nama';
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

				case 'mlembaga':
					$sql	= 'SELECT * FROM  mlembaga ORDER BY mlembaga';
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
						mp.*,kc.*,ko.*,po.*,mo.*,al.*,
						YEAR(now())-YEAR(mp.tgl_lahir)as umur
					FROM
						mpenerima mp
						JOIN malamat al ON al.id_malamat= mp.id_malamat
						JOIN mkecamatan kc ON kc.id_mkecamatan = al.id_mkecamatan
						JOIN mkota ko ON ko.id_mkota = kc.id_mkota
						JOIN mpropinsi po ON po.id_mpropinsi = ko.id_mpropinsi
						JOIN mortupenerima mo ON mo.id_mpenerima = mp.id_mpenerima
					WHERE
						mp.id_mpenerima = '.$_GET['id_mpenerima'];

			$exe	= mysql_query($sql);
			#var_dump($exe);exit();
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_mpenerima":"'.$res['id_mpenerima'].'",
					"id_mkecamatan":"'.$res['id_mkecamatan'].'",
					"nm_lengkap":"'.$res['nm_lengkap'].'",
					"nm_panggilan":"'.$res['nm_panggilan'].'",
					"anak_ke":"'.$res['anak_ke'].'",
					"jml_sdr":"'.$res['jml_sdr'].'",
					"j_kelamin":"'.$res['j_kelamin'].'",
					"tmp_lahir":"'.$res['tmp_lahir'].'",
					"tgl_lahir":"'.$res['tgl_lahir'].'",
					"alamat":"'.$res['alamat'].'",
					"agama":"'.$res['agama'].'",
					"no_telp":"'.$res['no_telp'].'",
					"email":"'.$res['email'].'",
					"asrama":"'.$res['asrama'].'",
					"status_sos":"'.$res['status_sos'].'",
					"isActive":"'.$res['isActive'].'"
				}';

			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = "UPDATE mpenerima set 	id_mkecamatan		= '".mysql_real_escape_string($_POST['id_mkecamatanTB'])."',
											nm_lengkap			= '".mysql_real_escape_string($_POST['nm_lengkapTB'])."',
											nm_panggilan		= '".mysql_real_escape_string($_POST['nm_panggilanTB'])."',
											anak_ke				= '".mysql_real_escape_string($_POST['anak_keTB'])."',
											jml_sdr				= '".mysql_real_escape_string($_POST['jml_sdrTB'])."',
											j_kelamin			= '".mysql_real_escape_string($_POST['j_kelaminTB'])."',
											tmp_lahir			= '".mysql_real_escape_string($_POST['tmp_lahirTB'])."',
											tgl_lahir			= '".mysql_real_escape_string($_POST['tgl_lahirTB'])."',
											alamat				= '".mysql_real_escape_string($_POST['alamatTB'])."',
											agama				= '".mysql_real_escape_string($_POST['agamaTB'])."',
											no_telp				= '".mysql_real_escape_string($_POST['no_telpTB'])."',
											email				= '".mysql_real_escape_string($_POST['emailTB'])."',
											asrama				= '".mysql_real_escape_string($_POST['asramaTB'])."',
											status_sos			= '".mysql_real_escape_string($_POST['status_sosTB'])."',
											isActive 			= '".mysql_real_escape_string($_POST['isActiveTB'])."'
									where	id_mpenerima		= ".$_GET['id_mpenerima'];
		//var_dump($sql);exit();
			$exe	= mysql_query($sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
			
		break;


		#tambah  ==============================================================================================
		case 'tambah':
			// alamat penerima--------------------------------------------------------------------------------------
			$sqal 	= 'INSERT into malamat  set	malamat			= "'.mysql_real_escape_string($_POST['malamatpTB']).'",
												id_mkecamatan 	= "'.$_POST['id_mkecpTB'].'",
												kode_pos		= "'.mysql_real_escape_string($_POST['kode_posoTB']).'",
												tipe			= "rumah" ';
			$exal	= mysql_query($sqal);	
			$idal 	= mysql_insert_id();
			if (!$exal) {
				$out='{"status":"gagal simpan alamat penerima"}';
			} else {
				// bio mpenerima --------------------------------------------------------------------------------------
				$sqp 	= 'INSERT into mpenerima  set	id_malamat		= '.$idal.',
														nm_lengkap		= "'.mysql_real_escape_string($_POST['nm_lengkapTB']).'",
														nm_panggilan 	= "'.mysql_real_escape_string($_POST['nm_panggilanTB']).'",
														anak_ke			= "'.mysql_real_escape_string($_POST['anak_keTB']).'",
														jml_sdr			= "'.mysql_real_escape_string($_POST['jml_sdrTB']).'",
														j_kelamin		= "'.mysql_real_escape_string($_POST['j_kelaminTB']).'",
														tmp_lahir		= "'.mysql_real_escape_string($_POST['tmp_lahirTB']).'",
														tgl_lahir		= "'.mysql_real_escape_string($_POST['tgl_lahirTB']).'",
														agama			= "'.mysql_real_escape_string($_POST['agamaTB']).'",
														no_telp			= "'.mysql_real_escape_string($_POST['no_telpTB']).'",
														email			= "'.mysql_real_escape_string($_POST['emailTB']).'",
														asrama			= "'.mysql_real_escape_string($_POST['asramaTB']).'",
														status_sos		= "'.mysql_real_escape_string($_POST['status_sosTB']).'",
														isActive		= "'.mysql_real_escape_string($_POST['isActiveTB']).'"';
				$exp	= mysql_query($sqp);
				$idp 	= mysql_insert_id();
				if (!$exp) {
					$out='{"status":"gagal simpan biodata penerima"}';
				} else {
					// alamat ortu--------------------------------------------------------------------------------------
					$sqalo 	= 'INSERT into malamat  set	malamat			= "'.mysql_real_escape_string($_POST['malamatoTB']).'",
														id_mkecamatan 	= "'.$_POST['id_mkecpTB'].'",
														kode_pos		= "'.mysql_real_escape_string($_POST['kode_posoTB']).'",
														tipe			= "rumah" ';
					$exalo	= mysql_query($sqalo);
					$idalo 	= mysql_insert_id();
					$idalw2 = '';
					// alamat wali--------------------------------------------------------------------------------------
					if(isset($_POST['tugelTB'])){
						$sqalw 	= 'INSERT into malamat  set	malamat		= "'.mysql_real_escape_string($_POST['malamatwTB']).'",
															id_mkecamatan 	= "'.$_POST['id_mkecwTB'].'",
															kode_pos		= "'.mysql_real_escape_string($_POST['kode_poswTB']).'",
															tipe			= "rumah" ';
						$exalw	= mysql_query($sqalw);
						// $idalw 	= mysql_insert_id();
						$idalw2.= 'id_malamatw		= '.mysql_insert_id().',';
						if(!$exalw)
							$out='{"status":"gagal simpan alamat wali"}';
					}

					if (!$exalo) {
						$out='{"status":"gagal simpan alamat ortu"}';
					} else {
						// if (!$exalw) {
						// } else {
							//bio ortu / wali -----------------------------------------------------------------------------------------
							$sqor 	= 'INSERT into mortupenerima  set 	id_mpenerima	='.$idp.',
																		nm_ayah			= "'.mysql_real_escape_string($_POST['nm_ayahTB']).'",
																		nm_ibu			= "'.mysql_real_escape_string($_POST['nm_ibuTB']).'",
																		nm_wali			= "'.mysql_real_escape_string($_POST['nm_waliTB']).'",
																		job_ibu			= "'.mysql_real_escape_string($_POST['job_ibuTB']).'",
																		job_ayah		= "'.mysql_real_escape_string($_POST['job_ayahTB']).'",
																		job_wali		= "'.mysql_real_escape_string($_POST['job_waliTB']).'",
																		gaji_ayah		= "'.mysql_real_escape_string($_POST['gaji_ayahTB']).'",
																		gaji_ibu		= "'.mysql_real_escape_string($_POST['gaji_ibuTB']).'",
																		gaji_wali		= "'.mysql_real_escape_string($_POST['gaji_waliTB']).'",
																		id_malamato		= '.$idalo.', '.$idalw2.'
																		stat_ayah		= "'.mysql_real_escape_string($_POST['stat_ayahTB']).'",
																		stat_ibu		= "'.mysql_real_escape_string($_POST['stat_ibuTB']).'"';
							$exor	= mysql_query($sqor);
							// var_dump(count($_POST['prest']));exit();
							$out2=0;
							if (!isset($_POST['prest'])) {
								$out2+=0;
							}else{
								foreach ($_POST['prest'] as $key => $count ){
									// $katpres	= $_POST['katpresTB_'.$count];
									$sqpr	='INSERT into dprestasi set	id_mpenerima= '.$idp.',
																		instansi	= "'.$_POST['instansiTB'][$key].'",
																		kompetisi	= "'.$_POST['kompetisiTB'][$key].'",
																		tingkat		= "'.$_POST['tingkatTB'][$key].'",
																		juara		= "'.$_POST['juaraTB'][$key].'",
																		katpres		= "'.$_POST['katpresTB'][$key].'",
																		tahun		= "'.$_POST['tahunTB'][$key].'"';
									// var_dump($sqpr);exit();
									$expr = mysql_query($sqpr);
									if(!$expr){
										$out2+=1;
									}
								}
							}

							if($out2>0){
								$out='{"status":"gagal simpan prest"}';
							}else{
								$out='{"status":"sukses"}';
							}
							#eo bio ortu/wali
						// }#eo alamat wali
					}#eo alamat ortu  
				}#bio penerima
			}#eo alamat penerima
			echo $out;
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from mpenerima where id_mpenerima ='.$_GET['id_mpenerima'];
			$exe	= mysql_query($sql);
			
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';	
			}
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			$nm_lengkap		= trim($_GET['nm_lengkapS'])?$_GET['nm_lengkapS']:'';
			$nm_panggilan 	= trim($_GET['nm_panggilanS'])?$_GET['nm_panggilanS']:'';
			$anak_ke		= trim($_GET['anak_keS'])?$_GET['anak_keS']:'';
			$jml_sdr		= trim($_GET['jml_sdrS'])?$_GET['jml_sdrS']:'';
			$j_kelamin 		= trim($_GET['j_kelaminS'])?$_GET['j_kelaminS']:'';
			$tmp_lahir		= trim($_GET['tmp_lahirS'])?$_GET['tmp_lahirS']:'';
			$tgl_lahir		= trim($_GET['tgl_lahirS'])?$_GET['tgl_lahirS']:'';
			$alamatp 		= trim($_GET['alamatpS'])?$_GET['alamatpS']:'';
			$agama			= trim($_GET['agamaS'])?$_GET['agamaS']:'';
			$no_telp 		= trim($_GET['no_telpS'])?$_GET['no_telpS']:'';
			$email			= trim($_GET['emailS'])?$_GET['emailS']:'';
			$asrama 		= trim($_GET['asramaS'])?$_GET['asramaS']:'';
			$status_sos		= trim($_GET['status_sosS'])?$_GET['status_sosS']:'';
			$isActive 		= trim($_GET['isActiveS'])?$_GET['isActiveS']:'';

			$sql = 'SELECT	
						mp.*,kc.*,ko.*,po.*,mo.*,al.*,
						YEAR(now())-YEAR(mp.tgl_lahir)as umur
					FROM
						mpenerima mp
						JOIN malamat al ON al.id_malamat= mp.id_malamat
						JOIN mkecamatan kc ON kc.id_mkecamatan = al.id_mkecamatan
						JOIN mkota ko ON ko.id_mkota = kc.id_mkota
						JOIN mpropinsi po ON po.id_mpropinsi = ko.id_mpropinsi
						JOIN mortupenerima mo ON mo.id_mpenerima = mp.id_mpenerima
					WHERE
						mp.nm_lengkap like "%'.$nm_lengkap.'%" AND
						mp.nm_panggilan like "%'.$nm_panggilan.'%" AND
						mp.anak_ke like "%'.$anak_ke.'%" AND
						mp.jml_sdr like "%'.$jml_sdr.'%" AND
						mp.j_kelamin like "%'.$j_kelamin.'%" AND
						mp.tmp_lahir like "%'.$tmp_lahir.'%" AND
						mp.tgl_lahir like "%'.$tgl_lahir.'%" AND
						al.malamat like "%'.$alamatp.'%" AND
						mp.agama like "%'.$agama.'%" AND
						mp.no_telp like "%'.$no_telp.'%" AND
						mp.email like "%'.$email.'%" AND
						mp.asrama like "%'.$asrama.'%" AND
						mp.status_sos like "%'.$status_sos.'%" AND
						mp.isActive like "%'.$isActive.'%"
					ORDER BY
						po.mpropinsi ASC';
		

			$starting=isset($_GET['starting'])?$_GET['starting']:0;

			$recpage= 5;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			$jum	= mysql_num_rows($result);
			if($jum!=0){	
				$nox 	= $starting+1;
				while($res = mysql_fetch_array($result)){	
					$status='Belum konfirmasi';

				
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['nm_lengkap'].'</label></td>
							<td><label class="control-label">'.$res['nm_panggilan'].'</label></td>
							<td><label class="control-label">'.$res['anak_ke'].'</label></td>
							<td><label class="control-label">'.$res['jml_sdr'].'</label></td>
							<td><label class="control-label">'.$res['j_kelamin'].'</label></td>
							<td><label class="control-label">'.$res['tmp_lahir'].'</label></td>
							<td><label class="control-label">'.$res['umur'].' th.</label></td>
							<td><label class="control-label">'.$res['malamat'].'</label></td>
							<td><label class="control-label">'.$res['agama'].'</label></td>
							<td><label class="control-label">'.$res['no_telp'].'</label></td>
							<td><label class="control-label">'.$res['email'].'</label></td>
							<td><label class="control-label">'.$res['asrama'].'</label></td>
							<td><label class="control-label">'.$res['status_sos'].'</label></td>
							<td><label class="control-label">'.$res['isActive'].'</label></td>
						</tr>';
                	$nox++;
				}
			}
			#kosong
			else
			{
				echo "<tr align='center'>
						<td  colspan=17 ><span style='color:red;text-align:center;'>
						... data masih kosong...</span></td></tr>";
			}
			#link paging
			echo "<tr class='info'><td colspan=17>".$obj->anchors."</td></tr>";
			echo "<tr class='info'><td colspan=17>".$obj->total."</td></tr>";
	break;
	
} ?>			
