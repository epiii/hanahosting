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
		#view==============================================================================================
		case 'viewlokasi':
			$sql =' SELECT * 
					from dmarketer dm
						join mkecamatan kc on kc.id_mkecamatan = dm.id_mkecamatan 
						join mkota ko on ko.id_mkota = kc.id_mkota 
						join mpropinsi po on po.id_mpropinsi =ko.id_mpropinsi 
					where 
						dm.id_mmarketer='.$_GET['id_mmarketer'];
			// print_r($sql);exit();
			$exe = mysql_query($sql);
			$datax=array();
			while ($res=mysql_fetch_assoc($exe)) {
				$datax[]=$res;
			}

			if(!$exe){
				$out='{"status":"error db"}';
			}else{
				if ($datax==NULL) {
					$out='{"status":"kosong"}';
				} else {
					$out='{"status":"sukses","datax":'.json_encode($datax).'}';
				}
			}
			echo $out;
		break;
		#cek==============================================================================================
		case 'cek':
			$isActive =$_GET['isActive']=='y'?'n':'y';
			$sql ='UPDATE mlogin set isActive	="'.$isActive.'" 
								where id_mlogin	=(
										SELECT id_mlogin from mmarketer where id_mmarketer='.$_GET['id_mmarketer'].'
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
				case 'mpropinsi':
					$sql	= 'SELECT * FROM  mpropinsi ORDER BY mpropinsi';
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

				case 'mkota':
					$whr 	= !empty($_GET['id_mpropinsi'])?'where id_mpropinsi = "'.$_GET['id_mpropinsi'].'"':'';
					$sql 	= 'SELECT * from mkota  '.$whr.' order by mkota  asc';
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
				
				case 'mkecamatan':
					$whr 	= !empty($_GET['id_mkota'])?'where id_mkota = "'.$_GET['id_mkota'].'"':'';
					$sql 	= 'SELECT * from mkecamatan  '.$whr.' order by mkecamatan  asc';
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
		#end of combo ==============================================================================================


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

			$exe	= mysql_query($sql);
			#var_dump($exe);exit();
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_mmarketer":"'.$res['id_mmarketer'].'",
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
			$sql2 = 'UPDATE mmarketer set	nama 		= "'.mysql_real_escape_string($_POST['namaTB']).'",
											no_telp 	= "'.mysql_real_escape_string($_POST['no_telpTB']).'"
									where	id_mmarketer= '.$_GET['id_mmarketer'];
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

		#tambah lokasi marketer  ==============================================================================================
		case 'tambahlokasi':
			$sql = 'INSERT into dmarketer set 	id_mmarketer  = '.$_POST['id_mmarketer'].',
												id_mkecamatan = '.$_POST['id_mkecamatan'];
			$exe = mysql_query($sql);
			if (!$exe) {
				$out='{"status":"gagal"}';
			} else {
				$out='{"status":"sukses"}';
			}
			echo $out;
		break;

		#tambah  ==============================================================================================
		case 'tambah':
			$sql1 = 'INSERT into mlogin set email 		= "'.trim(mysql_real_escape_string($_POST['emailTB'])).'",
											password	= "'.md5(mysql_real_escape_string($_POST['passwordTB'])).'",
											level		= "marketer",
											isActive	= "y"';
			$exe1 = mysql_query($sql1);
			$id1  = mysql_insert_id();
			//print_r($sql);exit();
			// $out='';
			if (!$exe1) {
				$out='{"status":"gagal simpan data login"}';
			} else {
				$sql2 = 'INSERT into mmarketer set	id_mlogin   = '.$id1.',
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
			$sql	= 'DELETE from mmarketer where id_mmarketer ='.$_GET['id_mmarketer'];
			// var_dump($sql);exit();
			$exe	= mysql_query($sql);
			
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"p gagal"}';	
			}
		break;
			
		#hapus ==============================================================================================
		case 'hapuslokasi':
			$sql	= 'DELETE from dmarketer where id_dmarketer ='.$_GET['id_dmarketer'];
			// var_dump($sql);exit();
			$exe	= mysql_query($sql);
			
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal hapus lokasi marketer"}';	
			}
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			$nama		= trim($_GET['namaS'])?$_GET['namaS']:'';
			$no_telp 	= trim($_GET['no_telpS'])?$_GET['no_telpS']:'';
			$email		= trim($_GET['emailS'])?$_GET['emailS']:'';

			$sql = 'SELECT *
					FROM
						mmarketer mm
						join mlogin ml on ml.id_mlogin = mm.id_mlogin 
					WHERE
						mm.nama like "%'.$nama.'%" AND
						mm.no_telp like "%'.$no_telp.'%" AND
						ml.email like "%'.$email.'%" 
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
						$dis3='onclick="statmmarketer('.$res['id_mmarketer'].',\''.$res['isActive'].'\');"';
						$dis4='onclick="viewlokasi('.$res['id_mmarketer'].');"';
						$clr2='default';
						$clr3='default';
					} else {
						$dis1='onclick="editmmarketer('.$res['id_mmarketer'].');"';
						$dis2='onclick="hapusmmarketer('.$res['id_mmarketer'].');"';
						$dis3='onclick="statmmarketer('.$res['id_mmarketer'].',\''.$res['isActive'].'\');"';
						$dis4='onclick="viewlokasi('.$res['id_mmarketer'].');"';
						$clr2='danger';
						$clr3='info';
					}

					if ($res['isActive']=='y') {
						$info = 'non aktifkan';
						$clr = 'success';
					} else {
						$info = 'aktifkan';
						$clr = 'default';
					}
					
					$btn ='<td>
						 	<div class="btn-group">
							  	<button type="button" '.$dis1.' class="btn btn-'.$clr3.'"
								  	onmouseover="return tooltipx(this);" data-toggle="tooltip" title="ubah" data-placement="top" >
							  		<i class="icon-pencil"></i>
						  		</button>
							  	<button type="button" '.$dis2.' class="btn btn-'.$clr2.'"
								  	onmouseover="return tooltipx(this);" data-toggle="tooltip" title="hapus" data-placement="top" >
							  		<i class="icon-trash"></i>
						  		</button>
							  	<button type="button" '.$dis3.' class="btn btn-'.$clr.'"
								  	onmouseover="return tooltipx(this);" data-toggle="tooltip" title="'.$info.'" data-placement="top" >
							  		<i class="icon-off"></i>
						  		</button>
							  	<button type="button" '.$dis4.' class="btn btn-warning"
								  	onmouseover="return tooltipx(this);" data-toggle="tooltip" title="lokasi penagihan" data-placement="top" >
							  		<i class="icon-th-list"></i>
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
}
?>			
