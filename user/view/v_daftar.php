<?php require_once 'lib/koneksi.php';?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Unesa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Le styles -->
    <link href="assets/css/bootstrap.css"rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="apple-touch-icon-precomposed" sizes="144x144">
    <link rel="apple-touch-icon-precomposed" sizes="114x114">
    <link rel="apple-touch-icon-precomposed" sizes="72x72">
    <link rel="apple-touch-icon-precomposed">
    <link rel="shortcut icon">
	<script src="assets/js/jquery.js"></script>
    <script src="js/plugins/bootstrap-datepicker.js"></script>
    <script src="s_daftar.js"></script>

    <style type="text/css">
	.form-login {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color:#F60;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-login .form-signin-heading,
      .form-login .checkbox {
        margin-bottom: 10px;
      }
      .form-login input[type="text"],
      .form-login input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
	  .bod{
		  padding-top:120px;
	  }
	  #info{
		  color: #FFFFFF;
		  font-weight:bold;
		  
	  }#footerx{
			color:#FFFFFF;
			text-align:center;
			background:#000099;
			padding: 10px 0;
			background: -moz-linear-gradient(left, black,#000055);
			background: -webkit-linear-gradient(left, black,#000055);
			background: -ms-linear-gradient(left, black,#000055);
			background: -o-linear-gradient(left, black,#000055);
			background: -linear-gradient(left, black,#000055);
			bottom: 0;
			position: fixed;
			width: 100%;
			font-size: 18px;
	}
	#footerx a{
		text-decoration: none;
		font-weight: bold;
		color: #000;
	}.lowerizer{
		text-transform:lowercase;
	}.upperizer{
		text-transform:uppercase;
	}
	</style>
	</head>
	
    <body style="overflow:scroll;">
        <div id="header" align="center" class="top-header" style="background-color:#005;">
            <img src="img/logoooo.png" />
            <h2 style="color:#F60">Sistem Inforamsi Dana Bantuan Anak Yatim</h2>
        </div>    

    <div class="container">
    <a  href="./" class="pull-right btn btn-secondary"><i class="icon-home"></i> Kembali</a>
    <h2 align="center"><legend>Form Pendaftaran Donatur</legend></h2>
		<div class="container-fluid">
			<div class="span2"></div>
			<div class="span8">
				<form name="form-daftar" class="form-horizontal" autocomplete="off" action="p_daftar.php" method="post">
					<div class="control-group">
						<label class="control-label">Nama :</label>
						<div class="controls">
							<input id="nama" name="nama" class="lowerizer" required type="text" placeholder="max 20 karakter (a-z 0-9  _)" maxlength="20">
							<div id="userinfo"></div>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Jenis Kelamin :</label>
						<div class="controls">
							<select required  name="j_kelamin" id="j_kelamin">
								<option value="">pilih jenis kelamin ...</option>
								<option value="L">Laki - Laki</option>
								<option value="P">Perempuan</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Alamat :</label>
						<div class="controls">
							<input id="alamat" name="alamat" required type="text" placeholder="Masukan Alamat" maxlength="20">
                        <div id="rpsinfo"></div>    
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Kode Pos :</label>
						<div class="controls">
							<input name="kode_pos" id="kose_pos" required type="text" placeholder="Masukan Kode Pos" min="18" maxlength="18">
								<div id="nipinfo"></div>
							</div>
					</div>

					<div class="control-group">
						<label class="control-label">Kecamatan</label>
						<div class="controls" >
						<select name="mkecamatan" id="mkecamatan" required>
						<option value=''>Pilih Kecamtan ...</option>
						</select>
						</div>
							<span id="mkecamatanInfo"></span>
					</div>

					<div class="control-group">
						<label class="control-label">No Telepon:</label>
						<div class="controls">
							<input id="telp"name="telp"  type="text" placeholder="No Telepon" maxlength="20" >
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">No HP :</label>
						<div class="controls">
							<input id="hp"name="hp"  required type="text" placeholder="No Handphone" maxlength="20" >
						</div>
					</div>
					
					
					<div class="form-actions">
						<button type="submit" class="btn btn-primary" value="daftar">Daftar</button>
						<button type="submit" class="btn" value="cancel" onClick="window.history.back()">Cancel</button>
					</div>
				</form>
                <div>.</div>
                <div>.</div>
    		</div>
	    </div>
    </div> <!-- /container -->

	
    <!-- Le java3333ipt
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>

	</body>
	<div id="footerx">copyright UNESA @ 2013</div>
</html>
