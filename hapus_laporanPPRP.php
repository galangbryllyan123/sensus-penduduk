<?php require_once('Connections/koneksi.php'); ?>
<?php

$id = $_GET['id'];

$sql = "DELETE FROM laporan_PPRP WHERE nomor_laporan = '$id'";
$res = mysql_query($sql);

include "laporan_PPRP.php";


?>