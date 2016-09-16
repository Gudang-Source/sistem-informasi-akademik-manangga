<?php
require ( __DIR__ . '/init.php');
mysql_query("DELETE from materi WHERE kd_materi='$_GET[id]'");
header('location: ./materi-guru');
?>