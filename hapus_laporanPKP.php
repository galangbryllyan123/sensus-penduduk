<?php require_once('Connections/koneksi.php'); ?>
<?php

$id = $_GET['id'];

$sql = "DELETE FROM laporan_PKP WHERE nomor_laporan = '$id'";
$res = mysql_query($sql);

include "laporan_PKP.php";


?>