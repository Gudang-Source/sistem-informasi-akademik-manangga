<?php
require ('../config.php');
$id_guru = $_GET['id_guru'];
//$mapel = mysql_query("SELECT * from mapel ");
$mapel = mysql_query("SELECT mapel.kd_mapel,mapel.nm_mapel FROM mapel left join mengajar on mengajar.kd_mapel=mapel.kd_mapel 
					where 
					mengajar.id_guru='$id_guru' 
					order by mapel.nm_mapel");
echo "<option>-- Pilih Mata Pelajaran --</option>";
while($k = mysql_fetch_array($mapel)){
    echo "<option value=\"".$k['kd_mapel']."\">".$k['nm_mapel']."</option>\n";
}
?>