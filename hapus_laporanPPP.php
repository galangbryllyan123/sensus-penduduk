<?php require_once('Connections/koneksi.php'); ?>
<?php

$id = $_GET['id'];

$sql = "DELETE FROM laporan_PPP WHERE nomor_laporan = '$id'";
$res = mysql_query($sql);

include "laporan_PPP.php";


?>