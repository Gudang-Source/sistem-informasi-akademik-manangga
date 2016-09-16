<?php
require ( __DIR__ . '/init.php');
mysql_query("DELETE from guru WHERE nip='$_GET[id]'");
header('location: ./guru');
?>
