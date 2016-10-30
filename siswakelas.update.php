<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

/*template control*/
$ui_register_page     = 'siswa';
$ui_register_assets   = array('datepicker');

/*load header*/
loadAssetsHead('Tambah Data Siswa per Tahun Ajaran');

/*form processing*/
if (isset ($_POST["siswakelas_simpan"])) { 

    // baca variabel
    $id_kelas     = $_POST['id_kelas'];
    $id_kelas     = str_replace("", "&acute;", $id_kelas);

    $id_siswa     = $_POST['id_siswa'];
    $id_siswa     = str_replace("", "&acute;", $id_siswa);

    $id_tahun     = $_POST['id_tahun'];
    $id_tahun     = str_replace("", "&acute;", $id_tahun);

    // validation form kosong
$pesanError= array();
if (trim($id_kelas)=="") {
    $pesanError[]="Data <b>Kelas</b> Masih Kosong.";
  }
if (trim($id_siswa)=="") {
    $pesanError[]="Data <b>Data Siswa</b> Masih Kosong.";
  }
if (trim($id_tahun)=="") {
    $pesanError[]="Data <b>Tahun Ajaran</b> Masih Kosong.";
  }

    // validasi kode kelas pada database
/*  $cekSql ="SELECT * FROM kelas_siswa WHERE id_siswa='$id_siswa'";
  $cekQry = mysql_query($cekSql) or die("Error Query:".mysql_error());
  if (mysql_num_rows($cekQry)>=1) {
    $pesanError[]= "Maaf, Siswa <b>$id_siswa</b> Sudah Ada, ganti dengan nama lain";
  }*/

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
  $querytambahsiswakelas = mysql_query("INSERT INTO kelas_siswa (id_kelas, id_siswa, id_tahun) 
    VALUES ( '$id_kelas' , '$id_siswa' , '$id_tahun' )") or die(mysql_error());

  if ($querytambahsiswakelas){ 
    header('location: ./siswa.kelas');
  }
 }
}

    // simpan pada form, dan jika form belum terisi
  $dataidkelas  = isset($_POST['id_kelas']) ? $_POST['id_kelas'] : '';
  $dataidsiswa  = isset($_POST['id_siswa']) ? $_POST['id_siswa'] : '';
  $dataidtahun  = isset($_POST['id_tahun']) ? $_POST['id_tahun'] : '';

  $edit = mysql_query("SELECT * FROM siswa, kelas WHERE siswa.id_kelas=kelas.id_kelas AND nis='$_GET[id]'");
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
          <h1 class="uk-article-title">Siswa <span class="uk-text-large">{ Tambah Data Siswa per Tahun Ajaran }</span></h1>
          <br>
          <a href="./siswa.kelas" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Siswa"><i class="uk-icon-angle-left"></i> Kembali</a>

          <!-- <hr class="uk-article-divider"> -->

          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">

        <form id="formsiswakelas" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

         <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_siswa">ID Siswa<span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input readonly type="text" id="id_siswa" name="id_siswa" value="<?php echo $rowks['id_siswa'];?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
         </div>

         <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">NIS<span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input readonly type="text" name="nis" value="<?php echo $rowks['nis'];?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
         </div>

         <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_siswa">Nama Siswa<span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <input readonly type="text" name="nm_siswa" value="<?php echo $rowks['nm_siswa'];?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
         </div>

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
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_tahun">Pilih Tahun Pelajaran<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="id_tahun" id="id_tahun" value="<?php echo $datatahunpelajaran; ?>" class="form-control col-md-7 col-xs-12">
              <option value="">--- Tahun Pelajaran --</option>
              <?php
              $query = "SELECT * from tahun_ajaran";
              $hasil = mysql_query($query);
              while ($data = mysql_fetch_array($hasil))
              {
                echo "<option value=".$data['id_tahun'].">".$data['thn_ajaran']."</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" id="siswakelas_simpan" name="siswakelas_simpan" class="btn btn-success">Submit</button>
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
