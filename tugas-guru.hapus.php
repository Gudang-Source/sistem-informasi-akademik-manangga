<?php
require ( __DIR__ . '/init.php');
mysql_query("DELETE from tugas WHERE kd_tugas='$_GET[id]'");
header('location: ./tugas-guru');
?>