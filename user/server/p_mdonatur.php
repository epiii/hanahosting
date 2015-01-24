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
		#tampil  =============================================================================================
		case 'tampil' :
			$nama 		= trim($_GET['namaS'])?$_GET['namaS']:'';
			$j_kelamin 	= trim($_GET['j_kelaminS'])?$_GET['j_kelaminS']:'';
			$alamat 	= trim($_GET['alamatS'])?$_GET['alamatS']:'';
			$kode_pos 	= trim($_GET['kode_posS'])?$_GET['kode_posS']:'';
			$mpropinsi 	= trim($_GET['mpropinsiS'])?$_GET['mpropinsiS']:'';
			$mkota 		= trim($_GET['mkotaS'])?$_GET['mkotaS']:'';
			$mkecamatan = trim($_GET['mkecamatanS'])?$_GET['mkecamatanS']:'';
			$telp 		= trim($_GET['telpS'])?$_GET['telpS']:'';
			$hp 		= trim($_GET['hpS'])?$_GET['hpS']:'';
			$email 		= trim($_GET['emailS'])?$_GET['emailS']:'';
			$mkatdonatur= trim($_GET['mkatdonaturS'])?$_GET['mkatdonaturS']:'';
			$mtipebayar = trim($_GET['mtipebayarS'])?$_GET['mtipebayarS']:'';

			$sql = 'SELECT
						*
					FROM
						mdonatur md
						JOIN ddonatur dd ON dd.id_mdonatur = md.id_mdonatur
						JOIN mkecamatan mkc ON mkc.id_mkecamatan = md.id_mkecamatan
						JOIN mkota mko ON mko.id_mkota = mkc.id_mkota
						JOIN mpropinsi mpo ON mpo.id_mpropinsi = mko.id_mpropinsi
						JOIN mlogin ml on ml.id_mlogin = md.id_mlogin
						JOIN (
							SELECT
								mkd.mkatdonatur,
								dkd.*, concat(
									mt.mtipebayar,
									" ",
									dt.dtipebayar
								) AS bayarvia
							FROM
								mkatdonatur mkd
							JOIN dkatdonatur dkd ON dkd.id_mkatdonatur = mkd.id_mkatdonatur
							JOIN dtipebayar dt ON dt.id_dtipebayar = dkd.id_dtipebayar
							JOIN mtipebayar mt ON mt.id_mtipebayar = dt.id_mtipebayar
						) tbkatdon ON tbkatdon.id_dkatdonatur = dd.id_dkatdonatur
					WHERE
						md.alamat like "%'.$alamat.'%" and 
						md.j_kelamin like "%'.$j_kelamin.'%" and 
						md.kode_pos like "%'.$kode_pos.'%" and 
						md.nama like "%'.$nama.'%" and 
						md.hp like "%'.$hp.'%" and 
						md.telp like "%'.$telp.'%" AND
						mpo.mpropinsi like "%'.$mpropinsi.'%" AND
						mko.mkota like "%'.$mkota.'%" AND
						mkc.mkecamatan like "%'.$mkecamatan.'%" AND
						tbkatdon.mkatdonatur like "%'.$mkatdonatur.'%" AND
						tbkatdon.bayarvia like "%'.$mtipebayar.'%" 
						';
			// print_r($sql);exit();
			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 10;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			#ada data
			$jum	= mysql_num_rows($result);
			$out ='';
			if($jum!=0){	
				$nox 	= $starting+1;
				while($res = mysql_fetch_array($result)){
					$gender = ($res['j_kelamin']=='L')?'laki-laki':'Perempuan';	
					$btn ='<td>
								 <a class="btn btn-secondary" href="javascript:editmdonatur(\''.$res['id_mdonatur'].'\');" 
								 role="button"><i class="icon-pencil"></i></a>
								 <a class="btn btn-secondary" href="javascript:hapusmdonatur(\''.$res['id_mdonatur'].'\');" 
								 role="button"><i class="icon-remove"></i></a>
							 </td>';

					$out.=' <tr>
								<td>'.$nox.'</td>
								<td>'.$res['nama'].'</td>
								<td>'.$gender.'</td>
								<td>'.$res['alamat'].'</td>
								<td>'.$res['kode_pos'].'</td>
								<td>'.$res['mpropinsi'].'</td>
								<td>'.$res['mkota'].'</td>
								<td>'.$res['mkecamatan'].'</td>
								<td>'.$res['telp'].'</td>
								<td>'.$res['hp'].'</td>
								<td>'.$res['email'].'</td>
								<td>'.$res['mkatdonatur'].'</td>
								<td>'.$res['bayarvia'].'</td>
								'.$btn.'
							</tr>';
					$nox++;
				}
			}
			#kosong
			else
			{
				$out.= '<tr align="center">
						<td  colspan="15" ><span style="color:red;text-align:center;">
						... data masih kosong...</span></td></tr>';
			}
			#link paging
			$out.= '<tr class="info"><td colspan="14">'.$obj->anchors.'</td></tr>';
			$out.='<tr class="info"><td colspan="14">'.$obj->total.'</td></tr>';
			echo $out;
		break;
	
		#combo ==============================================================================================
		case 'combo':
			switch($menu){
				case 'mkota':
					$sql	= '	SELECT * from mkota ORDER by mkota asc '; 
					// print_r($sql);exit();	
					$exe	= mysql_query($sql);
					$datax	= array();
					while($res=mysql_fetch_assoc($exe)){
						$datax[]=$res;
					}
					// print_r($datax);exit();
					if($datax!=NULL){
						echo json_encode($datax);
					}else{
						echo '{"status":"gagal"}';
					}
				break;

				case 'mdonatur':
					$where 	=empty($_GET['id_mkota'])?' id_mdonatur ='.$_GET['id_mdonatur']:' id_mkota ='.$_GET['id_mkeota'];
					// print_r($where);exit();
					$sql	= '	SELECT * from mdonatur where '.$where.' order by mdonatur ASC ';
					$exe	= mysql_query($sql);
					$datax	= array();
					while($res=mysql_fetch_assoc($exe)){
						$datax[]=$res;
					}
					if($datax!=NULL){
						echo json_encode($datax);
					}else{
						echo '{"status":"gagal"}';
					}
				break;

				case 'mbukeg':
					$sql	= '	SELECT * from mbukeg order by mbukeg ';
					// print_r($sql);exit();	
					$exe	= mysql_query($sql);
					$datax	= array();
					while($res=mysql_fetch_assoc($exe)){
						$datax[]=$res;
					}
					// print_r($datax);exit();
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
			$sql = 'SELECT * from mdonatur WHERE id_mdonatur='.$_GET['id_mdonatur'];
			// var_dump($sql);exit();
			$exe	= mysql_query($sql);
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_mkota":"'.$res['id_mkota'].'",
					"mdonatur":"'.$res['mdonatur'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
				
		#ubah  ==============================================================================================
		case 'ubah':
			$sql = 'UPDATE  mdonatur set 	id_mkota= '.mysql_real_escape_string($_POST['id_mkotaTB']).',
										mdonatur 	= "'.mysql_real_escape_string($_POST['mdonaturTB']).'"
								WHERE id_mdonatur='.$_GET['id_mdonatur'];
			$exe = mysql_query($sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;

		#tambah  ==============================================================================================
		case 'tambah':
			$sql = 'INSERT into mdonatur set 	id_mkota 	= '.mysql_real_escape_string($_POST['id_mkotaTB']).',
											mdonatur 		= "'.mysql_real_escape_string($_POST['mdonaturTB']).'"';
			// print_r($sql);exit();
			$exe = mysql_query($sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo $out;
		break;
		
		#hapus ==============================================================================================
		case 'hapus':
			$sql	= 'DELETE from mdonatur  where id_mdonatur  ='.$_GET['id_mdonatur'];
			$exe	= mysql_query($sql);
			$out = ($exe)?'{"status":"sukses"}':'{"status":"gagal"}';
			echo  $out;
		break;
} ?>			
