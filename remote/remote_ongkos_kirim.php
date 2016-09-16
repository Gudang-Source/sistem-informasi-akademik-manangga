<?php
header('Content-type: application/json');



$valid = true;

include "../inc/config.php";
$sql="SELECT id_kec FROM ongkos_kirim";
$sq=mysql_query($sql);


while ($s=mysql_fetch_array($sq)) {
    
    $d=ucwords(strtolower($s['id_kec']));
    $kecamatan[$d]=$d;
}

if (array_key_exists(ucwords(strtolower($_POST['id_kec'])), $kecamatan)) {
    $valid = false;
} 

echo json_encode(array(
    'valid' => $valid,
));

?>