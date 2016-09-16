<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));

// TEMPLATE CONTROL
$ui_register_page     = 'dashboard';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Tambah Berita');

// FORM PROCESSING

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
<head>
         <script type="text/javascript" src="assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.form.js"></script>

        <script type="text/javascript" >
            $(document).ready(function() {
                $('#submitbtn').click(function() {
                    $("#viewimage").html('');
                    $(".uk-form uk-form-stacked").ajaxForm({
                        target: '#viewimage'
                    }).submit();
                });
            });
        </script> 

</head>
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
    			  <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="Sistem Informasi" title="Sistem Informasi">
    		  </div>
    		  <hr class="uk-article-divider">
          <h1 class="uk-article-title">Berita <span class="uk-text-large">{ Tambah Berita }</span></h1>
          <br>
          <a href="./" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Kelas"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
     <form class="uk-form uk-form-stacked" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                
                     <div class="uk-form-row">
                       <div class="uk-progress uk-progress-mini uk-progress-primary uk-progress-striped uk-active">
                       <div class="uk-progress-bar" id="berita_progress" style="width: 0%;"></div>
                       </div>
                     </div>
                
                            <div class="uk-form-row">
                              <label class="uk-form-label" for="">( <span class="uk-text-danger">*</span> ) <i> Wajib di isi</i></label>
                            </div>
                
                     <div class="uk-form-row">
                       <label class="uk-form-label" for="">Judul Berita<span class="uk-text-danger">*</span></label>
                       <div class="uk-form-controls"><input type="text" name="judul" id="judul" class="uk-width-1-2" placeholder="Judul"  autofocus required></div>
                     </div>
                
                            <div class="uk-form-row">
                              <label class="uk-form-label" for="">Isi<span class="uk-text-danger">*</span></label>
                              <div class="uk-form-controls"><textarea  rows="10" class="uk-width-1-2" name="isi" id="isi"  placeholder="Minimal 600 karakter" required></textarea></div>
                            </div>
                
                     <div class="uk-form-row">
                       <label class="uk-form-label" for="">Foto<span class="uk-text-danger">*</span></label>
                       <div class="uk-form-controls"><input type="file" class="uk-width-1-2" name="imagefile" id="foto" data-uk-tooltip="{pos:'bottom-left'}" title="Maksimal 2MB"  autofocus required></div>
                     </div>
                
                            <div class="uk-form-row">
                              <div class="uk-alert">Pastikan semua isian sudah terisi dengan benar !</div>
                            </div>
                
                     <div class="uk-form-row">
                       <button type="submit" value="Simpan Data" name="berita_simpan" id="berita_simpan" class="uk-button uk-button-large uk-button-success" title="Simpan Berita" disabled><i class="uk-icon-paper-plane"></i> Simpan</button>
                     </div>
     </form>
            </div>
          </div>
        </article>
		<br><br>
      </div>
    </div>
  </div>
</body>

<?php
// ADDITIONAL SCRIPTS
$scripts = <<<'JS'
<script>
// FORM SUBMIT and PROGRESS BAR CONTROL
$(document).ready(function (){
  $('#judul, #isi, #foto').on('change', function(){
    validate();
    progress();
  });
});

function validate(){
  if (
    $('#judul').val().length > 0 &&
    $('#isi').val().length > 0 &&
    $('#foto').val().length > 0 
    ) 
{
    $('#berita_simpan').prop('disabled', false);
  }
  else {
    $('#berita_simpan').prop('disabled', true);
  }
}
function progress(){
  var w1 = ($('#judul').val().length > 0) ? 35 : 0;
  var w2 = ($('#isi').val().length > 0) ? 35 : 0;
  var w3 = ($('#foto').val().length != '') ? 30 : 0;
  var wt = w1 + w2 + w3;
  $('#berita_progress').css('width', wt+'%');
}
</script>

JS;
// LOAD FOOTER
loadAssetsFoot($scripts);
ob_end_flush();
?>