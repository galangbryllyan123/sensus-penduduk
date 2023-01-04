<?php require_once('Connections/koneksi.php'); ?>
<?php
mysql_select_db($database_koneksi, $koneksi);
$query_n = "SELECT * FROM penduduk";
$n = mysql_query($query_n, $koneksi) or die(mysql_error());
$row_n = mysql_fetch_assoc($n);
$totalRows_n = mysql_num_rows($n);

mysql_select_db($database_koneksi, $koneksi);
$query_k = "SELECT * FROM kelahiranpenduduk";
$k = mysql_query($query_k, $koneksi) or die(mysql_error());
$row_k = mysql_fetch_assoc($k);
$totalRows_k = mysql_num_rows($k);

mysql_select_db($database_koneksi, $koneksi);
$query_l = "SELECT * FROM kelahiranpenduduk";
$l = mysql_query($query_l, $koneksi) or die(mysql_error());
$row_l = mysql_fetch_assoc($l);
$totalRows_l = mysql_num_rows($l);

mysql_select_db($database_koneksi, $koneksi);
$query_h = "SELECT * FROM pendudukpindah";
$h = mysql_query($query_h, $koneksi) or die(mysql_error());
$row_h = mysql_fetch_assoc($h);
$totalRows_h = mysql_num_rows($h);
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
<title>Login user</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />
<script type="text/javascript" src="layout/scripts/jquery.min.js"></script>
<script type="text/javascript" src="layout/scripts/jquery.jcarousel.pack.js"></script>
<script type="text/javascript" src="layout/scripts/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="layout/scripts/jquery.jcarousel.setup.js"></script>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {font-size: 14px}
.style3 {color: #CC9900}
-->
</style>
</head>
<body id="top">
<div class="wrapper col1">
  <div id="topbar">
    <p> Desa Cimareme | Telepon : 6867005 </p>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col2">
  <div id="header">
    <div class="fl_left">
      <h1><img src="images/Header.png" width="345" height="88" /></h1>
    </div>
    <div class="fl_right"> 
      <div align="right"><a href="#"><img src="images/Logo Bandung Barat.png" width="127" height="91" /></a> </div>
    </div>
    <br class="clear" />
  </div>
  <marquee>
  <div align="center" class="style2">- Wilujeng Sumping di Aplikasi Sensus Penduduk Desa Cimareme -</div>
  </marquee>
  </p>
</div>
<!-- ####################################################################################################### -->
<!-- ####################################################################################################### -->
<!-- ####################################################################################################### -->
<div class="wrapper col5">
  <div id="container">
    <p align="left">&nbsp;<?php echo $totalRows_n ?> Penduduk Lahir </p>
    <p align="left">&nbsp;<?php echo $totalRows_k ?> Penduduk Datang </p>
    <p align="left">&nbsp;<?php echo $totalRows_l ?> Penduduk Mati </p>
    <p align="left">&nbsp;<?php echo $totalRows_h ?> Penduduk Pindah </p>
    <table width="39%" border="2"  align="center" cellpadding="3" cellspacing="10">
      <tr>
        <td colspan="2" ><div align="center"> <b>Kelolah Jumlah Data Arsip </b></div></td>
      </tr>
      <tr>
        <td><form name="form1" action="hitung.php" method="post"></td>
      </tr>
      <tr>
        <td width="38%"><div align="left">Jumlah Surat Keluar</div></td>
        <td width="62%"><div align="left">
            <input name="input1" type="text" value="<?php echo $totalRows_n ?>">
        </div></td>
      </tr>
      <tr>
        <td><div align="left">Jumlah Surat Masuk </div></td>
        <td><div align="left">
            <select name="input2" type="text" >
			<option value="<?php echo $totalRows_k ?>">penduduk Pindah [<?php echo $totalRows_k ?>]</option>
			<option value="<?php echo $totalRows_l ?>">Penduduk Lahir [<?php echo $totalRows_l ?>] </option>
			<option value="<?php echo $totalRows_h ?>">Penduduk Datang [<?php echo $totalRows_h ?>]</option>
			</select>
        </div></td>
      </tr>
      <tr>
        <td><div align="left">Oprator</div></td>
        ><td><div align="left">
            <select name="hitung">
              <option value="+">+</option>
            </select>
        </div></td>
      </tr>
      <tr>
        <td colspan="2"><div align="left">
            <input name="Submit" type="submit" class="style3" value="hitung" />
            <input name="Submit2" type="reset" class="style3" value="Reset" />
        </div></td>
      </tr>
      <tr> </tr>
    </table>
    <p align="left">&nbsp;</p>
  </div>
</div>
<div align="center">
  <p>
    <!-- ####################################################################################################### -->
</p>
  <hr width="71%" />
  <p>
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="960" height="125">
      <param name="movie" value="images/bawah.swf" />
      <param name="quality" value="high" />
      <embed src="images/bawah.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="960" height="125"></embed>
</object>
</p>
<hr width="71%" />
<p>&nbsp;</p>
</div>
<!-- ####################################################################################################### -->
<div class="col1">
  <div id="copyright">
    <p class="fl_left style1">Copyright &copy; Desa Cimareme 2015</p>
    <br class="clear" />
  </div>
</div>
</body>
</html>
<?php
mysql_free_result($n);

mysql_free_result($k);

mysql_free_result($l);

mysql_free_result($h);
?>