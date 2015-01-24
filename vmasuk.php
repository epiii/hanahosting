<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/signin.css" rel="stylesheet">

<form class="form-signin" role="form" action="p_login.php" method="post">
  <h2 class="form-signin-heading">Masuk </h2>

  <?php 
    if(isset($_SESSION['emaily'])){
  		$user='value="'.$_SESSION['emaily'].'" ';
  		$disabled='readonly';
			$btn='<button class="btn btn-lg btn-success btn-primary" type="submit">Masuk</button>
    			  <a class="btn btn-lg btn-info btn-primary" href="logout.php">Akun Lain</a>';
  	}else{
  		$user='';
  		$disabled='';
   		$btn='<button class="btn btn-lg btn-success btn-primary btn-block" type="submit">Masuk</button>';
  	}
  ?> 
  <input <?php echo $user.$disabled; ?> class="form-control" placeholder="email" id="usernameTB" name="usernameTB" required autofocus>
  <input type="password" name="passwordTB" id="passwordTB" class="form-control" placeholder="Kata Sandi" required>
  <?php echo $btn;?>
  <div>
    admin <br>
    - id : lfree_style@yahoo.co.id <br>
    - pass :  lali <br>
    donatur <br>
    - id : gue.elfrianto@gmail.com <br>
    - pass  :lali <br>
  </div>
</form>

<!-- 
<html>
 <head>
    <meta name="viewport" content="width=device-width">
    <title>PHP Mailer by Mkhuda</title>
    <meta name="description" content="PHP Mailer by Mkhuda">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300" rel="stylesheet" type="text/css">
    <link href="style.css" type="tex/css" rel="stylesheet" media="all">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
 
</head>    
<body>
 
<div id="form">
    <form method="post" action="mail.php" class="form-horizontal">
    <label class="detik">username </label><br>
    <input class="input" type="text" name="username" placeholder="Masukkan username"><br>
    <label class="detik">Nama Email Anda</label><br>
    <input class="input" type="text" name="email" placeholder="Masukkan Email Anda"><br>
    <button type="submit" name="submit" class="btn">Submit</button>
</form>
</div>
<div id="mk-link">
    <a class="link" href="http://mkhuda.com" title="Mkhuda Blog">Back to Site</a>
</div>
</body>
</html> -->