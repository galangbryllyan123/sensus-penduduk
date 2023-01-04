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
  $insertSQL = sprintf("INSERT INTO penduduk (NIK, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, agama, status_perkawinan, pekerjaan, kewarganegaraan, foto) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['NIK'], "int"),
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['tempat_lahir'], "text"),
                       GetSQLValueString($_POST['tanggal_lahir'], "date"),
                       GetSQLValueString($_POST['jenis_kelamin'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['agama'], "text"),
                       GetSQLValueString($_POST['status_perkawinan'], "text"),
                       GetSQLValueString($_POST['pekerjaan'], "text"),
                       GetSQLValueString($_POST['kewarganegaraan'], "text"),
					   //GetSQLValueString($_POST['foto'], "text"),
					   GetSQLValueString($foto = $_FILES['foto']['name'], "text"));
        
  if (strlen($foto)>0) {
  //skript upload file:
  if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
  
  // posisi folder penampung foto terletak di dalam folder avatar "avatar/"
  move_uploaded_file($_FILES['foto']['tmp_name'], "foto/" . $foto);
  }
        }    
//Skrift Upload Foto Sampai Sini.


					   

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  $insertGoTo = "penduduk.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

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
// 1 detik = 1000
window.setTimeout("waktu()",1000);  
function waktu() {   
var tanggal = new Date();  
setTimeout("waktu()",1000);  
document.getElementById("output").innerHTML =tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds();
 }
</script>


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
<script type="text/JavaScript">
<!--
function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
//-->
</script>
</head>
<body id="top">
<div class="wrapper col1">
  <div id="topbar">
    <p>Desa Cimareme | Telepon : 6867005 | User</p>
	<ul class="style2">
	  <li><a href="kontak.php" class="style3">Kontak </a></li> <li><a href="<?php echo $logoutAction ?>" class="style3">Logout</a></li> 
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
      <li><a href="penduduk.php">Penduduk</a><span>data</span>
        <ul>
          <li><a href="tambahpenduduk.php">Tambah penduduk</a></li>
          <li><a href="penduduk_cetak.php">Cetak data</a></li>
        </ul>
    </ul>
    <br class="clear" />
  </div>
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
    <div id="content">
      <h2>Penduduk</h2>
    </div>
    <form method="post" name="form1" enctype="multipart/form-data" action="<?php echo $editFormAction; ?>">
      <table align="center">
        <tr valign="baseline">
          <td nowrap align="right"><div align="left">NIK</div></td>
          <td><input type="text" name="NIK" value="" size="25" placeholder="Nomor Induk Kependudukan" maxlength="25"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left">Nama</div></td>
          <td><input type="text" name="nama" value="" size="32" placeholder="Nama lengkap" maxlength="40"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left">Tempat lahir</div></td>
          <td><input type="text" name="tempat_lahir" value="" size="16" placeholder="Tempat lahir" maxlength="20"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left">Tanggal lahir</div></td>
          <td><input type="date" name="tanggal_lahir" value="" size="32"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left">Jenis kelamin</div></td>
          <td valign="baseline"><table>
              <tr>
                <td><input type="radio" name="jenis_kelamin" value="Laki - laki" >
                  Laki - laki</td>
              </tr>
              <tr>
                <td><input type="radio" name="jenis_kelamin" value="Perempuan" >
                  Perempuan</td>
              </tr>
          </table></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right" valign="top"><div align="left">Alamat</div></td>
          <td><textarea name="alamat" cols="50" rows="5" placeholder="Alamat tempat tinggal"></textarea></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left">Agama</div></td>
          <td><select name="agama">
              <option value="Islam" <?php if (!(strcmp("Islam", ""))) {echo "SELECTED";} ?>>Islam</option>
              <option value="Katolik" <?php if (!(strcmp("Katolik", ""))) {echo "SELECTED";} ?>>Katolik</option>
              <option value="Protestan" <?php if (!(strcmp("Protestan", ""))) {echo "SELECTED";} ?>>Protestan</option>
              <option value="Hindu" <?php if (!(strcmp("Hindu", ""))) {echo "SELECTED";} ?>>Hindu</option>
              <option value="Budha" <?php if (!(strcmp("Budha", ""))) {echo "SELECTED";} ?>>Budha</option>
              <option value="Konghucu" <?php if (!(strcmp("Konghucu", ""))) {echo "SELECTED";} ?>>Konghucu</option>
            </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left">Status perkawinan</div></td>
          <td valign="baseline"><table>
              <tr>
                <td><input type="radio" name="status_perkawinan" value="Kawin" >
                  Kawin</td>
              </tr>
              <tr>
                <td><input type="radio" name="status_perkawinan" value="Belum kawin" >
                  Belum kawin</td>
              </tr>
          </table></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left">Pekerjaan</div></td>
          <td><input type="text" name="pekerjaan" value="" size="32" placeholder="Pekerjaan" maxlength="40"></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left">Kewarganegaraan</div></td>
          <td><select name="kewarganegaraan">
              <option value="WNI" <?php if (!(strcmp("WNI", ""))) {echo "SELECTED";} ?>>WNI</option>
              <option value="WNA" <?php if (!(strcmp("WNA", ""))) {echo "SELECTED";} ?>>WNA</option>
            </select></td>
        </tr>
		<tr valign="baseline">
          <td nowrap align="right"><div align="left">Foto ( ukuran maksimal = 1 MB )</div></td>
          <td><input type="file" name="foto" required></td>
        </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left"></div></td>
          <td><input name="Submit" type="submit" class="col1" onclick="MM_popupMsg('Data penduduk ditambahkan')" value="Save">
          <input name="Reset" type="reset" class="col1" value="Reset" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1">
      <br class="clear" />
  </form>
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
		<li><a href="PPP.php">Penduduk pertumbuhan penduduk</a></li>
		<li><a href="PPRP.php">Penduduk perpindahan penduduk</a></li>
		<li><a href="PKP.php">Penduduk kepadatan penduduk</a></li>
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
      <h2 class="style4 style3">Pertumbuhan penduduk</h2>
      <ul>
        <li><a href="kelahiran_penduduk.php">Kelahiran penduduk</a></li>
        <li><a href="kematian_penduduk.php">Kematian penduduk</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2 class="style4 style3">Data Master</h2>
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