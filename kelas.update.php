<!-- user login -->
<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));

// TEMPLATE CONTROL
$ui_register_page     = 'kelas';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Update Data Kelas');

//LOAD DATA
if (isset($_POST['kelas_simpan'])) {

  #baca variabel

    $nm_kelas     = $_POST['nm_kelas'];
    $nm_kelas     = str_replace("", "&acute;", $nm_kelas);
    $nm_kelas     = strtoupper($nm_kelas);

    $kd_kelas     = strtoupper(str_replace("  ", "-", $nm_kelas));
    $kd_kelas     = strtoupper(str_replace(" ", "-", $nm_kelas));

    $id_guru     = $_POST['id_guru'];
    $id_guru      = str_replace("", "&acute;", $id_guru);
    $id_guru      = strtoupper($id_guru);


  #validasi form kosong
$pesanError= array();
if (trim($nm_kelas)=="") {
    $pesanError[]="Data <b>Nama Kelas</b> Masih Kosong.";
  }
if (trim($id_guru)=="") {
    $pesanError[]="Data <b>Wali Kelas</b> Masih Kosong.";
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
    $query = mysql_query("UPDATE kelas SET kd_kelas='$kd_kelas', nm_kelas='$nm_kelas', id_guru='$id_guru' WHERE kd_kelas='$_GET[id]'") or die(mysql_error());

   if ($query){
    header('location: ./kelas');
  }
} 

}
# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
$edit = mysql_query("SELECT * FROM kelas WHERE kd_kelas='$_GET[id]'");
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
          <h1 class="uk-article-title">Kelas <span class="uk-text-large">{ Edit Kelas }</span></h1>
          <br>
          <a href="./kelas" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Kelas"><i class="uk-icon-angle-left"></i> Kembali</a>

            <form id="formkelas" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

      <div class="item form-group">
       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_kelas">Kode Kelas <span class="required">*</span>
       </label>
       <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="kd_kelas" name="kd_kelas" value="<?php echo $rowks['kd_kelas'];?>" required="required" class="form-control col-md-7 col-xs-12">
      </div>
    </div>

    <div class="item form-group">
       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_kelas">Nama Kelas<span class="required">*</span>
       </label>
       <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="nm_kelas" name="nm_kelas" value="<?php echo $rowks['nm_kelas'];?>" required="required" class="form-control col-md-7 col-xs-12">
      </div>
    </div>

         <tr>
            <div class="item form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_guru">Wali Kelas<span class="required">*</span>
             </label>
             <div class="col-md-6 col-sm-6 col-xs-12">
               <select  type="text" class="form-control chzn-select col-md-7 col-xs-12" id="id_guru" name="id_guru" value="" required>
                <option value="">-Pilih Wali Kelas-</option> 
                <?php
                $id_guru =mysql_query("SELECT * FROM kelas ORDER BY id_guru");
                while ($dataidguru=mysql_fetch_array($id_guru)) {
                 if ($dataidguru['id_guru']==$rowks['id_guru']) {
                   $cek ="selected";
                 }
                 else{
                  $cek= "";
                }
                echo "<option value=\"$dataidguru[id_guru]\" $cek>$dataidguru[id_guru]</option>\n";
              }
              ?>
            </select>
          </div>
        </div>
      </tr>


    <div style="text-align:center" class="form-actions no-margin-bottom">
     <button type="submit" id="kelas_simpan" name="kelas_simpan" class="btn btn-success">Submit</button>
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
