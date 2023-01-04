<?php require_once('Connections/koneksi.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO penyewa (kode_penyewa, nama, alamat, telepon, jenis_kelamin, email, username, password) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['kode_penyewa'], "text"),
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['telepon'], "text"),
                       GetSQLValueString($_POST['jenis_kelamin'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  $insertGoTo = "login2.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body {
	background-image: url(images/GreEn
%20(14).jpg);
	background-image: url(images/background-polos-utk-jcael.jpg);
}
</style>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
</head>

<body>

<p>  <tr>
    <center>
      <td height="94" colspan="4"><img src="images/header_back.png" width="1000" height="200" alt="title" />
     
    <p><center><h1> Formulir Penyewa</h1></center></p>
        <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
          <table align="center">
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Nama Depan:</td>
           <td><span id="sprytextfield6">
             <input type="text" name="kode_penyewa" value="" size="25" placeholder="Masukan Nama Depan" />
             <span class="textfieldRequiredMsg">Isi Nama Depan Terlebih Dahulu!</span></span></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Nama Belakang:</td>
              <td><span id="sprytextfield3">
                <label for="nama"></label>
                <input type="text" name="nama" id="nama" size="32" placeholder="Masukan Nama Belakang"/>
              <span class="textfieldRequiredMsg">Isi Nama Belakang Terlebih Dahulu!.</span></span></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Alamat:</td>
              <td><span id="sprytextfield4">
                <label for="alamat"></label>
                <input type="text" name="alamat" id="alamat" size="32" placeholder="Masukan Alamat"/>
              <span class="textfieldRequiredMsg">Isi Alamat Terlebih Dahulu!.</span></span></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Telepon:</td>
              <td><span id="sprytextfield5">
              <label for="telepon"></label>
              <input type="text" name="telepon" id="telepon" placeholder="Masukan No Telepon"/>
              <span class="textfieldRequiredMsg">Isi No Telepon Anda Terlebih Dahulu!.</span><span class="textfieldInvalidFormatMsg">Format No telepon Salah.</span><span class="textfieldMinCharsMsg">No Telepon Anda Terlalu Pendek.</span><span class="textfieldMaxCharsMsg">No Telepon Anda Terlalu Panjang.</span></span></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Jenis Kelamin:</td>
              <td valign="baseline"><table>
                <tr>
                 
                </tr>
                <tr>
 
                </tr>
              </table>
                <span id="spryradio1">
                <label>
                  <input type="radio" name="jenis_kelamin" value="pria" id="jenis_kelamin_0" />
                  pria</label>
                <br />
                <label>
                  <input type="radio" name="jenis_kelamin" value="wanita" id="jenis_kelamin_1" />
                  wanita</label>
                <br />
              <span class="radioRequiredMsg">Pilih Jenis Kelamin! .</span></span></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Email:</td>
          <td><span id="sprytextfield2">
          <label for="email"></label>
          <input type="text" name="email" id="email" size="32" placeholder="Masukan Email"/>
          <span class="textfieldRequiredMsg">Isi Email Anda Terlebih Dahulu!.</span><span class="textfieldInvalidFormatMsg">Format Email Anda Belum Benar!.</span></span></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Username:</td>
              <td><span id="sprytextfield7">
                <input type="text" name="username" value="" size="32" placeholder="Masukan Username"/>
              <span class="textfieldRequiredMsg">Isi Username Terlebih Dahulu!</span></span></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Password:</td>
              <td><span id="sprytextfield8">
                <input type="password" name="password" value="" size="32" placeholder="Masukan Password"/>
              <span class="textfieldRequiredMsg">Isi Password Terlebih Dahulu!</span></span></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">&nbsp;</td>
              <td><input type="submit" value="Simpan" />
              <input name="Reset" type="reset" value="Batal" /></td>
            </tr>
          </table>
          <input type="hidden" name="MM_insert" value="form1" />
        </form>
      <p>&nbsp;</p></td></center>
  </tr></p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
<p>&nbsp;</p>
  <p>            
  <tr>
   <td><h3><center>Copyright &copy; 2015. ZANGKAR Adventure Equipment</center></h3></td>
</tr></p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "integer", {minChars:11, maxChars:12});
var spryradio1 = new Spry.Widget.ValidationRadio("spryradio1");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
</script>
</body>
</html>