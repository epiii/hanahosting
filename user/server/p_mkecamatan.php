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
				case 'mkecamatan':
					$sql	= "SELECT * from mkota";
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
						mkecamatan  
						join mkota on mkota.id_mkota = mkecamatan.id_mkota  
					where
						mkecamatan.id_mkecamatan = '.$_GET['id_mkecamatan'].' 
					ORDER BY
						mkota.id_mkota ASC';

			$exe	= mysql_query($sql);
			//var_dump($exe);exit();
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_mkecamatan":"'.$res['id_mkecamatan'].'",
					"id_mkota":"'.$res['id_mkota'].'",
					"mkecamatan":"'.$res['mkecamatan'].'",
					"mkota":"'.$res['mkota'].'"
				}';

			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = "UPDATE mkecamatan set 	id_mkota	= '".mysql_real_escape_string($_POST['id_mkotaTB'])."',
										mkecamatan 			= '".mysql_real_escape_string($_POST['mkecamatanTB'])."'
								where 	id_mkecamatan		= ".$_GET['id_mkecamatan'];
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
			$sql = 'INSERT into mkecamatan  set	id_mkota= '.mysql_real_escape_string($_POST['id_mkotaTB']).',
											mkecamatan		= "'.mysql_real_escape_string($_POST['mkecamatanTB']).'"';
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
			$sql	= 'DELETE from mkecamatan where id_mkecamatan ='.$_GET['id_mkecamatan'];
			print_r($sql);exit();
			$exe	= mysql_query($sql);
			
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"p gagal"}';	
			}
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			$mkecamatan		= trim($_GET['mkecamatanS'])?$_GET['mkecamatanS']:'';
			$mkota 			= trim($_GET['mkotaS'])?$_GET['mkotaS']:'';
		
			$sql = 'SELECT
						*
					FROM
						mkecamatan  
						join mkota on mkota.id_mkota = mkecamatan.id_mkota  
					WHERE
						mkecamatan.mkecamatan like "%'.$mkecamatan.'%" AND
						mkota.mkota like "%'.$mkota.'%"
					ORDER BY
						mkota.id_mkota ASC';

//var_dump($sql);exit();
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
				
				while($res = mysql_fetch_array($result)){	

					$btn ="	 <td>
								 <a class='btn btn-secondary' href=\"javascript:editGol('$res[id_mkecamatan]');\" 
								 role='button'><i class='icon-pencil'></i></a>
								 <a class='btn btn-secondary' href=\"javascript:hapusGol('$res[id_mkecamatan]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>";
					echo '<tr>
							<td><label class="control-label">'.$x.'</label></td>
							<td><label class="control-label">'.$res['mkecamatan'].'</label></td>
							<td><label class="control-label">'.$res['mkota'].'</label></td>
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
