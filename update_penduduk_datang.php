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
$hubungan_keluarga = $_POST['hubungan_keluarga'];
$alasan_datang = $_POST['alasan_datang'];
$alamat_tujuan = $_POST['alamat_tujuan'];
$klasifikasi_pindah = $_POST['klasifikasi_pindah'];
$tanggal_datang = $_POST['tanggal_datang'];

$query_r = ("UPDATE pendudukdatang SET  NKK = '$NKK', alamat = '$alamat', NIK = '$NIK', nama = '$nama', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', jenis_kelamin = '$jenis_kelamin', agama = '$agama', hubungan_keluarga = '$hubungan_keluarga', alasan_datang= '$alasan_datang', alamat_tujuan= '$alamat_tujuan', tanggal_datang= '$tanggal_datang', klasifikasi_pindah= '$klasifikasi_pindah' WHERE nomor = '$nomor'");
$r = mysql_query($query_r, $koneksi) or die(mysql_error());

header ("Location: penduduk_datang.php");
exit;
?>