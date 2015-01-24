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
		#cek==============================================================================================
		case 'cek':
			$isActive =$_GET['isActive']=='y'?'n':'y';
			$sql ='UPDATE mlogin set isActive	="'.$isActive.'" 
								where id_mlogin	=(
										SELECT id_mlogin from madmin where id_madmin='.$_GET['id_madmin'].'
									 )';
			// print_r($sql);exit();
			$exe = mysql_query($sql);
			if(!$exe){
				$out='{"status":"gagal"}';
			}else{
				$out='{"status":"sukses"}';
			}
			echo $out;
		break;

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
					"email":"'.$res['email'].'",
					"no_telp":"'.$res['no_telp'].'"
				}';

			}else{
				echo '{"status":"p. gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql1 = 'UPDATE mlogin set	email 			= "'.mysql_real_escape_string($_POST['emailTB']).'",
										password 		= "'.md5(mysql_real_escape_string($_POST['passwordTB'])).'"
								where 	id_mlogin		= '.$_POST['id_mloginH'];
			$sql2 = 'UPDATE madmin set	nama 			= "'.mysql_real_escape_string($_POST['namaTB']).'",
										no_telp 		= "'.mysql_real_escape_string($_POST['no_telpTB']).'"
								where 	id_madmin		= '.$_GET['id_madmin'];
			// var_dump($sql);exit();
			$exe1	= mysql_query($sql1);
			if(!$exe1){
				$out='{"status":"gagal ubah data login"}';
			}else{
				$exe2= mysql_query($sql2);
				if(!$exe2){
					$out='{"status":"gagal ubah data admin"}';
				}else{
					$out='{"status":"sukses"}';
				}
			}
			echo $out;
		break;

		#tambah  ==============================================================================================
		case 'tambah':
			$sql1 = 'INSERT into mlogin set email 		= "'.trim(mysql_real_escape_string($_POST['emailTB'])).'",
											password	= "'.mysql_real_escape_string($_POST['passwordTB']).'",
											level		= "admin",
											isActive	= "y"';
			$exe1 = mysql_query($sql1);
			$id1  = mysql_insert_id();
			//print_r($sql);exit();
			// $out='';
			if (!$exe1) {
				$out='{"status":"gagal simpan data login"}';
			} else {
				$sql2 = 'INSERT into madmin set	id_mlogin   = '.$id1.',
											nama 		= "'.trim(mysql_real_escape_string($_POST['namaTB'])).'",
											no_telp		= "'.trim(mysql_real_escape_string($_POST['no_telpTB'])).'"';
				$exe2	= mysql_query($sql2);
				if(!$exe2){
					$out='{"status":"gagal simpan data admin"}';
				}else{
					$out='{"status":"sukses"}';
				}
			}
			echo $out;
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
			$email		= trim($_GET['emailS'])?$_GET['emailS']:'';

			$sql = 'SELECT *
					FROM
						madmin mad
						join mlogin ml on ml.id_mlogin = mad.id_mlogin 
					WHERE
						mad.nama like "%'.$nama.'%" AND
						mad.no_telp like "%'.$no_telp.'%" AND
						ml.email like "%'.$email.'%" AND 
						ml.id_mlogin!='.$_SESSION['id_mloginy'].'
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

			$out='';
			$jum= mysql_num_rows($result);
			if($jum!=0){	
				$nox= $starting+1;
				while($res = mysql_fetch_array($result)){
					if (!empty($res['acak'])) {
						$dis1=' disabled';
						$dis2=' disabled';
						$dis3='onclick="statmadmin('.$res['id_madmin'].',\''.$res['isActive'].'\');"';
						$clr1='default';
						$clr2='default';
					} else {
						$dis1='onclick="editmadmin('.$res['id_madmin'].');"';
						$dis2='onclick="hapusmadmin('.$res['id_madmin'].');"';
						$dis3='onclick="statmadmin('.$res['id_madmin'].',\''.$res['isActive'].'\');"';
						$clr1='info';
						$clr2='danger';
					}

					if ($res['isActive']=='y') {
						$info = 'non aktifkan';
						$clr3 = 'success';
					} else {
						$info = 'aktifkan';
						$clr3 = 'default';
					}
					
					$btn ='<td>
						 	<div class="btn-group">
							  	<button type="button" '.$dis1.' class="btn btn-'.$clr1.'"
								  	onmouseover="return tooltipx(this);" data-toggle="tooltip" title="ubah" data-placement="top" >
							  		<i class="icon-pencil"></i>
						  		</button>
							  	<button type="button" '.$dis2.' class="btn btn-'.$clr2.'"
								  	onmouseover="return tooltipx(this);" data-toggle="tooltip" title="hapus" data-placement="top" >
							  		<i class="icon-trash"></i>
						  		</button>
							  	<button type="button" '.$dis3.' class="btn btn-'.$clr3.'"
								  	onmouseover="return tooltipx(this);" data-toggle="tooltip" title="'.$info.'" data-placement="top" >
							  		<i class="icon-off"></i>
						  		</button>
						 </td>';

					$out.='<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['nama'].'</label></td>
							<td><label class="control-label">'.$res['no_telp'].'</label></td>
							<td><label class="control-label">'.$res['email'].'</label></td>
							'.$btn.'
						</tr>';
                	$nox++;
				}
			}
			#kosong
			else
			{
				$out.= "<tr align='center'>
						<td  colspan=7 ><span style='color:red;text-align:center;'>
						... data masih kosong...</span></td></tr>";
			}
			#link paging
			$out.= "<tr class='info'><td colspan=7>".$obj->anchors."</td></tr>";
			$out.= "<tr class='info'><td colspan=7>".$obj->total."</td></tr>";
		echo $out;
	break;
	
} ?>			
