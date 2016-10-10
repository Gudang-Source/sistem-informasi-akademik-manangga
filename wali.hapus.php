<?php
require ( __DIR__ . '/init.php');
mysql_query("DELETE from wali WHERE id_wali='$_GET[id]'");
header('location: ./wali-murid');
?>
