<?php ob_start(); ?>
<?php
// koneksi
session_start();
$hostname_koneksi = "localhost";
$database_koneksi = "penyewaan";
$username_koneksi = "root";
$password_koneksi = "";
$koneksi = mysql_pconnect($hostname_koneksi, $username_koneksi, $password_koneksi) or trigger_error(mysql_error(),E_USER_ERROR); 

//ambil sata dari form
$n = $_POST ['username'];
$p= $_POST ['password'];

//query ke tabel
$sql ="SELECT * FROM penyewa WHERE username = '$n' AND password= '$p'";
$kirim = mysql_query ($sql);
	
//menghitung jumlah baris hasil query
$jumlah  = mysql_num_rows ($kirim);
if ($jumlah > 0) {
    echo "Login Sukses";
	session_start();
	$_SESSION["penyewa"] = $n;
	$tampil = mysql_fetch_array($kirim);
		$_SESSION['username'] = $n ;
		$_SESSION['password'] = $p; 
		 header('location:home.php');
}
	else
	{
		//jika password salah
		include "login.php";
		//exit();
	}
?>
</body>
</html>
