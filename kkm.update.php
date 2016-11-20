<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

// TEMPLATE CONTROL
$ui_register_page     = 'kkm';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Update Data Mata Pelajaran');

//LOAD DATA
if (isset($_POST['kkm_simpan'])) {

  #baca variabel
  $kd_kkm     = $_POST['kd_kkm'];
  $kd_kkm     = str_replace("", "&acute;", $kd_kkm);
  $kd_kkm     = ucwords(strtolower($kd_kkm));

  $nm_kkm     = $_POST['nm_kkm'];
  $nm_kkm     = str_replace("", "&acute;", $nm_kkm);

  #validasi form kosong
   $pesanError= array();
  if (trim($kd_kkm)=="") {
    $pesanError[]="Data <b>Kode Mata Pelajaran</b> Masih Kosong.";
  }
  if (trim($nm_kkm)=="") {
    $pesanError[]="Data <b>Nama Mata Pelajaran</b> Masih Kosong.";
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
    $query = mysql_query("UPDATE kkm SET id_kkm='$id_kkm', nm_kkm='$nm_kkm' WHERE id_kkm='$_GET[id]'") or die(mysql_error());

   if ($query){
    header('location: ./kkm');
  }
} 

}

# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
$edit = mysql_query("SELECT * FROM kkm INNER JOIN mapel ON mapel.kd_mapel=kkm.kd_mapel WHERE id_kkm='$_GET[id]'");
$rowks  = mysql_fetch_array($edit);

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
          <h1 class="uk-article-title">Kriteria Kelulusan Minimal <span class="uk-text-large">{ Edit Kriteria Kelulusan Minimal }</span></h1>
          <br>
          <a href="./kkm" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Kriteria Kelulusan Minimal"><i class="uk-icon-angle-left"></i> Kembali</a>

            <form id="formkkm" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

       <tr>
     <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_mapel">Pilih Mata Pelajaran<span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <select  name="kd_mapel" id="kd_mapel" value="" class="form-control col-md-7 col-xs-12">
          <option value="">--- Pilih Mata Pelajaran --</option>
          <?php
          $mapel=mysql_query("SELECT * FROM mapel ORDER BY kd_mapel");
          while ($datakodemapel=mysql_fetch_array($mapel)) {
           if ($datakodemapel['kd_mapel']==$rowks['kd_mapel']) {
             $cek ="selected";
           }
           else{
            $cek= "";
          }
          echo "<option value=\"$datakodemapel[kd_mapel]\" $cek>$datakodemapel[nm_mapel]</option>\n";
        }
        ?>
      </select>
    </div>
  </div>


      <div class="item form-group">
       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kkm">Kriteria Kelulusan Minimal (KKM) <span class="required">*</span>
       </label>
       <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="kkm" name="kkm" value="<?php echo $rowks['kkm'];?>" required="required" class="form-control col-md-7 col-xs-12">
      </div>
    </div>

    <div style="text-align:center" class="form-actions no-margin-bottom">
     <button type="submit" id="kkm_simpan" name="kkm_simpan" class="btn btn-success">Submit</button>
   </div>
 </form>
</div>

<script src="assets/validator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/vendor/formvalidation/css/formValidation.min.css">
<link rel="stylesheet" href="/asset/css/demo.css">
<script src="/vendor/formvalidation/js/formValidation.min.js"></script>
<script src="/vendor/formvalidation/js/framework/uikit.min.js"></script>

<script type="text/javascript">
 var formkkm = $("#formkkm").serialize();
 var validator = $("#formkkm").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "glyphicon glyphicon-ok",
    invalid: "glyphicon glyphicon-remove", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
    kd_kkm : {
     validators: {
      notEmpty: {
       message: 'Harus Pilih Mata Pelajaran'
     },

   }
 }, 
nm_kkm: {
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
