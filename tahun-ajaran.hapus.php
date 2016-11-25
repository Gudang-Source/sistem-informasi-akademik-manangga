<?php
require ( __DIR__ . '/init.php');
mysql_query("DELETE from tahun_ajaran WHERE thn_ajaran='$_GET[id]'");

		$cektahun = mysql_query("SELECT * FROM tahun_ajaran WHERE status='1'");
          mysql_num_rows($cektahun);
          $tahun_ajaransession = mysql_fetch_array($cektahun);          

          // tahun ajaran session
          $_SESSION['id_tahun'] = $tahun_ajaransession['id_tahun'];
          $_SESSION['thn_ajaran'] = $tahun_ajaransession['thn_ajaran'];
          $_SESSION['semester'] = $tahun_ajaransession['semester'];
          $_SESSION['status'] = $tahun_ajaransession['status'];

header('location: ./tahun-ajaran');
?>
