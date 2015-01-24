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
				case 'mkatpenerima':
					$sql	= "SELECT * from mkatpenerima order by katpenerima asc";
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
					$sql	= "SELECT * from mjenjang order by mjenjang asc";
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
						dkatpenerima dkp
						JOIN mkatpenerima mkp ON mkp.id_mkatpenerima = dkp.id_mkatpenerima
						JOIN mjenjang j ON j.id_mjenjang = dkp.id_mjenjang
					WHERE 
						dkp.id_dkatpenerima ='.$_GET['id_dkatpenerima'];

			$exe	= mysql_query($sql);
			#var_dump($exe);exit();
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_mkatpenerima":"'.$res['id_mkatpenerima'].'",
					"id_mjenjang":"'.$res['id_mjenjang'].'",
					"nominal":"'.$res['nominal'].'",
					"status":"'.$res['status'].'"
				}';

			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = 'UPDATE dkatpenerima  set 	id_mkatpenerima 	= '.$_POST['id_mkatpenerimaTB'].',
												id_mjenjang 		= '.$_POST['id_mjenjangTB'].',
												nominal 			= "'.mysql_real_escape_string($_POST['nominalTB']).'",
												status 				= "'.mysql_real_escape_string($_POST['statusTB']).'"
										where 	id_dkatpenerima		= '.$_GET['id_dkatpenerima'];
		// var_dump($sql);exit();
			$exe	= mysql_query($sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;

		#tambah  ==============================================================================================
		case 'tambah':
			$sql = 'INSERT into dkatpenerima  set	id_mkatpenerima = '.$_POST['id_mkatpenerimaTB'].',
													id_mjenjang		= '.$_POST['id_mjenjangTB'].',
													nominal 		= "'.mysql_real_escape_string(trim($_POST['nominalTB'])).'",
													status 			= "'.$_POST['statusTB'].'"';
			// var_dump($sql);exit();
			$exe	= mysql_query($sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from dkatpenerima where id_dkatpenerima ='.$_GET['id_dkatpenerima'];
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
			$katpenerima= trim($_GET['katpenerimaS'])?$_GET['katpenerimaS']:'';
			$mjenjang	= trim($_GET['mjenjangS'])?$_GET['mjenjangS']:'';
			$nominal	= trim($_GET['nominalS'])?$_GET['nominalS']:'';
			$status		= trim($_GET['statusS'])?$_GET['statusS']:'';

			$sql = 'SELECT
						*
					FROM
						dkatpenerima dkp
						JOIN mkatpenerima mkp ON mkp.id_mkatpenerima = dkp.id_mkatpenerima
						JOIN mjenjang j ON j.id_mjenjang = dkp.id_mjenjang

					WHERE 
						mkp.katpenerima like "%'.$katpenerima.'%" and
						j.mjenjang like "%'.$mjenjang.'%" and
						dkp.nominal like "%'.$nominal.'%" and
						dkp.status like "%'.$status.'%"';

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
				$x	= $starting+1;
				#$nox = 1;
				while($res = mysql_fetch_array($result)){	

					$btn ="	 <td>
								 <a class='btn btn-secondary' href=\"javascript:editGol('$res[id_dkatpenerima]');\" 
								 role='button'><i class='icon-pencil'></i></a>
								 <a class='btn btn-secondary' href=\"javascript:hapusGol('$res[id_dkatpenerima]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>";
					echo '<tr>
							<td><label class="control-label">'.$x.'</label></td>
							<td><label class="control-label">'.$res['katpenerima'].'</label></td>
							<td><label class="control-label">'.$res['mjenjang'].'</label></td>
							<td><label class="control-label">'.$res['nominal'].'</label></td>
							<td><label class="control-label">'.$res['status'].'</label></td>
							'.$btn.'
						</tr>';
                	$x++;
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
			echo "<tr class='info'><td colspan=7>".$obj->anchors."</td></tr>";
			echo "<tr class='info'><td colspan=7>".$obj->total."</td></tr>";
	break;
	
} ?>			
