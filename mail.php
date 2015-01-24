<?php
    // $to = 'nobody@example.com';
    // $subject = 'the subject';
    // $message = 'hello';
    // $headers = 'From: webmaster@example.com' . "\r\n" .
    // 'Reply-To: webmaster@example.com' . "\r\n" .
    // 'X-Mailer: PHP/' . phpversion();
    // $to      = 'gue.elfrianto@gmail.com';
    $to      = 'hanahosting@gmail.com';
    $subject = 'tes hanaboot';
    $message = 'hello jeh';
    $headers = 'From: gue.elftianto@gmail.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    $m=mail($to, $subject, $message, $headers);
    if ($m) {
        echo 'sukses';
    } else {
        echo 'gagal';
    }
    
    // if()
/*error_reporting(0);

function rand_string( $length ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  

    $size = strlen( $chars );
    for( $i = 0; $i < $length; $i++ ) {
        $str .= $chars[ rand( 0, $size - 1 ) ];
    }

    return $str;
}

include 'lib/koneksi.php';
$username = $_POST['username'];
$email = $_POST['email'];
// $id = rand_string( 10 );
if (!isset($nama)) {
echo "Lengkap form";
}
elseif (!isset($email)) {
    echo "Lengkapi form";
} 
else {
    $query = "SELECT email FROM mlogin WHERE email='$email'";
    $find = mysql_query($query);

    if ($find && mysql_num_rows($find) > 0) {
        echo "user telah terdaftar";
    }
    else {
        // $add = "insert into user set id='$id', name='$nama', email='$email', confirm='no'";
        $add = "INSERT  into mlogin set  username='$username', email='$email', isActive='n'";
        $set = mysql_query($add);
        if ($set) {
            echo '<script>alert("berhasil query insert");</script>';
        } else {
            echo '<script>alert("gagal query insert");</script>';
        }
        require_once('lib/PHPMailer-master/class.phpmailer.php'); //menginclude librari phpmailer

        $mail             = new PHPMailer();
        $body             = 
        "<body style='margin: 10px;'>
            <div style='width: 640px; font-family: Helvetica, sans-serif; font-size: 13px; padding:10px; line-height:150%; border:#eaeaea solid 10px;'>
                <br>
                <strong>Terima Kasih Telah Mendaftar</strong><br>
                <b>Nama Anda : </b>".$nama."<br>
                <b>Email : </b>".$email."<br>
                <br>
            </div>
        </body>";
        $body               = eregi_replace("[\]",'',$body);
        $mail->IsSMTP();    // menggunakan SMTP
        $mail->SMTPDebug    = 1;   // mengaktifkan debug SMTP

        $mail->SMTPAuth     = true;   // mengaktifkan Autentifikasi SMTP
        $mail->Host         = 'mail.mkhuda.com'; // host sesuaikan dengan hosting mail anda
        $mail->Port         = 25;  // post gunakan port 25
        $mail->Username     = "hello@mkhuda.com"; // username email akun
        $mail->Password     = "passwordanda";        // password akun

        $mail->SetFrom('hello@mkhuda.com', 'Hello Mkhuda');

        $mail->Subject    = "Hello";
        $mail->MsgHTML($body);

        $address = $email; //email tujuan
        $mail->AddAddress($address, "Hello (Reciever name)");

        if(!$mail->Send()) {
            echo "Oops, Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Mail Sukses";
        }
    }
}
*/
?>