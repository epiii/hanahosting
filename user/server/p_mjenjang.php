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
		
		#ambiledit==============================================================================================
		case 'ambiledit':
			$sql = 'SELECT * from mjenjang where id_mjenjang = '.$_GET['id_mjenjang'];
			$exe = mysql_query($sql);
			$res = mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"mjenjang":"'.$res['mjenjang'].'",
					"jumkelas":"'.$res['jumkelas'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = "UPDATE mjenjang set mjenjang = '".mysql_real_escape_string($_POST['jenjangTB'])."',
										jumkelas = '".mysql_real_escape_string($_POST['jmlkelasTB'])."'
							where id_mjenjang	 =	".$_GET['id_mjenjang'];
			#print_r($sql);exit();
			$exe	= mysql_query($sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"p gagal"}';
			}
			
		break;
		#tambah  ==============================================================================================
		case 'tambah':
			$sql = 'INSERT into mjenjang set	mjenjang	= "'.trim(mysql_real_escape_string($_POST['jenjangTB'])).'",
												jumkelas	= "'.trim(mysql_real_escape_string($_POST['jmlkelasTB'])).'"';
			#print_r($sql);exit();
			$exe	= mysql_query($sql);
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from mjenjang where id_mjenjang ='.$_GET['id_mjenjang'];
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
			$mjenjang 	 = trim($_GET['mjenjangS']);
			$jumkelas 	 = trim($_GET['jumkelasS']);
			$sql = 'SELECT * 
					FROM mjenjang
					where 
						mjenjang like "%'.$mjenjang.'%" and 
						jumkelas like "%'.$jumkelas.'%"';
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
								 <a class="btn" href="javascript:editmjenjang('.$res['id_mjenjang'].');" 
								 role="button"><i class="icon-pencil"></i></a>
								 <a class="btn" href="javascript:hapusmjenjang('.$res['id_mjenjang'].');" 
								 role="button"><i class="icon-remove"></i></a>
							 </td>';
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['mjenjang'].'</label></td>
							<td><label class="control-label">'.$res['jumkelas'].' th.</label></td>							
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
