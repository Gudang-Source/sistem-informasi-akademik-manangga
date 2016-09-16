<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));

// TEMPLATE CONTROL
$ui_register_page     = 'pegawai';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Tambah Data Pegawai');

// FORM PROCESSING
if (isset ($_POST["pegawai_simpan"]) ){ 

 function ubahformatTgl($tanggal) {
    $pisah    = explode('/',$tanggal);
    $urutan   = array($pisah[2],$pisah[1],$pisah[0]);
    $satukan  = implode('/',$urutan);
    return $satukan;
  }


  $id_pegawai  = $_POST['id_pegawai'];
  $nm_pegawai  = $_POST['nm_pegawai'];
  $password  = $_POST['password'];
  $date_tgl_lahir  = $_POST['date_tgl_lahir'];
  $ubahtgl  = ubahformatTgl($date_tgl_lahir);
  $tmpt_lahir  = $_POST['tmpt_lahir'];
  $jns_kelamin  = $_POST['jns_kelamin'];
  $agama  = $_POST['agama'];
  $status  = $_POST['status'];
  $jabatan  = $_POST['jabatan'];
  $gelar_depan  = $_POST['gelar_depan'];
  $gelar_depan_akademik  = $_POST['gelar_depan_akademik'];
  $gelar_belakang  = $_POST['gelar_belakang'];
  $almt_sekarang =$_POST['almt_sekarang'];
  $no_hp  = $_POST['no_hp'];
  $email  = $_POST['email'];

  


$name = ''; $type = ''; $size = ''; $error = ''; 
function compress_image($source_url, $destination_url, $quality) 
{ 
    $info = getimagesize($source_url); 
    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source_url); 
    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source_url); 
    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source_url); 
    imagejpeg($image, $destination_url, $quality); 
    return $destination_url; 
} 

  
  
  //Mengecek apakah file yang di upload sudah ada atau belum
  if(($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/pjpeg")){
           $lokasi = 'gallery/pegawai/';
           $url = $lokasi . $id_pegawai.'.jpg';
           $jeneng = $id_pegawai.'.jpg';
           
           $filename = compress_image($_FILES["file"]["tmp_name"], $url, 80); 

           $query = mysql_query("insert into pegawai values ('$id_pegawai', '2', '$password' , '$nm_pegawai' , '$tmpt_lahir' , '$ubahtgl' , '$jns_kelamin'  , '$agama' , '$status' , '$jabatan' , '$gelar_depan' , '$gelar_depan_akademik' , '$gelar_belakang' , '$almt_sekarang' , '$no_hp' , '$email' ,  '$jeneng')" ) or die(mysql_error());
              
              

           $buffer = file_get_contents($url); 
           /* Force download dialog... */ 
           header("Content-Type: application/force-download"); 
           header("Content-Type: application/octet-stream"); 
           header("Content-Type: application/download"); 
           /* Don't allow caching... */ 
           header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
           /* Set data type, size and filename */ 
           header("Content-Type: application/octet-stream"); 
           header("Content-Transfer-Encoding: binary"); 
           header("Content-Length: " . strlen($buffer)); 
           header("Content-Disposition: attachment; filename=$url"); 
           /* Send our file... */ 
           echo $buffer; }
           if ($query){
           header('location: ./pegawai');
            }
else { $error = "Uploaded image should be jpg or gif or png"; } 

    }
?>
<script src="assets/js/script.js"></script>
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
            <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="SIA" title="SIA">
          </div>
          <hr class="uk-article-divider">
          <h1 class="uk-article-title">PEGAWAI<span class="uk-text-large">{ Tambah Pegawai }</span></h1>
          <br>
          <a href="./pegawai" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Pegawai"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
              <form class="uk-form uk-form-stacked" method="post" enctype="multipart/form-data">
                <div class="uk-form-row">
                  <div class="uk-progress uk-progress-mini uk-progress-primary uk-progress-striped uk-active">
                    <div class="uk-progress-bar" id="pegawai_progress" style="width: 0%;"></div>
                  </div>
                </div>
                <div class="uk-form-row">
                  <label class="uk-form-label" for="">( <span class="uk-text-danger">*</span> ) <i> Wajib di isi</i></label>
                </div>
                <table>
                <tbody>
                <tr>
                  <td class="reg-label"><div class="uk-form-row"><label class="uk-form-label" for="">id_pegawai<span class="uk-text-danger">*</span></label></td>
                  <td class="reg-input"><div class="uk-form-controls"><input type="number" name="id_pegawai" id="id_pegawai" style="width:300px" placeholder="id_pegawai"  autofocus required></div>
                      <div class="reg-info">contoh: 126500182411, jumlah angka harus 12 , wajib diisi</div></div></td>
                </tr>
                <tr>
                  <td class="reg-label"><div class="uk-form-row"><label class="uk-form-label" for="">Nama<span class="uk-text-danger">*</span></label></td>
                  <td class="reg-input"><div class="uk-form-controls"><input type="text" name="nm_pegawai" id="nm_pegawai" style="width:300px" placeholder="Nama" autofocus required></div>
                      <div class="reg-info">Minimal terdapat 3 huruf, wajib diisi</div></div></td>
                </tr>
                <tr>
                  <td class="reg-label"><div class="uk-form-row"><label class="uk-form-label" for="">Password<span class="uk-text-danger">*</span></label></td>
                  <td class="reg-input"><div class="uk-form-controls"><input type="password" name="password" id="password" style="width:300px" placeholder="password"  autofocus required></div></div>
                      <div class="reg-info">password harus berupa huruf atau angka dilarang menggunakan simbol</div></div></td>
                </tr>
                <tr>
                  <td class="reg-label"><div class="uk-form-row"><label class="uk-form-label" for="">Tanggal Lahir<span class="uk-text-danger">*</span></label></td>
                  <td class="reg-input"><div class="uk-form-controls">
                    <input type="text" name="date_tgl_lahir" id="date_tgl_lahir" placeholder="Tanggal Lahir" style="width:300px" class="uk-width-small-1-6 uk-width-medium-1-10" data-uk-datepicker="{format:'DD/MM/YYYY'}" required></div>
                    <span class="uk-form-help-inline">Format : <code>HH/BB/TTTT</code></span>
                    <div class="reg-info">contoh: 07/01/1994, Format penulisan tanggal bisa dilihat dicontohnya</div></div></td>
                </tr>
                <tr>
                  <td class="reg-label"><div class="uk-form-row"><label class="uk-form-label" for="">Tempat Lahir<span class="uk-text-danger">*</span></label></td>
                  <td class="reg-input"><div class="uk-form-controls">
                     <input type="text" name="tmpt_lahir" id="tmpt_lahir" placeholder="tmpt_lahir" style="width:300px" class="uk-width-1-5" autofocus required></div>
                     <div class="reg-info">contoh: Gunungkidul, Tempat Lahir berupa nama kabupaten </div></div></td>
                </tr>
                <tr>
                  <td class="reg-label"><div class="uk-form-row"><label class="uk-form-label" for="">Jenis Kelamin</label></td>
                  <td class="reg-input"><div class="uk-form-controls">
                    <select name="jns_kelamin" id="jns_kelamin" class=""  title="Pilih Jenis Kelamin" required>
                      <option value="">--- Pilih Jenis Kelamin ---</option>
                      <option value="Laki-Laki">Laki-Laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                    </div><div class="reg-info">Jenis Kelamin Hanya Laki-Laki dan Perempuan , Pilih Salah Satu!!! </div></div></td>
                </tr>
                <tr>
                  <td class="reg-label"><div class="uk-form-row"><label class="uk-form-label" for="">Agama<span class="uk-text-danger">*</span></label></td>
                  <td class="reg-input"><div class="uk-form-controls">
                    <select name="agama" id="agama" class=""  title="Pilih Agama" required>
                      <option value="">--- Pilih Agama yang dianut ---</option>
                      <option value="Islam">Islam</option>
                      <option value="Kristen">Kristen</option>
                      <option value="Katolik">Katolik</option>
                      <option value="Hindhu">Hindhu</option>
                      <option value="Budha">Budha</option>
                      <option value="Konghuchu">Konghucu</option>
                    </select>
                    </div><div class="reg-info">Pilihan Agama yang ada hanya terdapat di pilihan, apabila tidak ada dalam menu pilihan agama ,harap menghubungi di bagian kesiswaan </div></div></td>
                </tr>
                <tr>
                  <td class="reg-label"><div class="uk-form-row"><label class="uk-form-label" for="">Status Kerja<span class="uk-text-danger">*</span></label></td>
                  <td class="reg-input"><div class="uk-form-controls"><input type="text" name="status" id="status" placeholder="Status" style="width:300px" autofocus required></div>
                      <div class="reg-info">Pilihan Agama yang ada hanya terdapat di pilihan, apabila tidak ada dalam menu pilihan agama ,harap menghubungi di bagian kesiswaan </div></div></td>
                </tr>
                               <tr>
                 <div class="uk-form-row">
                  <td class="reg-label"><label class="uk-form-label" for="">Jabatan<span class="uk-text-danger">*</span></label>
                  </td>
                  <td class="reg-input"><div class="uk-form-controls"><input type="text" name="jabatan" id="jabatan" placeholder="jabatan" style="width:300px" autofocus required></div>
                </td>
                </div>
                </tr>
                <tr>
                 <div class="uk-form-row">
                  <td class="reg-label"><label class="uk-form-label" for="">Gelar Depan Non Akademik<span class="uk-text-danger"></span></label>
                  </td>
                  <td class="reg-input"><div class="uk-form-controls"><input type="text" name="gelar_depan" id="gelar_depan" placeholder="Gelar Depan" style="width:300px" autofocus></div>
                </td>
                </div>
                </tr>
                <tr>
                <div class="uk-form-row">
                  <td class="reg-label"><label class="uk-form-label" for="">Gelar Depan Akademik<span class="uk-text-danger"></span></label>
                  </td>
                  <td class="reginput">
                  <div class="uk-form-controls"><input type="text" name="gelar_depan_akademik" id="gelar_depan_akademik" placeholder="Gelar Depan Akademik" style="width:300px" autofocus></div>
                </td>
                </div>
                </tr>
                <tr>
                <div class="uk-form-row">
                  <td class="reg-label"><label class="uk-form-label" for="">Gelar Belakang<span class="uk-text-danger"></span></label>
                  </td>
                  <td class="reg-input"><div class="uk-form-controls"><input type="text" name="gelar_belakang" id="gelar_belakang" placeholder="Gelar Belakang" style="width:300px" autofocus></div>
                </td>
                </div>
                </tr>
                <tr>
                <div class="uk-form-row">
                  <td class="reg-label"><label class="uk-form-label" for="">Alamat Rumah Sekarang<span class="uk-text-danger">*</span></label>
                  </td>
                  <td class="reg-input"><div class="uk-form-controls"><input type="text" name="almt_sekarang" id="almt_sekarang" placeholder="Alamat Rumah sekarang" style="width:300px" autofocus required></div>
                </td>
                </div>
                </tr>
                <tr>
                <div class="uk-form-row">
                  <td class="reg-label"><label class="uk-form-label" for="">No Handphone<span class="uk-text-danger">*</span></label>
                  </td>
                  <td class="reg-input"><div class="uk-form-controls"><input type="text" name="no_hp" id="no_hp" placeholder="No HP" style="width:300px" autofocus required></div>
                </td>
                </div>
                </tr>
                <tr>
                <div class="uk-form-row">
                  <td class="reg-label"><label class="uk-form-label" for="">Email<span class="uk-text-danger">*</span></label>
                  </td>
                  <td class="reg-input">
                  <div class="uk-form-controls"><input type="text" name="email" id="email" placeholder="email" style="width:300px"  autofocus required></div>
                </td></div>
                </tr>
                <tr>
                  <link rel="stylesheet" href="assets/css/style.css" />
                  <script src="assets/js/jquery.min.js"></script>
                  <script src="assets/js/script.js"></script>
                <div class="uk-form-row">
                  <td class="reg-label"><label class="uk-form-label" for="">Foto<span class="uk-text-danger">*</span></label>
                  </td><td class="reg-input"><div class="uk-form-controls"><input type="file" name="file" id="file" placeholder="file"  autofocus required>
                  <img id="previewing" src="assets/images/noimage.png" />
                  </div>
                </td>
                
                </div>

                </tr>
              </tbody>
              </table>
                <div class="uk-form-row">
                   <div class="uk-alert">Pastikan semua isian sudah terisi dengan benar !</div>
                </div>
                <div class="uk-form-row">
                  <button type="submit" value="Simpan Data" name="pegawai_simpan" id="pegawai_simpan" class="uk-button uk-button-large uk-button-success" title="Simpan Data Guru" disabled><i class="uk-icon-paper-plane"></i> Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </article>
    <br><br><br>
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
   $('#id_pegawai , #nm_pegawai , #password, #date_tgl_lahir , #tmpt_lahir , #jns_kelamin , #agama, #status, #jabatan, #gelar_depan , #gelar_depan_akademik , #gelar_belakang , #almt_sekarang , #no_hp , #email,  #foto').on('change', function(){
    validate();
    progress();
  });
});

function validate(){
  if (
    $('#id_pegawai').val().length > 0 &&
    $('#nm_pegawai').val().length > 0 &&
    $('#password').val().length > 0 &&
    $('#date_tgl_lahir').val().length > 0 &&
    $('#tmpt_lahir').val().length &&
    $('#jns_kelamin').val().length > 0 &&
    $('#agama').val().length > 0 &&
    $('#status').val().length > 0 &&
    $('#jabatan').val().length > 0 &&
    $('#gelar_depan').val().length > 0 &&
    $('#gelar_depan_akademik').val().length > 0 &&
    $('#gelar_belakang').val().length > 0 &&
    $('#almt_sekarang').val().length > 0 &&
    $('#no_hp').val().length > 0 &&
    $('#email').val().length > 0 &&
    $('#file').val().length > 0 
    ) 
{
    $('#pegawai_simpan').prop('disabled', false);
  }
  else {
    $('#pegawai_simpan').prop('disabled', true);
  }
}
function progress(){
  var w1 = ($('#id_pegawai').val().length > 0) ? 7 : 0;
  var w2 = ($('#nm_pegawai').val().length > 0) ? 7 : 0;
  var w3 = ($('#password').val().length != '') ? 7 : 0;
  var w4 = ($('#date_tgl_lahir').val().length > 0) ? 7 : 0;
  var w5 = ($('#tmpt_lahir').val().length > 0) ? 6 : 0;
  var w6 = ($('#jns_kelamin').val().length > 0) ? 6 : 0;
  var w7 = ($('#agama').val().length != '') ? 6 : 0;
  var w8 = ($('#status').val().length > 0) ? 6 : 0;
  var w9 = ($('#jabatan').val().length > 0) ? 6 : 0;
  var w10 = ($('#gelar_depan').val().length > 0) ? 6 : 0;
  var w11 = ($('#gelar_depan_akademik').val().length > 0) ? 6 : 0;
  var w12 = ($('#gelar_belakang').val().length > 0) ? 6 : 0;
  var w13 = ($('#almt_sekarang').val().length != '') ? 6 : 0;
  var w14 = ($('#no_hp').val().length > 0) ? 6 : 0;
  var w15 = ($('#email').val().length > 0) ? 6 : 0;
  var w16 = ($('#file').val().length != '') ? 6 : 0;

  var wt = w1 + w2 + w3 + w4+ w5 + w6 + w7 + w8 + w9 + w10 + w11 + w12 + w13 + w14 + w15 +w16;
  $('#pegawai_progress').css('width', wt+'%');
}
</script>

JS;
// LOAD FOOTER
loadAssetsFoot($scripts);
ob_end_flush();
?>