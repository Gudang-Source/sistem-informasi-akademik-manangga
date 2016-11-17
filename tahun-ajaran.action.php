<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));
$act=$_GET['id'];

		$update=mysql_query("UPDATE tahun_ajaran SET  status='0' WHERE status='1'");
		$update=mysql_query("UPDATE tahun_ajaran SET  status='1' WHERE id_tahun='$act'");
?>
<script language="JavaScript">alert('Data Tahun Ajaran Berhasil Diaktifkan')</script>
	<script>
 window.location=history.go(-1);
 </script>		
<?php	

