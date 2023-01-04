<?php require_once('Connections/koneksi.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO nilai_arsipk (  tgl_surat,  perihal, nama_surat,  kerahasiaan, fupload, bobot, pengolah, id_surat   ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                      
					   
                       GetSQLValueString($_POST['tgl_surat'], "text"),
                       GetSQLValueString($_POST['perihal'], "text"),
                       GetSQLValueString($_POST['nama_surat'], "text"),
                       GetSQLValueString($_POST['kerahasiaan'], "text"),
                       GetSQLValueString($_POST['fupload'], "text"),
					    GetSQLValueString($_POST['bobot'], "text"),
					   GetSQLValueString($_POST['pengolah'], "text"),
                       GetSQLValueString($_POST['id_surat'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}

$maxRows_n = 10;
$pageNum_n = 0;
if (isset($_GET['pageNum_n'])) {
  $pageNum_n = $_GET['pageNum_n'];
}
$startRow_n = $pageNum_n * $maxRows_n;

mysql_select_db($database_koneksi, $koneksi);
$query_n = "SELECT * FROM nilai_arsipk";
$query_limit_n = sprintf("%s LIMIT %d, %d", $query_n, $startRow_n, $maxRows_n);
$n = mysql_query($query_limit_n, $koneksi) or die(mysql_error());
$row_n = mysql_fetch_assoc($n);

if (isset($_GET['totalRows_n'])) {
  $totalRows_n = $_GET['totalRows_n'];
} else {
  $all_n = mysql_query($query_n);
  $totalRows_n = mysql_num_rows($all_n);
}
$totalPages_n = ceil($totalRows_n/$maxRows_n)-1;

ini_set('display_errors', 1); ini_set('error_reporting', E_ERROR);
$cari = $_GET['cari'];
$currentPage = $_SERVER["PHP_SELF"];


$maxRows_n = 100000000;
$pageNum_n = 0;
if (isset($_GET['pageNum_n'])) {
  $pageNum_n = $_GET['pageNum_n'];
}
$startRow_n = $pageNum_n * $maxRows_n;

mysql_select_db($database_koneksi, $koneksi);
$query_n = "SELECT nomor, id_surat, tgl_surat, pengolah, perihal, nama_surat, bobot, kerahasiaan FROM nilai_arsipk";

if ($cari != "")
	$query_n .= " WHERE bobot LIKE '%$cari%'";

$query_limit_n = sprintf("%s LIMIT %d, %d", $query_n, $startRow_n, $maxRows_n);
$n = mysql_query($query_limit_n, $koneksi) or die(mysql_error());
$row_n = mysql_fetch_assoc($n);



if (isset($_GET['totalRows_n'])) {
} else {

  $all_n = mysql_query($query_n);
  $totalRows_n = mysql_num_rows($all_n);
}

$totalPages_n = ceil($totalRows_n/$maxRows_n)-1;


$queryString_n = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_n") == false && 
        stristr($param, "totalRows_n") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_n = "&" . htmlentities(implode("&", $newParams));
  }
}
$totalPages_n = ceil($totalRows_n/$maxRows_n)-1;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<html><head>

 <title>PT. Pos Indonesia</title>
  <meta name="description" content="free website template" />
  <meta name="keywords" content="enter your keywords here" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/image_slide.js"></script>
  
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link href="css/style1.css" rel="stylesheet" type="text/css">
  <link href="css/cadangan/bootstrap.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-color: #666666;
	background-image: url(images/);
}
-->
</style>
<link href="css/responsive.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {color: #FF9900}
.style2 {color: #999999}
.style3 {color: #00CC99}
.style4 {color: #000000}
.style5 {color: #666666}
-->
</style>
</head>

	
	
<body>
<div id="main">
    <div id="header">
	  <div id="banner">
	    <!--close welcome-->
<div id="welcome_slogan">
	      <h1 align="left"><img src="images/aaaaa.gif" width="413" height="599"></h1>
	    </div><!--close welcome_slogan-->
	  </div><!--close banner-->
    </div><!--close header-->

	<div id="menubar">
      <ul id="menu">
        <li><a href="home.php">Home</a></li>
		<ul id="menu">
		<li><a href="pos.php">Pos Indonesia</a></li>
        <li class="current"  ><a href="Dokumen.php">Dokumen</a></li>
		<li ><a href="laporan1.php">Laporan</a></li>
		<li><a href="pengguna.php">Pengguna </a></li>
        <li><a href="kontak1.php">Contact Us</a></li>
		
	
		<ul id="menu">
		<li><a ></a></li>
        <li><a> </a></li>
		<li><a ></a></li>
        <li ><a href="index.php">Log Out</a></li>
		<li class="current"><a href="suratmasuk.php">Surat Masuk</a></li>
		
        <li><a href="suratkeluar.php">Surat Keluar</a></li>
		
      </ul>
    </div><!--close menubar-->
	
	
	<div id="site_content">

	  </th>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <th scope="row">&nbsp;</th>
          <td>&nbsp;</td>
        </tr>
      </table>
	  <!--close sidebar_container-->
<div align="center">
<marquee>
      <br >
      <H2 class="style2">Surat Masuk</H2> 
  </marquee>
  <table width="914" height="268" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="54" colspan="2" bgcolor="#000066" class="style5">
	  <ul id="menu">
		<li><a >Jumlah Data <?php echo $totalRows_n ?></a></li>
		<li><a href="T_masuk.php">+ Tambah Data</a></li>
		<li><a href="cetak.php">Cetak Data</a></li>
		<li> <form>
				  <div align="right"><img src="images/cari1.png" width="45" height="16" border="0">
				    <input name=cari type=text placeholder="Pencarian Kategori">
				    <input name="submit" type="submit" class="btn btn-success" value="Cari" >
	          </div>
		</form>
		  </li>
		</ul>      </td>
    </tr>
    
    <tr>
      <td colspan="2" class="style5"></td>
    </tr>
    <tr>
      
    <a href="isidata_arsipk.php"></a>
	  <td height="65" colspan="2" class="style3"><table class="table table-bordered" width="101%" border="1" align="left" cellpadding=1 cellspacing=1>
        <tr bgcolor=#cccccc height=20>
          <td width="17%" bgcolor="#000099"><div align="center" class="style1">Nomor Office </div></td>
          <td width="15%" bgcolor="#000099"><div align="center" class="style1">Tanggal</div></td>
          <td width="20%" bgcolor="#000099"><div align="center" class="style1">Keterangan</div></td>
          <td width="25%" bgcolor="#000099"><div align="center" class="style1">Kategori </div></td>
          <td width="23%" bgcolor="#000099"><div align="center" class="style1">Aksi</div></td>
          </tr>
        <tr bgcolor=#cccccc>
          <td colspan=12 height=1 bgcolor=#00000></td>
        </tr>
       
      </table>      </td>
    </tr>
    <tr>
      <td height="149" colspan="2" class="style3">
	  <div style=&rsquo;overflow-y:scroll;overflow-x:scroll;height:340px;padding:=100px;scroll-color:hidden;&rsquo;>
	  <table class="table table-bordered" width="101%" border="1" align="left" cellpadding=1 cellspacing=1>
        <?php do { ?>
        <tr>
          <td width="18%"><div align="center" class="style4"><?php echo $row_n['pengolah']; ?></div></td>
          <td width="15%"><div align="center" class="style4"><?php echo $row_n['tgl_surat']; ?></div></td>
          <td width="20%"><div align="center" class="style4"><?php echo $row_n['kerahasiaan']; ?> </div></td>
          <td width="26%"><div align="center" class="style4"><?php echo $row_n['bobot']; ?> </div></td>
          <td width="5%"><div align="center"><a href="detail_M.php?id=<?php echo $row_n['nomor']; ?>">Dtl<img src="images/detail2.png" width="16" height="26" border="0"></a></div></td>
          <td width="6%"><div align="center"><a href="disposisi.php?id=<?php echo $row_n['nomor']; ?>">Disp<img src="images/dis2.png" width="16" height="26" border="0"></a></div></td>
          <td width="5%"><div align="center"><a href="EDIT.php?id=<?php echo $row_n['nomor']; ?>">Edt <img src="images/edit2.png" width="16" height="26" border="0"></a></div></td>
          <td width="5%"><div align="center"><a href="hapus_suratmasuk.php?id=<?php echo $row_n['nomor']; ?>">Del<img src="images/dell2.png" width="16" height="16" border="0"></a></div></td>
        </tr>
        <?php } while ($row_n = mysql_fetch_assoc($n)); ?>
      </table></td>
    </tr>
  </table>
</div>
<p>&nbsp;</p>
</td>
</tr>
<tr>
    <td height="91"><div align="center">
      <p><span class="style2">
        <marquee>
      <br>
      <span class="style1">Copyright &copy; Pos Indonesia 2015 </span>
        </marquee>
        </span><br>
      </p>
      </div></td>
</tr>
</table>
</body>
</html>
<?php
mysql_free_result($n);
?>
