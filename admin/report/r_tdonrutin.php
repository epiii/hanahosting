<?php
  session_start();
  require_once '../../lib/koneksi.php';
  require_once '../../lib/tglindo.php';
  require_once '../../lib/mpdf/mpdf.php';
  // require_once '../server/f_pak.php';
  
  //sudah login ---
  if(isset($_SESSION['login'])!=0){
    //tipe file pdf ---
    if(isset($_GET['tipe']) AND $_GET['tipe']=='pdf'){
      $ruwet  = base64_encode($_SESSION['idsesi'].$_SESSION['id_mloginy'].$_SESSION['idsesi']);
      //enkripsi ruwet ---
      if(isset($_GET['ruwet']) AND $_GET['ruwet']==$ruwet){ 
          // $id=isset($_GET['iddsn'])?'d.iddsn='.$_GET['iddsn']:'d.id_mloginp='.$_SESSION['id_mloginp'];
          ob_start(); // digunakan untuk convert php ke html
          // echo '<pre>';
          //   print_r($res);exit();
          // echo '</pre>';
          // $sql='SELECT * from manggota where id_mlogin='.$_SESSION['id_mloginp'];
          $blnx =[ 1=>'Januari',
                  2  =>'Februari',
                  3  =>'Maret',
                  4  =>'April',
                  5  =>'Mei',
                  6  =>'Juni',
                  7  =>'Juli',
                  8  =>'Agustus',
                  9  =>'September',
                  10 =>'Oktober',
                  11 =>'November',
                  12 =>'Desember'];

          $out='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
              <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Yatim Mandiri [ Laporan Donasi Rutin '.$_GET['bulan'].' '.$_GET['tahun'].' ]</title>
              </head>

              <body>
                <p align="center">
                  <b>
                    LAPORAN DONASI (RUTIN) <br>
                    '.$blnx[$_GET['bulan']].'  '.$_GET['tahun'].'  <br> 
                  </b>
                </p>';
                
                $bln    = trim($_GET['bulan'])!=''?' AND MONTH(td.tgl_lunas) = '.$_GET['bulan']:'';
                $thn    = trim($_GET['tahun'])!=''?' AND YEAR(td.tgl_lunas) = '.$_GET['tahun']:'';
                $nma    = trim($_GET['nama'])!=''?$_GET['nama']:'';
                $sql = 'SELECT
                          md.nama,
                          td.nom_akhir
                        FROM
                          tdonasi td
                          JOIN ddonatur dd ON dd.id_ddonatur = td.id_ddonatur
                          JOIN mdonatur md ON md.id_mdonatur = dd.id_mdonatur
                          JOIN dkatdonatur dkd ON dkd.id_dkatdonatur = dd.id_dkatdonatur
                          JOIN mkatdonatur mkd ON mkd.id_mkatdonatur = dkd.id_mkatdonatur
                        WHERE
                          td.isLunas = "y"
                          AND md.nama LIKE "%'.$nma.'%"
                          AND mkd.mkatdonatur = "rutin" '.$thn.$bln;
                // print_r($sql);exit();
                $jum = mysql_num_rows(mysql_query($sql));

                $out.='<span style="font-weight:bold;">Jumlah Donatur : '.$jum.' Orang</span>
                <table class="isi" width="100%">
                    <tr class="head">
                      <td align="center">No.</td>
                      <td align="center">Nama Donatur</td>
                      <td align="center">Jumlah Donasi</td>
                    </tr>';

                // print_r($sql);exit();
                $exe = mysql_query($sql);
                $nox=1;
                $tot=0;
                if ($jum==0) {
                  $out.='<tr>
                          <td align="center" > -</td>
                          <td align="center" > -</td>
                          <td align="center" > -</td>
                        </tr>';
                }else{
                  while ($res=mysql_fetch_assoc($exe)) {
                    $out.='<tr>
                            <td>'.$nox.'</td>
                            <td>'.$res['nama'].'</td>
                            <td>Rp. '.number_format($res['nom_akhir']).',-</td>
                          </tr>';
                    $nox++;
                    $tot+=$res['nom_akhir'];
                  }
                } 
                $out.='<tr class="head">
                        <td align="right" colspan="2">Total :</td>
                        <td>Rp. '.number_format($tot).',-</td>
                      </tr>';
                $out.='</table><br>';
                echo $out;
  
        #generate html -> PDF ------------
          $out2 = ob_get_contents();
          ob_end_clean(); 
          $mpdf=new mPDF('c','A4','');   
          $mpdf->SetDisplayMode('fullpage');   
          $stylesheet = file_get_contents('../../lib/mpdf/r_cetak.css');
          $mpdf->WriteHTML($stylesheet,1);  // The parameter 1 tells that this is css/style only and no body/html/text
          $mpdf->WriteHTML($out);
          $mpdf->Output();
        #end of generate html -> PDF ------------
      } //end of enkripsi ruwet -- 
      else{ // ruwet  =salah 
          echo 'kode enkripsi (url) tidak sesuai ';
      } // end of ruwet =salah     
    } //end of file pdf --
    else{ // tipe file bukan pdf ---
      echo 'bukan tipe pdf ';
    } // end of tipe file bukan pdf ---
  } // end of sudah login --
  else{ //belum login ---
    echo '<script>alert("anda belum login");window.location="../masuk";</script>';
  } //end of belum login ---
// echo $out;
