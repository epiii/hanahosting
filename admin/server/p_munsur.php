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
		#ambiledit==============================================================================================
		case 'ambiledit':
			$sql = 'SELECT * from munsur where id_munsur = '.$_GET['id_munsur'];
			$exe = mysql_query($sql);
			$res = mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"munsur":"'.$res['munsur'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = "UPDATE  munsur set munsur = '".mysql_real_escape_string($_POST['munsurTB'])."'
					where id_munsur=".$_GET['id_munsur'];
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
			$sql = "INSERT into munsur set	munsur	= '".trim(mysql_real_escape_string($_POST['munsurTB']))."'";
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
			$sql	= 'DELETE from munsur where id_munsur ='.$_GET['id_munsur'];
			$exe	= mysql_query($sql);
			
			if($exe){
				echo '{"status":"sukses"}';
			}else{
				echo '{"status":"gagal"}';	
			}
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
		
			$sql = "SELECT * FROM munsur";
			//var_dump($sql);exit();
			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 10;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;
			#end of paging	 
			
			#ada data
			if(mysql_num_rows($result)!=0)
			{
				$nox 	= $starting+1;
				while($res = mysql_fetch_array($result)){	
					$btn ="<td>
								 <a class='btn' href=\"javascript:editMunsur('$res[id_munsur]');\" 
								 role='button'><i class='icon-pencil'></i></a>
								 <a class='btn' href=\"javascript:hapusMunsur('$res[id_munsur]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>";
					echo '<tr>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['munsur'].'</label></td>
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
