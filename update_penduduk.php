<?php require_once('Connections/koneksi.php'); 

$nomor = $_POST['nomor'];
$nama = $_POST['nama'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$agama = $_POST['agama'];
$status_perkawinan = $_POST['status_perkawinan'];
$pekerjaan = $_POST['pekerjaan'];
$kewarganegaraan = $_POST['kewarganegaraan'];
$foto = $_POST['foto'];

$query_r = ("UPDATE penduduk SET  nama = '$nama', tempat_lahir = '$tempat_lahir',   tanggal_lahir = '$tanggal_lahir',   jenis_kelamin = '$jenis_kelamin', alamat = '$alamat',  agama = '$agama', status_perkawinan = '$status_perkawinan', pekerjaan= '$pekerjaan', kewarganegaraan= '$kewarganegaraan', foto= '$foto' WHERE nomor = '$nomor'");
$r = mysql_query($query_r, $koneksi) or die(mysql_error());

header ("Location: penduduk.php");
exit;
?>