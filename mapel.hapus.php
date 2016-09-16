<?php
require ( __DIR__ . '/init.php');
mysql_query("DELETE from mapel WHERE kd_mapel='$_GET[id]'");
header('location: ./mapel');
?>