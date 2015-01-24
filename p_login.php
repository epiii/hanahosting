<?php
	#start of : cek email/password 
	require_once'lib/koneksi.php';
	// var_dump($_POST);exit();
	if(!isset($_POST)){
		echo '<script>window.location=\'./\'</script>';
	}else{
		function anti_injection($data){
			$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
			return $filter;
		}

		$username = anti_injection($_POST['usernameTB']);
		$password = anti_injection(md5($_POST['passwordTB']));

		$sql 	= '	SELECT * 
					FROM 
						mlogin 
					WHERE  
						password="'.$password.'" and email="'.$username.'"';
		// var_dump($sql);exit();
		$login	= mysql_query($sql);
		$ketemu	= mysql_num_rows($login);
		$r		= mysql_fetch_assoc($login);

		// Apabila email dan password ditemukan
		if ($ketemu > 0){
			if($r['isActive']=='n' and $r['acak']=='confirmed'){ //blokir
				echo '<script>alert(\'akun anda sedang diblokir, silahkan hubungi admin\');window.location=\'masuk\'</script>';
			}elseif($r['isActive']=='n' and $r['acak']!='confirmed'){ // brlum aktivasi email
				echo '<script>alert(\'anda belum aktivasi silahkan buka email anda\');window.location=\'masuk\'</script>';
			}else{ // normal
				session_start();

				$sql2 ='SELECT * from m'.$r['level'].' WHERE id_mlogin ='.$r['id_mlogin'];
				$exe2 = mysql_query($sql2);
				$res2 =  mysql_fetch_assoc($exe2);
				//var_dump($sql2);exit();
				//$_SESSION['namay'] 		= $r['nama'];
				$_SESSION['id_mloginy'] = $r['id_mlogin'];
				$_SESSION['emaily']  	= $r['email'];
				$_SESSION['levely']		= $r['level'];
				
				$_SESSION['login'] 		= 1;
				
				$sid_lama = session_id();
				session_regenerate_id();
				$sid_baru = session_id();
				$_SESSION['idsesi']		= $sid_baru;
				

				 //var_dump($_SESSION);exit();
		
				if($r['level']!='donatur'){
					if(empty($r['acak'])){
						// $sqlc = 'UPDATE mlogin set acak="'.base64_encode($r['email']).'" where id_mlogin='.$r['id_mlogin'];
						$sqlc = 'UPDATE mlogin set acak="confirmed" where id_mlogin='.$r['id_mlogin'];
						$exec = mysql_query($sqlc);
					}
					header("Location:admin");
				}else{
					header("Location:user");
				}
			}
		}else{
			// echo "<script>alert('email / password salah ');window.location='./';</script>";
			echo "<script>window.location='masuk';</script>";
		}
	}#end  of : cek email/password 

?>
