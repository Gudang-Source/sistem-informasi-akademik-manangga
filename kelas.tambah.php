<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

/*template control*/
$ui_register_page     = 'kelas';
$ui_register_assets   = array('datepicker');

/*load header*/
loadAssetsHead('Tambah Data Kelas');

/*form processing*/
if (isset ($_POST["kelas_simpan"])) { 

    // baca variabel
    

 

    $nm_kelas     = $_POST['nm_kelas'];
    $nm_kelas     = str_replace("", "&acute;", $nm_kelas);
    $nm_kelas     = strtoupper($nm_kelas);

   $kd_kelas     = strtoupper(str_replace("  ", "-", $nm_kelas));
    $kd_kelas     = strtoupper(str_replace(" ", "-", $nm_kelas));

    // validation form kosong
   $pesanError= array();
  if (trim($nm_kelas)=="") {
    $pesanError[]="Data <b>Nama Kelas</b> Masih Kosong.";
  }

    // validasi kode kelas pada database
  $cekSql ="SELECT * FROM kelas WHERE nm_kelas='$nm_kelas'";
  $cekQry = mysql_query($cekSql) or die("Error Query:".mysql_error());
  if (mysql_num_rows($cekQry)>=1) {
    $pesanError[]= "Maaf, kelas <b>$nm_kelas</b> Sudah Ada, ganti dengan nama lain";
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
  $querytambahkelas = mysql_query("INSERT INTO kelas (kd_kelas, nm_kelas) 
    VALUES ( '$kd_kelas' , '$nm_kelas' )") or die(mysql_error());

  if ($querytambahkelas){
    header('location: ./kelas');
  }
 }
}

    // simpan pada form, dan jika form belum terisi
  $datakodekelas  = isset($_POST['kd_kelas']) ? $_POST['kd_kelas'] : '';
  $datanamakelas  = isset($_POST['nm_kelas']) ? $_POST['nm_kelas'] : '';

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
          <h1 class="uk-article-title">Kelas <span class="uk-text-large">{ Tambah Data Kelas }</span></h1>
          <br>
          <a href="./kelas" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Kelas"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
             <form id="formkelas" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
        
        
          


        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_kelas">Nama Kelas<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nm_kelas" name="nm_kelas" value="<?php echo $datanamakelas; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

        <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" id="kelas_simpan" name="kelas_simpan" class="btn btn-success">Submit</button>
       </div>
     </form>    
</div>
</div>
</div>
</article>
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
