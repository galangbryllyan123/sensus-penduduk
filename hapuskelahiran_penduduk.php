<?php require_once('Connections/koneksi.php'); ?>
<?php

$id = $_GET['id'];

$sql = "DELETE FROM kelahiranpenduduk WHERE NSKL = '$id'";
$res = mysql_query($sql);

include "kelahiran_penduduk.php";


?>