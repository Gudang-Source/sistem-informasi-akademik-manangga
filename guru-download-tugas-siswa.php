<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1,10));

// TEMPLATE CONTROL
$ui_register_page = 'siswa-tugas';

// LOAD HEADER
loadAssetsHead('Data Tugas dari Guru');


$tugas = $_REQUEST['tugas'];

$query = "SELECT * FROM tugas_siswa WHERE kd_tugas_siswa = '$_GET[id]'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);

header("Content-Disposition: attachment; filename=".$data['nama_file']);
header("Content-length: ".$data['size']);
header("Content-type: ".$data['type']);

echo $data['content'];

?>