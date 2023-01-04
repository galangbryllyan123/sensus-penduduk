<?php require_once('Connections/koneksi.php'); ?>
<?php

$id = $_GET['id'];

$sql = "DELETE FROM kematianpenduduk WHERE NSKM = '$id'";
$res = mysql_query($sql);

include "kematian_penduduk.php";


?>