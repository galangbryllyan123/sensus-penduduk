<?php require_once('Connections/koneksi.php'); 

$nomor = $_POST['nomor'];
$NKK = $_POST['NKK'];
$NIK = $_POST['NIK'];
$nama = $_POST['nama'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$hubungan_keluarga = $_POST['hubungan_keluarga'];
$alasan_pindah = $_POST['alasan_pindah'];
$alamat_pindah = $_POST['alamat_pindah'];
$tanggal_pindah = $_POST['tanggal_pindah'];
$klasifikasi_pindah = $_POST['klasifikasi_pindah'];

$query_r = ("UPDATE pendudukpindah SET NKK = '$NKK', NIK = '$NIK', nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat', hubungan_keluarga = '$hubungan_keluarga', alasan_pindah = '$alasan_pindah', alamat_pindah = '$alamat_pindah', tanggal_pindah = '$tanggal_pindah', klasifikasi_pindah = '$klasifikasi_pindah' WHERE nomor = '$nomor'");
$r = mysql_query($query_r, $koneksi) or die(mysql_error());

header ("Location: penduduk_pindah.php");
exit;
?>