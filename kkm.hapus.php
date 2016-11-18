<?php
require ( __DIR__ . '/init.php');
mysql_query("DELETE from kkm WHERE id_kkm='$_GET[id]'");
header('location: ./kkm');
?>