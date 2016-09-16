<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(0));

/*template control*/
$ui_register_page     = 'siswa-tugas';
$ui_register_assets   = array('datepicker');

/*load header*/
loadAssetsHead('Kumpulkan Data Tugas');

/*form processing*/

        $nip=$_REQUEST['nip'];
        $kd_kelas = $_REQUEST['kd_kelas'];
        $kd_mapel = $_REQUEST['kd_mapel'];

        $query = "SELECT * from siswa where nis={$_SESSION['usernamesiswa']}";
        $sql = mysql_query($query);
        $data = mysql_query($sql);

$query0 = "SELECT * from guru where nip=$_GET[id]"; 
$sql0=mysql_query($query0);
$data0=mysql_fetch_array($sql0);
$querymapel = "SELECT * from mapel where kd_mapel='$_GET[kd_mapel]'"; 
$sqlmapel=mysql_query($querymapel);
$datamapel=mysql_fetch_array($sqlmapel);

$query1 = "SELECT
*
FROM
tugas
INNER JOIN mapel ON tugas.kd_mapel = mapel.kd_mapel WHERE tugas.kd_mapel='$_GET[kd_mapel]'";
$query_select1=mysql_query($query1);
$data1=mysql_fetch_array($query_select1);

        
        $query = "SELECT * from kelas where kd_kelas='$_GET[kd_kelas]";
        $sql=mysql_query($query);
        $data2=mysql_fetch_array($sql);
        $nm_kelas=$data2['nm_kelas'];

   $queryjudultugas = "SELECT tugas.judul_tugas FROM tugas where tugas.judul_tugas='$_GET[judul_tugas]'";
        $sql=mysql_query($queryjudultugas);
        $datajudultugas=mysql_fetch_array($sql);


     
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
          <h1 class="uk-article-title">Tugas<span class="uk-text-large">{ Tambah Data Tugas }</span></h1>
          <br>
          <a href="./siswa-tugas" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Tugas"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
    

    <form action="aksi_tugas_siswa?action=tambah" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
       <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Siswa<span class="required">*</span>
           </label>
          <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input class="form-control" type="hidden" value="<?php echo $_SESSION['usernamesiswa']; ?>" name="nis" readonly><i class="form-control"><?php echo $_SESSION['usernamesiswa']; ?></i>
              </div>
        </div>
         <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nip">Guru<span class="required">*</span>
           </label>
          <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input class="form-control" type="hidden" value="<?php echo $data0['nip'];?>" name="nip" readonly><i class="form-control"><?php echo $data0['nm_guru'] ?></i>
              </div>
        </div>

           <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_mapel">Mapel<span class="required">*</span>
           </label>
          <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input class="form-control" type="hidden" value="<?php echo $data1['kd_mapel'];?>" name="kd_mapel" readonly><i class="form-control"><?php echo $data1['nm_mapel'] ?></i>
              </div>
        </div>

       <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_kelas">Kelas<span class="required">*</span>
           </label>
          <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input class="form-control" type="hidden" value="<?php echo $_SESSION['kd_kelas']; ?>" name="kd_kelas" readonly><i class="form-control"><?php echo $_SESSION['kd_kelas']; ?></i>
              </div>
        </div>

       <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="judul_tugas">Judul Tugas<span class="required">*</span>
           </label>
          <div class="form-group input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input class="form-control" type="text" name="judule" value="<?php echo $datajudultugas['judul_tugas']; ?>">
               
              </div>
        </div>

      

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12">Unggah Materi<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="hidden" name="MAX_FILE_SIZE" value="2000000" required="required">
            <input type="file" id="File" name="userfile">
            <div class="reg-info">Format file yang dapat diunggah: <code>.doc, .docx, .pdf , .ppt , .pptx , .xls , .xlsx, .txt</code></div>
          </div>
        </div>

        <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" class="btn btn-success">Submit</button>
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
 var formtugas = $("#formtugas").serialize();
 var validator = $("#formtugas").bootstrapValidator({
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
       message: 'Harus Pilih Kelas'
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
      max: 50,
      message: 'Nama Kelas Harus Lebih dari 1 Huruf dan Maksimal 50 Huruf'
    },
    regexp: {
      regexp: /^[a-zA-Z0-9_ \. ]+$/,
      message: 'Karakter Boleh Digunakan (Angka, Huruf, Titik, Underscore)'
    },
  
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
