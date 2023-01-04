<?php require_once('Connections/koneksi.php');

mysql_select_db($database_koneksi, $koneksi);
$query_n = "SELECT * FROM penduduk ORDER BY nama ASC";
$n = mysql_query($query_n, $koneksi) or die(mysql_error());
$row_n = mysql_fetch_assoc($n);
$totalRows_n = mysql_num_rows($n);

mysql_select_db($database_koneksi, $koneksi);
$query_L = "SELECT * FROM penyewa";
$L = mysql_query($query_L, $koneksi) or die(mysql_error());
$row_L = mysql_fetch_assoc($L);
$totalRows_L = mysql_num_rows($L);

mysql_select_db($database_koneksi, $koneksi);
$query_A = "SELECT * FROM `admin`";
$A = mysql_query($query_A, $koneksi) or die(mysql_error());
$row_A = mysql_fetch_assoc($A);
$totalRows_A = mysql_num_rows($A);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Template Name: Modular Business
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Cetak penduduk</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />
<script type="text/javascript" src="layout/scripts/jquery.min.js"></script>
<script type="text/javascript" src="layout/scripts/jquery.jcarousel.pack.js"></script>
<script type="text/javascript" src="layout/scripts/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="layout/scripts/jquery.jcarousel.setup.js"></script>
<style type="text/css">
<!--
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
<script type="text/JavaScript">
<!--
function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
//-->
</script>
</head>
<body id="top">
  <td colspan="2"><script>
window.print();
      </script>
<div class="wrapper col5">
<div id="container">
<div id="header">
    <div class="fl_left">
      <h1><img src="images/Header.png" width="345" height="88" /></h1>
    </div>
    <div class="fl_right"> 
      <div align="right"><a href="#"><img src="images/Logo Bandung Barat.png" width="127" height="91" /></a> </div>
    </div>
    <br class="clear" /> 
    Jalan Raya Cimareme Nomor 314, Kec. Ngamprah, Kab. Bandung Barat
</div>
<h1 align="center" class="style4">&nbsp;</h1>
<h1 align="center" class="style4">DATA PENDUDUK </h1>
<p align="center" class="style4">&nbsp;</p>
<table border="1" cellpadding="0" cellspacing="3">
	
      <tr class="col1">
        <td><div align="center">NIK</div></td>
        <td><div align="center">Nama</div></td>
        <td><div align="center">Tempat lahir</div></td>
        <td><div align="center">Tanggal lahir</div></td>
        <td><div align="center">Jenis kelamin</div></td>
        <td><div align="center">Alamat</div></td>
        <td><div align="center">Agama</div></td>
        <td><div align="center">Status perkawinan</div></td>
        <td><div align="center">Pekerjaan</div></td>
        <td><div align="center">Kewarganegaraan</div></td>
      </tr>
      <?php do { ?>
        <tr>
          <td><div align="center"><?php echo $row_n['NIK']; ?></div></td>
          <td><div align="center"><?php echo $row_n['nama']; ?></div></td>
          <td><div align="center"><?php echo $row_n['tempat_lahir']; ?></div></td>
          <td><div align="center"><?php echo $row_n['tanggal_lahir']; ?></div></td>
          <td><div align="center"><?php echo $row_n['jenis_kelamin']; ?></div></td>
          <td><div align="center"><?php echo $row_n['alamat']; ?></div></td>
          <td><div align="center"><?php echo $row_n['agama']; ?></div></td>
          <td><div align="center"><?php echo $row_n['status_perkawinan']; ?></div></td>
          <td><div align="center"><?php echo $row_n['pekerjaan']; ?></div></td>
          <td><div align="center"><?php echo $row_n['kewarganegaraan']; ?></div></td>
        </tr>
        <?php } while ($row_n = mysql_fetch_assoc($n)); ?>
    </table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div id="column">
<div class="holder">
	<p>User Login,</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>Username : <?php echo $row_L['username']; ?></p>
	<p>Email : <?php echo $row_L['email']; ?></p>
	</div>
    </div>
<div id="column">
<div class="holder">
	<p>Admin,</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>Username : <?php echo $row_A['username']; ?></p>
	<p>Email : <?php echo $row_A['email']; ?></p>
	</div>
    </div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>
</div>
</div>
<!-- ####################################################################################################### -->
<div class="col1"></div>
</body>
</html>
<?php
mysql_free_result($n);

mysql_free_result($L);

mysql_free_result($A);
?>