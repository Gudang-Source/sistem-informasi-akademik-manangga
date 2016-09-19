<?php
require ( __DIR__ . '/init.php');
doUserAuthRedirect();


function cek(){
  if (!empty($_SESSION['id_user'])) {
    header('location: dashboard');
  }
}

// TEMPLATE CONTROL
$ui_register_bg   = 'secondary';
$ui_register_page = 'index';

// LOAD HEADER
loadAssetsHead('Sistem Informasi Akademik SDN II Manangga');

?>

<body>
  <div class="uk-vertical-align uk-text-center uk-height-1-1">
    <div class="uk-vertical-align-middle">
      <img class="uk-margin-bottom uk-animation-fade uk-animation-10,5" width="70%" height="70%" src="assets/images/banner.png" alt="Sistem Informasi Akademik SDN II Manangga" title="Sistem Informasi Akademik SDN II Manangga">
    <br><br><br>
      <a href="./login" target="_self"><img class="uk-margin-bottom uk-animation-fade uk-animation-10,5" width="150px" src="assets/images/button_masuk.png" alt="Sistem Informasi Akademik SDN II Manangga" title="Sistem Informasi Akademik SDN II Manangga"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="./tentang" target="_self"><img class="uk-margin-bottom uk-animation-fade uk-animation-10,5" width="150px" src="assets/images/button_tentang.png" alt="Sistem Informasi Akademik SDN II Manangga" title="Sistem Informasi Akademik SDN II Manangga"></a>
  </div>
  </div>


<?php
// LOAD FOOTER
loadAssetsFoot();

ob_end_flush();
?>
</body>