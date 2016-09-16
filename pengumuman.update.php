<!-- user login -->
<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1,10));

// TEMPLATE CONTROL
$ui_register_page     = 'pengumuman';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Update Data Pengumuman');

//LOAD DATA
if (isset($_POST['pengumuman_simpan'])) {

  #baca variabel
  
    $nip                 = $_POST['nip'];
    $judul_pengumuman     = $_POST['judul_pengumuman'];
    $isi                  = $_POST['isi'];

  #validasi form kosong
   $pesanError= array();
  if (trim($nip)=="") {
    $pesanError[]="Data <b>NIP</b> Masih Kosong.";
  }
    if (trim($judul_pengumuman)=="") {
    $pesanError[]="Data <b>Judul Pengumuman</b> Masih Kosong.";
  }
    if (trim($isi)=="") {
    $pesanError[]="Data <b>Isi</b> Masih Kosong.";
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
    $query = mysql_query("UPDATE pengumuman SET nip='$nip', judul_pengumuman='$judul_pengumuman', isi='$isi' WHERE kd_pengumuman='$_GET[id]'") or die(mysql_error());

   if ($query){
    header('location: ./pengumuman');
  }
} 

}

$datanip  = isset($_POST['nip']) ? $_POST['nip'] : '';
$datajudulpengumuman  = isset($_POST['judul_pengumuman']) ? $_POST['judul_pengumuman'] : '';
$dataisi  = isset($_POST['isi']) ? $_POST['isi'] : '';

# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
$edit = mysql_query("SELECT * FROM pengumuman, guru WHERE pengumuman.nip=guru.nip AND kd_pengumuman='$_GET[id]'");
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
          <h1 class="uk-article-title">Pengumuman <span class="uk-text-large">{ Edit Pengumuman }</span></h1>
          <br>
          <a href="./pengumuman" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Pengumuman"><i class="uk-icon-angle-left"></i> Kembali</a>

            <form id="formpengumuman" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

    <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_kelas">Pilih Guru<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="nip" id="nip" value="<?php echo $rowks['nip'];?>" class="form-control col-md-7 col-xs-12">
              <option value="">--- Guru --</option>
               <?php
                      //MENGAMBIL yg DATABASE
        $query = "SELECT * FROM guru";
        $hasil = mysql_query($query);
        while ($data=mysql_fetch_array($hasil)) 
        {
         if ($data['nip']==$rowks['nip']) {
           $cek ="selected";
         }
         else{
          $cek= "";
        }
        echo "<option value=\"$data[nip]\" $cek>$data[nm_guru]</option>\n";
      }
      ?>
              
            </select>
          </div>
        </div>

         <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="judul_pengumuman">Judul Pengumuman<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="judul_pengumuman" name="judul_pengumuman" value="<?php echo $rowks['judul_pengumuman'];?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

      <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="isi">Isi Pengumuman<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea type="text" id="isi" name="isi" value="<?php echo $rowks['judul_pengumuman'];?>" required="required" class="form-control col-md-7 col-xs-12"><?php echo $rowks['isi'];?></textarea>
          </div>
        </div>

        <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" id="pengumuman_simpan" name="pengumuman_simpan" class="btn btn-success">Submit</button>
       </div>
     </form>   
</div>

<script src="assets/validator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/vendor/formvalidation/css/formValidation.min.css">
<link rel="stylesheet" href="/asset/css/demo.css">
<script src="/vendor/formvalidation/js/formValidation.min.js"></script>
<script src="/vendor/formvalidation/js/framework/uikit.min.js"></script>

<script type="text/javascript">
 var formpengumuman = $("#formpengumuman").serialize();
 var validator = $("#formpengumuman").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "glyphicon glyphicon-ok",
    invalid: "glyphicon glyphicon-remove", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
    nip : {
     validators: {
      notEmpty: {
       message: 'Harus Isi Kode NIP'
     },

   }
 }, 
pengumuman: {
  message: 'Isi Pengumuman',
  validators: {
    notEmpty: {
      message: 'Isi Pengumuman Harus Diisi'
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
