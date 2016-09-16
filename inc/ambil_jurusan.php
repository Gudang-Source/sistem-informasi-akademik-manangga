<?php
require ( __DIR__ . '/init.php');
$jurusan = $_GET['jurusan'];
$namajurusan = mysql_query("SELECT kd_jurusan,nm_jurusan FROM jurusan WHERE kd_jurusan='$jurusan' order by nm_jurusan");
echo "<option>-- Pilih Jurusan --</option>";
while($k = mysql_fetch_array($namajurusan)){
    echo "<option value=\"".$k['kd_jurusan']."\">".$k['nm_jurusan']."</option>\n";
}
?>