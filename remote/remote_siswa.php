<?php
header('Content-type: application/json');

$valid = true;

include "../config.php";
$sql="SELECT nis FROM siswa";
$sq=mysql_query($sql);

while ($s=mysql_fetch_array($sq)) {
    
    $d=ucwords(strtolower($s['nis']));
    $siswa[$d]=$d;
}

if (array_key_exists(ucwords(strtolower($_POST['nis'])), $siswa)) {
    $valid = false;
} 

echo json_encode(array(
    'valid' => $valid,
));

?>
