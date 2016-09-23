<?php
require ('../config.php');
$id_kec = $_GET['id_kec'];
$kel = mysql_query("SELECT id_kel,nama_kel FROM kelurahan WHERE id_kec='$id_kec' order by nama_kel");

echo "<option>-- Pilih Kelurahan --</option>";

while($k = mysql_fetch_array($kel)){
    echo "<option value=\"".$k['id_kel']."\">".$k['nama_kel']."</option>\n";
}
?>