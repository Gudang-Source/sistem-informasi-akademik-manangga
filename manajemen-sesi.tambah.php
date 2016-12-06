<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

/*template control*/
$ui_register_page     = 'manajemen-sesi';
$ui_register_assets   = array('datepicker');

/*load header*/
loadAssetsHead('Tambah Data Master Manajemen Sesi');

/*form processing*/
if (isset ($_POST["sesi_simpan"])) { 

    // baca variabel
    
    $id_kelas     = $_POST['id_kelas'];
    $id_kelas     = str_replace("", "&acute;", $id_kelas);

    $jam     = $_POST['jam'];
    $jam     = str_replace("", "&acute;", $jam);
    $jam     = ucwords(strtolower($jam));


    // validation form kosong
   $pesanError= array();
  if (trim($id_kelas)=="") {
    $pesanError[]="Data <b>Kode Kelas</b> Masih Kosong.";
  }
  if (trim($jam)=="") {
    $pesanError[]="Data <b>Jam</b> Masih Kosong.";
  }


    // validasi kode mapel pada database
  $cekSql ="SELECT * FROM sesi WHERE id_sesi='$id_sesi'";
  $cekQry = mysql_query($cekSql) or die("Error Query:".mysql_error());
  if (mysql_num_rows($cekQry)>=1) {
    $pesanError[]= "Maaf, kode sesi <b>$id_sesi</b> sudah ada di database. Gantilah dengan kode lain.";
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
  $querytambahmapel = mysql_query("INSERT INTO sesi (id_kelas, jam) 
    VALUES ( '$id_kelas' , '$jam' )") or die(mysql_error());

  if ($querytambahmapel){
    header('location: ./manajemen-sesi');
  }
 }
}

    // simpan pada form, dan jika form belum terisi
  $dataidkelas  = isset($_POST['id_kelas']) ? $_POST['id_kelas'] : '';
  $datajam  = isset($_POST['jam']) ? $_POST['jam'] : '';
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
          <h1 class="uk-article-title">Manajemen Sesi <span class="uk-text-large">{ Tambah Master Data Manajemen Sesi }</span></h1>
          <br>
          <a href="./manajemen-sesi" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Sesi"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
             <form id="formsesi" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
        
       <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_kelas">Pilih Kelas<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="id_kelas" id="id_kelas" value="<?php echo $rowks['id_kelas'];?>" class="form-control col-md-7 col-xs-12">
              <option value="">--- Kelas ---</option>
    <?php
    $query = "SELECT * from kelas";
    $hasil = mysql_query($query);
    while ($data = mysql_fetch_array($hasil))
    {
      if ($data['id_kelas']==$rowks['id_kelas']) {
       $cek ="selected";
     }
     else{
      $cek= "";
    }
    echo "<option value=\"$data[id_kelas]\" $cek>$data[nm_kelas]</option>\n";           
  }
  
  ?>
            </select>
          </div>
        </div>


        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jam">Jam <span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="jam" name="jam" value="<?php echo $datajam; ?>" required="required" class="form-control col-md-7 col-xs-12">
            <div class="reg-info">Contoh: 07.00-07.35</div>
          </div>
        </div>


        <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" id="sesi_simpan" name="sesi_simpan" class="btn btn-success">Submit</button>
       </div>
     </form>    
</div>
</div>
</div>
</div>
</div>
<script src="assets/validator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/vendor/formvalidation/css/formValidation.min.css">
<link rel="stylesheet" href="/asset/css/demo.css">
<script src="/vendor/formvalidation/js/formValidation.min.js"></script>
<script src="/vendor/formvalidation/js/framework/uikit.min.js"></script>

<script type="text/javascript">
 var formsesi = $("#formsesi").serialize();
 var validator = $("#formsesi").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "glyphicon glyphicon-ok",
    invalid: "glyphicon glyphicon-remove", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
jam: {
  message: 'Format Jam Sesi Pelajaran Tidak Benar',
  validators: {
    notEmpty: {
      message: 'Jam Sesi Pelajaran Harus Diisi'
    },
    stringLength: {
      min: 11,
      max: 11,
      message: 'Format sesuai contoh'
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
