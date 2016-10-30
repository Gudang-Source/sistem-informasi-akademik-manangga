<!-- user login -->
  <?php
  require ( __DIR__ . '/init.php');
  checkUserAuth();
  checkUserRole(array(10));

  // TEMPLATE CONTROL
  $ui_register_page     = 'siswa';
  $ui_register_assets   = array('datepicker');

  // LOAD HEADER
  loadAssetsHead('Update Data Siswa');

  //LOAD DATA
  if (isset($_POST['siswa_simpan'])) {

    #baca variabel
    $nis     = $_POST['nis'];
    $password     = $_POST['password'];
    $nm_siswa     = $_POST['nm_siswa'];
    $tmpt_lahir     = $_POST['tmpt_lahir'];
    $date_tgl_lahir = $_POST['date_tgl_lahir'];
    $jns_kelamin     = $_POST['jns_kelamin'];
    $agama     = $_POST['agama'];
    $alamat     = $_POST['alamat'];
    $email     = $_POST['email'];
    $telp     = $_POST['telp'];
    $kd_kelas    = $_POST['kd_kelas'];
    $id_user =3;

    #validasi form kosong
    $pesanError= array();
    if (trim($nis)=="nis") {
      $pesanError[]="Data <b>NIS</b> Masih Kosong.";
    }
    if (trim($password)=="password") {
      $pesanError[]="Data <b>Password</b> Masih Kosong.";
    }
    if (trim($nm_siswa)=="nm_siswa") {
      $pesanError[]="Data <b>Nama Siswa</b> Masih Kosong.";
    }
    if (trim($tmpt_lahir)=="tmpt_lahir") {
      $pesanError[]="Data <b>Tempat Lahir</b> Masih Kosong.";
    }
    if (trim($date_tgl_lahir)=="date_tgl_lahir") {
      $pesanError[]="Data <b>Tanggal Lahir</b> Masih Kosong.";
    }
    if (trim($jns_kelamin)=="jns_kelamin") {
      $pesanError[]="Data <b>Jenis Kelamin</b> Masih Kosong.";
    }
    if (trim($agama)=="agama") {
      $pesanError[]="Data <b>Agama</b> Masih Kosong.";
    }
    if (trim($alamat)=="alamat") {
      $pesanError[]="Data <b>Alamat</b> Masih Kosong.";
    }
    if (trim($email)=="email") {
      $pesanError[]="Data <b>Email</b> Masih Kosong.";
    }
    if (trim($telp)=="telp") {
      $pesanError[]="Data <b>Nomor Telepon</b> Masih Kosong.";
    }
    if (trim($kd_kelas)=="kd_kelas") {
      $pesanError[]="Data <b>Kode Kelas</b> Masih Kosong.";
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
    #nis, id_user, password, nm_siswa, tmpt_lahir, date_tgl_lahir, jns_kelamin, agama, alamat, email, telp, kd_kelas
      $query = mysql_query("UPDATE siswa SET nis='$nis', id_user='$id_user', password='$password', nm_siswa='$nm_siswa', tmpt_lahir='$tmpt_lahir', date_tgl_lahir='$date_tgl_lahir', jns_kelamin='$jns_kelamin', agama='$agama', alamat='$alamat', email='$email' , telp='$telp' , kd_kelas='$kd_kelas' WHERE nis='$_GET[id]'") or die(mysql_error());

      if ($query){
        header('location: ./siswa');
      }
    } 

  }

    // simpan pada form, dan jika form belum terisi
  $datanis  = isset($_POST['nis']) ? $_POST['nis'] : '';
  $datapassword  = isset($_POST['password']) ? $_POST['password'] : '';
  $datanamasiswa  = isset($_POST['nm_siswa']) ? $_POST['nm_siswa'] : '';
  $datatempatlahir  = isset($_POST['tmpt_lahir']) ? $_POST['tmpt_lahir'] : '';
  $datatanggallahir  = isset($_POST['date_tgl_lahir']) ? $_POST['date_tgl_lahir'] : '';
  $datajeniskelamin  = isset($_POST['jns_kelamin']) ? $_POST['jns_kelamin'] : '';
  $dataagama  = isset($_POST['agama']) ? $_POST['agama'] : '';
  $dataalamat  = isset($_POST['alamat']) ? $_POST['alamat'] : '';
  $dataemail  = isset($_POST['email']) ? $_POST['email'] : '';
  $datatelp  = isset($_POST['telp']) ? $_POST['telp'] : '';
  $datakodekelas  = isset($_POST['kd_kelas']) ? $_POST['kd_kelas'] : '';

  # MEMBUAT NILAI DATA PADA FORM
  # SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
  
  $edit = mysql_query("SELECT * FROM siswa, kelas WHERE siswa.id_kelas=kelas.id_kelas AND nis='$_GET[id]'");
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
              <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="E-Learning SMK N 4 Klaten" title="E-Learning SMK N 4 Klaten">
            </div>
            <hr class="uk-article-divider">
            <h1 class="uk-article-title">Siswa <span class="uk-text-large">{ Edit Siswa }</span></h1>
            <br>
            <a href="./siswa" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Siswa"><i class="uk-icon-angle-left"></i> Kembali</a>

            <form id="formsiswa" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

             <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">NIS<span class="required">*</span>
               </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="nis" name="nis" value="<?php echo $rowks['nis'];?>" required="required" class="form-control col-md-7 col-xs-12">
                <div class="reg-info">Contoh: 55550. Wajib Diisi (Digunakan sebagai username untuk login)</div>
              </div>
            </div>

            <div class="item form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nip">Password<span class="required">*</span>
             </label>
             <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="password" name="password" value="<?php echo $rowks['password'];?>" required="required" class="form-control col-md-7 col-xs-12">
            </div>
          </div>

          <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_siswa">Nama Siswa<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nm_siswa" name="nm_siswa" value="<?php echo $rowks['nm_siswa'];?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

        <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tmpt_lahir">Tempat Lahir<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" id="tmpt_lahir" name="tmpt_lahir" value="<?php echo $rowks['tmpt_lahir'];?>" required="required" class="form-control col-md-7 col-xs-12">
        </div>
      </div>

      <div class="item form-group">
       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_tgl_lahir">Tanggal Lahir<span class="required">*</span>
       </label>
       <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="date_tgl_lahir" name="date_tgl_lahir" value="<?php echo $rowks['date_tgl_lahir'];?>" required="required" class="form-control col-md-7 col-xs-12" data-uk-datepicker="{format:'YYYY/DD/MM'}" >
                          <div class="reg-info">Format: <code>DD/MM/YYYY</code></div>
                          <div class="reg-info">Contoh: 31/12/1994</div>
      </div>
    </div>

    <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jns_kelamin">Jenis Kelamin<span class="required">*</span>
     </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
       <select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="jns_kelamin" name="jns_kelamin" value="" required>
        <option value="">-Pilih Jenis Kelaimn-</option>
        <?php
                      //MENGAMBIL NAMA PROVINSI YANG DI DATABASE
        $jns_kelamin =mysql_query("SELECT * FROM siswa ORDER BY jns_kelamin");
        while ($datajeniskelamin=mysql_fetch_array($jns_kelamin)) {
         if ($datajeniskelamin['jns_kelamin']==$rowks['jns_kelamin']) {
           $cek ="selected";
         }
         else{
          $cek= "";
        }
        echo "<option value=\"$datajeniskelamin[jns_kelamin]\" $cek>$datajeniskelamin[jns_kelamin]</option>\n";
      }
      ?>
    </select>
    
  </div>
</div>
<div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="agama">Agama<span class="required">*</span>
 </label>
 <div class="col-md-6 col-sm-6 col-xs-12">
   <select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="agama" name="agama" value="" required>
    <option value="">-Pilih Agama-</option>
    <?php
    $endiagamamu  = array('Islam','Kristen Katolik','Kristen Protestan','Hindu','Budha','Konghucu','Lainnya');
    ?>
    
    <?php
    $agama =mysql_query("SELECT * FROM siswa ORDER BY agama");
    $dataagama=mysql_fetch_array($agama);
    
    for ($d = 0; $d < sizeof($endiagamamu); $d++) {
      if ($dataagama['agama'] == $endiagamamu[$d]) {
       echo '<option value="'.$endiagamamu[$d].'" selected>'.$endiagamamu[$d].'</option>';
     } else {
       echo '<option value="'.$endiagamamu[$d].'">'.$endiagamamu[$d].'</option>';
     }
   }
   ?>
 </select>
 
</div>
</div>



<div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat Rumah<span class="required">*</span>
 </label>
 <div class="col-md-6 col-sm-6 col-xs-12">
  <input type="text" id="alamat" name="alamat" value="<?php echo $rowks['alamat'];?>" required="required" class="form-control col-md-7 col-xs-12">
</div>
</div>

<div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email<span class="required">*</span>
 </label>
 <div class="col-md-6 col-sm-6 col-xs-12">
  <input type="text" id="email" name="email" value="<?php echo $rowks['email'];?>" required="required" class="form-control col-md-7 col-xs-12">
</div>
</div>

<div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telp">Nomor Telepon<span class="required">*</span>
 </label>
 <div class="col-md-6 col-sm-6 col-xs-12">
  <input type="text" id="telp" name="telp" value="<?php echo $rowks['telp'];?>" required="required" class="form-control col-md-7 col-xs-12">
</div>
</div>

<div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_kelas">Kelas<span class="required">*</span>
 </label>
 <div class="col-md-6 col-sm-6 col-xs-12">
  <select name="id_kelas" id="id_kelas" value="<?php echo $rowks['id_kelas'];?>" class="form-control col-md-7 col-xs-12">
    <option value="">--- Pilih Kelas Siswa --</option>
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

<div style="text-align:center" class="form-actions no-margin-bottom">
 <button type="submit" id="siswa_simpan" name="siswa_simpan" class="btn btn-success">Submit</button>
</div>
</form>
</div>

<script src="assets/validator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/vendor/formvalidation/css/formValidation.min.css">
<link rel="stylesheet" href="/asset/css/demo.css">
<script src="/vendor/formvalidation/js/formValidation.min.js"></script>
<script src="/vendor/formvalidation/js/framework/uikit.min.js"></script>

<script type="text/javascript">
 var formsiswa = $("#formsiswa").serialize();
 var validator = $("#formsiswa").bootstrapValidator({
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
       message: 'Harus Isi NIP'
     },
     stringLength: {
      min: 1,
      max: 12,
      message: 'NIP harus 12 angka.'
    },
    remote: {
      type: 'POST',
      url: 'remote/remote_siswa.nip.php',
      message: 'NIS Siswa Telah Tersedia'
    },
  }
}, 

}
});
</script>

</body>

<?php
  // LOAD FOOTER
loadAssetsFoot();

ob_end_flush();
?>
