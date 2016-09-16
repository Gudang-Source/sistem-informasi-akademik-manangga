<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(0));

// TEMPLATE CONTROL
$ui_register_page = 'siswa-materi';

// LOAD HEADER
loadAssetsHead('Data Materi dari Guru');


$materi = $_REQUEST['materi'];

$query = "SELECT * FROM materi WHERE kd_materi = '$_GET[id]'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);

header("Content-Disposition: attachment; filename=".$data['nama_file']);
header("Content-length: ".$data['size']);
header("Content-type: ".$data['type']);

echo $data['content'];

?>