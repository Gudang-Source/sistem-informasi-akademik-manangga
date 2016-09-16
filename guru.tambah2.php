<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));

// TEMPLATE CONTROL
$ui_register_page     = 'guru';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Tambah Data Guru');

// FORM PROCESSING
if (isset ($_POST["guru_simpan"]) ){ 

 function ubahformatTgl($tanggal) {
    $pisah    = explode('/',$tanggal);
    $urutan   = array($pisah[2],$pisah[1],$pisah[0]);
    $satukan  = implode('/',$urutan);
    return $satukan;
  }
  $lokasi_file = $_FILES['foto']['tmp_name'];
  $tipe_file   = $_FILES['foto']['type'];
  $nama_file   = $_FILES['foto']['name'];
  $direktori   = "../gallery/guru/$nip/$nama_file";
  $nip  = $_POST['nip'];
  $nm_guru  = $_POST['nm_guru'];
  $password  = $_POST['password'];
  $tmpt_lahir  = $_POST['tmpt_lahir'];
  $date_tgl_lahir  = $_POST['date_tgl_lahir'];
  $jns_kelamin  = $_POST['jns_kelamin'];
  $hari  = $_POST['hari'];  
  $agama  = $_POST['agama'];
  $status  = $_POST['status'];
  $kd_mapel  = $_POST['kd_mapel'];
  $jabatan  = $_POST['jabatan'];
  $almt_sekarang =$_POST['almt_sekarang'];
  $gelar_depan  = $_POST['gelar_depan'];
  $gelar_depan_akademik  = $_POST['gelar_depan_akademik'];
  $gelar_belakang  = $_POST['gelar_belakang'];
  $no_hp  = $_POST['no_hp'];
  $email  = $_POST['email'];
  $brg_tgl_terima   = $_POST['brg_tgl_terima'];
  $ubahtgl          = ubahformatTgl($brg_tgl_terima);
  $id_user =2;

  if(!empty($lokasi_file)) {
      move_uploaded_file($lokasi_file,$direktori);
      $sql = "insert into guru values ('$nip', '$id_user, '$password' , '$nm_guru' , '$tmpt_lahir' , '$ubahtgl' , '$jns_kelamin'  , '$agama' , '$status' , '$kd_mapel' , '$jabatan' , '$gelar_depan' , '$gelar_depan_akademik' , '$gelar_belakang' , '$almt_sekarang' , '$no_hp' , '$email' , '$hari' , '$nama_file'  )";
      $aksi = mysql_query($sql);
      if (!$aksi) {
          echo "<script>";
          echo 'alert("Maaf Gagal Menambahkan Data")';
          echo "</script>";
          echo '<script> window.location="./guru.tambah"</script>';
      }else{
          echo "<script>";
          echo 'alert("Data Behasil di tambahkan :)")';
          echo "</script>";
          echo '<script> window.location=" ./guru"</script>'; 
      }
    }else{
          echo "<script>";
          echo 'alert("Maaf Data Gagal Disimpan")';
          echo "</script>";
          echo '<script> window.location="./guru.tambah"</script>'; 
  }
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
            <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="SI Inventaris" title="SI Inventaris">
          </div>
          <hr class="uk-article-divider">
          <h1 class="uk-article-title">GURU<span class="uk-text-large">{ Tambah Guru }</span></h1>
          <br>
          <a href="./guru" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Barang"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
              <form class="uk-form uk-form-stacked" method="post">
                <div class="uk-form-row">
                  <div class="uk-progress uk-progress-mini uk-progress-primary uk-progress-striped uk-active">
                    <div class="uk-progress-bar" id="guru_progress" style="width: 0%;"></div>
                  </div>
                </div>
                <div class="uk-form-row">
                  <label class="uk-form-label" for="">( <span class="uk-text-danger">*</span> ) <i> Wajib di isi</i></label>
                </div>
                <div class="uk-form-row">
                  <label class="uk-form-label" for="">NIP<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls"><input type="text" name="nip" id="nip" placeholder="NIP"  autofocus required></div>
                </div>
                <div class="uk-form-row">
                  <label class="uk-form-label" for="">Nama<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls"><input type="text" name="nm_guru" id="nm_guru" placeholder="Nama" autofocus required>
                  </div>
                </div>
                 <div class="uk-form-row">
                  <label class="uk-form-label" for="">Password<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls"><input type="password" name="password" id="password" placeholder="password"  autofocus required></div>
                </div>
                <div class="uk-form-row">
                  <label class="uk-form-label" for="">Tanggal Lahir<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls">
                    <input type="text" name="brg_tgl_terima" id="brg_tgl_terima" placeholder="Tanggal Lahir" class="uk-width-small-1-6 uk-width-medium-1-10" data-uk-datepicker="{format:'DD/MM/YYYY'}" required>
                    <span class="uk-form-help-inline">Format : <code>HH/BB/TTTT</code></span>
                  </div>
                </div>
                <div class="uk-form-row">
                  <label class="uk-form-label" for="">Tempat Lahir<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls">
                    <input type="text" name="tmpt_lahir" id="tmpt_lahir" placeholder="tmpt_lahir" class="uk-width-1-5" autofocus required>
                  </div>
                </div>
                 <div class="uk-form-row">
                  <label class="uk-form-label" for="">Jenis Kelamin<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls"><input type="text" name="jns_kelamin" id="jns_kelamin" placeholder="jenis kelamin"  autofocus required></div>
                </div>
                <div class="uk-form-row">
                  <label class="uk-form-label" for="">Agama<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls">
                    <input type="text" name="agama" id="agama" placeholder="Agama" class="uk-width-1-5" autofocus required>
                  </div>
                </div>
                 <div class="uk-form-row">
                  <label class="uk-form-label" for="">Status Kerja<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls"><input type="text" name="status" id="status" placeholder="Status"  autofocus required></div>
                </div>
                <div class="uk-form-row">
                  <label class="uk-form-label" for="">Mata Pelajaran Yang Ditampu<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls">
                    <select name="kd_mapel" id="kd_mapel" class="" data-uk-tooltip="{pos:'bottom-left'}" title="Pilih Mata Pelajaran Yang Ditampu Oleh Guru Tersebut" required>
                      <option value="">--- Pilih Mata Pelajaran ---</option>
                      <?php 
                      $query = mysql_query("select * from mapel");
                      while ($row = mysql_fetch_array($query)) 
                      { 
                       echo "<option value=$row[kd_mapel]> $row[nm_mapel] </option>";
                     } 
                     ?> 
                    </select>
                  </div>
                </div>
                 <div class="uk-form-row">
                  <label class="uk-form-label" for="">Jabatan<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls"><input type="text" name="jabatan" id="jabatan" placeholder="jabatan"  autofocus required></div>
                </div>
                 <div class="uk-form-row">
                  <label class="uk-form-label" for="">Gelar Depan Non Akademik<span class="uk-text-danger"></span></label>
                  <div class="uk-form-controls"><input type="text" name="gelar_depan" id="gelar_depan" placeholder="Gelar Depan"  autofocus></div>
                </div>
                <div class="uk-form-row">
                  <label class="uk-form-label" for="">Gelar Depan Akademik<span class="uk-text-danger"></span></label>
                  <div class="uk-form-controls"><input type="text" name="gelar_depan_akademik" id="gelar_depan_akademik" placeholder="Gelar Depan Akademik"  autofocus></div>
                </div>
                <div class="uk-form-row">
                  <label class="uk-form-label" for="">Gelar Belakang<span class="uk-text-danger"></span></label>
                  <div class="uk-form-controls"><input type="text" name="gelar_belakang" id="gelar_belakang" placeholder="Gelar Belakang"  autofocus></div>
                </div>
                <div class="uk-form-row">
                  <label class="uk-form-label" for="">Alamat Rumah Sekarang<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls"><input type="text" name="almt_sekarang" id="almt_sekarang" placeholder="Alamat Rumah sekarang"  autofocus required></div>
                </div>
                <div class="uk-form-row">
                  <label class="uk-form-label" for="">No Handphone<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls"><input type="text" name="no_hp" id="no_hp" placeholder="No HP"  autofocus required></div>
                </div>
                <div class="uk-form-row">
                  <label class="uk-form-label" for="">Email<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls"><input type="text" name="email" id="email" placeholder="email"  autofocus required></div>
                </div>
                <div class="uk-form-row">
                  <label class="uk-form-label" for="">Jadwal Hari Piket</label>
                  <div class="uk-form-controls">
                    <select name="hari" id="hari" class=""  title="Pilih Hari Jadwal Piket" required>
                      <option value="">--- Pilih Hari Piket ---</option>
                      <option value="Senin">Senin</option>
                      <option value="Selasa">Selasa</option>
                      <option value="Rabu">Rabu</option>
                      <option value="Kamis">Kamis</option>
                      <option value="Jumat">Jumat</option>
                      <option value="Sabtu">Sabtu</option>
                      <option value="&nbsp;">--Kosongkan--</option>
                    </select>
                  </div>
                </div>


                <div class="uk-form-row">
                  <label class="uk-form-label" for="">Foto<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls"><input type="file" name="foto" id="foto" placeholder="foto"  autofocus required></div>
                </div>
                <div class="uk-form-row">
                   <div class="uk-alert">Pastikan semua isian sudah terisi dengan benar !</div>
                </div>
                <div class="uk-form-row">
                  <button type="submit" value="Simpan Data" name="guru_simpan" id="guru_simpan" class="uk-button uk-button-large uk-button-success" title="Simpan Data Guru" disabled><i class="uk-icon-paper-plane"></i> Simpan</button>
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
  $('#nip, #nm_guru, #password, #date_tgl_lahir, #brg_tgl_terima , #jns_kelamin, #agama, #status, #kd_mapel, #jabatan, #almt_sekarang, #no_hp, #email, #hari, #foto').on('change', function(){
    validate();
    progress();
  });
});

function validate(){
  if (
    $('#nip').val().length > 0 &&
    $('#nm_guru').val().length > 0 &&
    $('#password').val() > 0 &&
    $('#brg_tgl_terima').val().length > 0 &&
    $('#tmpt_lahir').val() != '' &&
    $('#jns_kelamin').val().length > 0 &&
    $('#agama').val().length > 0 &&
    $('#status').val() > 0 &&
    $('#kd_mapel').val().length > 0 &&
    $('#jabatan').val().length > 0 &&
    $('#almt_sekarang').val() > 0 &&
    $('#no_hp').val().length > 0 &&
    $('#email').val().length > 0 &&
    $('#hari').val() > 0 &&
    $('#foto').val().length > 0 
    ) {
    $('#guru_simpan').prop('disabled', false);
  }
  else {
    $('#guru_simpan').prop('disabled', true);
  }
}

function progress(){
  var w1 = ($('#nip').val().length > 0) ? 6 : 0;
  var w2 = ($('#nm_guru').val().length > 0) ? 6 : 0;
  var w3 = ($('#password').val().length != '') ? 6 : 0;
  var w4 = ($('#brg_tgl_terima').val().length > 0) ? 6 : 0;
  var w5 = ($('#tmpt_lahir').val().length > 0) ? 6 : 0;
  var w6 = ($('#jns_kelamin').val().length > 0) ? 6 : 0;
  var w7 = ($('#agama').val().length != '') ? 6 : 0;
  var w8 = ($('#status').val().length > 0) ? 6 : 0;
  var w9 = ($('#kd_mapel').val().length > 0) ? 6 : 0;
  var w10 = ($('#jabatan').val().length > 0) ? 6 : 0;
  var w11 = ($('#almt_sekarang').val().length != '') ? 16 : 0;
  var w12 = ($('#no_hp').val().length > 0) ? 6 : 0;
  var w13 = ($('#email').val().length > 0) ? 6 : 0;
  var w14 = ($('#hari').val().length > 0) ? 6 : 0;
  var w15 = ($('#foto').val().length != '') ? 6 : 0;

  var wt = w1 + w2 + w3 + w4+ w5 + w6 + w7 + w8 + w9 + w10 + w11 + w12 + w13 + w14 + w15;
  $('#guru_progress').css('width', wt+'%');
}
</script>

JS;

// LOAD FOOTER
loadAssetsFoot($scripts);

ob_end_flush();
?>