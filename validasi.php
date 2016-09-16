<?php
include "config.php"
$sql = mysql_query("select * from guru where nip = '$_POST['nip']'");
$cocok = mysql_num_rows($sql);

echo $cocok;
?>