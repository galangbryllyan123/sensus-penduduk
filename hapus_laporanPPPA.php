<?php require_once('Connections/koneksi.php'); ?>
<?php

$id = $_GET['id'];

$sql = "DELETE FROM laporan_PPPA WHERE nomor_laporan = '$id'";
$res = mysql_query($sql);

include "laporan_PPPA.php";


?>