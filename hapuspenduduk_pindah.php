<?php require_once('Connections/koneksi.php');

$id = $_GET['id'];

$sql = "DELETE FROM pendudukpindah WHERE NSKP = '$id'";
$res = mysql_query($sql);

include "penduduk_pindah.php";


?>