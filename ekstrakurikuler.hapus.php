<?php
require ( __DIR__ . '/init.php');
mysql_query("DELETE from ekstrakurikuler WHERE id_ekstrakurikuler='$_GET[id]'");
header('location: ./ekstrakurikuler');
?>