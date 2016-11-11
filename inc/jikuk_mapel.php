<?php
require ('../config.php');
$dkelas = $_GET['dkelas'];
$dmapel = mysql_query("SELECT id_mapel,nama_mapel FROM mata_pelajaran WHERE id_kelas='$dkelas' order by nama_mapel");
echo "<option>-- Pilih Mata Pelajaran --</option>";
while($k = mysql_fetch_array($dmapel)){
    echo "<option value=\"".$k['id_mapel']."\">".$k['nama_mapel']."</option>\n";
}
?>