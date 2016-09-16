<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

/*template control*/
$ui_register_page     = 'siswa';
$ui_register_assets   = array('datepicker');

/*load header*/
loadAssetsHead('Tambah Data Siswa');

/*form processing*/
if (isset ($_POST["siswa_simpan"])) { 

    // baca variabel
    
    $nis     = $_POST['nis'];
    $nis     = str_replace("", "&acute;", $nis);

    $password     = $_POST['password'];

    $nm_siswa     = $_POST['nm_siswa'];
    $nm_siswa     = str_replace("", "&acute;", $nm_siswa);
    $nm_siswa     = ucwords(strtolower($nm_siswa));

    $tmpt_lahir     = $_POST['tmpt_lahir'];
    $date_tgl_lahir = $_POST['date_tgl_lahir'];
    $jns_kelamin     = $_POST['jns_kelamin'];
    $agama     = $_POST['agama'];
    $alamat     = $_POST['alamat'];
    $email     = $_POST['email'];
    $telp     = $_POST['telp'];
    $kd_kelas    = $_POST['kd_kelas'];
    $id_user =3;

    // validation form kosong
   $pesanError= array();
  if (trim($nis)=="nis") {
    $pesanError[]="Data <b>NIS</b> Masih Kosong.";
  }
  if (trim($password)=="password") {
    $pesanError[]="Data <b>Password</b> Masih Kosong.";
  }
  if (trim($nm_siswa)=="nm_siswa") {
    $pesanError[]="Data <b>Nama Siswa</b> Masih Kosong.";
  }
  if (trim($tmpt_lahir)=="tmpt_lahir") {
    $pesanError[]="Data <b>Tempat Lahir</b> Masih Kosong.";
  }
  if (trim($date_tgl_lahir)=="date_tgl_lahir") {
    $pesanError[]="Data <b>Tanggal Lahir</b> Masih Kosong.";
  }
    if (trim($jns_kelamin)=="jns_kelamin") {
    $pesanError[]="Data <b>Jenis Kelamin</b> Masih Kosong.";
  }
    if (trim($agama)=="agama") {
    $pesanError[]="Data <b>Agama</b> Masih Kosong.";
  }
    if (trim($alamat)=="alamat") {
    $pesanError[]="Data <b>Alamat</b> Masih Kosong.";
  }
    if (trim($email)=="email") {
    $pesanError[]="Data <b>Email</b> Masih Kosong.";
  }
    if (trim($telp)=="telp") {
    $pesanError[]="Data <b>Nomor Telepon</b> Masih Kosong.";
  }
    if (trim($kd_kelas)=="kd_kelas") {
    $pesanError[]="Data <b>Kode Kelas</b> Masih Kosong.";
  }

    // validasi kode kelas pada database
  $cekSql ="SELECT * FROM siswa WHERE nis='$nis'";
  $cekQry = mysql_query($cekSql) or die("Error Query:".mysql_error());
  if (mysql_num_rows($cekQry)>=1) {
    $pesanError[]= "Maaf, siswa dengan NIS <b>$nis</b> Sudah Ada, ganti dengan nama lain";
  }

$id=isset($_GET['kd_kelas'])?$_GET['kd_kelas']:'';
$sql_var="select * from kelas where kd_kelas= '$id'";
$hasil=mysql_query($sql_var);
$data=mysql_fetch_array($hasil);

    // jika ada error dari validasi form
     if (count($pesanError)>=1) {
    echo "<div class='mssgBox'>";
    echo "<img src ='../images/attention.png'><br><hr>";
    $noPesan= 0;
    foreach ($pesanError as $indeks => $pesan_tampil) {
      $noPesan++;
      echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
     }
    echo "</div><br />";
    }

    else{

    // simpan ke database
  $querytambahsiswa = mysql_query("INSERT INTO siswa (nis, id_user, password, nm_siswa, tmpt_lahir, date_tgl_lahir, jns_kelamin, agama, alamat, email, telp, kd_kelas) 
    VALUES ( '$nis' , '$id_user' , '$password' , '$nm_siswa' , '$tmpt_lahir' , '$date_tgl_lahir' , '$jns_kelamin' , '$agama' , '$alamat' , '$email' , '$telp' , '$kd_kelas')") or die(mysql_error());

  if ($querytambahsiswa){
    header('location: ./siswa');
  }
 }
}



    // simpan pada form, dan jika form belum terisi
  $datanis  = isset($_POST['nis']) ? $_POST['nis'] : '';
  $datapassword  = isset($_POST['password']) ? $_POST['password'] : '';
  $datanamasiswa  = isset($_POST['nm_siswa']) ? $_POST['nm_siswa'] : '';
  $datatempatlahir  = isset($_POST['tmpt_lahir']) ? $_POST['tmpt_lahir'] : '';
  $datatanggallahir  = isset($_POST['date_tgl_lahir']) ? $_POST['date_tgl_lahir'] : '';
  $datajeniskelamin  = isset($_POST['jns_kelamin']) ? $_POST['jns_kelamin'] : '';
  $dataagama  = isset($_POST['agama']) ? $_POST['agama'] : '';
  $dataalamat  = isset($_POST['alamat']) ? $_POST['alamat'] : '';
  $dataemail  = isset($_POST['email']) ? $_POST['email'] : '';
  $datatelp  = isset($_POST['telp']) ? $_POST['telp'] : '';
  $datakodekelas  = isset($_POST['kd_kelas']) ? $_POST['kd_kelas'] : '';
?>

<body>

  <?php
  // LOAD MAIN MENU
  loadMainMenu();
  ?>

  <div class="uk-container uk-container-center uk-margin-large-top">
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match>
      <div class="uk-width-medium-1-6 uk-hidden-small">
        <?php loadSidebar() ?>
      </div>
      <div class="uk-width-medium-5-6 tm-article-side">
        <article class="uk-article">
          <div class="uk-vertical-align uk-text-right uk-height-1-1">
            <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="E-Learning" title="E-Learning">
          </div>
          <hr class="uk-article-divider">
          <h1 class="uk-article-title">Siswa <span class="uk-text-large">{ Tambah Master Data Siswa }</span></h1>
          <br>
          <a href="./siswa" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Siswa"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->

          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
             <form id="formsiswa" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
         
         <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">NIS<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nis" name="nis" value="<?php echo $datanis; ?>" required="required" class="form-control col-md-7 col-xs-12">
            <div class="reg-info">Contoh: 55550. Wajib Diisi (Digunakan sebagai username untuk login)</div>
          </div>
          </div>

         <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nip">Password<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="password" name="password" value="<?php echo $datapassword; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
          </div>

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_siswa">Nama Siswa<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nm_siswa" name="nm_siswa" value="<?php echo $datanamasiswa; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tmpt_lahir">Tempat Lahir<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="tmpt_lahir" name="tmpt_lahir" value="<?php echo $datatempatlahir; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

       <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_tgl_lahir">Tanggal Lahir<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="date_tgl_lahir" name="date_tgl_lahir" value="<?php echo $datatanggallahir; ?>" required="required" class="form-control col-md-7 col-xs-12" data-uk-datepicker="{format:'YYYY/DD/MM'}" >
            <div class="reg-info">Format: <code>TTTT/HH/BB</code></div>
            <div class="reg-info">Contoh: 1995/31/12</div>
          </div>
       </div>

      <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jns_kelamin">Jenis Kelamin<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="jns_kelamin" id="jns_kelamin" value="<?php echo $datajeniskelamin; ?>" class="form-control col-md-7 col-xs-12">
              <option value="">--- Pilih Jenis Kelamin --</option>
              <option value="Laki-Laki">Laki-Laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
        </div>

      <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="agama">Agama<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="agama" id="agama" value="<?php echo $dataagama; ?>" class="form-control col-md-7 col-xs-12">
              <option value="">--- Pilih agama yang dianut --</option>
              <option value="Islam">Islam</option>
              <option value="Kristen Protestan">Kristen Protestan</option>
              <option value="Kristen Katholik">Kristen Katholik</option>
              <option value="Hindu">Hindu</option>
              <option value="Buddha">Buddha</option>
              <option value="Konghuchu">Konghuchu</option>
            </select>
          </div>
        </div>

       

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat Rumah<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="alamat" name="alamat" value="<?php echo $dataalamat; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

         <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="email" name="email" value="<?php echo $dataemail; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
       </div>

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telp">Nomor Telepon<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="telp" name="telp" value="<?php echo $datatelp; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
       </div>

     <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_kelas">Kelas<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="kd_kelas" id="kd_kelas" value="<?php echo $datakodekelas; ?>" class="form-control col-md-7 col-xs-12">
              <option value="">--- Pilih Kelas Siswa --</option>
              <?php
              $query = "SELECT * from kelas";
              $hasil = mysql_query($query);
              while ($data = mysql_fetch_array($hasil))
              {
                echo "<option value=".$data['kd_kelas'].">".$data['nm_kelas']."</option>";
              }
              ?>
            </select>
          </div>
        </div>

        

         <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" id="siswa_simpan" name="siswa_simpan" class="btn btn-success">Submit</button>
       </div>
     </form>    
</div>
</div>
</div>

<script src="assets/validator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/vendor/formvalidation/css/formValidation.min.css">
<link rel="stylesheet" href="/asset/css/demo.css">
<script src="/vendor/formvalidation/js/formValidation.min.js"></script>
<script src="/vendor/formvalidation/js/framework/uikit.min.js"></script>

<script type="text/javascript">
 var formsiswa = $("#formsiswa").serialize();
 var validator = $("#formsiswa").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "glyphicon glyphicon-ok",
    invalid: "glyphicon glyphicon-remove", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
    nis : {
     validators: {
      notEmpty: {
       message: 'Harus Isi NIS'
     },
     remote: {
      type: 'POST',
      url: 'remote/remote_siswa.php',
      message: 'Nama Kelas Telah Tersedia'
    },
   }
 }, 


}
});
</script>

</body>

<?php
// LOAD FOOTER
loadAssetsFoot();

ob_end_flush();
?>
