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
				case 'mkatdonatur':
					$sql	= "SELECT * from mkatdonatur order by mkatdonatur asc";
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
				case 'dtipebayar':
					$sql	= "SELECT * from dtipebayar order by dtipebayar asc";
					$exe  	= mysql_query($sql);
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
						dkatdonatur dkd
						JOIN mkatdonatur mkd ON mkd.id_mkatdonatur = dkd.id_mkatdonatur
						JOIN dtipebayar dtb ON dtb.id_dtipebayar = dkd.id_dtipebayar
					WHERE 
						dkd.id_dkatdonatur ='.$_GET['id_dkatdonatur'];

			$exe	= mysql_query($sql);
			#var_dump($exe);exit();
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_mkatdonatur":"'.$res['id_mkatdonatur'].'",
					"id_dtipebayar":"'.$res['id_dtipebayar'].'"
				}';

			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = 'UPDATE dkatdonatur  set 	id_mkatdonatur 		= '.$_POST['id_mkatdonaturTB'].',
												id_dtipebayar 		= '.$_POST['id_dtipebayarTB'].'
										where 	id_dkatdonatur		= '.$_GET['id_dkatdonatur'];
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
			$sql = 'INSERT into dkatdonatur set		id_mkatdonatur 		= '.$_POST['id_mkatdonaturTB'].',
													id_dtipebayar		= '.$_POST['id_dtipebayarTB'].'';
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
			$sql	= 'DELETE from dkatdonatur where id_dkatdonatur ='.$_GET['id_dkatdonatur'];
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
			$mkatdonatur = trim($_GET['mkatdonaturS'])?$_GET['mkatdonaturS']:'';
			$dtipebayar	 = trim($_GET['dtipebayarS'])?$_GET['dtipebayarS']:'';
			
			$sql = 'SELECT
						*
					FROM
						dkatdonatur dkd
						JOIN mkatdonatur mkd ON mkd.id_mkatdonatur = dkd.id_mkatdonatur
						JOIN dtipebayar dtb ON dtb.id_dtipebayar = dkd.id_dtipebayar
					WHERE 
						mkd.mkatdonatur like "%'.$mkatdonatur.'%" and
						dtb.dtipebayar like "%'.$dtipebayar.'%"';

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
								 <a class='btn btn-secondary' href=\"javascript:edittombol('$res[id_dkatdonatur]');\" 
								 role='button'><i class='icon-pencil'></i></a>
								 <a class='btn btn-secondary' href=\"javascript:hapustombol('$res[id_dkatdonatur]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>";
					echo '<tr>
							<td><label class="control-label">'.$x.'</label></td>
							<td><label class="control-label">'.$res['mkatdonatur'].'</label></td>
							<td><label class="control-label">'.$res['dtipebayar'].'</label></td>
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