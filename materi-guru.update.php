<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

/*template control*/
$ui_register_page     = 'materi';
$ui_register_assets   = array('datepicker');

/*load header*/
loadAssetsHead('Update Materi Ajar');

/*form processing*/
if (isset ($_POST["materi_simpan"])) { 
  $nip=$_REQUEST['nip'];  
  $kd_mapel=$_REQUEST['kd_mapel'];  
  $kd_kelas=$_REQUEST['kd_kelas'];  
  $judul_materi=ucwords($_REQUEST['judul_materi']); 
  $valid=0; 

                            $pesanError= array();
                                  if (trim($judul_materi)=="") {
                                $pesanError[]="Data <b>Judul Materi</b> Masih Kosong.";
                              }
                                if (trim($nip)=="") {
                                $pesanError[]="Data <b>Guru</b> Masih Kosong.";
                              }
                                  if (trim($kd_kelas)=="") {
                                $pesanError[]="Data <b>Kelas</b> Masih Kosong.";
                              }
                                  if (trim($kd_mapel)=="") {
                                $pesanError[]="Data <b>Materi Pelajaran</b> Masih Kosong.";
                              }
    $tmpName = $_FILES['userfile']['tmp_name']; 

    if (!is_uploaded_file($tmpName) || empty($tmpName))
    {
      echo '<script>alert("Mohon isi data dengan lengkap")</alert>';
      echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=upload_materi.php\">";
      $valid = 1;
    }

    $fileSize   = $_FILES['userfile']['size'];
    $fileType = $_FILES['userfile']['type'];
    $fileName = $_FILES['userfile']['name'];
    $info   = pathinfo($fileName);
    $ukuran   = 2000000;
    $extensiList= array("doc","docx","pdf","ppt","pptx","xls","xlsx", "txt");
    $pisah      = explode(".",$fileName);
    $ekstensi     = $pisah[1];
$jenglot= rand(1000,100000)."-".$fileName.$ekstensi;

    $fp   = fopen($tmpName, 'r');
    $konten = fread($fp, filesize($tmpName));
    $konten = addslashes($konten);
    fclose($fp);

    if(!get_magic_quotes_gpc())
    {
      $fileName = addslashes($fileName);
    }

    if(!in_array($ekstensi,$extensiList))
    {
      echo '<script>alert("File tidak sesuai")</script>';
      echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"10;URL=materi.tambah.php\">";
      $valid= 1;
    }

    if($fileSize >= $ukuran)
    {
      echo '<script>alert("Ukuran file terlalu besar")</script>';
      echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"10;URL=materi.tambah.php\">";
      $valid= 1;
    }
    if($valid != 1)
    {

       $query = mysql_query("UPDATE materi SET kd_materi=NULL, nama_file='$nama_file' , size='$size' , judul_materi='$judul_materi' , nip='$nip' , kd_kelas='$kd_kelas' , kd_mapel='$kd_mapel' , waktu='$waktu' , type='$type' , content='$content' ") or die(mysql_error());

   if ($query){
    header('location: ./materi-guru');
  }
} 

}
    // baca variabel
    #update data ke database

    // simpan pada form, dan jika form belum terisi
  $datanip  = isset($_POST['nip']) ? $_POST['nip'] : '';
  $datakodekelas  = isset($_POST['kd_kelas']) ? $_POST['kd_kelas'] : '';
  $datakodemapel  = isset($_POST['kd_mapel']) ? $_POST['kd_mapel'] : '';
  $datajudulmateri  = isset($_POST['judul_materi']) ? $_POST['judul_materi'] : '';
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
          <h1 class="uk-article-title">Update Materi Ajar <span class="uk-text-large">{ Edit Materi Ajar }</span></h1>
          <br>
          <a href="./materi-guru" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Materi Ajar"><i class="uk-icon-angle-left"></i> Kembali</a>

           <form id="formmateri" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
 <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_kelas">Pilih Guru<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="nip" id="nip" value="<?php echo $rowks['nip'];?>" class="form-control col-md-7 col-xs-12">
              <option value="">--- Guru --</option>
              <?php
              $query = "SELECT * from guru";
              $hasil = mysql_query($query);
              while ($data = mysql_fetch_array($hasil))
                        {
         if ($data['nip']==$rowks['nip']) {
           $cek ="selected";
         }
           else{
          $cek= "";
              }
                echo "<option value=\".$data[nip]\" $cek>$data[nm_guru]</option>";
              }
              ?>
            </select>
          </div>
        </div>

         <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_kelas">Pilih Mata Pelajaran<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="kd_mapel" id="kd_mapel" value="<?php echo $datakodemapel; ?>" class="form-control col-md-7 col-xs-12">
              <option value="">--- Mata Pelajaran --</option>
              <?php
              $query = "SELECT * from mapel";
              $hasil = mysql_query($query);
              while ($data = mysql_fetch_array($hasil))
                 {
         if ($data['kd_mapel']==$rowks['kd_mapel']) {
           $cek ="selected";
         }
           else{
          $cek= "";
              }
                echo "<option value=\".$data[kd_mapel]\" $cek>$data[nm_mapel]</option>";
             
              }

              ?>
            </select>
          </div>
        </div>

     <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_kelas">Pilih Kelas<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="kd_kelas" id="kd_kelas" value="<?php echo $datakodeklas; ?>" class="form-control col-md-7 col-xs-12">
              <option value="">--- Kelas --</option>
              <?php
              $query = "SELECT * from kelas";
              $hasil = mysql_query($query);
              while ($data = mysql_fetch_array($hasil))
                {
         if ($data['kd_kelas']==$rowks['kd_kelas']) {
           $cek ="selected";
         }
           else{
          $cek= "";
              }
               echo "<option value=\".$data[kd_kelas]\" $cek>$data[kd_kelas]</option>";
              }
              ?>
            </select>
          </div>
        </div>

         <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="judul_materi">Judul Materi<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="judul_materi" name="judul_materi" value="<?php echo $rowks['judul_materi'];?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12">Unggah Materi<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="hidden" action="action" name="MAX_FILE_SIZE" value="2000000" required="required">
            <input name="userfile" type="file"></input>
            <div class="reg-info">Format file yang dapat diunggah: <code>.doc, .docx, .pdf , .ppt , .pptx , .xls , .xlsx, .txt</code></div>
          </div>
        </div>
        <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" id="materi_simpan" name="materi_simpan" class="btn btn-success">Submit</button>
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
       message: 'Harus Pilih Kelas'
     },
     remote: {
      type: 'POST',
      url: 'remote/remote_kelas.php',
      message: 'Nama Kelas Telah Tersedia'
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
