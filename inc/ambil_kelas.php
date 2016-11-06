<?php
require ('../config.php');
$ajaran = $_GET['ajaran'];
$kelas = mysql_query("SELECT id_kelas_siswa,id_kelas FROM kelas_siswa WHERE id_kelas_siswa='$ajaran' order by id_kelas");
echo "<option>-- Pilih Kelas --</option>";
while($k = mysql_fetch_array($kelas)){
    echo "<option value=\"".$k['id_kelas_siswa']."\">".$k['id_kelas']."</option>\n";
}
?>