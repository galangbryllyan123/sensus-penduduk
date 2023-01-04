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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "home.php";
  $MM_redirectLoginFailed = "gagal_user.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_koneksi, $koneksi);
  
  $LoginRS__query=sprintf("SELECT username, password FROM penyewa WHERE username=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $koneksi) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
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
</head>

<body>
<p>  <tr>
    <center>
      <td height="94" colspan="4"><img src="images/header_back.png" width="1000" height="200" alt="title" /></td></center>
  </tr></p>
  <center><table width="500" height="200" border="0" bgcolor="#009933">
    <tr>        <h2><center>Login User</center></h2>
 <form ACTION="<?php echo $loginFormAction; ?>" id="login" name="login" method="POST" >
<tr>
<td width="200">Username </td>
<td width="400">:  
  <input type="text" name="username" size="30"></td>
</tr>
<tr>
<td>Password</td>
<td>: <input type="password" class="input" size="30" name="password" ></td>
</tr>
<td></td>
<td><p>
 <input type="submit" name="Login" value="Login"></a>
  <input type="reset" name="clear" value="clear">
</p>
  <p><a href="penyewaan.php">Daftar</a> </p></td>
</tr>
	</form>
</table>
		
	
      </div></td>
    </tr>
  </table></center>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
<p>&nbsp;</p>
  <p>            
  <tr>
   <td><h3><center>Copyright &copy; 2015. ZANGKAR Adventure Equipment</center></h3></td>
</tr></p>
</body>
</html>