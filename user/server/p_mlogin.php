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
				case 'mlogin':
					$sql	= 'SELECT * from  mlogin where id_mlogin = '.$_GET['id_mlogin'];
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
			$sql = 'SELECT * from mlogin where id_mlogin = '.$_GET['id_mlogin'];
			$exe = mysql_query($sql);
			$res = mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"username":"'.$res['username'].'",
					"password":"'.$res['password'].'",
					"email":"'.$res['email'].'",
					"level":"'.$res['level'].'",
					"isActive":"'.$res['isActive'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = "UPDATE mlogin set username 	 = '".mysql_real_escape_string($_POST['userTB'])."',
										password = '".mysql_real_escape_string($_POST['passTB'])."',
										email 	 = '".mysql_real_escape_string($_POST['emailTB'])."',
										level 	 = '".mysql_real_escape_string($_POST['levelTB'])."',
										isActive  = '".mysql_real_escape_string($_POST['isactiveTB'])."'
							where id_mlogin	 =".$_GET['id_mlogin'];
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
			$sql = 'INSERT into mlogin set	username	= "'.trim(mysql_real_escape_string($_POST['userTB'])).'",
											password	= "'.mysql_real_escape_string($_POST['passTB']).'",
											email		= "'.mysql_real_escape_string($_POST['emailTB']).'",
											level		= "'.mysql_real_escape_string($_POST['levelTB']).'",
											isActive	= "'.mysql_real_escape_string($_POST['isactiveTB']).'"';
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
			$sql	= 'DELETE from mlogin where id_mlogin ='.$_GET['id_mlogin'];
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
		
			$sql = "SELECT * FROM mlogin";
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
								 <a class="btn" href="javascript:editmlogin('.$res['id_mlogin'].');" 
								 role="button"><i class="icon-pencil"></i></a>
								 <a class="btn" href="javascript:hapusmlogin('.$res['id_mlogin'].');" 
								 role="button"><i class="icon-remove"></i></a>
							 </td>';
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['username'].'</label></td>
							<td><label class="control-label">'.$res['password'].'</label></td>	
							<td><label class="control-label">'.$res['email'].'</label></td>	
							<td><label class="control-label">'.$res['level'].'</label></td>	
							<td><label class="control-label">'.$res['isActive'].'</label></td>							
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
