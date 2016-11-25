<?php
require ( __DIR__ . '/init.php');
mysql_query("DELETE from sesi WHERE id_sesi='$_GET[id]'");
header('location: ./manajemen-sesi');
?>