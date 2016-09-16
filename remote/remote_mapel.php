<?php
header('Content-type: application/json');

$valid = true;

include "../config.php";
$sql="SELECT kd_mapel FROM mapel";
$sq=mysql_query($sql);

while ($s=mysql_fetch_array($sq)) {
    
    $d=ucwords(strtolower($s['kd_mapel']));
    $mapel[$d]=$d;
}

if (array_key_exists(ucwords(strtolower($_POST['kd_mapel'])), $mapel)) {
    $valid = false;
} 

echo json_encode(array(
    'valid' => $valid,
));

?>
