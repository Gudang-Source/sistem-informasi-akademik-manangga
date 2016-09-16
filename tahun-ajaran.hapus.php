<?php
require ( __DIR__ . '/init.php');
mysql_query("DELETE from tahun_ajaran WHERE nm_tahun_ajaran='$_GET[id]'");
header('location: ./tahun-ajaran');
?>
