<?php
header('Content-type: application/json');



$valid = true;

include "../config.php";
$sql="SELECT email FROM guru";
$sq=mysql_query($sql);


while ($s=mysql_fetch_array($sq)) {
    
    $d=ucwords(strtolower($s['email']));
    $nip[$d]=$d;
}

if (array_key_exists(ucwords(strtolower($_POST['email'])), $nip)) {
    $valid = false;
} 

echo json_encode(array(
    'valid' => $valid,
));

?>