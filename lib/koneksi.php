<?php
	// $server   = "localhost";
	// $username = "root";
	// $password = "";
	// $database = "anak_asuh";
	
	$server   = "mysql.idhostinger.com";
	$username = "u673359344_hanaf";
	$password = "1tambah1=2";
	$database = "u673359344_hanaf";
	
	// Koneksi dan memilih database di server
	$con = mysql_connect($server,$username,$password);
	if(!$con){
		echo "Koneksi gagal";
	}else{
		$db=mysql_select_db($database,$con);
		if(!$db){
			echo 'gagal pilih database';
		}
	}
?>
