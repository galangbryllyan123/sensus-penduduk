<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?php  
mysql_connect("localhost","root","");  
mysql_select_db("sensuspenduduk");  
$result = mysql_query("select * from penduduk");  
$jsArray = "var yosh = new Array();\n";  
echo 'NIK : <select name="nomor" onchange="changeValue(this.value)">';  
echo '<option>-------</option>';  
while ($row = mysql_fetch_array($result)) {  
    echo '<option value="' . $row['nomor'] . '">' . $row['NIK'] . '</option>';  
    $jsArray .= "yosh['" . $row['nomor'] . "'] = {nama:'" . addslashes($row['nama']) . "',
	tempat_lahir:'".addslashes($row['tempat_lahir'])."',
	tanggal_lahir:'".addslashes($row['tanggal_lahir'])."',
	jenis_kelamin:'".addslashes($row['jenis_kelamin'])."',
	alamat:'".addslashes($row['alamat'])."',
	agama:'".addslashes($row['agama'])."',
	status_perkawinan:'".addslashes($row['status_perkawinan'])."',
	pekerjaan:'".addslashes($row['pekerjaan'])."',
	kewarganegaraan:'".addslashes($row['kewarganegaraan'])."'};\n";  
}  
echo '</select>';  
?>  
<script type="text/javascript">  
<?php echo $jsArray; ?>
function changeValue(id){
document.getElementById('nama').value = yosh[id].nama;
document.getElementById('tempat_lahir').value = yosh[id].tempat_lahir;
document.getElementById('tanggal_lahir').value = yosh[id].tanggal_lahir;
document.getElementById('jenis_kelamin').value = yosh[id].jenis_kelamin;
document.getElementById('alamat').value = yosh[id].alamat;
document.getElementById('agama').value = yosh[id].agama;
document.getElementById('status_perkawinan').value = yosh[id].status_perkawinan;
document.getElementById('pekerjaan').value = yosh[id].pekerjaan;
document.getElementById('kewarganegaraan').value = yosh[id].kewarganegaraan;
};
</script>
</body>
</html>
	