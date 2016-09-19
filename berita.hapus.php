<?php
require ( __DIR__ . '/init.php');
mysql_query("DELETE from berita WHERE id_berita='$_GET[id]'");
unlink("../assets/user/images/slider/$_GET[file]");

echo '<script language="javascript">';
echo 'alert("Data Berhasil Dihapus")';
echo '</script>';
echo "<script> document.location.href='dashboard.php';</script>";

?>