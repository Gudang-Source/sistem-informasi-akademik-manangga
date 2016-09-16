<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

/*template control*/
$ui_register_page     = 'guru';
$ui_register_assets   = array('datepicker');

/*load header*/
loadAssetsHead('Tambah Master Data guru');

/*form processing*/
if (isset ($_POST["guru_simpan"])) { 

    // baca variabel
    
  $nip  = $_POST['nip'];
  $password  = $_POST['password'];
  $nm_guru  = $_POST['nm_guru'];
  $tmpt_lahir  = $_POST['tmpt_lahir'];
  $date_tgl_lahir  = $_POST['date_tgl_lahir'];
  $jns_kelamin  = $_POST['jns_kelamin'];
  $agama  = $_POST['agama'];
  $almt_sekarang = $_POST['almt_sekarang'];
  $no_hp  = $_POST['no_hp'];
  $email  = $_POST['email'];
  $id_user =2;

    // validation form kosong
   $pesanError= array();
  if (trim($nip)=="") {
    $pesanError[]="Data <b>NIP</b> masih kosong.";
  }
   if (trim($password)=="") {
    $pesanError[]="Data <b>Password</b> masih kosong.";
  }
  if (trim($nm_guru)=="") {
    $pesanError[]="Data <b>Nama Gru</b> masih kosong.";
  }
   if (trim($tmpt_lahir)=="") {
    $pesanError[]="Data <b>Tempat Lahir</b> masih kosong.";
  }
    if (trim($date_tgl_lahir)=="") {
    $pesanError[]="Data <b>Tanggal Lahir</b> masih kosong.";
  }
    if (trim($jns_kelamin)=="") {
    $pesanError[]="Data <b>Jenis Kelamin</b> masih kosong.";
  }
    if (trim($agama)=="") {
    $pesanError[]="Data <b>Agama</b> masih kosong.";
  }
   if (trim($almt_sekarang)=="") {
    $pesanError[]="Data <b>Alamat Sekarang</b> masih kosong.";
  }
      if (trim($no_hp)=="") {
    $pesanError[]="Data <b>Nomor HP</b> masih kosong.";
  }
      if (trim($email)=="") {
    $pesanError[]="Data <b>Email</b> masih kosong.";
  }
   
    // validasi nip pada database
  $cekSql ="SELECT * FROM guru WHERE nip='$nip'";
  $cekQry = mysql_query($cekSql) or die("Error Query:".mysql_error());
  if (mysql_num_rows($cekQry)>=1) {
    $pesanError[]= "Maaf, NIP dengan nomor <b>$nip</b> telah ada di database. Gantilah dengan NIP lain.";
  }

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
  $querytambahguru = mysql_query("INSERT INTO guru (nip, id_user, password, nm_guru, tmpt_lahir, date_tgl_lahir, jns_kelamin, agama, almt_sekarang, no_hp, email) 
    VALUES ( '$nip', '$id_user', '$password', '$nm_guru', '$tmpt_lahir', '$date_tgl_lahir', '$jns_kelamin', '$agama', '$almt_sekarang', '$no_hp', '$email' )") or die(mysql_error());

  if ($querytambahguru){
    header('location: ./guru');
  }
 }
}

    // simpan pada form, dan jika form belum terisi
  $datanip  = isset($_POST['nip']) ? $_POST['nip'] : '';
  $datapassword  = isset($_POST['password']) ? $_POST['password'] : '';
  $datanamaguru  = isset($_POST['nm_guru']) ? $_POST['nm_guru'] : '';
  $datatempatlahir  = isset($_POST['tmpt_lahir']) ? $_POST['tmpt_lahir'] : '';
  $datatanggallahir  = isset($_POST['date_tgl_lahir']) ? $_POST['date_tgl_lahir'] : '';
  $datajeniskelamin  = isset($_POST['jns_kelamin']) ? $_POST['jns_kelamin'] : '';
  $dataagama  = isset($_POST['agama']) ? $_POST['agama'] : '';
  $dataalamat  = isset($_POST['almt_sekarang']) ? $_POST['almt_sekarang'] : '';
  $datanohp  = isset($_POST['no_hp']) ? $_POST['no_hp'] : '';
  $dataemail  = isset($_POST['email']) ? $_POST['email'] : '';

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
          <h1 class="uk-article-title">Guru<span class="uk-text-large">{ Tambah Naster Data Guru }</span></h1>
          <br>
          <a href="./guru" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Guru"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
             <form id="formguru" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
        
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nip">NIP<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nip" name="nip" value="<?php echo $datanip; ?>" required="required" class="form-control col-md-7 col-xs-12">
            <div class="reg-info">Contoh: 126500182411. Jumlah minimal 18 angka. Wajib Diisi (Digunakan sebagai username untuk login)</div>
          </div>
        </div>

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_guru">Nama Guru<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nm_guru" name="nm_guru" value="<?php echo $datanamaguru; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

   <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="password" name="password" value="<?php echo $datapassword; ?>" required="required" class="form-control col-md-7 col-xs-12">
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
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tmpt_lahir">Tempat Lahir<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="tmpt_lahir" name="tmpt_lahir" value="<?php echo $datatempatlahir; ?>" required="required" class="form-control col-md-7 col-xs-12">
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
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="almt_sekarang">Alamat Rumah<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="almt_sekarang" name="almt_sekarang" value="<?php echo $dataalamat; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
       </div>

      <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_hp">No. HP<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="no_hp" name="no_hp" value="<?php echo $datanohp; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
       </div>

         <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="email" name="email" value="<?php echo $dataemail; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
       </div>

        <div class="uk-form-row">
                   <div class="uk-alert">Pastikan semua isian sudah terisi dengan benar !</div>
        </div>
        <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" id="guru_simpan" name="guru_simpan" class="btn btn-success">Submit</button>
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
 var formguru = $("#formguru").serialize();
 var validator = $("#formguru").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "glyphicon glyphicon-ok",
    invalid: "glyphicon glyphicon-remove", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
    nip : {
     validators: {
      notEmpty: {
       message: 'Harus Isi NIP'
     },
     stringLength: {
      min: 1,
      max: 18,
      message: 'NIP minimal 18 angka.'
    },
     remote: {
      type: 'POST',
      url: 'remote/remote_guru.php',
      message: 'NIP Guru Telah Tersedia'
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
