<?php
require ( __DIR__ . '/init.php');
mysql_query("DELETE from guru WHERE id_guru='$_GET[id]'");
header('location: ./guru');
?>
