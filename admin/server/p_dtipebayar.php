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
				case 'mtipebayar':
					$sql	= "SELECT * from mtipebayar order by mtipebayar asc";
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
			$sql = 'SELECT *
					FROM
						dtipebayar dtb
						JOIN mtipebayar mtb ON mtb.id_mtipebayar = dtb.id_mtipebayar
					WHERE 
						dtb.id_dtipebayar ='.$_GET['id_dtipebayar'];

			$exe	= mysql_query($sql);
			#var_dump($exe);exit();
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_mtipebayar":"'.$res['id_mtipebayar'].'",
					"dtipebayar":"'.$res['dtipebayar'].'",
					"no_rek":"'.$res['no_rek'].'"
				}';

			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = 'UPDATE dtipebayar  set 	id_mtipebayar	= '.$_POST['id_mtipebayarTB'].',
											dtipebayar 		= "'.mysql_real_escape_string($_POST['dtipebayarTB']).'",
											no_rek 			= "'.mysql_real_escape_string($_POST['no_rekTB']).'"
									where 	id_dtipebayar	= '.$_GET['id_dtipebayar'];
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
			$sql = 'INSERT into dtipebayar set	id_mtipebayar 		= '.$_POST['id_mtipebayarTB'].',
													no_rek	 		= "'.mysql_real_escape_string(trim($_POST['no_rekTB'])).'",
													dtipebayar 		= "'.mysql_real_escape_string(trim($_POST['dtipebayarTB'])).'"';
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
			$sql	= 'DELETE from dtipebayar where id_dtipebayar ='.$_GET['id_dtipebayar'];
			//print_r($sql);exit();
			$exe	= mysql_query($sql);
			
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';	
			}
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			$mtipebayar = trim($_GET['mtipebayarS'])?$_GET['mtipebayarS']:'';
			$dtipebayar	= trim($_GET['dtipebayarS'])?$_GET['dtipebayarS']:'';
			$no_rek		= trim($_GET['no_rekS'])?$_GET['no_rekS']:'';

			$sql = 'SELECT
						*
					FROM
						dtipebayar dtb
						JOIN mtipebayar mtb ON mtb.id_mtipebayar = dtb.id_mtipebayar
					WHERE 
						mtb.mtipebayar like "%'.$mtipebayar.'%" and
						dtb.dtipebayar like "%'.$dtipebayar.'%"and
						dtb.no_rek like "%'.$no_rek.'%"';
					//print_r($sql);exit();
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
								 <a class='btn btn-secondary' href=\"javascript:edittombol('$res[id_dtipebayar]');\" 
								 role='button'><i class='icon-pencil'></i></a>
								 <a class='btn btn-secondary' href=\"javascript:hapustombol('$res[id_dtipebayar]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>";
					echo '<tr>
							<td><label class="control-label">'.$x.'</label></td>
							<td><label class="control-label">'.$res['mtipebayar'].'</label></td>
							<td><label class="control-label">'.$res['dtipebayar'].'</label></td>
							<td><label class="control-label">'.$res['no_rek'].'</label></td>
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
