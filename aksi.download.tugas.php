<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(0));

// TEMPLATE CONTROL
$ui_register_page = 'siswa-tugas';

// LOAD HEADER
loadAssetsHead('Data Tugas dari Guru');

$action=$_POST['action'];
$tugas = $_REQUEST['tugas'];
$kd_tugas = $_REQUEST['kd_tugas'];

$query = "SELECT * FROM tugas WHERE kd_tugas = '$_GET[id]'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);

header("Content-Disposition: attachment; filename=".$data['nama_file']);
header("Content-length: ".$data['size']);
header("Content-type: ".$data['type']);

echo $data['content'];

?>