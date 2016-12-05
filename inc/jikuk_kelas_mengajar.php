<?php
require ('../config.php');
$kd_mapel = $_GET['kd_mapel'];

$id_guru = $_GET['id_guru'];

$output = preg_replace('/[^0-9]/', '', $id_guru );

$cektahun = mysql_query("SELECT * FROM guru WHERE nip='$output'");

$jikukid_guru = mysql_fetch_array($cektahun);   
       
$id_guru1 = $jikukid_guru['id_guru'];


$kelas = mysql_query("SELECT id_kelas, nm_kelas FROM kelas where id_kelas in (SELECT kelas.id_kelas FROM kelas left join mengajar on mengajar.id_kelas=kelas.id_kelas 
	where mengajar.kd_mapel='$kd_mapel' and mengajar.id_guru='$id_guru1'
	) order by nm_kelas asc");
echo "<option>-- Pilih Kelas --</option>";
while($k = mysql_fetch_array($kelas)){
	echo "<option value=\"".$k['id_kelas']."\">".$k['nm_kelas']."</option>\n";
}
?>