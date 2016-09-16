<?php
header('Content-type: application/json');



$valid = true;

include "../config.php";
$sql="SELECT nm_jurusan FROM jurusan";
$sq=mysql_query($sql);


while ($s=mysql_fetch_array($sq)) {
    
    $d=ucwords(strtolower($s['nm_jurusan']));
    $jurusan[$d]=$d;
}

if (array_key_exists(ucwords(strtolower($_POST['nm_jurusan'])), $jurusan)) {
    $valid = false;
} 

echo json_encode(array(
    'valid' => $valid,
));

?>