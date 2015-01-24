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
				case 'mlogin':
					$sql	= "select * from mlogin";
					$exe	= mysql_query($sql);
					$datax	= array();
					//print_r($sql);
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
						mmarketer  
						join mlogin on mlogin.id_mlogin = mmarketer.id_mlogin  
					where 
						mmarketer.id_mmarketer = '.$_GET['id_mmarketer'].' 
					ORDER BY
						mlogin.id_mlogin ASC';


			//var_dump($sql);exit();
			$exe	= mysql_query($sql);
			#var_dump($exe);exit();
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_mlogin":"'.$res['id_mlogin'].'",
					"nama":"'.$res['nama'].'",
					"alamat":"'.$res['alamat'].'",
					"notel":"'.$res['no_telp'].'"
				}';

			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = "UPDATE mmarketer set 	id_mlogin	= '".mysql_real_escape_string($_POST['id_mloginTB'])."',
											nama 		= '".mysql_real_escape_string($_POST['namaTB'])."',
											alamat		= '".mysql_real_escape_string($_POST['alamatTB'])."',
											no_telp		= '".mysql_real_escape_string($_POST['notelTB'])."'
								where 	id_mmarketer		= ".$_GET['id_mmarketer'];
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
			$sql = 'INSERT into mmarketer  set	id_mlogin = "'.mysql_real_escape_string($_POST['id_mloginTB']).'",
												nama		= "'.mysql_real_escape_string($_POST['namaTB']).'",
												alamat		= "'.mysql_real_escape_string($_POST['alamatTB']).'",
												no_telp		= "'.mysql_real_escape_string($_POST['notelTB']).'"';
			#var_dump($sql);exit();
			$exe	= mysql_query($sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal coy"}';
			}
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from mmarketer where id_mmarketer ='.$_GET['id_mmarketer'];
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
			$sql = "SELECT
						*
					FROM
						mmarketer  
						join mlogin on mlogin.id_mlogin = mmarketer.id_mlogin  
					ORDER BY
						mlogin.id_mlogin ASC";

			$jumTot = mysql_num_rows(mysql_query($sql));
			// var_dump($sql);exit();
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
				$nox	= $starting+1;
				while($res = mysql_fetch_array($result)){	
					// $nox='<select name="noTB" id="noTB_'.$x.'" class="span2" onchange="ubahUrutan('.$res['urutan'].','.$x.');">';
					// var_dump($nox);exit();
					// for($i=1;$i<=$jumTot;$i++){
					// 	if($res['urutan']==$i){
					// 		$nox.= '<option value="'.$i.'" selected="selected">'.$i.'</option>';
					// 	}else{
					// 		$nox.= '<option value="'.$i.'" >'.$i.'</option>';
					// 	}
					// }
					// $nox.='</select>';
					$btn ="	 <td>
								 <a class='btn btn-secondary' href=\"javascript:editmarketer('$res[id_mmarketer]');\" 
								 role='button'><i class='icon-pencil'></i></a>
								 <a class='btn btn-secondary' href=\"javascript:hapusmarketer('$res[id_mmarketer]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>";
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['nama'].'</label></td>
							<td><label class="control-label">'.$res['username'].'</label></td>
							<td><label class="control-label">'.$res['alamat'].'</label></td>
							<td><label class="control-label">'.$res['no_telp'].'</label></td>
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
