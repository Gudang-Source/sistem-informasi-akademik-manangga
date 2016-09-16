<?php

// include dari sistem
require ( __DIR__ . '/init.php');

// query delete data
mysql_query("DELETE from jurusan WHERE kd_jurusan='$_GET[id]'");
header('location: ./jurusan');
?>