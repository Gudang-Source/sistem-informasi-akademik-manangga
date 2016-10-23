<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

/*template control*/
$ui_register_page     = 'tahun-ajaran';
$ui_register_assets   = array('datepicker');

/*load header*/
loadAssetsHead('Tambah Master Data Tahun Pelajaran');

/*form processing*/
if (isset ($_POST["tahun_simpan"])) { 

    // baca variabel

    $thn_ajaran     = $_POST['thn_ajaran'];
    $thn_ajaran     = str_replace("", "&acute;", $thn_ajaran);
    $thn_ajaran     = ucwords(strtolower($thn_ajaran));

    $semester     = $_POST['semester'];

    // validation form kosong
   $pesanError= array();
  if (trim($thn_ajaran)=="") {
    $pesanError[]="Data <b>Nama Tahun Pelajaran</b> Masih Kosong.";
  }
  if (trim($semester)=="") {
    $pesanError[]="Data <b>Semester</b> Masih Kosong.";
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
  $querytambahtahun = mysql_query("INSERT INTO tahun_ajaran (thn_ajaran, semester) 
    VALUES ('$thn_ajaran' , '$semester' )") or die(mysql_error());

  if ($querytambahtahun){
    header('location: ./tahun-ajaran');
  }
 }
}

    // simpan pada form, dan jika form belum terisi
  $datanamatahunajaran = isset($_POST['thn_ajaran']) ? $_POST['thn_ajaran'] : '';
  $datasemester  = isset($_POST['semester']) ? $_POST['semester'] : '';

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
          <h1 class="uk-article-title">Tahun Pelajaran <span class="uk-text-large">{ Tambah Data Tahun Pelajaran }</span></h1>
          <br>
          <a href="./tahun-ajaran" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Tahun Pelajaran"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
             <form id="formtahun" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
        
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="thn_ajaran">Tahun Pelajaran<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="thn_ajaran" name="thn_ajaran" value="<?php echo $datanamatahunajaran; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

      <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="semester">Semester<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="semester" id="semester" value="<?php echo $datasemester; ?>" class="form-control col-md-7 col-xs-12">
              <option value="">--- Semester --</option>
              <option value="Ganjil">Ganjil</option>
              <option value="Genap">Genap</option>
            </select>
          </div>
        </div>

        <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" id="tahun_simpan" name="tahun_simpan" class="btn btn-success">Submit</button>
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
 var formtahun = $("#formtahun").serialize();
 var validator = $("#formtahun").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "glyphicon glyphicon-ok",
    invalid: "glyphicon glyphicon-remove", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
    thn_ajaran : {
     validators: {
      notEmpty: {
       message: 'Harus Isi Tahun Pelajaran'
     },
    
   }
 }, 
semester: {
  message: 'Nama Semester Tidak Benar',
  validators: {
    notEmpty: {
      message: 'Nama Semester Harus Diisi'
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
