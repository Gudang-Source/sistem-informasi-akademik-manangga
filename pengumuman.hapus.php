<?php
require ( __DIR__ . '/init.php');
mysql_query("DELETE from pengumuman WHERE kd_pengumuman='$_GET[id]'");
header('location: ./pengumuman');
?>
