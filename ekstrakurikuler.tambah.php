<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

/*template control*/
$ui_register_page     = 'ekstrakurikuler.tambah';
$ui_register_assets   = array('datepicker');

/*load header*/
loadAssetsHead('Tambah Data Master Ekstrakurikuler');

/*form processing*/
if (isset ($_POST["ekstrakurikuler_simpan"])) { 

    // baca variabel
    
    $nm_ekstrakurikuler     = $_POST['nm_ekstrakurikuler'];
    $id_guru                = $_POST['id_guru'];

 //$kd_kelas     = str_replace("", "&acute;", $kd_kelas);
  // validation form kosong
  
   $pesanError= array();
  if (trim($id_ekstrakurikuler)=="") {
    $pesanError[]="Data <b>ID Ekstrakurikuler</b> Masih Kosong.";
  }
  if (trim($nm_ekstrakurikuler)=="") {
    $pesanError[]="Data <b>Nama Ekstrakurikuler</b> Masih Kosong.";
  }
  if (trim($id_guru)=="") {
    $pesanError[]="Data <b>ID Guru</b> Masih Kosong.";
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
      $querytambahekstrakurikuler =  mysql_query("INSERT INTO ekstrakurikuler (nm_ekstrakurikuler, id_guru) VALUES ( '$nm_ekstrakurikuler', '$id_guru' )") or die(mysql_error());
}

    // simpan ke database
    header('location: ./ekstrakurikuler');
 }

    // simpan pada form, dan jika form belum terisi
 $datanamaekstrakurikuler  = isset($_POST['nm_ekstrakurikuler']) ? $_POST['nm_ekstrakurikuler'] : '';
 $dataidguru  = isset($_POST['id_guru']) ? $_POST['id_guru'] : '';
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
          <h1 class="uk-article-title">ekstrakurikuler <span class="uk-text-large">{ Tambah Master Data ekstrakurikuler }</span></h1>
          <br>
          <a href="./ekstrakurikuler" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Master ekstrakurikuler"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
             <form id="formekstrakurikuler" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
        

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_ekstrakurikuler">Nama Ekstrakurikuler<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nm_ekstrakurikuler" name="nm_ekstrakurikuler" value="<?php echo $datanamaekstrakurikuler; ?>" required="required" class="form-control col-md-7 col-xs-12">
          <div class="reg-info">Contoh: Pramuka</div>
          </div>
        </div>

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_guru">Pengampu<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="id_guru" id="id_guru" value="<?php echo $dataidguru; ?>" class="form-control col-md-7 col-xs-12">
              <option value="">--- Guru --</option>
              <?php
              $query = "SELECT * from guru";
              $hasil = mysql_query($query);
              while ($data = mysql_fetch_array($hasil))
              {
                echo "<option value=".$data['id_guru'].">".$data['nm_guru']."</option>";
              }
              ?>
            </select>
          </div>
        </div>
        
     

        <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" id="ekstrakurikuler_simpan" name="ekstrakurikuler_simpan" class="btn btn-success">Submit</button>
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
       message: 'Harus Pilih ekstrakurikuler'
     },
     
   }
 }, 
nm_mapel: {
  message: 'Nama ekstrakurikuler Tidak Benar',
  validators: {
    notEmpty: {
      message: 'Nama ekstrakurikuler Harus Diisi'
    },
    stringLength: {
      min: 1,
      max: 30,
      message: 'Nama ekstrakurikuler Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
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
