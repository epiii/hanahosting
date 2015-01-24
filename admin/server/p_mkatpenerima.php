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
				case 'mkatpenerima':
					$sql	= 'SELECT * from  mkatpenerima where id_mkatpenerima = '.$_GET['id_mkatpenerima'];
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
			$sql = 'SELECT * from mkatpenerima where id_mkatpenerima = '.$_GET['id_mkatpenerima'];
			$exe = mysql_query($sql);
			$res = mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"katpenerima":"'.$res['katpenerima'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = "UPDATE mkatpenerima set katpenerima  = '".mysql_real_escape_string($_POST['katTB'])."'
							where id_mkatpenerima	 =".$_GET['id_mkatpenerima'];
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
			$sql = 'INSERT into mkatpenerima set katpenerima	= "'.mysql_real_escape_string($_POST['katTB']).'"';
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
			$sql	= 'DELETE from mkatpenerima where id_mkatpenerima ='.$_GET['id_mkatpenerima'];
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
		
			$sql = "SELECT * FROM mkatpenerima";
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
								 <a class="btn" href="javascript:editmkatpenerima('.$res['id_mkatpenerima'].');" 
								 role="button"><i class="icon-pencil"></i></a>
								 <a class="btn" href="javascript:hapusmkatpenerima('.$res['id_mkatpenerima'].');" 
								 role="button"><i class="icon-remove"></i></a>
							 </td>';
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['katpenerima'].'</label></td>						
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
