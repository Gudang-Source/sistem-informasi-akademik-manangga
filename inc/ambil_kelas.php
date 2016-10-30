<?php
require ('../config.php');
$ajaran = $_GET['ajaran'];
$kelas = mysql_query("SELECT id_kelas,nm_kelas FROM kelas_siswa WHERE id_kelas='$ajaran' order by nm_kelas");
echo "<option>-- Pilih Kelas --</option>";
while($k = mysql_fetch_array($kelas)){
    echo "<option value=\"".$k['id_kelas']."\">".$k['nm_kelas']."</option>\n";
}
?>