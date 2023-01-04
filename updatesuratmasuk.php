<?php require_once('Connections/koneksi.php'); 

$nomor = $_POST['nomor'];
$id_surat = $_POST['id_surat'];
$tgl_surat = $_POST['tgl_surat'];
$pengolah = $_POST['pengolah'];
$penerima = $_POST['penerima'];
$perihal = $_POST['perihal'];
$nama_surat = $_POST['nama_surat'];
$bobot = $_POST['bobot'];
$kerahasiaan = $_POST['kerahasiaan'];

$query_r = "UPDATE nilai_arsipk SET id_surat = '$id_surat', tgl_surat = '$tgl_surat',  pengolah = '$pengolah', penerima = '$penerima',  
 perihal = '$perihal',  nama_surat = '$nama_surat', bobot = '$bobot', kerahasiaan= '$kerahasiaan' WHERE nomor = '$nomor' ";
$r = mysql_query($query_r, $koneksi) or die(mysql_error());

header ("Location: suratmasuk.php");
exit;
?>