<?php
require ( __DIR__ . '/init.php');
mysql_query("DELETE from pegawai WHERE id_pegawai='$_GET[id]'");
header('location: ./pegawai');
?>