<?php
require ('../config.php');
$propinsi = $_GET['prov'];
$kota = mysql_query("SELECT id_kab,nama_kab FROM kabupaten WHERE id_prov='$propinsi' order by nama_kab");
echo "<option>-- Pilih Kabupaten/Kota --</option>";
while($k = mysql_fetch_array($kota)){
    echo "<option value=\"".$k['id_kab']."\">".$k['nama_kab']."</option>\n";
}
?>