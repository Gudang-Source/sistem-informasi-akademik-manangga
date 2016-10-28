<?php
require ('../config.php');
$kelas = $_GET['kel'];
$siswa = mysql_query("SELECT id_siswa,nm_siswa FROM siswa WHERE id_kelas='$kelas' order by nm_siswa");
echo "<option>-- Pilih Siswa --</option>";
while($k = mysql_fetch_array($siswa)){
    echo "<option value=\"".$k['id_siswa']."\">".$k['nm_siswa']."</option>\n";
}
?>