<?php
require ('../config.php');
$id_guru = $_GET['id_guru'];
$output = preg_replace('/[^0-9]/', '', $id_guru );
$cektahun = mysql_query("SELECT * FROM guru WHERE nip='$output'");
        
          $jikukid_guru = mysql_fetch_array($cektahun);          
          $id_guru1 = $jikukid_guru['id_guru'];

$mapel = mysql_query("SELECT kd_mapel, nm_mapel FROM mapel where kd_mapel in (SELECT mapel.kd_mapel FROM mapel left join mengajar on mengajar.kd_mapel=mapel.kd_mapel 
					where mengajar.id_guru='$id_guru1' 
					) order by nm_mapel asc");
echo "<option>-- Pilih Mata Pelajaran --</option>";
while($k = mysql_fetch_array($mapel)){
    echo "<option value=\"".$k['kd_mapel']."\">".$k['nm_mapel']."</option>\n";
}
?>