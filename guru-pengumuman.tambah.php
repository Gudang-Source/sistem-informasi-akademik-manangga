<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

/*template control*/
$ui_register_page     = 'pengumuman';
$ui_register_assets   = array('datepicker');

/*load header*/
loadAssetsHead('Tambah Data Pengumuman');

/*form processing*/
if (isset ($_POST["pengumuman_simpan"])) { 

    // baca variabel
  
    $nip                 = $_POST['nip'];
    $judul_pengumuman     = $_POST['judul_pengumuman'];
    $isi                  = $_POST['isi'];


    // validation form kosong
   $pesanError= array();
  if (trim($nip)=="") {
    $pesanError[]="Data <b>NIP</b> Masih Kosong.";
  }
    if (trim($judul_pengumuman)=="") {
    $pesanError[]="Data <b>Judul Pengumuman</b> Masih Kosong.";
  }
    if (trim($isi)=="") {
    $pesanError[]="Data <b>Isi</b> Masih Kosong.";
  }


    // validasi pengumuman pada database
  $cekSql ="SELECT * FROM pengumuman WHERE kd_pengumuman='$kd_pengumuman'";
  $cekQry = mysql_query($cekSql) or die("Error Query:".mysql_error());
  if (mysql_num_rows($cekQry)>=1) {
    $pesanError[]= "Maaf, pengumuman <b>$kd_pengumuman</b> Sudah Ada, ganti dengan nama lain";
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
  $querytambahpengumuman = mysql_query("INSERT INTO pengumuman (nip, judul_pengumuman, isi) 
    VALUES ('$nip' , '$judul_pengumuman' , '$isi')") or die(mysql_error());

  if ($querytambahpengumuman){
    header('location: ./guru-pengumuman');
  }
 }
}

    // simpan pada form, dan jika form belum terisi
  $datanip  = isset($_POST['nip']) ? $_POST['nip'] : '';
  $datajudulpengumuman  = isset($_POST['judul_pengumuman']) ? $_POST['judul_pengumuman'] : '';
  $dataisi  = isset($_POST['isi']) ? $_POST['isi'] : '';

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
          <h1 class="uk-article-title">Pengumuman <span class="uk-text-large">{ Tambah Data Pengumuman }</span></h1>
          <br>
          <a href="./pengumuman" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Pengumuman"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
             <form id="formpengumuman" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">


 <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_kelas">Pilih Guru<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="nip" id="nip" value="<?php echo $datanip; ?>" class="form-control col-md-7 col-xs-12">
              <option value="">--- Guru --</option>
              <?php
              $query = "SELECT * from guru";
              $hasil = mysql_query($query);
              while ($data = mysql_fetch_array($hasil))
              {
                echo "<option value=".$data['nip'].">".$data['nm_guru']."</option>";
              }
              ?>
            </select>
          </div>
        </div>

         <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="judul_pengumuman">Judul Pengumuman<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="judul_pengumuman" name="judul_pengumuman" value="<?php echo $datajudulpengumuman; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

      <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="isi">Isi Pengumuman<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea type="text" id="isi" name="isi" rows="3" value="<?php echo $dataisipengumuman; ?> " required="required" class="form-control col-md-7 col-xs-12"></textarea>
          </div>
        </div>

        <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" id="pengumuman_simpan" name="pengumuman_simpan" class="btn btn-success">Submit</button>
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
 var formkelas = $("#formkelas").serialize();
 var validator = $("#formkelas").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "glyphicon glyphicon-ok",
    invalid: "glyphicon glyphicon-remove", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
    kd_kelas : {
     validators: {
      notEmpty: {
       message: 'Harus Pilih Kelas'
     },
     remote: {
      type: 'POST',
      url: 'remote/remote_kelas.php',
      message: 'Nama Kelas Telah Tersedia'
    },
   }
 }, 
nm_kelas: {
  message: 'Nama Kelas Tidak Benar',
  validators: {
    notEmpty: {
      message: 'Nama Kelas Harus Diisi'
    },
    stringLength: {
      min: 1,
      max: 50,
      message: 'Nama Kelas Harus Lebih dari 1 Huruf dan Maksimal 50 Huruf'
    },
    regexp: {
      regexp: /^[a-zA-Z0-9_ \. ]+$/,
      message: 'Karakter Boleh Digunakan (Angka, Huruf, Titik, Underscore)'
    },
    remote: {
      type: 'POST',
      url: 'remote/remote_namakelas.php',
      message: 'Nama Kelas Telah Tersedia'
    },

  }
}

}
});
</script>

</body>

<?php
// LOAD FOOTER
loadAssetsFoot();

ob_end_flush();
?>
