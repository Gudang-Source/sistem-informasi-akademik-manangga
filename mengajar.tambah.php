<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

/*template control*/
$ui_register_page     = 'mengajar.tambah';
$ui_register_assets   = array('datepicker');

/*load header*/
loadAssetsHead('Tambah Data Master Mengajar');

/*form processing*/
if (isset ($_POST["mengajar_simpan"])) { 

    // baca variabel
    
    $kd_mapel     = $_POST['kd_mapel'];
    $nip     = $_POST['nip'];
    $nip     = str_replace("", "&acute;", $nip);
    $kd_kelas     = $_POST['kd_kelas'];
 //   $kd_kelas     = str_replace("", "&acute;", $kd_kelas);
    // validation form kosong
   $pesanError= array();
  if (trim($kd_mapel)=="") {
    $pesanError[]="Data <b>Kode Mengajar</b> Masih Kosong.";
  }
  if (trim($nip)=="") {
    $pesanError[]="Data <b>Nama Mengajar</b> Masih Kosong.";
  }
  
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

 $jumlah = count($_POST["kd_kelas"]);

for($i=0; $i < $jumlah; $i++)
{
   $kelass=$_POST['kd_kelas'][$i];


      $querytambahmengajar =  mysql_query("INSERT INTO mengajar (id_guru, kd_mapel, id_kelas) VALUES ( '$nip', '$kd_mapel',  '$kelass' )") or die(mysql_error());


}

    // simpan ke database

  header('location: ./mengajar');


  
    
  
 }
}

    // simpan pada form, dan jika form belum terisi
 // $datakodemapel  = isset($_POST['kd_mapel']) ? $_POST['kd_mapel'] : '';
 // $datanamamapel  = isset($_POST['nm_mapel']) ? $_POST['nm_mapel'] : '';
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
          <h1 class="uk-article-title">Mengajar <span class="uk-text-large">{ Tambah Master Data Mengajar }</span></h1>
          <br>
          <a href="./mengajar" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Master Mengajar"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
             <form id="formmapel" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
        
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nip">Pilih Guru<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="nip" id="nip" value="<?php echo $datanip; ?>" class="form-control col-md-7 col-xs-12">
              <option value="">--- Guru --</option>
              <?php
              $query = "SELECT * from guru";
              $hasil = mysql_query($query);
              while ($data = mysql_fetch_array($hasil))
              {
                echo "<option value=".$data['id_guru'].">".$data['nm_guru']."</option>";
              }
              ?>
            </select>
          </div>
        </div>
        
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_mapel">Pilih Mapel<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="kd_mapel"  id="kd_mapel" value="" class="form-control col-md-7 col-xs-12">
              <option value="">--- Mapel --</option>
              <?php
              $query2 = "SELECT * from mapel";
              $hasil2 = mysql_query($query2);
              while ($data2 = mysql_fetch_array($hasil2))
              {
                echo "<option value=".$data2['kd_mapel'].">".$data2['nm_mapel']."</option>";
              }
              ?>
            </select>
          </div>
        </div>


<div class="item form-group">
      <label  class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_kelas">Pilih Kelas yang Diampu <span class="required" >*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="select">
         <label>
             <?php
                $querys = "SELECT * FROM kelas";
                $hasils = mysql_query($querys);
               
                while ($datas = mysql_fetch_array($hasils))
                {
                  echo "<p><br><input type='checkbox' class='flat-red' id='kd_kelas' value='".$datas['id_kelas']."' name='kd_kelas[]'/>
                  <label for='kd_kelas'>".$datas['nm_kelas']."</label></p>";
                }?>
      </div>
    </div>

</div>


        <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" id="mengajar_simpan" name="mengajar_simpan" class="btn btn-success">Submit</button>
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
 var formmapel = $("#formmapel").serialize();
 var validator = $("#formmapel").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "glyphicon glyphicon-ok",
    invalid: "glyphicon glyphicon-remove", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
    kd_mapel : {
     validators: {
      notEmpty: {
       message: 'Harus Pilih Mengajar'
     },
     
   }
 }, 
nm_mapel: {
  message: 'Nama Mengajar Tidak Benar',
  validators: {
    notEmpty: {
      message: 'Nama Mengajar Harus Diisi'
    },
    stringLength: {
      min: 1,
      max: 30,
      message: 'Nama Mengajar Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
    },
    regexp: {
      regexp: /^[a-zA-Z0-9_ \. ]+$/,
      message: 'Karakter Boleh Digunakan (Angka, Huruf, Titik, Underscore)'
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
