<!-- user login -->
<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));

// TEMPLATE CONTROL
$ui_register_page     = 'mengajar';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Update Data Mengajar');

//LOAD DATA
if (isset($_POST['mengajar_simpan'])) {

  #baca variabel
    $kd_mapel     = $_POST['kd_mapel'];
    $nip     = $_POST['nip'];
    $nip     = str_replace("", "&acute;", $nip);
    $kd_kelas     = $_POST['kd_kelas'];

  #validasi form kosong
   $pesanError= array();
  if (trim($kd_mapel)=="") {
    $pesanError[]="Data <b>Kode Mengajar</b> Masih Kosong.";
  }
  if (trim($nip)=="") {
    $pesanError[]="Data <b>Nama Mengajar</b> Masih Kosong.";
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
  foreach ($kd_kelas as $c) {
    $query = mysql_query("UPDATE mengajar SET kd_mengajar='', nip='$nip' , kd_mapel='$kd_mapel' , kd_kelas='$c' WHERE kd_mengajar='$_GET[id]'") or die(mysql_error());
}
   if ($query){
    header('location: ./mengajar');
  }
} 

}
# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
$edit = mysql_query("SELECT * FROM mengajar WHERE kd_mengajar='$_GET[id]'");
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
          <h1 class="uk-article-title">Mengajar <span class="uk-text-large">{ Edit Mengajar }</span></h1>
          <br>
          <a href="./mengajar" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Guru Mengajar"><i class="uk-icon-angle-left"></i> Kembali</a>

            <form id="formkelas" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

<div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nip">Pilih Guru<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="nip" id="nip" value="" class="form-control col-md-7 col-xs-12">
              <option value="">--- Guru --</option>
         <?php
                      //MENGAMBIL NAMA PROVINSI YANG DI DATABASE
        $guru =mysql_query("SELECT * FROM guru ORDER BY nip");
        while ($dataguru=mysql_fetch_array($guru)) {
         if ($dataguru['nip']==$rowks['nip']) {
           $cek ="selected";
         }
         else{
          $cek= "";
        }
        echo "<option value=\"$dataguru[nip]\" $cek>$dataguru[nm_guru]</option>\n";
      }
      ?>
            </select>
          </div>
        </div>
<div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_mapel">Pilih Mapel<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="kd_mapel"  id="kd_mapel" value="<?php echo $rowks['kd_mapel'];?>" class="form-control col-md-7 col-xs-12">
              <option value="">--- Mapel --</option>
               <?php
                      //MENGAMBIL NAMA PROVINSI YANG DI DATABASE
        $mapel =mysql_query("SELECT * FROM mapel ORDER BY kd_mapel");
        while ($datamapel=mysql_fetch_array($mapel)) {
         if ($datamapel['kd_mapel']==$rowks['kd_mapel']) {
           $cek ="selected";
         }
         else{
          $cek= "";
        }
        echo "<option value=\"$datamapel[kd_mapel]\" $cek>$datamapel[nm_mapel]</option>\n";
      }
      ?>
            </select>
          </div>
        </div>

        <div class="item form-group">
      <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_kelas">Pilih Kelas yang Diampu <span class="required" >*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="select">
         <label>
             <?php
                $querys = "SELECT * FROM kelas";
                $hasils = mysql_query($querys);
               
                while ($datas = mysql_fetch_array($hasils))
                {
                  echo "<p><br><input type='checkbox' class='flat-red' id='kd_kelas' value='".$datas['kd_kelas']."' name='kd_kelas[]'/>
                  <label for='kd_kelas'>".$datas['nm_kelas']."</label></p>";
                }?>
      </div>
</div>
    <div style="text-align:center" class="form-actions no-margin-bottom">
     <button type="submit" id="mengajar_simpan" name="mengajar_simpan" class="btn btn-success">Submit</button>
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
