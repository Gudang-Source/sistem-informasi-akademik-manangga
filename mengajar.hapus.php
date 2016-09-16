<?php
require ( __DIR__ . '/init.php');
mysql_query("DELETE from mengajar WHERE kd_mengajar='$_GET[id]'");
header('location: ./mengajar');
?>
