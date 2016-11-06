<?php
require ('../config.php');
$kelas = $_GET['kel'];
$siswa = mysql_query("SELECT DISTINCT id_kelas_siswa,id_siswa,nm_siswa FROM kelas_siswa WHERE id_kelas_siswa='$kelas' order by nm_siswa");
echo "<option>-- Pilih SISWA --</option>";
while($k = mysql_fetch_array($siswa)){
    echo "<option value=\"".$k['id_kelas_siswa']."\">".$k['nm_siswa']."</option>\n";
}
?>