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
		// total
		case 'total':
			$sql = 'SELECT sum(nom_akhir)as tot from tdonasi WHERE isLunas="y"';
			$exe = mysql_query($sql);
			$res = mysql_fetch_assoc($exe);
			$out = $exe ? '{"status":"sukses", "tot":"Rp. '.number_format($res['tot']).',-"}':'{"status":"gagal"}';
			echo $out;
		break;

		#cek ==============================================================================================
		case 'cek':
			$sqlc = 'SELECT * 
					from ddonatur dd
						JOIN mdonatur md on md.id_mdonatur = dd.id_mdonatur  
					 where 
					 	md.id_mlogin='.$_SESSION['id_mloginy'];
			$exec = mysql_query($sqlc);
			$resc = mysql_fetch_assoc($exec);
			$jumc = mysql_num_rows($exec);

			#jika ada non aktif --
			if ($jumc>0) { // ada non aktif
				$sqls = 'UPDATE ddonatur set isActive="n" 
						 WHERE 
							id_mdonatur = '.$resc['id_mdonatur'].' AND 
							id_ddonatur !='.$_GET['id_ddonatur'];
				// print_r($sqls);exit();
				$exes = mysql_query($sqls);
				if (!$exes) {
					$out='{"status":"gagal non aktifkan"}';
				}
			}#end of jika ada non aktif --

			#aktifkan --
			$sqlu = 'UPDATE ddonatur set isActive="y" 
					 WHERE 
						id_ddonatur='.$_GET['id_ddonatur'];
			// print_r($sqls);exit();
			$exeu = mysql_query($sqlu);
			if (!$exeu) {
				$out='{"status":"gagal aktifkan"}';
			}else{
				$out='{"status":"sukses"}';
			}
			#end of aktifkan --
			echo $out;
		break;
		#end of : cek ==============================================================================================

		#combo ==============================================================================================
		case 'combo':
			switch($menu){
				case 'tahun':
					$datax=array();
					for($i=date('Y'); $i>2008; $i--) {
						$datax[]=$i;
					}
					echo json_encode($datax);
				break;

				case 'bulan':
					$datax=[1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',
							6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember',];
					echo json_encode($datax);
				break;

				case 'dkatdonatur':
					$sql	= 'SELECT 
									dkd.id_dkatdonatur,
									dt.dtipebayar,
									dt.no_rek
								from 
									dkatdonatur dkd 
									JOIN mkatdonatur mkd on mkd.id_mkatdonatur = dkd.id_mkatdonatur
									JOIN dtipebayar dt on dt.id_dtipebayar= dkd.id_dtipebayar
									JOIN mtipebayar mt on mt.id_mtipebayar= dt.id_mtipebayar
								WHERE	
									mt.mtipebayar != "tunai"
								ORDER BY	
									dt.dtipebayar ASC';
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
					$sql	= 'SELECT * FROM  mkota where id_mpropinsi='.$_GET['id_mpropinsi'].' ORDER BY mkota';
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
					$sql	= 'SELECT * FROM  mkecamatan where id_mkota='.$_GET['id_mkota'].' ORDER BY mkecamatan';
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
			$sql = 'SELECT 
						dkd.id_dkatdonatur,
						dt.dtipebayar,
						dt.no_rek,
						td.nom_akhir,
						td.bukti,
						dd.id_ddonatur
					from 
						tdonasi td 
						join ddonatur dd on dd.id_ddonatur = td.id_ddonatur
						join mdonatur md on md.id_mdonatur= dd.id_mdonatur
						join dkatdonatur dkd on dkd.id_dkatdonatur=dd.id_dkatdonatur
						join mkatdonatur mkd on mkd.id_mkatdonatur=dkd.id_mkatdonatur
						join dtipebayar dt on dt.id_dtipebayar=dkd.id_dtipebayar
					WHERE
						td.id_tdonasi='.$_GET['id_tdonasi']; 

			// var_dump($sql);exit();
			$exe	= mysql_query($sql);
			$res	= mysql_fetch_assoc($exe);
			if($exe){
				echo '{
					"id_dkatdonatur":"'.$res['id_dkatdonatur'].'",
					"bukti":"'.$res['bukti'].'",
					"dtipebayar":"'.$res['dtipebayar'].'",
					"no_rek":"'.$res['no_rek'].'",
					"nom_akhir":"'.$res['nom_akhir'].'",
					"id_ddonatur":"'.$res['id_ddonatur'].'"
				}';
			}else{
				echo '{"status":"gagal"}';
			}
		break;
		
		#ubah  ==============================================================================================
		case 'ubah':
			$sql1 = 'UPDATE tdonasi set isLunas 	= "'.$_POST['isLunasTB'].'",
										tgl_lunas 	= NOW()
								WHERE id_tdonasi 	= '.$_GET['id_tdonasi'];
			$exe1	= mysql_query($sql1);
			if(!$exe1){
				$out='{"status":"gagal ubah"}';
			}else{
				$out='{"status":"sukses"}';
			}
			echo $out;
		break;
			
		#tampil  =============================================================================================
		case 'tampil' :
			$nama  		= trim($_GET['namaS'])?$_GET['namaS']:'';
			$nom_akhir  = trim($_GET['nom_akhirS'])?$_GET['nom_akhirS']:'';
			$no_rek 	= trim($_GET['no_rekS'])?$_GET['no_rekS']:'';
			$isLunas    = trim($_GET['isLunasS'])?$_GET['isLunasS']:'';
			$dtipebayar = trim($_GET['dtipebayarS'])?$_GET['dtipebayarS']:'';
			$bulan 		= trim($_GET['bulanS'])!=''?' AND MONTH(td.tgl_lunas) = '.$_GET['bulanS']:'';
			$tahun 		= trim($_GET['tahunS'])!=''?' AND YEAR(td.tgl_lunas) = '.$_GET['tahunS']:'';

			$sql = 'SELECT 
						md.nama,
						td.id_tdonasi,
						td.nom_akhir,
						dt.dtipebayar,
						dt.no_rek,
						td.tgl,
						td.tgl_lunas,
						td.isLunas
					from 
						tdonasi td 
						join ddonatur dd on dd.id_ddonatur = td.id_ddonatur
						join mdonatur md on md.id_mdonatur= dd.id_mdonatur
						join dkatdonatur dkd on dkd.id_dkatdonatur=dd.id_dkatdonatur
						join mkatdonatur mkd on mkd.id_mkatdonatur=dkd.id_mkatdonatur
						join dtipebayar dt on dt.id_dtipebayar=dkd.id_dtipebayar
					WHERE
						mkd.mkatdonatur="insidentil" 
						AND md.nama LIKE "%'.$nama.'%"
						AND td.nom_akhir LIKE "%'.$nom_akhir.'%"
						AND dt.dtipebayar LIKE "%'.$dtipebayar.'%"
						AND dt.no_rek LIKE "%'.$no_rek.'%"
						AND isLunas LIKE "%'.$isLunas.'%" 
						AND isLunas !="n" '.$tahun.$bulan;
						// md.id_mlogin='.$_SESSION['id_mloginy'].' 
			// print_r($sql);exit();

			if(isset($_GET['starting'])){ //nilai awal halaman
				$starting=$_GET['starting'];
			}else{
				$starting=0;
			}

			$recpage= 5;//jumlah data per halaman
			$obj 	= new pagination_class($menu,$sql,$starting,$recpage);
			$result =$obj->result;

			$out='';
			$jum	= mysql_num_rows($result);	
			$tot = 0;
			if($jum!=0){	
				$nox	= $starting+1;
				while($res = mysql_fetch_array($result)){	

					$tgl_lunas =$res['tgl_lunas']=='0000-00-00'?'-':tgl_indo($res['tgl_lunas']);
					// $kantor = empty($res['pre_malamat'])?'-':$res['pre_malamat'];
					if($res['isLunas']=='o'){ //sudah konfirmasi / upload bukti pembayaran
						$status ='Pending';
						$clr = 'class="success" onmouseover="return tooltipx(this);" data-toggle="tooltip" title="Pending" data-placement="left" ';
						$btn ='<div class="btn-group">
								  	<button type="button" onclick="edittdonasi('.$res['id_tdonasi'].',\'konfirmasi\');" class="btn btn-success"
									  	onmouseover="return tooltipx(this);" data-toggle="tooltip" title="konfirmasi" data-placement="top" >
								  		<i class="icon-ok"></i>
							  		</button>
								</div>';
					}elseif($res['isLunas']=='y'){ //sudah approve oleh admin 
						$tot+=$res['nom_akhir'];
						$status ='Sudah diperiksa';
						$clr = 'class="info" onmouseover="return tooltipx(this);" data-toggle="tooltip" title="Sudah diperiksa admin" data-placement="left" ';
						$btn ='<div class="btn-groups">
								  	<button disabled class="btn btn-default" >
								  		<i class="icon-ok"></i>
							  		</button>
								</div>';
					}

					$out.='<tr '.$clr.'>
							<td><label class="control-label">'.$nox.'</label></td>
							<td><label class="control-label">'.$res['nama'].'</label></td>
							<td><label class="control-label">'.$res['dtipebayar'].'</label></td>
							<td><label class="control-label">'.$res['no_rek'].'</label></td>
							<td><label class="control-label">Rp. '.number_format($res['nom_akhir']).',-</label></td>
							<td><label class="control-label">'.$tgl_lunas.'</label></td>
							<td><label class="control-label">'.$status.'</label></td>
							<td>
								'.$btn.'
							</td>
						</tr>';
					// <td><label class="control-label">'.$res['nama'].'</label></td>
                	$nox++;
				}
			}
			#kosong
			else
			{
				$out.='<tr align="center">
						<td  colspan="7"><span style="color:red;text-align:center;">
						... data masih kosong...</span></td></tr>';
			}
			#link paging
			$out.='<tr style="color:blue;font-weight:bold;">
					<td colspan="4">
						<span class="pull-right">Total :</span><br>
						<p class="pull-right label label-warning">Hanya donasi yang telah masuk rekening [YATIM MANDIRI] </p>
					</td>
					<td colspan="4">Rp. '.number_format($tot).',-</td>
					</tr>';
			$out.='<tr class="info"><td colspan="8">'.$obj->anchors.'</td></tr>';
			$out.='<tr class="info"><td colspan="8">'.$obj->total.'</td></tr>';
		echo $out;
	break;
	
} ?>			
