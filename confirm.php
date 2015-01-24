<?php
include 'lib/koneksi.php';
$confirm = $_GET['id'];
if (isset($confirm)) {
    // $query = "SELECT id FROM user WHERE id='$confirm'";
    $find = mysql_query($query);
    $query = "SELECT acak FROM  mlogin  WHERE acak='$confirm'";
 
    if ($find && mysql_num_rows($find) > 0) {
        $update = "UPDATE mlogin set confirm='yes' where user.id='$confirm'";
        $set = mysql_query ($update);
        if ($set) {
            echo "Konfirmasi sukses";
        }
    } else {
        echo "ID tidak dikenali";
    }
} else {
    echo "Nothing to do";
}
 
?>