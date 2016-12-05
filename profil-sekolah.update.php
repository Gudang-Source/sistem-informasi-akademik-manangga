<!-- user login -->
<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));

// TEMPLATE CONTROL
$ui_register_page     = 'profil-sekolah';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Update Data Master Profil Sekolah');

//LOAD DATA
if (isset($_POST['profil_simpan'])) {

  #baca variabel
    $npsn     = $_POST['npsn'];
    $npsn     = str_replace("", "&acute;", $npsn);
    $npsn     = ucwords(strtolower($npsn));

    $status_sekolah         = $_POST['status_sekolah'];
    $bentuk                 = $_POST['bentuk'];
    $kodepos                = $_POST['kodepos'];
    $email                  = $_POST['email'];
    $website                = $_POST['website'];
    $sk_pendirian           = $_POST['sk_pendirian'];
    $tanggal_pendirian0     = $_POST['tanggal_pendirian'];
    $tanggal_pendirian      = ubahformatTgl($tanggal_pendirian0);
    $status_pemilik         = $_POST['status_pemilik'];
    $sk_izin                = $_POST['sk_izin'];
    $tanggal_izin0          = $_POST['tanggal_izin'];
    $tanggal_izin           = ubahformatTgl($tanggal_izin0);
    $lokasi                 = $_POST['lokasi'];
    $id_kec                 = $_POST['id_kec'];
    $id_kec                 = str_replace("'","&acute;",$id_kec);
    $kota                   = $_POST['kota'];
    $kota                   = str_replace("'","&acute;",$kota);
    $prov                   = $_POST['prov'];
    $prov                   = str_replace("'","&acute;",$prov);
    $alamat_sekolah         = $_POST['alamat_sekolah'];
    $id_kel                 = $_POST['id_kel'];
    $id_kel                 = str_replace("'","&acute;",$id_kel);

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
    $query = mysql_query("UPDATE tahun_ajaran SET thn_ajaran='$thn_ajaran', semester='$semester' WHERE thn_ajaran='$_GET[id]'") or die(mysql_error());

   if ($query){
        $cektahun = mysql_query("SELECT * FROM tahun_ajaran WHERE status='1'");
          mysql_num_rows($cektahun);
          $tahun_ajaransession = mysql_fetch_array($cektahun);          

          // tahun ajaran session
          $_SESSION['id_tahun'] = $tahun_ajaransession['id_tahun'];
          $_SESSION['thn_ajaran'] = $tahun_ajaransession['thn_ajaran'];
          $_SESSION['semester'] = $tahun_ajaransession['semester'];
          $_SESSION['status'] = $tahun_ajaransession['status'];
    header('location: ./tahun-ajaran');
  }
} 

}
  $datatahunpelajaran  = isset($_POST['thn_ajaran']) ? $_POST['thn_ajaran'] : '';
  $datasemester  = isset($_POST['semester']) ? $_POST['semester'] : '';

# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
$edit = mysql_query("SELECT * FROM tahun_ajaran WHERE id_tahun='$_GET[id]'");
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
          <h1 class="uk-article-title">Tahun Ajaran <span class="uk-text-large">{ Edit Tahun Ajaran }</span></h1>
          <br>
          <a href="./tahun-ajaran" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Tahun Ajaran"><i class="uk-icon-angle-left"></i> Kembali</a>

            <form id="formtahun" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="thn_ajaran">Tahun Ajaran<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="thn_ajaran" name="thn_ajaran" value="<?php echo $rowks['thn_ajaran'];?>" required="required" class="form-control col-md-7 col-xs-12">
            <div class="reg-info">Contoh: 2012/2013</div>
          </div>
        </div>

       <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="semester">Semester<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
                 <select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="semester" name="semester" value="" required>
        <?php
        //MENGAMBIL NAMA PROVINSI YANG DI DATABASE
              if ($rowks['semester']=="Ganjil") {
        ?>
              <option value="Ganjil" selected>Ganjil</option>
              <option value="Genap">Genap</option>
        <?php
         }
         else { ?>
              <option value="Genap" selected>Genap</option>
              <option value="Ganjil" >Ganjil</option>
                      
        <?php     
        }
        ?>
    </select>
          </div>
        </div>


    <div style="text-align:center" class="form-actions no-margin-bottom">
     <button type="submit" id="tahun_simpan" name="tahun_simpan" class="btn btn-success">Submit</button>
   </div>
 </form>
</div>

<script src="assets/validator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/vendor/formvalidation/css/formValidation.min.css">
<link rel="stylesheet" href="/asset/css/demo.css">
<script src="/vendor/formvalidation/js/formValidation.min.js"></script>
<script src="/vendor/formvalidation/js/framework/uikit.min.js"></script>

<script type="text/javascript">
 var formtahun = $("#formtahun").serialize();
 var validator = $("#formtahun").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "glyphicon glyphicon-ok",
    invalid: "glyphicon glyphicon-remove", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
    thn_ajaran : {
     validators: {
      notEmpty: {
       message: 'Harus Isi Tahun Ajaran'
     },
            stringLength: {
          min: 9,
          max: 9,
          message: 'Tahun Ajaran Tidak Lebih dari 9 Karakter'
        },
                regexp: {
          regexp: /[0-9+]+$/,
          message: 'Format Tidak Benar'
        },
   }
 }, 
semester: {
  message: 'Nama Semester Tidak Benar',
  validators: {
    notEmpty: {
      message: 'Nama Semester Harus Diisi'
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
