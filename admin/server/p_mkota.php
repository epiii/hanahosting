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
					$sql	= "select * from mpropinsi";
					$exe	= mysql_query($sql);
					$datax	= array();
					while($res=mysql_fetch_assoc($exe)){
						$datax[]=$res;
					}
					
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
			$sql = 'SELECT
						*
					FROM
						mkota  
						join mpropinsi on mpropinsi.id_mpropinsi = mkota.id_mpropinsi  
					where 
						mkota.id_mkota = '.$_GET['id_mkota'].' 
					ORDER BY
						mpropinsi.id_mpropinsi ASC';

			$exe	= mysql_query($sql);
			#var_dump($exe);exit();
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_mkota":"'.$res['id_mkota'].'",
					"id_mpropinsi":"'.$res['id_mpropinsi'].'",
					"mkota":"'.$res['mkota'].'",
					"mpropinsi":"'.$res['mpropinsi'].'"
				}';

			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = "UPDATE mkota set 	id_mpropinsi	= '".mysql_real_escape_string($_POST['id_mpropinsiTB'])."',
										mkota 			= '".mysql_real_escape_string($_POST['mkotaTB'])."'
								where 	id_mkota		= ".$_GET['id_mkota'];
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
			$sql = 'INSERT into mkota  set	id_mpropinsi= '.mysql_real_escape_string($_POST['id_mpropinsiTB']).',
											mkota		= "'.mysql_real_escape_string($_POST['mkotaTB']).'"';
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
			$sql	= 'DELETE from mkota where id_mkota ='.$_GET['id_mkota'];
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
			$mkota		= trim($_GET['mkotaS'])?$_GET['mkotaS']:'';
			$mpropinsi 	= trim($_GET['mpropinsiS'])?$_GET['mpropinsiS']:'';

			$sql = 'SELECT
						*
					FROM
						mkota  
						join mpropinsi on mpropinsi.id_mpropinsi = mkota.id_mpropinsi  
					WHERE
						mkota.mkota like "%'.$mkota.'%" AND
						mpropinsi.mpropinsi like "%'.$mpropinsi.'%"
					ORDER BY
						mpropinsi.id_mpropinsi ASC';


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
								 <a class='btn btn-secondary' href=\"javascript:editGol('$res[id_mkota]');\" 
								 role='button'><i class='icon-pencil'></i></a>
								 <a class='btn btn-secondary' href=\"javascript:hapusGol('$res[id_mkota]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>";
					echo '<tr>
							<td><label class="control-label">'.$x.'</label></td>
							<td><label class="control-label">'.$res['mkota'].'</label></td>
							<td><label class="control-label">'.$res['mpropinsi'].'</label></td>
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
