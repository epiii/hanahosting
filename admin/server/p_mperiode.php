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
				case 'tahun':
					$now=date('Y');
					$datax=array();
					// for($i=2008; $i<=$now; $i++){
					$sql = 'SELECT * from mperiode';
					$exe = mysql_query($sql);
					
					while ($res=mysql_fetch_assoc($exe)) {

					}
					
					for($i=$now; $i>2007; $i--){
						$datax[]=$i;
					}
					
					if($datax!=NULL){
						$out= '{
								"status":"sukses",
								"datax":'.json_encode($datax).'
							}';
					}else{
						$out='{"status":"kosong"}';
					}
					echo $out;
				break;
				
				case 'tahun2':
					$now = date('Y');
					$th  = implode(',', $datax);

					// $sql = 'SELECT *
					// 		FROM mperiode
					// 		WHERE 
					// 			tahun NOT IN (
					// 				'.$th.'
					// 			)
					// 		ORDER BY
					// 			tahun DESC';
					$sql = 'SELECT distinct(tahun)th
							FROM mperiode
							WHERE 
								tahun NOT IN (
									'.$th.'
								)
							ORDER BY
								tahun DESC';
						print_r($sql);exit();
					$datax=array();
					$exe = mysql_query($sql);
					while ($res=mysql_fetch_assoc($exe)) {
						
					}

					$data2x=array();
					// for($i=2008; $i<=$now; $i++){
					for($i=$now; $i>2007; $i--){
						$datax[]=$i;
					}
					
					if($data2x!=NULL){
						$out= '{
								"status":"sukses",
								"datax":'.json_encode($data2x).'
							}';
					}else{
						$out='{"status":"kosong"}';
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
						mperiode  
						join mpropinsi on mpropinsi.id_mpropinsi = mperiode.id_mpropinsi  
					where 
						mperiode.id_mperiode = '.$_GET['id_mperiode'].' 
					ORDER BY
						mpropinsi.id_mpropinsi ASC';

			$exe	= mysql_query($sql);
			#var_dump($exe);exit();
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_mperiode":"'.$res['id_mperiode'].'",
					"id_mpropinsi":"'.$res['id_mpropinsi'].'",
					"mperiode":"'.$res['mperiode'].'",
					"mpropinsi":"'.$res['mpropinsi'].'"
				}';

			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = "UPDATE mperiode set 	id_mpropinsi	= '".mysql_real_escape_string($_POST['id_mpropinsiTB'])."',
										mperiode 			= '".mysql_real_escape_string($_POST['mperiodeTB'])."'
								where 	id_mperiode		= ".$_GET['id_mperiode'];
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
			$sql = 'INSERT into mperiode  set	tahun= '.$_POST['tahunTB'].',
											semester = "'.$_POST['semesterTB'].'"';
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
			$sql	= 'DELETE from mperiode where id_mperiode ='.$_GET['id_mperiode'];
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
			$tahun		= trim($_GET['tahunS'])?$_GET['tahunS']:'';
			$semester 	= trim($_GET['semesterS'])?$_GET['semesterS']:'';

			$sql = 'SELECT *
					FROM mperiode  
					WHERE tahun LIKE "%'.$tahun.'%" AND
						  semester like "%'.$semester.'%"
					ORDER BY
						tahun desc,
						semester desc';
			// print_r($sql);exit();
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
								 <a class='btn btn-secondary' href=\"javascript:editmperiode('$res[id_mperiode]');\" 
								 role='button'><i class='icon-pencil'></i></a>
								 <a class='btn btn-secondary' href=\"javascript:hapusmperiode('$res[id_mperiode]');\" 
								 role='button'><i class='icon-remove'></i></a>
							 </td>";
					echo '<tr>
							<td><label class="control-label">'.$x.'</label></td>
							<td><label class="control-label">'.$res['tahun'].'</label></td>
							<td><label class="control-label">'.$res['semester'].'</label></td>
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
