<?php require_once('Connections/koneksi.php'); 

$nomor = $_POST['nomor'];
$NKK = $_POST['NKK'];
$alamat = $_POST['alamat'];
$nama = $_POST['nama'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$waktu_lahir = $_POST['waktu_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$agama = $_POST['agama'];

$query_r = ("UPDATE kelahiranpenduduk SET NKK = '$NKK', alamat = '$alamat', nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', waktu_lahir = '$waktu_lahir', jenis_kelamin = '$jenis_kelamin', agama = '$agama' WHERE nomor = '$nomor'");
$r = mysql_query($query_r, $koneksi) or die(mysql_error());

header ("Location: kelahiran_penduduk.php");
exit;
?>