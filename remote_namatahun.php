<?php
header('Content-type: application/json');

$valid = true;

include "../config.php";
$sql="SELECT nm_tahun_ajaran FROM tahun_ajaran";
$sq=mysql_query($sql);

while ($s=mysql_fetch_array($sq)) {
    
    $d=ucwords(strtolower($s['nm_tahun_ajaran']));
    $tahunajar[$d]=$d;
}

if (array_key_exists(ucwords(strtolower($_POST['nm_tahun_ajaran'])), $tahunajar)) {
    $valid = false;
} 

echo json_encode(array(
    'valid' => $valid,
));

?>
