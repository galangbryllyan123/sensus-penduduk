<?php require_once('Connections/koneksi.php'); ?>
<?php

$id = $_GET['id'];

$sql = "DELETE FROM pendudukdatang WHERE NSKD = '$id'";
$res = mysql_query($sql);

include "penduduk_datang.php";


?>