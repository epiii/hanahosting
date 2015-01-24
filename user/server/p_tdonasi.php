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
				case 'msubunsur5':
					$sql	= '	SELECT id_msubunsur5,msubunsur5 from msubunsur5'; 

					// print_r($sql);exit();	
					$exe	= mysql_query($sql);
					$datax	= array();
					while($res=mysql_fetch_assoc($exe)){
						$datax[]=$res;
					}
					// print_r($datax);exit();
					if($datax!=NULL){
						echo json_encode($datax);
					}else{
						echo '{"status":"gagal"}';
					}
				break;
			}
		break;
		
		#ambiledit==============================================================================================
		case 'ambiledit':
			$sql ='	SELECT *
					FROM msubunsur6 
					where id_msubunsur6 ='.$_GET['id_msubunsur6'];
			// var_dump($sql);exit();
			$exe	= mysql_query($sql);
			#var_dump($exe);exit();
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_msubunsur5":"'.$res['id_msubunsur5'].'",
					"msubunsur6":"'.$res['msubunsur6'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
				
		#ubah  ==============================================================================================
		case 'ubah':
			$x=trim($_POST['msubunsur7TB']);
			$msubunsur7 = ($x=="" or empty($x))?'NULL':'"'.mysql_real_escape_string($x).'"';
			$sql = 'UPDATE msubunsur7 set 	id_msubunsur6	= '.$_POST['id_msubunsur6TB'].',
											msubunsur7 		= '.$msubunsur7.'
									WHERE  	id_msubunsur7	= '.$_GET['id_msubunsur7'];
			$exe	= mysql_query($sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;

		#tambah  ==============================================================================================
		case 'tambah':
			$x=trim($_POST['msubunsur7TB']);
			$msubunsur7 = ($x=="" or empty($x))?'NULL':'"'.mysql_real_escape_string($x).'"';
			$sql = 'INSERT into msubunsur7 set 	id_msubunsur6	= '.$_POST['id_msubunsur6TB'].',
												msubunsur7 		= '.$msubunsur4;
			$exe	= mysql_query($sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from msubunsur6  where id_msubunsur6  ='.$_GET['id_msubunsur6'];
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
			$sql = "SELECT *
					FROM msubunsur6, msubunsur5 
					where msubunsur6.id_msubunsur5 = msubunsur5.id_msubunsur5 
					ORDER BY msubunsur5.id_msubunsur5 DESC";

			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 10;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			#ada data
			$jum	= mysql_num_rows($result);
			if($jum!=0){	
				$nox=1;
				while($res = mysql_fetch_array($result)){	
					$btn ='<td>
								 <a class="btn btn-secondary" href="javascript:editmsubunsur6(\''.$res['id_msubunsur6'].'\');" 
								 role="button"><i class="icon-pencil"></i></a>
								 <a class="btn btn-secondary" href="javascript:hapusmsubunsur6(\''.$res['id_msubunsur6'].'\');" 
								 role="button"><i class="icon-remove"></i></a>
							 </td>';
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['msubunsur6'].'</label></td>
							<td><label class="control-label">'.$res['msubunsur5'].'</label></td>
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
			echo "<tr class='info'><td colspan=7>".$obj->anchors."</td></tr>";
			echo "<tr class='info'><td colspan=7>".$obj->total."</td></tr>";
	break;
	
} ?>			
