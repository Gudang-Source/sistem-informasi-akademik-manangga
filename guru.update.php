<!-- user login -->
<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));

// TEMPLATE CONTROL
$ui_register_page     = 'guru';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Update Data Guru');

//LOAD DATA
if (isset($_POST['guru_simpan'])) {

  #baca variabel
  $nip  = $_POST['nip'];
  $password  = $_POST['password'];
  $nm_guru  = $_POST['nm_guru'];
  $tmpt_lahir  = $_POST['tmpt_lahir'];
  $date_tgl_lahir  = $_POST['date_tgl_lahir'];
  $jns_kelamin  = $_POST['jns_kelamin'];
  $agama  = $_POST['agama'];
  $almt_sekarang = $_POST['almt_sekarang'];
  $no_hp  = $_POST['no_hp'];
  $email  = $_POST['email'];
  $id_user =2;

  #validasi form kosong
 $pesanError= array();
  if (trim($nip)=="") {
    $pesanError[]="Data <b>NIP</b> masih kosong.";
  }
   if (trim($password)=="") {
    $pesanError[]="Data <b>Password</b> masih kosong.";
  }
  if (trim($nm_guru)=="") {
    $pesanError[]="Data <b>Nama Gru</b> masih kosong.";
  }
   if (trim($tmpt_lahir)=="") {
    $pesanError[]="Data <b>Tempat Lahir</b> masih kosong.";
  }
    if (trim($date_tgl_lahir)=="") {
    $pesanError[]="Data <b>Tanggal Lahir</b> masih kosong.";
  }
    if (trim($jns_kelamin)=="") {
    $pesanError[]="Data <b>Jenis Kelamin</b> masih kosong.";
  }
    if (trim($agama)=="") {
    $pesanError[]="Data <b>Agama</b> masih kosong.";
  }
   if (trim($almt_sekarang)=="") {
    $pesanError[]="Data <b>Alamat Sekarang</b> masih kosong.";
  }
      if (trim($no_hp)=="") {
    $pesanError[]="Data <b>Nomor HP</b> masih kosong.";
  }
      if (trim($email)=="") {
    $pesanError[]="Data <b>Email</b> masih kosong.";
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
    $query = mysql_query("UPDATE guru SET nip='$nip', nm_guru='$nm_guru', password='$password', date_tgl_lahir='$date_tgl_lahir', jns_kelamin='$jns_kelamin', tmpt_lahir='$tmpt_lahir', agama='$agama', almt_sekarang='$almt_sekarang', no_hp='$no_hp', email='$email' WHERE nip='$_GET[id]'") or die(mysql_error());

   if ($query){
    header('location: ./guru');
  }
} 

}
# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
$edit = mysql_query("SELECT * FROM guru WHERE nip='$_GET[id]'");
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
          <h1 class="uk-article-title">Guru <span class="uk-text-large">{ Edit Guru }</span></h1>
          <br>
          <a href="./guru" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Guru"><i class="uk-icon-angle-left"></i> Kembali</a>

           <form id="formguru" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

      <div class="item form-group">
       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nip">NIP<span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nip" name="nip" value="<?php echo $rowks['nip'];?>" required="required" class="form-control col-md-7 col-xs-12">
            <div class="reg-info">Contoh: 126500182411. Jumlah angka harus 12. Wajib Diisi (Digunakan sebagai username untuk login)</div>
      </div>
      
    </div>

   <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_guru">Nama Guru<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nm_guru" name="nm_guru" value="<?php echo $rowks['nm_guru'];?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
      </div>

   <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="password" name="password" value="<?php echo $rowks['password'];?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

       <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_tgl_lahir">Tanggal Lahir<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="date_tgl_lahir" name="date_tgl_lahir" value="<?php echo $rowks['date_tgl_lahir'];?>" required="required" class="form-control col-md-7 col-xs-12" data-uk-datepicker="{format:'YYYY/DD/MM'}" >
            <div class="reg-info">Format: <code>TTTT/HH/BB</code></div>
            <div class="reg-info">Contoh: 1995/31/12</div>
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
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jns_kelamin">Jenis Kelamin<span class="required">*</span>
     </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
       <select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="jns_kelamin" name="jns_kelamin" value="" required>
        <option value="">-Pilih Jenis Kelaimn-</option> 
        <?php
                      //MENGAMBIL NAMA PROVINSI YANG DI DATABASE
        $jns_kelamin =mysql_query("SELECT * FROM guru ORDER BY jns_kelamin");
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
    $agama =mysql_query("SELECT * FROM guru ORDER BY agama");
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
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="almt_sekarang">Alamat Rumah<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="almt_sekarang" name="almt_sekarang" value="<?php echo $rowks['almt_sekarang'];?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
       </div>

      <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_hp">No. HP<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="no_hp" name="no_hp" value="<?php echo $rowks['no_hp'];?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
       </div>

         <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="email" name="email" value="<?php echo $rowks['email'];?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
       </div>

    <div style="text-align:center" class="form-actions no-margin-bottom">
     <button type="submit" id="guru_simpan" name="guru_simpan" class="btn btn-success">Submit</button>
   </div>
 </form>
</div>

<script src="assets/validator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/vendor/formvalidation/css/formValidation.min.css">
<link rel="stylesheet" href="/asset/css/demo.css">
<script src="/vendor/formvalidation/js/formValidation.min.js"></script>
<script src="/vendor/formvalidation/js/framework/uikit.min.js"></script>

<script type="text/javascript">
 var formguru = $("#formguru").serialize();
 var validator = $("#formguru").bootstrapValidator({
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
      url: 'remote/remote_guru.nip.php',
      message: 'NIP Guru Telah Tersedia'
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
