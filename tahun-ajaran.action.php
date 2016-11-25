<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));
$act=$_GET['id'];

		$update=mysql_query("UPDATE tahun_ajaran SET  status='0' WHERE status='1'");
		$update=mysql_query("UPDATE tahun_ajaran SET  status='1' WHERE id_tahun='$act'");

		session_start();
		
		$cektahun = mysql_query("SELECT * FROM tahun_ajaran WHERE status='1'");
          mysql_num_rows($cektahun);
          $tahun_ajaransession = mysql_fetch_array($cektahun);          

          // tahun ajaran session
          $_SESSION['id_tahun'] = $tahun_ajaransession['id_tahun'];
          $_SESSION['thn_ajaran'] = $tahun_ajaransession['thn_ajaran'];
          $_SESSION['semester'] = $tahun_ajaransession['semester'];
          $_SESSION['status'] = $tahun_ajaransession['status'];
?>
<script language="JavaScript">alert('Data Tahun Ajaran Berhasil Diaktifkan')</script>
	<script>
 window.location=history.go(-1);
 </script>		
<?php	

