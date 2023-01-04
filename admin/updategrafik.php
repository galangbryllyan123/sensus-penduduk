<?php require_once('Connections/koneksi.php'); 

$nomor = $_POST['nomor'];
$sensus = $_POST['sensus'];
$senin = $_POST['senin'];
$selasa = $_POST['selasa'];
$rabu = $_POST['rabu'];
$kamis = $_POST['kamis'];
$jumat = $_POST['jumat'];
$sabtu = $_POST['sabtu'];


$query_r = "UPDATE garafik_sensus SET sensus = '$sensus', senin = '$senin',  selasa = '$selasa', rabu = '$rabu',  
 kamis = '$kamis',  jumat = '$jumat', sabtu = '$sabtu' WHERE nomor = '$nomor' ";
$r = mysql_query($query_r, $koneksi) or die(mysql_error());

header ("Location: tambahgrafik.php");
exit;
?>