<?php
/**
 * Check whenever user is already logged-in or not.
 * @return none
 */
function checkUserAuth(){
  if ( empty($_SESSION['id_user']) ){
    header('location: login');
  }
}

function checkUserRole($allowed_roles){
  if( !in_array($_SESSION['tingkat_user'], $allowed_roles) ){
    header('location: dashboard');
    echo '<title>Forbidden Access !</title>';
    echo '<h1>You are forbidden !</h1>';
    echo '<a href="./dashboard">Go to Dashboard</a>';
    ob_end_flush();
  }
}

function doUserAuthRedirect(){
  if ( !empty($_SESSION['id_user']) ){
    header('location: dashboard');
  }
}

/**
 * Generate additional UIKIT Components
 * @param  [string] $type Define which output type
 * @return none
 */
function generateAdditionalAssets($type){
  global $ui_register_assets;
  if (isset($ui_register_assets) && !empty($ui_register_assets)){
    if( $type === 'css'){
      foreach ($ui_register_assets as $asset){
        echo '<link rel="stylesheet" href="'. ASSETS .'/css/components/'. $asset . THEME .'.min.css">' . "\n";
      }
      unset($asset);
    }
    else{
      foreach ($ui_register_assets as $asset){
        echo '<script src="'. ASSETS .'/js/components/'. $asset .'.min.js"></script>' . "\n";
      }
      unset($asset);
    }
  }
}

/**
 * Load header assets
 * @param  string $title Set page <title>
 * @return none
 */
function loadAssetsHead($title = 'index'){
?>
<!DOCTYPE html>
<?php global $ui_register_bg; echo ($ui_register_bg === 'secondary' ) ? '<html lang="en-us" dir="ltr" class="tm-bg-secondary">' : '<html lang="en-us" dir="ltr" class="tm-bg-primary">' ?>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title ?></title>
<link rel="shortcut icon" href="./" type="image/x-icon">
<link rel="apple-touch-icon-precomposed" href="<?php echo ASSETS . LOGO ?>">
<link rel="stylesheet" href="<?php echo ASSETS . UIKIT_CORE_CSS ?>">
<link rel="stylesheet" href="<?php echo ASSETS . STYLESHEET ?>">
<link rel="stylesheet" href="">
<!-- Bootstrap core CSS -->

  <link href="assets/admin/paneladmin/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/admin/paneladmin/fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/admin/paneladmin/css/animate.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/fileupload/css/bootstrap-fileupload.min.css" />
    <script src="assets/fileupload/js/jquery-2.0.3.min.js"></script>
    <script src="assets/fileupload/js/bootstrap-fileupload.js"></script>
<script type="text/javascript" language="javascript" src="assets/jquery.js"></script>

  <!-- Custom styling plus plugins -->





  <link rel="stylesheet" type="text/css" href="assets/admin/paneladmin/css/maps/jquery-jvectormap-2.0.3.css" />
  <link href="assets/admin/paneladmin/css/icheck/flat/green.css" rel="stylesheet" />
  <link href="assets/admin/paneladmin/css/floatexamples.css" rel="stylesheet" type="text/css" />

  <script src="assets/admin/paneladmin/js/jquery.min.js"></script>
  <script src="assets/admin/paneladmin/js/nprogress.js"></script>
</head>
<?php
}

/**
 * Load footer assets
 * @return none
 */


function loadAssetsFoot($scripts = ''){

?>

<script src="assets/js/jquery.js"></script>
<script src="assets/js/uikit.min.js"></script>
<?php
generateAdditionalAssets('js');
echo $scripts;
?>
<br><br><br>
<div class="sia-basic_main-full">
<?php include "footer.php";?>
 <div class="copyright">
	<div class="uk-vertical-align uk-text-center ">
		<div class="uk-vertical-align-middle uk-text-center">
			<label class="uk-text-success">
  Made with  <i class="fa fa-headphones"></i>  &   <i class="fa fa-coffee"></i>  from Yogyakarta, Indonesia.
  <p>
  © 2016 Beranda Siber Labs - Irfan Ofa. All rights reserved.
  </p>
</label>
		</div>
	</div>
  </div>
</div>
<?php
}

/**
 * Generate main menu navigation element
 * @param  string $page Page template to match
 * @param  string $link Menu link
 * @param  string $name Menu name to display
 * @return none
 */
function generateNavElement($roles, $page, $link, $name){
  global $ui_register_page;
  $user_role = isset($_SESSION['tingkat_user']) ? $_SESSION['tingkat_user'] : -1;

  if ( in_array($user_role, $roles) )
  echo ( $ui_register_page == $page ) ? '<li class="uk-active"><a href="'.$link.'">'.$name.'</a></li>' . "\n" : '<li><a href="'.$link.'">'.$name.'</a></li>' . "\n";
}

/**
 * Load main menu
 * @return none
 */
function loadMainMenu(){
/**
 * User role;
 * -1 = guest [debug usage]
 * 0 = normal user [dashboard, Mata Pelajaran, profile, logout]
 * 1 = staff [all except add user -› master Nilai]
 * 10 = admin [all]
 *
 * Available privilege area;
 * Dashboard
 * Manajemen (Guru, Pegawai, Mata Pelajaran)
 * Master (Siswa, Nilai, profil)
 * Keluar
 */

if( isset($_SESSION['tingkat_user']) ) :
?>

<div class="sia-basic_header-top"></div>
<div class="uk-container-center uk-text-center tm-menu-main">
    <nav class="uk-button-dropdown uk-visible-small" data-uk-dropdown="{mode:'click'}">
      <div><button class="uk-button uk-button-large uk-text-bold">- Menu -</button></div>
      <div class="uk-dropdown">
        <ul class="uk-nav uk-nav-dropdown uk-panel">
          <?php generateNavElement(array(0,1,2,10), 'dashboard', './dashboard', 'Dashboard') ?>
          <?php generateNavElement(array(), 'profil', './profil', 'Profil') ?>
  <li class="uk-nav-header">Data Sekolah</li>
    <?php generateNavElement(array(10), 'kelas', './kelas', 'Kelas') ?>
    <?php generateNavElement(array(10), 'mapel', './mapel', 'Mata Pelajaran') ?>
    <?php generateNavElement(array(), 'tahun-ajaran', './tahun-ajaran', 'Tahun Ajaran') ?>
    <?php generateNavElement(array(10), 'pengumuman', './pengumuman', 'Pengumuman') ?>
    <?php generateNavElement(array(0), 'siswa-profilsekolah', './siswa-profilsekolah', 'Profil Sekolah') ?>
  <li class="uk-nav-header">Guru</li>
   <?php generateNavElement(array(0,10), 'guru', './guru', 'Data Guru') ?>
   <?php generateNavElement(array(0), 'siswa-lihatguru', './siswa-lihatguru', 'Daftar Guru') ?>
    <?php generateNavElement(array(10), 'mengajar', './mengajar', 'Data Mengajar') ?>
    <?php generateNavElement(array(10), 'materi-guru', './materi-guru', 'Materi') ?>
    <?php generateNavElement(array(10), 'tugas-guru', './tugas-guru', 'Tugas') ?>
    <?php generateNavElement(array(1), 'guru-mengajar', './guru-mengajar', 'Kelas Mengajar') ?>
    <?php generateNavElement(array(1), 'guru-materi', './guru-materi', 'Materi Ajar') ?>
    <?php generateNavElement(array(1), 'guru-tugas', './guru-tugas', 'Tugas') ?>
    <?php generateNavElement(array(1), 'guru-pengumuman', './guru-pengumuman', 'Pengumuman') ?>
  <li class="uk-nav-header">Siswa</li>
  <li class="uk-nav-header"><?php generateNavElement(array(1,10), 'siswa', './siswa', 'Siswa') ?></li>
    <?php generateNavElement(array(10), 'siswa', './siswa', 'Data Siswa') ?>
    <?php generateNavElement(array(0), 'siswa-mapel', './siswa-mapel', 'Materi Pelajaran') ?>
    <?php generateNavElement(array(0,2), 'siswa-materi', './siswa-materi', 'Materi Siswa') ?>
    <?php generateNavElement(array(0,2), 'siswa-tugas', './siswa-tugas', 'Tugas Siswa') ?>

          <?php// generateNavElement(array(0,1,10), 'name', 'link', 'value') ?>
  <li class="uk-nav-divider"></li>
          <li><a href="./logout.php">Keluar</a></li>
        </ul>
      </div>
    </nav>
  </div>
<?php
endif;
}


/**
 * Generate site breadcrumbs
 * @param  string $arr Breadcrumbs array. array($name => $link)
 * @return none
 */
function generateBreadcrumbs($arr){
  $str = '<ul class="uk-breadcrumb">';
  foreach ($arr as $key => $val) {
    $str .= ($val === '') ? '<li class="uk-active"><span>'.$key.'</span></li>' : '<li><a href="'.$val.'">'.$key.'</a></li>';
  }
  $str .= '</ul>';

  echo $str;

  unset($key);
  unset($val);
}

/**
 * Main menu on left side.
 * @return none
 */
function admin(){
   $sql = "SELECT * from admin";
                        $result = mysql_query($sql);
                        $row=mysql_fetch_array($result);?>
              <div class="sia-profile">
                <p style="text-align:center"; font-weight:bold;>Selamat Datang</p>
                <img class="sia-profile-image" <?php echo "src='gallery/admin/{$row['foto']}'";?> alt="">
                <p style="text-align:center"; font-weight:bold;><b><?php echo "{$row['username']}";?></b></p>
                <p style="text-align:center"; font-weight:bold;><?php echo "{$row['pengguna']}";?></p>

              </div>
      <?php } ?>

<?php function pegawai(){

$sql = "SELECT * from pegawai where id_pegawai = $_SESSION[usernametu]";
                        $result = mysql_query($sql);
                        $row=mysql_fetch_array($result);?>
              <div class="sia-profile">
                <p style="text-align:center"; font-weight:bold;>Selamat Datang</p>
                <img class="sia-profile-image" <?php echo "src='gallery/pegawai/{$row['file']}'";?> alt="">
                <p style="text-align:center"; font-weight:bold;><b><?php echo "{$row['nm_pegawai']}";?></b></p>
                <p style="text-align:center"; font-weight:bold;><?php echo "{$row['id_pegawai']}";?></p>
              </div>
        <?php } ?>

<?php function guru(){

   $sql = "SELECT * FROM user, guru WHERE guru.id_user=user.id_user AND nip={$_SESSION['usernameguru']}";
                        $result = mysql_query($sql);
                        $row=mysql_fetch_array($result); 

                        ?>
              <div class="sia-profile">
                <p style="text-align:center"; font-weight:bold;>Selamat Datang</p>
                <img class="sia-profile-image" <?php echo "src='gallery/guru/logo.jpg'";?> </br> 
                <p style="text-align:center"; font-weight:bold;><b><?php echo "{$row['nip']}";?></b></p>
                <p style="text-align:center"; font-weight:bold;><b><?php echo "{$row['nm_guru']}";?></b></p>


              </div>
             <?php } ?>

 <?php function siswa(){
               $sql = "SELECT * from siswa where nis = $_SESSION[usernamesiswa]";
                        $result = mysql_query($sql);
                        $row=mysql_fetch_array($result);?>
              <div class="sia-profile">
                <p style="text-align:left"; font-weight:bold;>Selamat Datang, <b><?php echo "{$row['nm_siswa']}";?></b></p>
                <p style="text-align:left"; font-weight:bold;>NIS: <b><?php echo "{$row['nis']}";?></b></p>
                <p style="text-align:left"; font-weight:bold;>Kelas: <b><?php echo "{$row['kd_kelas']}";?></b></p>
              </div>
        <?php } ?>



<?php function loadSidebar(){

?>

       <ul class="uk-nav uk-nav-side tm-menu-side">


     <?php if(isset($_SESSION['usernameadmin'])) { admin(); }?>
     <?php if(isset($_SESSION['usernamesiswa'])) { siswa(); }?>
     <?php if(isset($_SESSION['usernameguru'])) { guru(); }?>
     <?php if(isset($_SESSION['usernametu'])) { pegawai(); }?>


  <hr class="uk-article-divider">
  <li class="uk-nav-header"></li>
          <?php generateNavElement(array(0,1,2,10), 'dashboard', './dashboard', 'Dashboard') ?>
          <?php generateNavElement(array(), 'profil', './profil', 'Profil') ?>
  <hr class="uk-article-divider">
  <li class="uk-nav-header">Data Sekolah</li>
    <?php generateNavElement(array(10), 'kelas', './kelas', 'Kelas') ?>
    <?php generateNavElement(array(10), 'mapel', './mapel', 'Mata Pelajaran') ?>
    <?php generateNavElement(array(), 'tahun-ajaran', './tahun-ajaran', 'Tahun Ajaran') ?>
    <?php generateNavElement(array(10), 'pengumuman', './pengumuman', 'Pengumuman') ?>
    <?php generateNavElement(array(0), 'siswa-profilsekolah', './siswa-profilsekolah', 'Profil Sekolah') ?>

  <hr class="uk-article-divider">
  <li class="uk-nav-header">Guru</li>
    
   <?php generateNavElement(array(10), 'guru', './guru', 'Data Guru') ?>
   <?php generateNavElement(array(0), 'siswa-lihatguru', './siswa-lihatguru', 'Daftar Guru') ?>
    <?php generateNavElement(array(10), 'mengajar', './mengajar', 'Data Mengajar') ?>
    <?php generateNavElement(array(10), 'materi-guru', './materi-guru', 'Materi') ?>
    <?php generateNavElement(array(10), 'tugas-guru', './tugas-guru', 'Tugas') ?>
    <?php generateNavElement(array(1), 'guru-mengajar', './guru-mengajar', 'Kelas Mengajar') ?>
    <?php generateNavElement(array(1), 'guru-materi', './guru-materi', 'Materi Ajar') ?>
    <?php generateNavElement(array(1), 'guru-tugas', './guru-tugas', 'Tugas') ?>
    <?php generateNavElement(array(1), 'guru-pengumuman', './guru-pengumuman', 'Pengumuman') ?>
    <?php// generateNavElement(array(0,1,10), 'name', 'link', 'value') ?>

  <li class="uk-nav-divider"></li>
    <li class="uk-nav-header">Siswa</li>
    <?php generateNavElement(array(10), 'siswa', './siswa', 'Data Siswa') ?>
    <?php generateNavElement(array(0), 'siswa-mapel', './siswa-mapel', 'Materi Pelajaran') ?>
    <?php generateNavElement(array(0,2), 'siswa-materi', './siswa-materi', 'Materi Siswa') ?>
    <?php generateNavElement(array(0,2), 'siswa-tugas', './siswa-tugas', 'Tugas Siswa') ?>


  <li><a href="./logout">Keluar</a></li>
</ul>
<?php
}
