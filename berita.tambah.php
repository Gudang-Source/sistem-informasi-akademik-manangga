<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

/*template control*/
$ui_register_page     = 'berita.tambah';
$ui_register_assets   = array('datepicker');

/*load header*/
loadAssetsHead('Tambah Data Berita');

/*form processing*/
if (isset ($_POST["berita_simpan"]) )
{
$file_formats = array("jpg", "png", "gif", "bmp");

$filepath = "gallery/news/";
 
 $name  = $_FILES['imagefile']['name']; // filename to get file's extension
 $size  = $_FILES['imagefile']['size'];
 $judul = $_POST['judul'];
 $isi   = $_POST['isi'];
 if (strlen($name)) {
  $extension = substr($name, strrpos($name, '.')+1);
  if (in_array($extension, $file_formats)) { // check it if it's a valid format or not
    if ($size < (2048 * 1024)) { // check it if it's bigger than 2 mb or no
      $imagename = md5(uniqid() . time()) . "." . $extension;
            $gambar= $imagename;
      $tmp = $_FILES['imagefile']['tmp_name'];
        if (move_uploaded_file($tmp, $filepath . $imagename)) {
                    $query = mysql_query("insert into woroworo values ('','$judul', '$gambar','$isi', NOW())") or die(mysql_error());
    if ($query){
                                                 echo "<script>";
                                                 echo 'alert("Berhasil.")';
                                                 echo "</script>";
                                                 echo '<script> window.location="./dashboard"</script>';       
      }else{
                                                 echo "<script>";
                                                 echo 'alert("Gagal.")';
                                                 echo "</script>";
                                                 echo '<script> window.location="./berita.tambah"</script>';       
      }
        } else {
                                                 echo "<script>";
                                                 echo 'alert("Gagal upload gambar.")';
                                                 echo "</script>";
                                                 echo '<script> window.location="./berita.tambah"</script>';       
        }
    } else {
                                                 echo "<script>";
                                                 echo 'alert("Ukuran Gambar melebihi 2MB.")';
                                                 echo "</script>";
                                                 echo '<script> window.location="./berita.tambah"</script>';       
    }
  } else {
                                                 echo "<script>";
                                                 echo 'alert("Format gambar salah.")';
                                                 echo "</script>";
                                                 echo '<script> window.location="./berita.tambah"</script>';       

  }
 } else {
                                                 echo "<script>";
                                                 echo 'alert("Gagal.Silahkan pilih gambar.")';
                                                 echo "</script>";
                                                 echo '<script> window.location="./berita.tambah"</script>';       

 }
 exit();
}
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
          <h1 class="uk-article-title">Berita <span class="uk-text-large">{ Tambah Data Berita }</span></h1>
          <br>
          <a href="./dashboard" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Dashboard"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
             <form id="form_berita" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
        
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="judul_berita">Judul Berita<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="judul_berita" name="judul_berita" value=" " required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>


        <div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keterangan">Isi <span class="required">*</span>
 </label>
 <div class="col-md-6 col-sm-6 col-xs-12">
  <textarea rows="9" id="keterangan" required="required" name="keterangan" class="form-control col-md-7 col-xs-12"></textarea>
</div>
</div>  
 <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Image <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="col-lg-8">
          <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="./assets/fileupload/images/nopict.jpg" alt="" /></div>
            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
            <div>
              <span class="btn btn-file btn-primary btn-xs"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" accept="image/*" name="file" id="file" placeholder="file" /></span>
              <a href="#" class="btn btn-danger btn-xs fileupload-exists" data-dismiss="fileupload">Remove</a>
            </div>
          </div>
        </div>
      </div>
    </div>

        <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" id="berita_simpan" name="berita_simpan" class="btn btn-success">Submit</button>
       </div>
     </form>    
</div>
</div>
</div>
</article>
</div>
</div>

<script src="assets/validator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="vendor/formvalidation/css/formValidation.min.css">
<script src="vendor/formvalidation/js/formValidation.min.js"></script>
<script src="vendor/formvalidation/js/framework/uikit.min.js"></script>
<script type="text/javascript">
 var form_berita = $("#form_berita").serialize();
 var validator = $("#form_berita").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "glyphicon glyphicon-ok",
    invalid: "glyphicon glyphicon-remove", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
    judul_berita : {
     validators: {
      notEmpty: {
       message: 'Harus Diisi '
     }
     
   }
 }, 
keterangan: {
  message: 'Isi Berita Tidak Benar',
  validators: {
    notEmpty: {
      message: 'Data Berita Harus Diisi'
    },
    stringLength: {
      min: 1,
      max: 50,
      message: 'Data Berita Harus Lebih dari 1 Huruf dan Maksimal 50 Huruf'
    },
    regexp: {
      regexp: /^[a-zA-Z0-9_ \. ]+$/,
      message: 'Karakter Boleh Digunakan (Angka, Huruf, Titik, Underscore)'
    }


  }
},
    file : {
      validators : {
        notEmpty: {
         message: 'Belum Memilih Gambar'
       },
       file : {
        extention : 'jpeg,jpg,png',
        type : 'image/jpeg,image/png',
              //maxSize : 2097152, //2048*1024
              message : 'file tidak benar'
            }
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
