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
					$sql	= 'SELECT * from  gol where id_mpropinsi = '.$_GET['id_mpropinsi'];
					$exe	= mysql_query($sql);
					$datax	= array();
					while($res=mysql_fetch_assoc($exe)){
						$datax[]=$res;
					}
					// var_dump($datax);exit();
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
			$sql = 'SELECT * from mpropinsi where id_mpropinsi = '.$_GET['id_mpropinsi'];
			#var_dump($sql);exit();
			$exe = mysql_query($sql);
			$res = mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"mpropinsi":"'.$res['mpropinsi'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = "UPDATE mpropinsi set mpropinsi = '".mysql_real_escape_string($_POST['mpropinsiTB'])."'
					where id_mpropinsi=".$_GET['id_mpropinsi'];
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
			$sql = "INSERT into mpropinsi set	mpropinsi	= '".trim(mysql_real_escape_string($_POST['mpropinsiTB']))."'";
			//var_dump($sql);exit();
			$exe	= mysql_query($sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			// $sql	= "DELETE from mpropinsi where id_mpropinsi ='$_GET[id_mpropinsi]'";
			$sql	= 'DELETE from mpropinsi where id_mpropinsi ='.$_GET['id_mpropinsi'];
			$exe	= mysql_query($sql);
			
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';	
			}
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			$mpropinsi		= trim($_GET['mpropinsiS'])?$_GET['mpropinsiS']:'';

			$sql =	'SELECT * FROM mpropinsi
					 WHERE 
					 	mpropinsi.mpropinsi like "%'.$mpropinsi.'%"
					 ORDER BY mpropinsi.id_mpropinsi ASC';
			$starting=isset($_GET['starting'])?$_GET['starting']:0;

			$recpage= 5;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			if(mysql_num_rows($result)!=0){
				$nox 	= $starting+1;
				while($res = mysql_fetch_array($result)){	
					$btn ='<td>
								 <a class="btn" href="javascript:editmpropinsi('.$res['id_mpropinsi'].');" 
								 role="button"><i class="icon-pencil"></i></a>
								 <a class="btn" href="javascript:hapusmpropinsi('.$res['id_mpropinsi'].');" 
								 role="button"><i class="icon-remove"></i></a>
							 </td>';
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
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
			echo "<tr class='info'><td colspan=7>".$obj->anchors."</td></tr>";
			echo "<tr class='info'><td colspan=7>".$obj->total."</td></tr>";
	break;
	
} ?>			
