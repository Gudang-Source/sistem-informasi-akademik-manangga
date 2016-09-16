<?php
header('Content-type: application/json');

$valid = true;

include "../config.php";
$sql="SELECT nip FROM guru";
$sq=mysql_query($sql);

while ($s=mysql_fetch_array($sq)) {
    
    $d=ucwords(strtolower($s['nip']));
    $guru[$d]=$d;
}

if (array_key_exists(ucwords(strtolower($_POST['nip'])), $guru)) {
    $valid = false;
} 

echo json_encode(array(
    'valid' => $valid,
));

?>
