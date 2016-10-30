<?php
require ('../config.php');
$ajaran = $_GET['ajaran'];
$kelas = mysql_query("SELECT id_kelas FROM kelas_siswa WHERE id_kelas='$ajaran'");
echo "<option>-- Pilih Kelas --</option>";
while($k = mysql_fetch_array($kelas)){
    echo "<option value=\"".$k['id_kelas']."\"</option>\n";
}
?>