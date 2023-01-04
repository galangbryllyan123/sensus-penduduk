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

mysql_select_db($database_koneksi, $koneksi);
$query_n = "SELECT * FROM kelahiranpenduduk";
$n = mysql_query($query_n, $koneksi) or die(mysql_error());
$row_n = mysql_fetch_assoc($n);
$totalRows_n = mysql_num_rows($n);
?>


<?php
$nomor = $_GET['id'];

$query_r = "SELECT * FROM kelahiranpenduduk WHERE nomor = '$nomor'";
$r = mysql_query($query_r, $koneksi) or die(mysql_error());
$row = mysql_fetch_row($r);
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


<title>Edit kelahiran penduduk</title>
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
      <li><a href="kelahiran_penduduk.php">Kelahiran Penduduk</a><span>data</span>
        <ul>
          <li><a href="tambahkelahiran_penduduk.php">Tambah kelahiran penduduk</a></li>
          <li><a href="kelahiranpenduduk_cetak.php">Cetak data</a></li>
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
      <h2>Edit Kelahiran Penduduk </h2>
    </div>
	  <p>&nbsp;</p>
	  <p>&nbsp;</p>
	<form action=update_kelahiranpenduduk.php method="POST" name="formedit" id="formedit">
     <input name="nomor" type="hidden" value="<?php echo $row[0];?>"> 
      <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
        <table align="center">
          <tr valign="baseline">
            <td width="22%" align="right" nowrap><div align="left">NSKL</div></td>
            <td width="78%"><div align="left"><?php echo $row[1];?></div></td>
          </tr>
		    <tr valign="baseline">
            <td nowrap align="right"><div align="left">
			<h1>Data Keluarga</h1>
            <p>NKK</p>
          </div></td>
          <td><p>&nbsp;
            </p>
            <p><input name="NKK" type="text" class="col7" id='NKK' value="<?php echo $row[2]; ?>" size="25" readonly='readonly' maxlength="25" placeholder="NKK" /></p></td>
		    </tr>
        <tr valign="baseline">
            <td nowrap align="right"><div align="left" class="style4">Alamat</div></td>
            <td><textarea name="alamat" cols="50" rows="5" class="col7" id='alamat' readonly='readonly' placeholder="Alamat tempat tinggal"><?php echo $row[3]; ?></textarea></td>
	  <tr valign="baseline">
          <td nowrap align="right"><div align="left">
            <h1>Data Penduduk Lahir</h1>
            <p>Nama</p>
          </div></td>
          <td><p>&nbsp;
            </p>
            <p><input name="nama" type="text" id="nama" value="<?php echo $row[4];?>" size="32" maxlength="40"></td>
          </tr>
		  <tr valign="baseline">
            <td nowrap align="right"><div align="left">Tempat lahir</div></td>
            <td><input name="tempat_lahir" type="text" id="tempat_lahir" value="<?php echo $row[5];?>" size="32" maxlength="20"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right"><div align="left">Tanggal lahir</div></td>
            <td><input name="tanggal_lahir" type="date" id="tanggal_lahir" value="<?php echo $row[6];?>" size="32"></td>
          </tr>
		  <tr valign="baseline">
            <td nowrap align="right"><div align="left">Waktu lahir</div></td>
            <td><input name="waktu_lahir" type="time" id="waktu_lahir" value="<?php echo $row[7];?>" size="32"></td>
          </tr>
		<tr valign="baseline">
        <td nowrap align="right"><div align="left">Jenis kelamin</div></td>
        <td valign="baseline"><div align="left">
          <table>
            <tr>
              <td><input type="radio" name="jenis_kelamin" value="Laki - laki" <?php if (!(strcmp($row[8],"Laki - laki"))) {echo "CHECKED";} ?>>
                Laki - laki</td>
                </tr>
            <tr>
              <td><input type="radio" name="jenis_kelamin" value="Perempuan" <?php if (!(strcmp($row[8],"Perempuan"))) {echo "CHECKED";} ?>>
                Perempuan</td>
                </tr>
          </table>
        </div></td>
      </tr>
        <tr valign="baseline">
          <td nowrap align="right"><div align="left">Agama</div></td>
          <td><select name="agama">
              <option value="Islam" <?php if (!(strcmp("Islam", $row[9]))) {echo "SELECTED";} ?>>Islam</option>
              <option value="Katolik" <?php if (!(strcmp("Katolik", $row[9]))) {echo "SELECTED";} ?>>Katolik</option>
              <option value="Protestan" <?php if (!(strcmp("Protestan", $row[9]))) {echo "SELECTED";} ?>>Protestan</option>
              <option value="Hindu" <?php if (!(strcmp("Hindu", $row[9]))) {echo "SELECTED";} ?>>Hindu</option>
              <option value="Budha" <?php if (!(strcmp("Budha", $row[9]))) {echo "SELECTED";} ?>>Budha</option>
              <option value="Konghucu" <?php if (!(strcmp("Konghucu", $row[9]))) {echo "SELECTED";} ?>>Konghucu</option>
            </select></td>
        </div></td>
      </tr>
<tr valign="baseline">
	<!-- ajax programming -->	  
        <?php  
mysql_connect("localhost","root","");  
mysql_select_db("sensuspenduduk");  
$result = mysql_query("select * from keluarga");  
$jsArray = "var yosh = new Array();\n";  
echo 'Pilih Nomor Kartu Keluarga ( NKK ) <select name="nomor" onchange="changeValue(this.value)">'; 
echo '<option>Pilih</option>';  
while ($row = mysql_fetch_array($result)) {  
    echo '<option value="' . $row['nomor'] . '">' . $row['NKK'] . '</option>';  
    $jsArray .= "yosh['" . $row['nomor'] . "'] = {NKK:'" . addslashes($row['NKK']) . "',
	alamat:'".addslashes($row['alamat'])."'};\n";  
}
echo '</select>';  
?> 
	<!-- ajax programming (sesuaikan name sama id nya-->
		</tr>
          <tr valign="baseline">
            <td nowrap align="right"><div align="left"></div></td>
            <td><input type="submit" class="col1" onclick="MM_popupMsg('Data kelahiran penduduk dirubah')" value="Save">
            <input name="Reset" type="reset" class="col1" value="Reset" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="form1">
        <input type="hidden" name="NIK" value="<?php echo $row_n['NSKL']; ?>">
    </form>
  </div>
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
	<!-- ajax programming II-->	  
<script type="text/javascript">  
<?php echo $jsArray; ?>
function changeValue(id){
document.getElementById('NKK').value = yosh[id].NKK;
document.getElementById('alamat').value = yosh[id].alamat;
};
</script>
</body>
</html>
<?php
mysql_free_result($n);
?>