<?php
	session_start();

	if(!isset($_SESSION['levely']) or empty($_SESSION['levely']) ){ //sesi kosong
		header('location:../');
	}else{ // sesi ada
		if($_SESSION['levely']=='donatur'){ //sesi : user
			header('location:../user');
		}else{ //sesi : bukan anggota
			include "../lib/koneksi.php";
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Yatim Mandiri</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="../assets/js/jquery.js"></script>
    <script src="../js/plugins/bootstrap-datepicker.js"></script>
    <link href="../lib/paging.css"rel="stylesheet">
    <link href="../assets/css/bootstrap.css"rel="stylesheet">
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet" media="screen">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" >
    <link rel="apple-touch-icon-precomposed" sizes="114x114" >
    <link rel="apple-touch-icon-precomposed" sizes="72x72" >
    <link rel="apple-touch-icon-precomposed" >
    <link rel="shortcut icon">
<style>
	#footerx{
			color:#FFFFFF;
			text-align:center;
			/*background:#000099;*/
			background:orange;
			padding: 10px 0;
			/*background: -webkit-linear-gradient(left, #ccc, #000099); /*#999*/
			/*background: -moz-linear-gradient(left, red,orange);*/
			background: -moz-linear-gradient(right, green,yellow);
			background: -ms-linear-gradient(right, green,yellow);
			background: -webkit-linear-gradient(right, green,yellow);
			background: -o-linear-gradient(right, green,yellow);
			bottom: 0;
			position: fixed;
			width: 100%;
			font-size: 18px;
	}
	#header{
		background: -moz-linear-gradient(right, green,yellow);
		background: -ms-linear-gradient(right, green,yellow);
		background: -webkit-linear-gradient(right, green,yellow);
		background: -o-linear-gradient(right, green,yellow);
	}
	#header2{
		background: -moz-linear-gradient(right, green,yellow);
		background: -ms-linear-gradient(right, green,yellow);
		background: -webkit-linear-gradient(right, green,yellow);
		background: -o-linear-gradient(right, green,yellow);
	}
</style>
</head>

<body>

<!-- <div class="container-fluid" style="background-color:#F90"> -->
<div id="header" class="container-fluid" > 
    <div class="span2" align="left" style="padding-top:5px;">
      <img src="../img/ym_logo.png" />   </div>   
     <div class="span8"> <h3 align="center" style="color:white">Aplikasi Dana Anak Yatim</h3>
    </div>
    <div class="span2">.</div>
  </div>

    <div class="container-fluid " id="header2" >
    <!-- <div class="container-fluid" style="background-color:#F90"> -->
    
    <div class="container-fluid">
	
			<div class="navbar">
				<div class="navbar-inner">
					<div class="container-fluid">
						 <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a> <a href="?menu=vmain" style="color:#000" class="brand">
						 <?php 
							echo $_SESSION['emaily'].' ('.$_SESSION['levely'].')';
						?></a>
						<div class="nav-collapse collapse navbar-responsive-collapse">
					        <ul class="nav navbar-nav pull-right">
								<!-- <li><a href="beranda" style="color:#000"><i class="icon-home"></i> <b>Beranda</b></a></li> -->
                                <li><a href="penerima" style="color:#000"><i class="icon-user"></i> <b>Penerima</b></a></li>
                                <li><a href="donatur" style="color:#000"><i class="icon-user"></i> <b>Donatur</b></a></li>
								<?php if ($_SESSION['levely']=='admin'){;?>
                                <li><a href="penyalur" style="color:#000"><i class="icon-user"></i> <b>Penyalur</b></a></li>                          
		                        <li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i> <b>Pengurus <i class="caret"></i></b></a>
									<ul class="dropdown-menu">
										<li><a href="admin"><b>Admin</b></a></li>
										<li><a href="marketer"><b>Marketer</b></a></li>
									</ul>
								</li>
								<?php } ?>
		                        <li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i> <b>Aliran Dana <i class="caret"></i></b></a>
									<ul class="dropdown-menu">
										<li class="dropdown-submenu">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="icon-book"></i> <b>Pengumpulan</b></a>
											<ul class="dropdown-menu">
												<li><a href="donasi-rutin"><b>Donasi Rutin</b></a></li>
												<li><a href="donasi-insidentil"><b>Donasi Sukarela</b></a></li>
											</ul>
										</li>
										<li><a href="penyaluran-dana"><b>Penyaluran</b></a></li>
									</ul>
								</li>
								<?php if ($_SESSION['levely']=='admin'){;?>
		                        <li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i> <b>Setting <i class="caret"></i></b></a>
									<ul class="dropdown-menu">
										<li><a href="periode"><i class="icon-info-sign"></i> <b>Periode</b></a></li>
										<li class="dropdown-submenu">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="icon-book"></i> <b>Penerima</b></a>
											<ul class="dropdown-menu">
												<li><a href="kategori-penerima"><b>Kategori Penerima</b></a></li>
												<li><a href="detail-penerima"><b>Detail Penerima</b></a></li>
											</ul>
										</li>
										<li class="dropdown-submenu">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="icon-book"></i> <b>Donatur</b></a>
											<ul class="dropdown-menu">
												<li><a href="kategori-donatur"><b>Kategori Donatur</b></a></li>
												<li><a href="detail-donatur"><b>Detail Donatur</b></a></li>
											</ul>
										</li>
										<li class="dropdown-submenu">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="icon-book"></i> <b>Pembayaran</b></a>
											<ul class="dropdown-menu">
												<li><a href="kategori-pembayaran"><b>Kategori Pemb.</b></a></li>
												<li><a href="detail-pembayaran"><b>Detail Pemb.</b></a></li>
											</ul>
										</li>
										<li class="dropdown-submenu">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="icon-book"></i> <b>Lokasi</b></a>
											<ul class="dropdown-menu">
												<li><a href="propinsi"><b>Propinsi</b></a></li>
												<li><a href="kota"><b>Kota</b></a></li>
												<li><a href="kecamatan"><b>Kecamatan</b></a></li>
											</ul>
										</li>
										<li class="dropdown-submenu">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="icon-book"></i> <b>Pendidikan</b></a>
											<ul class="dropdown-menu">
												<li><a href="jenjang"><b>Jenjang</b></a></li>
												<li><a href="sekolah"><b>Sekolah</b></a></li>
											</ul>
										</li>
										<?php } ?>
										<li><a href="profil"><i class="icon-info-sign"></i> <b>Profil</b></a></li>
										<li class="divider"></li>
		                                <li>
											<a href="../logout.php"><i class="icon-lock"></i> <b>Keluar</b></a>
										</li>

									</ul>
								</li>

							</ul>
							
						</div>
						
					</div>
				</div>
				
			</div>
            
		
	</div>
</div>

<!-- content -->
<div class="container">
    
        <!--<h3>HALAMAN <?php //echo $username; ?> </h3>-->
    	<?php
			if (isset($_GET['menu'])) {
				switch ($_GET['menu']){
					#common --
						case 'vmpenerima':
							require 'view/v_mpenerima.php';
						break;
						case 'vmdonatur':
							require 'view/v_mdonatur.php';
						break;
						case 'vmlembaga':
							require 'view/v_mlembaga.php';
						break;
						case 'vmadmin':
							require 'view/v_madmin.php';
						break;
						case 'vmmarketer':
							require 'view/v_mmarketer.php';
						break;

					#aliran dana --
						case 'vtdonrutin':
							require 'view/v_tdonrutin.php';
						break;
						case 'vtdoninsidentil':
							require 'view/v_tdoninsidentil.php';
						break;
						case 'vtpenyaluran':
							require 'view/v_tpenyaluran.php';
						break;

					#setting --
						#profil (edit only)	
							case 'vprofil':
								require 'view/v_profil.php';
							break;
						#periode ---
							case 'vmperiode':
								require 'view/v_mperiode.php';
							break;
						#penerima ---
							case 'vmkatpenerima':
								require 'view/v_mkatpenerima.php';
							break;
							case 'vdkatpenerima':
								require 'view/v_dkatpenerima.php';
							break;
						#donatur ---
							case 'vmkatdonatur':
								require 'view/v_mkatdonatur.php';
							break;
							case 'vmdkatdonatur':
								require 'view/v_dkatdonatur.php';
							break;
						#pembayaran	--
							case 'vmtipebayar':
								require 'view/v_mtipebayar.php';
							break;
							case 'vmdtipebayar':
								require 'view/v_dtipebayar.php';
							break;
						#lokasi --
							case 'vmpropinsi':
								require 'view/v_mpropinsi.php';
							break;
							case 'vmkota':
								require 'view/v_mkota.php';
							break;		
							case 'vmkecamatan':
								require 'view/v_mkecamatan.php';
							break;
						#sekolah ---
							case 'vmjenjang':
								require 'view/v_mjenjang.php';
							break;
							case 'vmsekolah':
								require 'view/v_msekolah.php';
							break;
				}
			}else{
				require 'view/v_mpenerima.php';
			}
		?>
   
</div>

<div id="footerx">copyright Yatim Mandiri @ 2014</div>


<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
	<script src="../js/base64.js"></script>
	<script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-scrollspy.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-tooltip.js"></script>
    <script src="../assets/js/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-carousel.js"></script>
    <script src="../assets/js/bootstrap-typeahead.js"></script>
</body>
</html>

<?php
		}
	}
?>