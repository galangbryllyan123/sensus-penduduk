<?php

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


echo "" . date("l");
echo ", " . date("d - m - Y") . "<br>";


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


	<meta charset="UTF-8" />
			<title>Grafik kolom</title>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
			<link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />
			<script type="text/javascript" src="layout/scripts/jquery.min.js"></script>
			<script type="text/javascript" src="layout/scripts/jquery.jcarousel.pack.js"></script>
			<script type="text/javascript" src="layout/scripts/jquery.easing.1.3.js"></script>
			<script type="text/javascript" src="layout/scripts/jquery.jcarousel.setup.js"></script>
			<script src="js/jquery.min.js" type="text/javascript"></script>
			<script src="js/highcharts.js" type="text/javascript"></script>
			<script type="text/javascript">
<!-- ####################################################################################################### -->					
var chart1; 
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'container',
            type: 'column' <!-- ini tempat model grafik jah-->	
         },   
         title: {
            text: 'Grafik Kolom Sensus Penduduk Desa Cimareme'
         },
         xAxis: {																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																											
            categories:['Keluarga', 'Penduduk', 'Penduduk lahir', 'Penduduk meninggal','Penduduk datang','Penduduk pindah']
         },
         yAxis: {
            title: {
               text: 'Perkembangan'
            }
         },
		 legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
              series:             
            [
            <?php 
        	include('config.php');
           $sql   = "SELECT sensus  FROM grafik_sensus";
            $query = mysql_query( $sql )  or die(mysql_error());
            while( $ret = mysql_fetch_array( $query ) ){
            	$sensus=$ret['sensus'];                     
                 $sql_keluarga   = "SELECT keluarga, penduduk,  Penduduk_lahir, Penduduk_meninggal, Penduduk_pendatang, Penduduk_pindah FROM grafik_sensus WHERE sensus='$sensus'";        
                 $query_keluarga = mysql_query( $sql_keluarga ) or die(mysql_error());
                 while( $data = mysql_fetch_array( $query_keluarga ) ){
                    $keluarga = $data['keluarga'];
					$penduduk = $data['penduduk'];
					$Penduduk_lahir = $data['Penduduk_lahir'];
					$Penduduk_meninggal = $data['Penduduk_meninggal'];
					$Penduduk_pendatang = $data['Penduduk_pendatang'];
					$Penduduk_pindah = $data['Penduduk_pindah'];
 					
                  }             
                  ?>
                  {
                      name: '<?php echo $sensus; ?>',
                      data: [<?php echo $keluarga; ?>, <?php echo $penduduk; ?>, <?php echo $Penduduk_lahir; ?>, <?php echo $Penduduk_meninggal; ?>, <?php echo $Penduduk_pendatang; ?>, <?php echo $Penduduk_pindah; ?>]
					  
					  
					  
                  },			  

                  <?php } ?>
				  
            ]
      });
   });	
   
</script>
<!-- ####################################################################################################### -->		
<style type="text/css">
<!--
.style1 {color: #CCCCCC}
.style2 {font-size: 15px}
.style4 {color: #cccccc}
-->
    </style>
</head>
	<body id="top">
	 <div class="wrapper col1">
  <div id="topbar">
    <p>Desa Cimareme | Telepon : 6867005</p>
	<ul class="style2">
	  <li><a href="kontak.php">Kontak </a></li> <li><a href="<?php echo $logoutAction ?>">Logout</a></li> 
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
      <li><a href="">Grafik</a><span>data</span>
        <ul>
          <li><a href="grafik_kolom.php">Kolom</a></li>
		  <li><a href="grafik_batang.php">Batang</a></li>
		  <li><a href="grafik_garis.php">Garis</a></li>
		  <li><a href="grafik_area.php">Area</a></li>
        </ul>
		</li>
    </ul>
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
	<ul>
      <li><a href="">Laporan</a><span>data</span>
        <ul>
          <li><a href="laporan_PPPT.php">Laporan Perhitungan Pertumbuhan Penduduk Total</a></li>
		  <li><a href="laporan_PPPA.php">Laporan Perhitungan Pertumbuhan Penduduk Alami</a></li>
		  <li><a href="laporan_PPP.php">Laporan Perhitungan Pertumbuhan Penduduk</a></li>
		  <li><a href="laporan_PPRP.php">Laporan Perhitungan Perpindahan Penduduk</a></li>
		  <li><a href="laporan_PKP.php">Laporan Perhitungan Kepadatan Penduduk</a></li>
        </ul>
		</li>
    </ul>
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### --> 
<div class="wrapper col5">
<body bgcolor="black" text="black" onload="waktu()">
<table align=center bgcolor="#ffffff" class="col5" style="border:1px solid black">
<tr><td>
<div id="output">
</div>
</td></tr>
</table>
<br class="clear" />
<div align="center">
</div>
</div>
<!-- ####################################################################################################### --> 
  			<!--awal kode grafik jah-->
				<!-- menu kotak grafik -->
				<div class="wrapper col5">
				<!-- this is for emulating position fixed of the nav -->
				<div class="scroller-inner">
						<!--model tengah grafikn -->
					<div class="content clearfix">						
					<div id='container'></div> <!-- kode memunculkan posisi grafik -->				
				</div>
			</div><!-- /pusher -->
		</div>
		<!-- /container -->
		<script src="js/classie.js"></script>
		<script src="js/mlpushmenu.js"></script>
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
      <h2 class="style4">Pertumbuhan penduduk</h2>
      <ul>
        <li><a href="kelahiran_penduduk.php">Kelahiran penduduk</a></li>
        <li><a href="kematian_penduduk.php">Kematian penduduk</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2 class="style4">Data Master</h2>
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