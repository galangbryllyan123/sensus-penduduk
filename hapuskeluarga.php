<?php require_once('Connections/koneksi.php'); ?>
<?php

$id = $_GET['id'];

$sql = "DELETE FROM keluarga WHERE NIK = '$id'";
$res = mysql_query($sql);

include "keluarga.php";


?>