<?php require_once('Connections/koneksi.php'); 

$nomor = $_POST['nomor'];
$NIK = $_POST['NIK'];
$nama = $_POST['nama'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$agama = $_POST['agama'];
$pendidikan = $_POST['pendidikan'];
$pekerjaan = $_POST['pekerjaan'];
$status_perkawinan = $_POST['status_perkawinan'];
$hubungan_keluarga = $_POST['hubungan_keluarga'];
$kewarganegaraan = $_POST['kewarganegaraan'];
$nama_ayah = $_POST['nama_ayah'];
$nama_ibu = $_POST['nama_ibu'];

$query_r = ("UPDATE keluarga SET  NIK = '$NIK', nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat',  agama = '$agama', pendidikan = '$pendidikan', pekerjaan = '$pekerjaan', status_perkawinan = '$status_perkawinan', hubungan_keluarga= '$hubungan_keluarga', kewarganegaraan= '$kewarganegaraan', nama_ayah = '$nama_ayah', nama_ibu = '$nama_ibu' WHERE nomor = '$nomor'");
$r = mysql_query($query_r, $koneksi) or die(mysql_error());

header ("Location: keluarga.php");
exit;
?>	