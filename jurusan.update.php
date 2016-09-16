<!-- user login -->
<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

// TEMPLATE CONTROL
$ui_register_page     = 'jurusan';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Update Data Jurusan');

//LOAD DATA
if (isset($_POST['jurusan_simpan'])) {

  #baca variabel
  $kd_jurusan  = $_POST['kd_jurusan'];
  $kd_jurusan  = str_replace("'","&acute;",$kd_jurusan);
  $kd_jurusan  = ucwords(strtolower($kd_jurusan));

  $nm_jurusan  = $_POST['nm_jurusan'];
  $nm_jurusan  = str_replace("'","&acute;",$nm_jurusan);

  #validasi form kosong
  $pesanError= array();
  if (trim($kd_jurusan)=="") {
    $pesanError[] = "Data <b>kode jurusan</b> tidak boleh kosong !";    
  }
  if (trim($nm_jurusan)=="") {
    $pesanError[]="Data <b>Nama Jurusan</b> Masih kosong !!";
  }
   
  #jika ada pesan error validasi form
  if (count($pesanError)>=1) {
    echo "<div class='mssgBox'>";
    echo "<img src ='/images/attention.png'><br><hr>";
    $noPesan= 0;
    foreach ($pesanError as $indeks => $pesan_tampil) {
      $noPesan++;
      echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
    }
    echo "</div><br />";
  }
  
  else{

  #update data ke database
    $query = mysql_query("UPDATE jurusan SET kd_jurusan='$kd_jurusan', nm_jurusan='$nm_jurusan' WHERE kd_jurusan='$_GET[id]'") or die(mysql_error());

   if ($query){
    header('location: ./jurusan');
  }
}	

}
# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
$edit = mysql_query("SELECT * FROM
  jurusan WHERE kd_jurusan='$_GET[id]'");
$rowks  = mysql_fetch_array($edit);

?>

<!-- Bootstrap core CSS -->

  <link href="assets/admin/paneladmin/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/admin/paneladmin/fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/admin/paneladmin/css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->

  <link rel="stylesheet" type="text/css" href="assets/admin/paneladmin/css/maps/jquery-jvectormap-2.0.3.css" />
  <link href="assets/admin/paneladmin/css/icheck/flat/green.css" rel="stylesheet" />
  <link href="assets/admin/paneladmin/css/floatexamples.css" rel="stylesheet" type="text/css" />


  <script src="assets/admin/paneladmin/js/jquery.min.js"></script>
  <script src="assets/admin/paneladmin/js/nprogress.js"></script>


<body>

  <?php
  // LOAD MAIN MENU
  loadMainMenu();
  ?>

<!-- page content -->
<div class="uk-container uk-container-center uk-margin-large-top">
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match>
      <div class="uk-width-medium-1-6 uk-hidden-small">
        <?php loadSidebar() ?>
      </div>
      <div class="uk-width-medium-5-6 tm-article-side">
        <article class="uk-article">
          <div class="uk-vertical-align uk-text-right uk-height-1-1">
            <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="Sistem Informasi" title="Sistem Informasi">
          </div>
          <hr class="uk-article-divider">
          <h1 class="uk-article-title">Jurusan <span class="uk-text-large">{ Tambah Jurusan }</span></h1>
          <br>
          <a href="./jurusan" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Jurusan"><i class="uk-icon-angle-left"></i> Kembali</a>

            <form id="formjurusan" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

      <div class="item form-group">
       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_jurusan">Kode Jurusan <span class="required">*</span>
       </label>
       <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="kd_jurusan" name="kd_jurusan" value="<?php echo $rowks['kd_jurusan'];?>" required="required" class="form-control col-md-7 col-xs-12">
      </div>
    </div>

    <div class="item form-group">
       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_jurusan">Nama Jurusan <span class="required">*</span>
       </label>
       <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="nm_jurusan" name="nm_jurusan" value="<?php echo $rowks['nm_jurusan'];?>" required="required" class="form-control col-md-7 col-xs-12">
      </div>
    </div>
    <div style="text-align:center" class="form-actions no-margin-bottom">
     <button type="submit" id="jurusan_simpan" name="jurusan_simpan" class="btn btn-success">Submit</button>
   </div>
 </form>
</div>
</div>
</div>
</div>
</div>


 
</body>

<script type="text/javascript">


 var formkabupaten = $("#formjurusan").serialize();
 var validator = $("#formjurusan").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "glyphicon glyphicon-ok",
    invalid: "glyphicon glyphicon-remove", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
    kd_jurusan : {
     validators: {
      notEmpty: {
       message: 'Harus Pilih Provinsi'
     }
     remote: {
      type: 'POST',
      url: 'remote/remote_jurusan.php',
      message: 'Kode Jurusan Sudah Tersedia'
    }
   }
 },  
nm_jurusan: {
  message: 'Nama kabupaten Tidak Benar',
  validators: {
    notEmpty: {
      message: 'Nama kabupaten Harus Diisi'
    },
    stringLength: {
      min: 1,
      max: 30,
      message: 'Nama kabupaten Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
    },
    regexp: {
       regexp: /^[a-zA-Z0-9_ \. ]+$/,
      message: 'Karakter Yang Boleh Digunakan (Angka, Huruf, Titik, Underscore'
    },
    remote: {
    type: 'POST',
    url: 'remote/remote_namajurusan.php',
    message: 'Nama Jurusan Sudah Tersedia'
    }
  }
}

}
});

</script>


<?

// LOAD FOOTER
loadAssetsFoot($scripts);

ob_end_flush();
?>