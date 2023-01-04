<?php require_once('Connections/koneksi.php'); 

$nomor = $_GET['id'];

$query_r = "SELECT * FROM penduduk WHERE nomor = '$nomor'";
$r = mysql_query($query_r, $koneksi) or die(mysql_error());
$row = mysql_fetch_row($r);

?>


<html>
	<body>

	<form action=updatesuratmasuk.php method="POST" name="formedit" id="formedit">
     <input name="nomor" type="hidden" value="<?php echo $row[0];?>">            
      <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
            <table>

			<tr valign="baseline">
                    <td width="251" align="left" nowrap>
						<div align="left">Nomor Dokumen:</div>
                    		<input name="NIK" type="text" id="NIK" value="<?php echo $row[1];?>">					</td>
                    <td width="217">
						<div align="left">Nomor Office: </div>
                    		<input name="pengolah" type="text" id="pengolah" value="<?php echo $row[3];?>">					</td>
             </tr>
				  
             <tr valign="baseline">
                     <td width="251" align="left" nowrap>
						<div align="left">Lampiran</div>
                    		<input name="nama_surat" type="text" id="nama_surat" value="<?php echo $row[6];?>">					</td>
					
                     <td width="217">
						<div align="left">Tanggal: </div>
                    		<input name="tgl_surat" type="date" class="benefit_block" id="tgl_surat" value="<?php echo $row[2];?>">					 </td>
             </tr>
				  
			 <tr valign="baseline">
                    <td width="251" align="left" nowrap> 
					           <div align="left">Perihal</div>
					           <input name="perihal" type="text" id="perihal" value="<?php echo $row[5];?>">					</td>
                        <td width="217">
					           <div align="left">Kategori:</div>                    
                               <input name="bobot" type="text" id="bobot" value="<?php echo $row[7];?>">					    </td>
			</tr>
                  
                  
                  
			<tr>
               <td height="87"><div align="left">Message</div>
              <textarea name="kerahasiaan" id="kerahasiaan"><?php echo $row[8];?></textarea> </td>
			        <td width="217">&nbsp;</td>
			</tr>
                     
            <tr>
              <td colspan="2" align="left" valign="baseline" nowrap><label class="message">
                <input name="submit" type="submit" class="btn btn-success" value="Save">
                <input name="Reset" type="reset" class="btn btn-danger" value="Reset">
                
              
      </table>
   </form>			
			
    

	</body>
</html>

