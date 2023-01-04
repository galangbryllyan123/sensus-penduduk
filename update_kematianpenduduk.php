<?php require_once('Connections/koneksi.php'); 


$nomor = $_POST['nomor'];
$NKK = $_POST['NKK'];
$alamat = $_POST['alamat'];
$NIK = $_POST['NIK'];
$nama = $_POST['nama'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$agama = $_POST['agama'];
$tempat_meninggal = $_POST['tempat_meninggal'];
$tanggal_meninggal = $_POST['tanggal_meninggal'];
$waktu_meninggal = $_POST['waktu_meninggal'];
$sebab_meninggal = $_POST['sebab_meninggal'];

$query_r = ("UPDATE kematianpenduduk SET NKK = '$NKK', alamat = '$alamat', NIK = '$NIK', nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', jenis_kelamin = '$jenis_kelamin', agama = '$agama', tempat_meninggal = '$tempat_meninggal', tanggal_meninggal = '$tanggal_meninggal', waktu_meninggal = '$waktu_meninggal', sebab_meninggal = '$sebab_meninggal' WHERE nomor = '$nomor'");
$r = mysql_query($query_r, $koneksi) or die(mysql_error());

header ("Location: kematian_penduduk.php");
exit;
?>