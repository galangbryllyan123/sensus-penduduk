<?php require_once('Connections/koneksi.php'); ?>
<?php

$id = $_GET['id'];

$sql = "DELETE FROM penyewa WHERE username = '$id'";
$res = mysql_query($sql);

include "pengguna.php";


?>