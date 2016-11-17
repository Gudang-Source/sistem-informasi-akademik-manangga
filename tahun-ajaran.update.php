<!-- user login -->
<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));

// TEMPLATE CONTROL
$ui_register_page     = 'tahun_ajaran';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Update Data Tahun Ajaran');

//LOAD DATA
if (isset($_POST['tahun_simpan'])) {

  #baca variabel
    $thn_ajaran     = $_POST['thn_ajaran'];
    $semester     = $_POST['semester'];

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
    $query = mysql_query("UPDATE tahun_ajaran SET thn_ajaran='$thn_ajaran', semester='$semester' WHERE thn_ajaran='$_GET[id]'") or die(mysql_error());

   if ($query){
    header('location: ./tahun-ajaran');
  }
} 

}
  $datatahunpelajaran  = isset($_POST['thn_ajaran']) ? $_POST['thn_ajaran'] : '';
  $datasemester  = isset($_POST['semester']) ? $_POST['semester'] : '';

# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
$edit = mysql_query("SELECT * FROM tahun_ajaran WHERE id_tahun='$_GET[id]'");
$rowks  = mysql_fetch_array($edit);

?>

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
            <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="E-Learning" title="E-Learning">
          </div>
          <hr class="uk-article-divider">
          <h1 class="uk-article-title">Tahun Ajaran <span class="uk-text-large">{ Edit Tahun Ajaran }</span></h1>
          <br>
          <a href="./tahun-ajaran" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Tahun Ajaran"><i class="uk-icon-angle-left"></i> Kembali</a>

            <form id="formtahunajaran" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="thn_ajaran">Tahun Ajaran<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="thn_ajaran" name="thn_ajaran" value="<?php echo $rowks['thn_ajaran'];?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

       <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="semester">Semester<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
                 <select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="semester" name="semester" value="" required>
        <?php
                      //MENGAMBIL NAMA PROVINSI YANG DI DATABASE

         if ($rowks['semester']=="Ganjil") {
        ?>
              <option value="Ganjil" selected>Ganjil</option>
              <option value="Genap">Genap</option>
        <?php
         }
         else{ ?>
                      <option value="Genap" selected>Genap</option>
                       <option value="Ganjil" >Ganjil</option>
                      
  <?php     }
        
      ?>
    </select>
          </div>
        </div>


    <div style="text-align:center" class="form-actions no-margin-bottom">
     <button type="submit" id="tahun_simpan" name="tahun_simpan" class="btn btn-success">Submit</button>
   </div>
 </form>
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
       message: 'Harus Isi Kode Kelas'
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
      max: 30,
      message: 'Nama Kelas Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
    },
    regexp: {
      regexp: /^[a-zA-Z0-9_ \. ]+$/,
      message: 'Karakter Boleh Digunakan (Angka, Huruf, Titik, Underscore)'
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
