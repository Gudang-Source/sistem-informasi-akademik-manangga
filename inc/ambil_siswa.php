<?php
require ('../config.php');
$kelas = $_GET['kel'];
$siswa = mysql_query("SELECT id_siswa, nm_siswa, id_kelas FROM kelas_siswa INNER JOIN siswa ON kelas_siswa.id_siswa=siswa.id_siswa");
echo "<option>-- Pilih Siswa --</option>";
while($k = mysql_fetch_array($siswa)){
    echo "<option value=\"".$k['id_siswa']."\">".$k['nm_siswa']."</option>\n";
}
?>

