<?php require_once('../Connections/koneksi.php'); ?>
<?php
mysql_select_db($database_koneksi, $koneksi);
$query_n = "SELECT * FROM garafik_sensus ORDER BY sensus ASC";
$n = mysql_query($query_n, $koneksi) or die(mysql_error());
$row_n = mysql_fetch_assoc($n);
$totalRows_n = mysql_num_rows($n);
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
<title>Tambah penduduk</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />
<script type="text/javascript" src="layout/scripts/jquery.min.js"></script>
<script type="text/javascript" src="layout/scripts/jquery.jcarousel.pack.js"></script>
<script type="text/javascript" src="layout/scripts/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="layout/scripts/jquery.jcarousel.setup.js"></script>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {font-size: 15px}
.style3 {color: #CCCCCC}
-->
</style>
</head>
<body id="top">
<div class="wrapper col1">
  <div id="topbar">
    <p> Desa Cimareme | Telepon : 6867005 </p>
    <ul class="style2">
	  <li><a href="kontak.php" class="style3 style2">Kontak </a>
	</ul>
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
<div class="wrapper col3">
  <div id="topnav">
    <ul>
      <li><a href="index.php">Desa Cimareme</a><span>Profil Desa</span>
        <ul>
          <li><a href="sejarah.php">Sejarah singkat</a></li>
          <li><a href="visimisi.php">Visi & Misi</a></li>
          <li><a href="struktur.php">Struktur Organisasi</a></li>
		  <li><a href="geografis.php">Wilayah Geografis</a></li>
		  <li><a href="perangkatdesa.php">Perangkat Desa</a></li>
        </ul>
      </li>
	  <li><a href="">Data Master</a><span>data</span>
        <ul>
          <li><a href="penduduk.php">Penduduk</a></li>
          <li><a href="keluarga.php">Keluarga</a></li>
        </ul>
      </li>
	  <li><a href="">Pertumbuhan penduduk</a><span>data</span>
        <ul>
          <li><a href="kelahiran_penduduk.php">Kelahiran penduduk</a></li>
          <li><a href="kematian_penduduk.php">Kematian penduduk</a></li>
        </ul>
      </li>
	  <li><a href="">Perpindahan penduduk</a><span>data</span>
        <ul>
          <li><a href="penduduk_datang.php">Penduduk datang</a></li>
          <li><a href="penduduk_pindah.php">Penduduk pindah</a></li>
        </ul>
      </li>
	  <li><a href="grafik_kolom.php">Grafik</a></li>
    </ul>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col4">
  <div id="featured_slide">
    <div id="featured_content">
      <ul>
        <li><a href="#"><img src="images/Kantor Kepala Desa Cimareme.jpg" alt="" /></a></li>
        <li><a href="#"><img src="images/Balai Desa Cimareme sekarang.jpg" alt="" /></a></li>
        <li><a href="#"><img src="images/Balai Desa Cimareme tempo dulu.jpg" alt="" /></a></li>
        <li><a href="#"><img src="images/Perangkat Desa.jpg" alt="" /></a></li>
        <li><a href="#"><img src="images/Warga Desa.jpg" alt="" /></a></li>
        <li><a href="#"><img src="images/Ibu - ibu.jpg" alt="" /></a></li>
        <li><a href="#"><img src="images/Ibu - ibu 2.jpg" alt="" /></a></li>
		<li><a href="#"><img src="images/Anak - anak.jpg" alt="" /></a></li>
        <li><a href="#"><img src="images/Rapat.jpg" alt="" /></a></li>
        <li><a href="#"><img src="images/Desa.jpg" alt="" /></a></li>
      </ul>
    </div>
    <a href="javascript:void(0);" id="featured-item-prev"><img src="layout/images/prev.png" alt="" /></a> <a href="javascript:void(0);" id="featured-item-next"><img src="layout/images/next.png" alt="" /></a> </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="topnav">
    <ul>
      <li><a href="penduduk.php">Penduduk</a><span>data</span>
        <ul>
          <li><a href="tambahpenduduk.php">Tambah penduduk</a></li>
          <li><a href="">Cetak data</a></li>
        </ul>
    </ul>
    <br class="clear" />
  </div>
</div>
<div class="wrapper col5">
  <div id="container">
    <div id="content">
      <h2>Penduduk</h2>
    </div>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	
    
  
    <table border="1">
      <tr>
        <td>sensus</td>
        <td>senin</td>
        <td>selasa</td>
        <td>rabu</td>
        <td>kamis</td>
        <td>jumat</td>
        <td>sabtu</td>
		<td>Ubah</td>
      </tr>
      <?php do { ?>
        <tr>
          <td><?php echo $row_n['sensus']; ?></td>
          <td><?php echo $row_n['senin']; ?></td>
          <td><?php echo $row_n['selasa']; ?></td>
          <td><?php echo $row_n['rabu']; ?></td>
          <td><?php echo $row_n['kamis']; ?></td>
          <td><?php echo $row_n['jumat']; ?></td>
          <td><?php echo $row_n['sabtu']; ?></td>
		  <td width="5%"><div align="center"><a href="editgrafik.php?id=<?php echo $row_n['nomor']; ?>">Edit <img src="images/edit2.png" width="16" height="26" border="0"></a></div></td>
        </tr>
         <?php } while ($row_n = mysql_fetch_assoc($n)); ?>
    </table>
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
<div class="wrapper col6">
  <div id="footer">
<div class="footbox">
      <h2><a href="">Perpindahan penduduk </a></h2>
      <ul>
        <li><a href="penduduk_datang.php">Penduduk datang</a></li>
        <li><a href="penduduk_pindah.php">Penduduk pindah</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2 class="style3">Pertumbuhan penduduk</h2>
      <ul>
        <li><a href="kelahiran_penduduk.php">Kelahiran penduduk</a></li>
        <li><a href="kematian_penduduk.php">Kematian penduduk</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2 class="style3">Data Master</h2>
      <ul>
        <li><a href="penduduk.php">Penduduk</a></li>
        <li><a href="keluarga.php">Keluarga</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2><a href="index.php">Desa Cimareme</a></h2>
      <ul>
        <li><a href="sejarah.php">Sejarah singkat</a></li>
        <li><a href="visimisi.php">Visi dan Misi</a></li>
        <li><a href="struktur.php">Struktur Organisasi</a></li>
        <li><a href="geografis.php">Wilayah Geografis</a></li>
		<li><a href="perangkatdesa.php">Perangkat Desa</a></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
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
?>