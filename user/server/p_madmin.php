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
				case 'madmin':
					$sql	= "select * from mlogin";
					$exe	= mysql_query($sql);
					$datax	= array();
					while($res=mysql_fetch_assoc($exe)){
						$datax[]=$res;
					}
					
					if($datax!=NULL){
						echo json_encode($datax);
					}else{
						echo '{"status":"p gagal"}';
					}
				break;
			}
		break;
		
		#ambiledit==============================================================================================
		case 'ambiledit':
			$sql = 'SELECT
						*
					FROM
						madmin  
						join mlogin on mlogin.id_mlogin = madmin.id_mlogin  
					where 
						madmin.id_madmin = '.$_GET['id_madmin'].' 
					ORDER BY
						mlogin.id_mlogin ASC';

			$exe	= mysql_query($sql);
			#var_dump($exe);exit();
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_madmin":"'.$res['id_madmin'].'",
					"id_mlogin":"'.$res['id_mlogin'].'",
					"nama":"'.$res['nama'].'",
					"no_telp":"'.$res['no_telp'].'",
					"jabatan":"'.$res['jabatan'].'"
				}';

			}else{
				echo '{"status":"p. gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = "UPDATE madmin set 	id_mlogin		= '".mysql_real_escape_string($_POST['id_mloginTB'])."',
										nama 			= '".mysql_real_escape_string($_POST['namaTB'])."',
										no_telp 		= '".mysql_real_escape_string($_POST['notelTB'])."',
										jabatan 		= '".mysql_real_escape_string($_POST['jabatanTB'])."'
								where 	id_madmin		= ".$_GET['id_madmin'];
		// var_dump($sql);exit();
			$exe	= mysql_query($sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"p gagal"}';
			}
			
		break;
		#tambah  ==============================================================================================
		case 'tambah':
			$sql = 'INSERT into madmin  set	id_mlogin   = "'.mysql_real_escape_string($_POST['id_mloginTB']).'",
											nama 		= "'.mysql_real_escape_string($_POST['namaTB']).'",
											no_telp		= "'.mysql_real_escape_string($_POST['notelTB']).'",
											jabatan		= "'.mysql_real_escape_string($_POST['jabatanTB']).'"';
			//print_r($sql);exit();
			$exe	= mysql_query($sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"p gagal"}';
			}
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from madmin where id_madmin ='.$_GET['id_madmin'];
			// var_dump($sql);exit();
			$exe	= mysql_query($sql);
			
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"p gagal"}';	
			}
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			$nama		= trim($_GET['namaS'])?$_GET['namaS']:'';
			$no_telp 	= trim($_GET['no_telpS'])?$_GET['no_telpS']:'';
			$jabatan	= trim($_GET['jabatanS'])?$_GET['jabatanS']:'';

			$sql = 'SELECT
						*
					FROM
						madmin mad
						join mlogin ml on ml.id_mlogin = mad.id_mlogin 
					WHERE
						mad.nama like "%'.$nama.'%" AND
						mad.no_telp like "%'.$no_telp.'%" AND
						mad.jabatan like "%'.$jabatan.'%"
					ORDER BY
						ml.id_mlogin ASC';


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
				$nox = 1;
				while($res = mysql_fetch_array($result)){	

					$btn ="	 <td>
								 <a class='btn btn-secondary' href=\"javascript:editmadmin('$res[id_madmin]');\" 
								 role='button'><i class='icon-pencil'></i></a>
								 <a class='btn btn-secondary' href=\"javascript:hapusmadmin('$res[id_madmin]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>";
					$out.= '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['nama'].'</label></td>
							<td><label class="control-label">'.$res['no_telp'].'</label></td>
							<td><label class="control-label">'.$res['jabatan'].'</label></td>
							'.$btn.'
						</tr>';
                	$x++;
				}
			}
			#kosong
			else
			{
				$out.="<tr align='center'>
						<td  colspan=7 ><span style='color:red;text-align:center;'>
						... data masih kosong...</span></td></tr>";
			}
			#link paging
			$out.="<tr class='info'><td colspan=7>".$obj->anchors."</td></tr>";
			$out.="<tr class='info'><td colspan=7>".$obj->total."</td></tr>";
		echo $out;
	break;
	
} ?>			
