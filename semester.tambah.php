<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

/*template control*/
$ui_register_page     = 'semester';
$ui_register_assets   = array('datepicker');

/*load header*/
loadAssetsHead('Tambah Master Data Semester');

/*form processing*/
if (isset ($_POST["semester_simpan"])) { 

    // baca variabel

    $nm_semester     = $_POST['nm_semester'];
    $nm_semester     = str_replace("", "&acute;", $nm_semester);
    $nm_semester     = ucwords(strtolower($nm_semester));

    // validation form kosong
   $pesanError= array();
  if (trim($nm_semester)=="") {
    $pesanError[]="Data <b>Nama Semester</b> Masih Kosong.";
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
  $querytambahsemester = mysql_query("INSERT INTO semester (nm_semester) 
    VALUES ('$nm_semester' )") or die(mysql_error());

  if ($querytambahsemester){
    header('location: ./semester');
  }
 }
}

    // simpan pada form, dan jika form belum terisi
  $datasemester = isset($_POST['nm_semester']) ? $_POST['nm_semester'] : '';

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
            <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="Sistem Informasi Akademik SDN II Manangga" title="Sistem Informasi Akademik SDN II Manangga">
          </div>
          <hr class="uk-article-divider">
          <h1 class="uk-article-title">Semester <span class="uk-text-large">{ Tambah Data Semester }</span></h1>
          <br>
          <a href="./semester" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Tahun Pelajaran"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
            
             <form id="formsemester" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
        
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_semester">Nama Semester<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nm_semester" name="nm_semester" value="<?php echo $datasemester; ?>" required="required" class="form-control col-md-7 col-xs-12">
                      <div class="reg-info">Contoh: Ganjil.</div>
          </div>

        </div>

        <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" id="semester_simpan" name="semester_simpan" class="btn btn-success">Submit</button>
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
