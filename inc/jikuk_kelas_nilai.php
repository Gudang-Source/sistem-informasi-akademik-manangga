<?php
require ('../config.php');
$kd_mapel = $_GET['kd_mapel'];

$id_guru = $_GET['id_guru'];


$kelas = mysql_query("SELECT id_kelas, nm_kelas FROM kelas where id_kelas in (SELECT kelas.id_kelas FROM kelas left join mengajar on mengajar.id_kelas=kelas.id_kelas 
	where mengajar.kd_mapel='$kd_mapel' and mengajar.id_guru='$id_guru'
	) order by nm_kelas asc");
?>
<option value="">--- Pilih Kelas ---</option>
<?php
while($k = mysql_fetch_array($kelas)){
	echo "<option value=\"".$k['id_kelas']."\">".$k['nm_kelas']."</option>\n";
}
?>