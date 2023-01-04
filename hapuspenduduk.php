<?php require_once('Connections/koneksi.php'); ?>
<?php

$id = $_GET['id'];

$sql = "DELETE FROM penduduk WHERE NIK = '$id'";
$res = mysql_query($sql);

include "penduduk.php";


?>