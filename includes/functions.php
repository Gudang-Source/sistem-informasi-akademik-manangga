<?php
/**
 * Check whenever user is already logged-in or not.
 * @return none
 */
function kelolatanggal($vardate,$added)
{
$data = explode("-", $vardate);
$date = new DateTime();
$date->setDate($data[0], $data[1], $data[2]);
$date->modify("".$added."");
$day= $date->format("Y-m-d");
return $day;
}

function IndonesiaTgl($tanggal){
  $tgl=substr($tanggal,8,2);
  $bln=substr($tanggal,5,2);
  $thn=substr($tanggal,0,4);
  $awal="$tgl-$bln-$thn";
  return $awal;
}

function ubahformatTgl($tanggal) {
    $pisah    = explode('/',$tanggal);
    $urutan   = array($pisah[2],$pisah[1],$pisah[0]);
    $satukan  = implode('-',$urutan);
    return $satukan;
  }
  
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
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <link rel="apple-touch-icon-precomposed" href="assets/images/logo.png">
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

<script src="assets/datepicker/js/bootstrap-datepicker.min.js"></script>
    




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
        Develop on progress with <i class="fa fa-headphones"></i>  &  <i class="fa fa-coffee"></i> 
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
      <hr class="uk-article-divider">
      <li class="uk-nav-header">Data Tahun Ajaran</li>
      <?php generateNavElement(array(10,1), 'tahun-ajaran', './tahun-ajaran', 'Tahun Ajaran') ?>
      <hr class="uk-article-divider"> 
      <li class="uk-nav-header">Data Pribadi Siswa</li>
      <?php generateNavElement(array(10,2,1,3,0), 'isi-data-pribadi-siswa', './isi-data-pribadi-siswa', 'Isi Data Pribadi Siswa') ?>
      <?php generateNavElement(array(10,2,1,3,0), 'isi-data-pribadi-orangtua', './isi-data-pribadi-orangtua', 'Isi Data Orangtua/ Wali Murid') ?>

      <hr class="uk-article-divider">
      <li class="uk-nav-header">Data Sekolah</li>
       <?php generateNavElement(array(10,1), 'siswa-profilsekolah', './siswa-profilsekolah', 'Profil Sekolah') ?>
       <?php generateNavElement(array(10,1), 'kepala-sekolah', './kepala-sekolah', 'Kepala Sekolah') ?>
       <?php generateNavElement(array(10,1), 'siswa', './siswa', 'Data Siswa') ?>
       <?php generateNavElement(array(10,1), 'siswa.pertahun', './siswa.pertahun', 'Data Siswa per Tahun Ajaran') ?>
       <?php generateNavElement(array(2, 10), 'guru', './guru', 'Data Guru') ?>
       <!--<?php generateNavElement(array(10,1), 'wali-murid', './wali-murid', 'Data Orangtua/Wali') ?>-->
       
      <hr class="uk-article-divider">
      <li class="uk-nav-header">Akademik</li>
    <!--<?php generateNavElement(array(10,1), 'siswa-mapel', './siswa-mapel', 'Materi Pelajaran') ?>-->
     <!-- <?php generateNavElement(array(10,0,2), 'siswa-materi', './siswa-materi', 'Materi Siswa') ?>-->
      <!--<?php generateNavElement(array(10,0,2), 'siswa-tugas', './siswa-tugas', 'Tugas Siswa') ?>-->
      <?php generateNavElement(array(10,1), 'kelas', './kelas', 'Kelas') ?>
      <?php generateNavElement(array(10,1), 'mapel', './mapel', 'Mata Pelajaran') ?>
      <?php generateNavElement(array(10,1), 'tahun-ajaran', './tahun-ajaran', 'Tahun Ajaran') ?>
  
     <!-- <?php generateNavElement(array(10,1), 'siswa-lihatguru', './siswa-lihatguru', 'Daftar Guru') ?>-->
   <?php generateNavElement(array(10,1), 'mengajar', './mengajar', 'Data Mengajar') ?>
    <!--  <?php generateNavElement(array(10,1), 'materi-guru', './materi-guru', 'Materi') ?>-->
    <!--  <?php generateNavElement(array(10,1), 'tugas-guru', './tugas-guru', 'Tugas') ?>-->
      <!--<?php generateNavElement(array(10,1), 'guru-mengajar', './guru-mengajar', 'Kelas Mengajar') ?>-->
    <!--  <?php generateNavElement(array(10,1), 'guru-materi', './guru-materi', 'Materi Ajar') ?>-->
    <!--  <?php generateNavElement(array(10,1), 'guru-tugas', './guru-tugas', 'Tugas') ?>-->
    <!--  <?php generateNavElement(array(10,1), 'guru-pengumuman', './guru-pengumuman', 'Pengumuman') ?>-->
     <?php generateNavElement(array(10), 'nilai', './nilai', 'Nilai') ?>
     <?php generateNavElement(array(1), 'nilai', './guru_nilai', 'Nilai') ?>
      <?php// generateNavElement(array(0,1,10), 'name', 'link', 'value') ?>

      <hr class="uk-article-divider">  
      <li class="uk-nav-header">Pembayaran</li>   
     <!--  <?php generateNavElement(array(10,2,10,1), 'riwayat-pembayaran', './riwayat-pembayaran', 'Riwayat Pembayaran') ?>-->
     <!--  <?php generateNavElement(array(10,1), 'tagihan-pembayaran', './tagihan-pembayaran', 'Tagihan Pembayaran') ?>-->

      <hr class="uk-article-divider">  
      <li class="uk-nav-header">Ekstrakurikuler</li>   
      <?php generateNavElement(array(10,2,10,1), 'ekstrakurikuler', './ekstrakurikuler', 'ekstrakurikuler') ?>
      <!-- <?php generateNavElement(array(10,1), 'tagihan-pembayaran', './tagihan-pembayaran', 'Tagihan Pembayaran') ?>-->
      <li class="uk-nav-divider"></li>



      <li><a href="./logout">Keluar</a></li>
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
    <img class="sia-profile-image" src="gallery/news/<?=$rowks['foto'];?>"> </br> 
    <p style="text-align:left"; font-weight:bold;>NIS: <b><?php echo "{$row['nis']}";?></b></p>
    <p style="text-align:left"; font-weight:bold;>Kelas: <b><?php echo "{$row['kd_kelas']}";?></b></p>
  </div>
  <?php } ?>



  <?php function loadSidebar(){

    ?>

    <ul class="uk-nav uk-nav-side tm-menu-side">


      <?php// generateNavElement(array(0,1,10), 'name', 'link', 'value') ?>
      <li class="uk-nav-divider"></li>
      <?php if(isset($_SESSION['usernameadmin'])) { admin(); }?>
      <?php if(isset($_SESSION['usernamesiswa'])) { siswa(); }?>
      <?php if(isset($_SESSION['usernameguru'])) { guru(); }?>
      <?php if(isset($_SESSION['usernametu'])) { pegawai(); }?>


      <hr class="uk-article-divider">

      <li class="uk-nav-header"></li>
      <?php generateNavElement(array(0,1,2,10), 'dashboard', './dashboard', 'Dashboard') ?>
      <hr class="uk-article-divider"> 
      <li class="uk-nav-header"><i class="uk-icon-institution"></i> Tahun Ajaran</li>
      <?php generateNavElement(array(10,1), 'tahun-ajaran', './tahun-ajaran', 'Data Tahun Ajaran') ?>
      <?php generateNavElement(array(), 'profil', './profil', 'Profil') ?>

      <hr class="uk-article-divider">
      <li class="uk-nav-header"><i class="uk-icon-child"></i> Siswa</li>
      <?php generateNavElement(array(10,1), 'siswa', './siswa', 'Data Siswa') ?>
      <?php generateNavElement(array(10,1), 'siswa.pertahun', './siswa.pertahun', 'Data Siswa Aktif') ?>
        <!--<?php generateNavElement(array(10,1), 'wali-murid', './wali-murid', 'Data Orangtua/Wali') ?>-->
      <hr class="uk-article-divider">
      <li class="uk-nav-header"><i class="uk-icon-user"></i> Pegawai</li>
       <?php generateNavElement(array(10,1), 'kepala-sekolah', './kepala-sekolah', 'Data Kepala Sekolah') ?>
       <?php generateNavElement(array(2,1, 10, 0), 'guru', './guru', 'Data Guru') ?>

      <hr class="uk-article-divider">
      <li class="uk-nav-header"><i class="uk-icon-home"></i> Kelas</li>
      <?php generateNavElement(array(10,1), 'kelas', './kelas', 'Data Kelas') ?>

      <hr class="uk-article-divider">
      <li class="uk-nav-header"><i class="uk-icon-tasks"></i> Mata Pelajaran</li>
      <?php generateNavElement(array(10,1,0), 'mapel', './mapel', 'Data Mapel') ?>
      <!--<?php generateNavElement(array(10,1,0), 'kkm', './kkm', 'Data KKM') ?>-->

      <hr class="uk-article-divider">
      <li class="uk-nav-header"><i class="uk-icon-circle-o-notch"></i> Mengajar</li>
      <?php generateNavElement(array(10,1), 'mengajar', './mengajar', 'Data Mengajar') ?>

      <hr class="uk-article-divider">  
      <li class="uk-nav-header"><i class="uk-icon-calendar"></i> Jadwal Mapel</li>  
     <?php generateNavElement(array(10), 'jadwal-mapel-admin', './jadwal-mapel-admin', 'Manajemen Jadwal') ?>
      <?php generateNavElement(array(10), 'manajemen-sesi', './manajemen-sesi', 'Manajemen Sesi') ?>
     <?php generateNavElement(array(10, 0), 'jadwal-mapel-siswa', './jadwal-mapel-siswa', 'Jadwal Pelajaran') ?>
      <hr class="uk-article-divider">
      <li class="uk-nav-header"><i class="uk-icon-mortar-board"></i> Data Sekolah</li>
       <?php generateNavElement(array(10,2,1,0), 'siswa-profilsekolah', './siswa-profilsekolah', 'Profil Sekolah') ?>
      <?php generateNavElement(array(10,2,1,0), 'ekstrakurikuler', './ekstrakurikuler', 'Ekstrakurikuler') ?> 


      <hr class="uk-article-divider">
      <li class="uk-nav-header">Data Pribadi Siswa</li>
      <?php generateNavElement(array(10,2,1,3,0), 'isi-data-pribadi-siswa', './isi-data-pribadi-siswa', 'Isi Data Pribadi Siswa') ?>
      <?php generateNavElement(array(10,2,1,3,0), 'isi-data-pribadi-orangtua', './isi-data-pribadi-orangtua', 'Isi Data Orangtua/ Wali Murid') ?>


      <hr class="uk-article-divider">  
      <li class="uk-nav-header">Data Nilai</li>   
     <?php generateNavElement(array(10), 'nilai', './nilai', 'Nilai') ?>
     <?php generateNavElement(array(1), 'nilai', './guru_nilai', 'Nilai') ?>
     <?php generateNavElement(array(0), 'nilai', './siswa_nilai', 'Nilai Siswa') ?>
    <!--<?php generateNavElement(array(10,1), 'siswa-mapel', './siswa-mapel', 'Materi Pelajaran') ?>-->
     <!-- <?php generateNavElement(array(10,0,2), 'siswa-materi', './siswa-materi', 'Materi Siswa') ?>-->
      <!--<?php generateNavElement(array(10,0,2), 'siswa-tugas', './siswa-tugas', 'Tugas Siswa') ?>-->


      <!--<?php generateNavElement(array(10,1), 'semester', './semester', 'Semester') ?>  
     <!-- <?php generateNavElement(array(10,1), 'siswa-lihatguru', './siswa-lihatguru', 'Daftar Guru') ?>-->

    <!--  <?php generateNavElement(array(10,1), 'materi-guru', './materi-guru', 'Materi') ?>-->
    <!--  <?php generateNavElement(array(10,1), 'tugas-guru', './tugas-guru', 'Tugas') ?>-->
      <!--<?php generateNavElement(array(10,1), 'guru-mengajar', './guru-mengajar', 'Kelas Mengajar') ?>-->
    <!--  <?php generateNavElement(array(10,1), 'guru-materi', './guru-materi', 'Materi Ajar') ?>-->
    <!--  <?php generateNavElement(array(10,1), 'guru-tugas', './guru-tugas', 'Tugas') ?>-->
    <!--  <?php generateNavElement(array(10,1), 'guru-pengumuman', './guru-pengumuman', 'Pengumuman') ?>-->
      <?php// generateNavElement(array(0,1,10), 'name', 'link', 'value') ?>


     <!--  <?php generateNavElement(array(10,2,10,1), 'riwayat-pembayaran', './riwayat-pembayaran', 'Riwayat Pembayaran') ?>-->
     <!--  <?php generateNavElement(array(10,1), 'tagihan-pembayaran', './tagihan-pembayaran', 'Tagihan Pembayaran') ?>-->
      
     <!--  <?php generateNavElement(array(10,2,10,1), 'riwayat-pembayaran', './riwayat-pembayaran', 'Riwayat Pembayaran') ?>-->
      <!-- <?php generateNavElement(array(10,1), 'tagihan-pembayaran', './tagihan-pembayaran', 'Tagihan Pembayaran') ?>-->
      <li class="uk-nav-divider"></li>



      <li><a href="./logout">Keluar</a></li>
    </ul>
    
    <?php
  }
