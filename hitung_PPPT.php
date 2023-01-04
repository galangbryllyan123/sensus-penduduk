<?php require_once('Connections/koneksi.php');

//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}

if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "eror_user.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>


<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO laporan_pppt (nomor_laporan, tanggal, jumlah_penduduk, jumlah_ppt, keterangan) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nomor_laporan'], "int"),
                       GetSQLValueString($_POST['tanggal'], "date"),
                       GetSQLValueString($_POST['jumlah_penduduk'], "int"),
                       GetSQLValueString($_POST['jumlah_ppt'], "int"),
                       GetSQLValueString($_POST['keterangan'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  $insertGoTo = "laporan_PPPT.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>


<?php
mysql_select_db($database_koneksi, $koneksi);
$query_pp = "SELECT * FROM penduduk";
$pp = mysql_query($query_pp, $koneksi) or die(mysql_error());
$row_pp = mysql_fetch_assoc($pp);
$totalRows_pp = mysql_num_rows($pp);
?>


<?php
mysql_select_db($database_koneksi, $koneksi);
$query_p = "SELECT * FROM penduduk";
$p = mysql_query($query_p, $koneksi) or die(mysql_error());
$row_p = mysql_fetch_assoc($p);
$totalRows_p = mysql_num_rows($p);
$data['TanggalCash']=date("Y-m-d");
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


<script type="text/javascript">
<!--
// 1 detik = 1000
window.setTimeout("waktu()",1000);  
function waktu() {   
var tanggal = new Date();  
setTimeout("waktu()",1000);  
document.getElementById("output").innerHTML =tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds();
 }

function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
//-->
</script>


<title>PPPT</title>
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
.style5 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style6 {color: #cccccc}
.style7 {font-size: 15px}
-->
</style>
</head>
<body id="top">
<div class="wrapper col1">
  <div id="topbar">
    <p> Desa Cimareme | Telepon : 6867005 </p>
	<ul class="style6 style7">
	  <li><a href="kontak.php" class="style3">Kontak</a></li> <li><a href="<?php echo $logoutAction ?>" class="style3">Logout</a></li> 
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
      <li><a href="home.php">Desa Cimareme</a><span>Profil Desa</span>
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
      <li><a href="">Perhitungan Penduduk</a><span>data</span>
        <ul>
          <li><a href="PPPT.php">Perhitungan pertumbuhan penduduk total</a></li>
		  <li><a href="PPPA.php">Perhitungan pertumbuhan penduduk alami</a></li>
		  <li><a href="PPP.php">Perhitungan pertumbuhan penduduk</a></li>
		  <li><a href="PPRP.php">Perhitungan perpindahan penduduk</a></li>
		  <li><a href="PKP.php">Perhitungan kepadatan penduduk</a></li>
        </ul>
	  </li>
    </ul>
    <br class="clear" />
  </div>
<!-- ####################################################################################################### -->
<div class="wrapper col5">
<body bgcolor="black" text="black" onload="waktu()">
<table align=center bgcolor="#CCCCCC" class="col5" style="border:1px solid black">
<tr><td>
<div id="output">
</div>
</td></tr>
</table>
  <div id="container">
    <div align="center">
    </div>
    <table width="39%" border="2"  align="center" cellpadding="3" cellspacing="10">
      <tr>
        <td colspan="2" ><div align="center" class="style5">
            <h1>Perhitungan Pertumbuhan Penduduk Total</h1>
        </div></td>
      </tr>
      <tr>
        <td width="21%"><div align="left">Hasil</div></td>
        <td width="79%"><div align="left">
       
<input name="input1" type="text" class="col7" value="<?php
 	 $pertama = $_POST['input1'] ;
	 $kedua = $_POST['input2'] ;
 	 $operator = $_POST['hitung'] ;
  	
 	if($operator=='*')
 	{
  	$hasil = $pertama * $kedua ;
  	echo "$hasil";
 	}

  	elseif($operator=='/')
 	{
  		$hasil = $pertama / $kedua ;
  		echo "$hasil";
 	}
 	elseif($operator=='+')
 	{
 	 $hasil = $pertama + $kedua ;
  		echo "$hasil"; 
 	}
 	elseif($operator=='-')
 	{
 	 $hasil = $pertama - $kedua ;
  	echo "$hasil";
 	}
 	
	?>" readonly='readonly' size="3">
		</div></td>
      </tr>
    </table>
	<p align="left">&nbsp;</p>
    <h1 align="center">Laporan Perhitungan Pertumbuhan Penduduk Total</h1>
    <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
      <table align="center">
        <tr valign="baseline">
          <td width="30%" align="right" nowrap><div align="left">Nomor laporan</div></td>
          <td width="70%"><input type="text" name="nomor_laporan" value="" placeholder="Nomor laporan" maxlength="15" size="25"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left">Tanggal</div></td>
          <td><input name="tanggal" type="date" class="col7" value="<?php echo $data['TanggalCash']; ?>" size="32" readonly='readonly'></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left">Penduduk</div></td>
          <td><input name="jumlah_penduduk" type="text" class="col7" value="<?php echo $totalRows_p ?>" size="3" readonly='readonly'></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left">Perhitungan Pertumbuhan Penduduk Total </div></td>
          <td><input name="jumlah_ppt" type="text" class="col7" value="<?php
 	 $pertama = $_POST['input1'] ;
	 $kedua = $_POST['input2'] ;
 	 $operator = $_POST['hitung'] ;
  	
 	if($operator=='*')
 	{
  	$hasil = $pertama * $kedua ;
  	echo "$hasil";
 	}

  	elseif($operator=='/')
 	{
  		$hasil = $pertama / $kedua ;
  		echo "$hasil";
 	}
 	elseif($operator=='+')
 	{
 	 $hasil = $pertama + $kedua ;
  		echo "$hasil"; 
 	}
 	elseif($operator=='-')
 	{
 	 $hasil = $pertama - $kedua ;
  	echo "$hasil";
 	}
 	
	?>" readonly='readonly' size="3"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right" valign="top"><div align="left">Keterangan</div></td>
          <td><textarea name="keterangan" cols="50" rows="5" placeholder="Keterangan laporan"></textarea></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left"></div></td>
          <td><input name="Submit" type="submit" class="col1" onclick="MM_popupMsg('Laporan ditambahkan')" value="Save">
          <input name="Submit2" type="reset" class="col1" value="Reset" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1">
    </form>
    <p>&nbsp;</p>
  </div>
</div>
<!-- ####################################################################################################### -->
<div align="center">
  <p>
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
<div class="wrapper col6">
  <div id="footer">
    <div class="footbox">
      <h2><a href="">Perhitungan penduduk</a></h2>
      <ul>
        <li><a href="PPPT.php">Perhitungan pertumbuhan penduduk total</a></li>
        <li><a href="PPPA.php">Penduduk pertumbuhan penduduk alami</a></li>
		<li><a href="">Penduduk pertumbuhan penduduk</a></li>
		<li><a href="">Penduduk perpindahan penduduk</a></li>
		<li><a href="">Penduduk kepadatan penduduk</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2><a href="">Perpindahan penduduk </a></h2>
      <ul>
        <li><a href="penduduk_datang.php">Penduduk datang</a></li>
        <li><a href="penduduk_pindah.php">Penduduk pindah</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2 class="style4 style6 style7">Pertumbuhan penduduk</h2>
      <ul>
        <li><a href="kelahiran_penduduk.php">Kelahiran penduduk</a></li>
        <li><a href="kematian_penduduk.php">Kematian penduduk</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2 class="style4 style7 style6">Data Master</h2>
      <ul>
        <li><a href="penduduk.php">Penduduk</a></li>
        <li><a href="keluarga.php">Keluarga</a></li>
	  </ul>
    </div>
    <div class="footbox">
	<h2>&nbsp;</h2>
	<h2>&nbsp;</h2>
      <h2><a href="home.php">Desa Cimareme</a></h2>
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
mysql_free_result($pp);

mysql_free_result($p);
?>