<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

/*template control*/
$ui_register_page     = 'mapel';
$ui_register_assets   = array('datepicker');

/*load header*/
loadAssetsHead('Tambah Data Master Mata Pelajaran');

/*form processing*/
if (isset ($_POST["mapel_simpan"])) { 

    // baca variabel
    
    $kd_mapel     = $_POST['kd_mapel'];
    $kd_mapel     = str_replace("", "&acute;", $kd_mapel);

    $nm_mapel     = $_POST['nm_mapel'];
    $nm_mapel     = str_replace("", "&acute;", $nm_mapel);
    $nm_mapel     = ucwords(strtolower($nm_mapel));


    // validation form kosong
   $pesanError= array();
  if (trim($kd_mapel)=="") {
    $pesanError[]="Data <b>Kode Mata Pelajaran</b> Masih Kosong.";
  }
  if (trim($nm_mapel)=="") {
    $pesanError[]="Data <b>Nama Mata Pelajaran</b> Masih Kosong.";
  }


    // validasi kode mapel pada database
  $cekSql ="SELECT * FROM mapel WHERE kd_mapel='$kd_mapel'";
  $cekQry = mysql_query($cekSql) or die("Error Query:".mysql_error());
  if (mysql_num_rows($cekQry)>=1) {
    $pesanError[]= "Maaf, kode mata pelajaran <b>$kd_mapel</b> sudah ada di database. Gantilah dengan kode lain.";
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
  $querytambahmapel = mysql_query("INSERT INTO mapel (kd_mapel, nm_mapel) 
    VALUES ( '$kd_mapel' , '$nm_mapel' )") or die(mysql_error());

  if ($querytambahmapel){
    header('location: ./mapel');
  }
 }
}

    // simpan pada form, dan jika form belum terisi
  $datakodemapel  = isset($_POST['kd_mapel']) ? $_POST['kd_mapel'] : '';
  $datanamamapel  = isset($_POST['nm_mapel']) ? $_POST['nm_mapel'] : '';
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
          <h1 class="uk-article-title">Mata Pelajaran <span class="uk-text-large">{ Tambah Master Data Mata Pelajaran }</span></h1>
          <br>
          <a href="./mapel" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Master Mata Pelajaran"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
             <form id="formmapel" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
        
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_mapel">Kode Mapel<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="kd_mapel" name="kd_mapel" value="<?php echo $datakodemapel; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>


        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_mapel">Nama Mata Pelajaran<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nm_mapel" name="nm_mapel" value="<?php echo $datanamamapel; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

        <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" id="mapel_simpan" name="mapel_simpan" class="btn btn-success">Submit</button>
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
 var formmapel = $("#formmapel").serialize();
 var validator = $("#formmapel").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "glyphicon glyphicon-ok",
    invalid: "glyphicon glyphicon-remove", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
    kd_mapel : {
     validators: {
      notEmpty: {
       message: 'Harus Pilih Mata Pelajaran'
     },
     remote: {
      type: 'POST',
      url: 'remote/remote_mapel.php',
      message: 'Nama Mata Pelajaran Telah Tersedia'
    },
   }
 }, 
nm_mapel: {
  message: 'Nama Mata Pelajaran Tidak Benar',
  validators: {
    notEmpty: {
      message: 'Nama Mata Pelajaran Harus Diisi'
    },
    stringLength: {
      min: 1,
      max: 30,
      message: 'Nama Mata Pelajaran Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
    },
    regexp: {
      regexp: /^[a-zA-Z0-9_ \. ]+$/,
      message: 'Karakter Boleh Digunakan (Angka, Huruf, Titik, Underscore)'
    },
    remote: {
      type: 'POST',
      url: 'remote/remote_namamapel.php',
      message: 'Nama Mata Pelajaran Telah Tersedia'
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
