<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

/*template control*/
$ui_register_page     = 'wali';
$ui_register_assets   = array('datepicker');

/*load header*/
loadAssetsHead('Update Master Data Orangtua/Wali Siswa');

/*form processing*/
if (isset ($_POST["wali_simpan"])) { 

    // baca variabel
  $nm_bapak            = $_POST['nm_bapak'];
  $pekerjaan_bapak     = $_POST['pekerjaan_bapak'];
  $gaji_bapak          = $_POST['gaji_bapak'];
  $nohp_bapak          = $_POST['nohp_bapak'];
  $nm_ibu              = $_POST['nm_ibu'];
  $pekerjaan_ibu       = $_POST['pekerjaan_ibu'];
  $gaji_ibu            = $_POST['gaji_ibu'];
  $nohp_ibu            = $_POST['nohp_ibu'];
  $alamat              = $_POST['alamat'];

    // validation form kosong

  if (trim($nm_bapak)=="") {
    $pesanError[]="Data <b>Nama Bapak</b> Masih Kosong.";
  }
  if (trim($pekerjaan_bapak)=="") {
    $pesanError[]="Data <b>Pekerjaan Bapak</b> Masih Kosong.";
  }
  if (trim($gaji_bapak)=="") {
    $pesanError[]="Data <b>Gaji Bapak</b> Masih Kosong.";
  }
  if (trim($nohp_bapak)=="") {
    $pesanError[]="Data <b>No Handphone Bapak</b> Masih Kosong.";
  }
  if (trim($nm_ibu)=="") {
    $pesanError[]="Data <b>Nama Ibu</b> Masih Kosong.";
  }
  if (trim($pekerjaan_ibu)=="") {
    $pesanError[]="Data <b>Pekerjaan Ibu</b> Masih Kosong.";
  }

    if (trim($gaji_ibu)=="") {
    $pesanError[]="Data <b>Gaji Ibu</b> Masih Kosong.";
  }
    if (trim($nohp_ibu)=="") {
    $pesanError[]="Data <b>No Handphone Ibu</b> Masih Kosong.";
  }
    if (trim($alamat)=="") {
    $pesanError[]="Data <b>Alamat</b> Masih Kosong.";
  }
 

    // jika ada error dari validasi form
      if (count($pesanError)>=1) {
        echo "
        <div class='alert alert-danger alert-dismissable'>
          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
          $noPesan= 0;
          foreach ($pesanError as $indeks => $pesan_tampil) {
            $noPesan++;
            echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
          }
          echo "</div><br />";
        }
        else{


$query = mysql_query("UPDATE wali SET nm_bapak='$nm_bapak', pekerjaan_bapak='$pekerjaan_bapak', gaji_bapak='$gaji_bapak', nohp_bapak='$nohp_bapak', nm_ibu='$nm_ibu', pekerjaan_ibu='$pekerjaan_ibu', gaji_ibu='$gaji_ibu', nohp_ibu='$nohp_ibu', alamat='$alamat' WHERE id_wali='$_GET[id]'") or die(mysql_error());

if ($query){
  header('location: ./wali-murid');
  }
}
}

    // simpan pada form, dan jika form belum terisi
    
$edit = mysql_query("SELECT * FROM wali WHERE id_wali='$_GET[id]'");
$rowks  = mysql_fetch_array($edit);

?>
      <script type="text/javascript">
        var htmlobjek;
        $(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=prov>
  $("#prov").change(function(){
    var prov = $("#prov").val();
    $.ajax({
      url: "inc/jikuk_kabupaten.php",
      data: "prov="+prov,
      cache: false,
      success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#kota").html(msg);
        }
    });
  });
  $("#kota").change(function(){
    var kota = $("#kota").val();
    $.ajax({
      url: "inc/jikuk_kecamatan.php",
      data: "kota="+kota,
      cache: false,
      success: function(msg){
        $("#id_kec").html(msg);
      }
    });
  });
  $("#id_kec").change(function(){
    var id_kec = $("#id_kec").val();
    $.ajax({
      url: "inc/jikuk_kelurahan.php",
      data: "id_kec="+id_kec,
      cache: false,
      success: function(msg){
        $("#id_kel").html(msg);
      }
    });
  });
});

      </script>
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
            <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="Sistem Informasi Akademik SD N II Manangga" title="Sistem Informasi Akademik SD N II Manangga">
          </div>
          <hr class="uk-article-divider">
          <h1 class="uk-article-title">Orangtua / Wali Siswa <span class="uk-text-large">{ Tambah Master Data Orangtua / Wali Siswa }</span></h1>
          <br>
          <a href="./wali-murid" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Siswa"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->

          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
             <form id="formsiswa" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">


        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_bapak">Nama Bapak<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nm_bapak" name="nm_bapak" value="<?php echo $rowks['nm_bapak'];?>" required="required" class="form-control col-md-7 col-xs-12">
            <div class="reg-info">Contoh: Sule Sunata</div>
          </div>
        </div>

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pekerjaan_bapak">Pekerjaan Bapak<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="pekerjaan_bapak" name="pekerjaan_bapak" value="<?php echo $rowks['pekerjaan_bapak'];?>" required="required" class="form-control col-md-7 col-xs-12">
            <div class="reg-info">Contoh: Komedian</div>
          </div>
        </div>

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gaji_bapak">Gaji Bapak<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="gaji_bapak" name="gaji_bapak" value="<?php echo $rowks['gaji_bapak'];?>" required="required" class="form-control col-md-7 col-xs-12">
            <div class="reg-info">Contoh: 3500000</div>
          </div>
        </div>

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nohp_bapak">Nomor Telepon<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nohp_bapak" name="nohp_bapak" value="<?php echo $rowks['nohp_bapak'];?>" required="required" class="form-control col-md-7 col-xs-12">
            <div class="reg-info">Contoh: 08123456789</div>
          </div>
        </div>

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_ibu">Nama Ibu<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nm_ibu" name="nm_ibu" value="<?php echo $rowks['nm_ibu'];?>" required="required" class="form-control col-md-7 col-xs-12">
            <div class="reg-info">Contoh: Awkarin Nurhidayah</div>
          </div>
        </div>


        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pekerjaan_ibu">Pekerjaan Ibu<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" value="<?php echo $rowks['pekerjaan_ibu'];?>" required="required" class="form-control col-md-7 col-xs-12">
            <div class="reg-info">Contoh: Youtuber</div>
          </div>
        </div>

       <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gaji_ibu">Gaji Ibu<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="gaji_ibu" name="gaji_ibu" value="<?php echo $rowks['gaji_ibu'];?>" required="required" class="form-control col-md-7 col-xs-12">
            <div class="reg-info">Contoh: 6500000</div>
          </div>
        </div>

       <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nohp_ibu">Nomor Telepon<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nohp_ibu" name="nohp_ibu" value="<?php echo $rowks['nohp_ibu'];?>" required="required" class="form-control col-md-7 col-xs-12">
            <div class="reg-info">Contoh: 08123456789</div>
          </div>
        </div>

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat Rumah<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="alamat" name="alamat" value="<?php echo $rowks['alamat'];?>" required="required" class="form-control col-md-7 col-xs-12">
            <div class="reg-info">Contoh: Jalan Kenanga, Depok, Sleman, Yogyakarta</div>
          </div>
        </div>

        <div class="uk-form-row">
        <div class="uk-alert">Pastikan semua isian sudah terisi dengan benar!</div>
        </div>
         <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" id="wali_simpan" name="wali_simpan" class="btn btn-success">Submit</button>
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
nm_bapak: {
    message: 'Nama Tidak Benar',
    validators: {
      notEmpty: {
        message: 'Nama Harus Diisi'
      },
      stringLength: {
        min: 1,
        max: 50,
        message: 'Nama Harus Lebih dari 1 Huruf dan Maksimal 50 Huruf'
      },
      regexp: {
        regexp: /^[a-zA-Z ]+$/,
        message: 'Karakter Yang Boleh Digunakan hanya huruf'
      },
    }
  },
pekerjaan_bapak: {
    message: 'Pekerjaan Tidak Benar',
    validators: {
      notEmpty: {
        message: 'Pekerjaan Harus Diisi'
      },
      stringLength: {
        min: 1,
        max: 50,
        message: 'Pekerjaan Harus Lebih dari 1 Huruf dan Maksimal 50 Huruf'
      },
      regexp: {
        regexp: /^[a-zA-Z ]+$/,
        message: 'Karakter Yang Boleh Digunakan hanya huruf'
      },
    }
  },
  gaji_bapak: {
    message: 'Gaji Tidak Benar',
    validators: {
      notEmpty: {
        message: 'Gaji Harus Diisi'
      },
      stringLength: {
        min: 0,
        max: 30,
        message: 'Gaji Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
      },
      regexp: {
        regexp: /^[0-9+]+$/,
        message: 'Format Tidak Benar'
      },
    }
  },
    nohp_bapak: {
    message: 'No HP Tidak Benar',
    validators: {
      notEmpty: {
        message: 'No HP Harus Diisi'
      },
      stringLength: {
        min: 10,
        max: 30,
        message: 'No Hp Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
      },
      regexp: {
        regexp: /^[0-9+]+$/,
        message: 'Format Tidak Benar'
      },
    }
  },
nm_ibu: {
    message: 'Nama Tidak Benar',
    validators: {
      notEmpty: {
        message: 'Nama Harus Diisi'
      },
      stringLength: {
        min: 1,
        max: 50,
        message: 'Nama Harus Lebih dari 1 Huruf dan Maksimal 50 Huruf'
      },
      regexp: {
        regexp: /^[a-zA-Z ]+$/,
        message: 'Karakter Yang Boleh Digunakan hanya huruf'
      },
    }
  },
pekerjaan_ibu: {
    message: 'Pekerjaan Tidak Benar',
    validators: {
      notEmpty: {
        message: 'Pekerjaan Harus Diisi'
      },
      stringLength: {
        min: 1,
        max: 50,
        message: 'Pekerjaan Harus Lebih dari 1 Huruf dan Maksimal 50 Huruf'
      },
      regexp: {
        regexp: /^[a-zA-Z ]+$/,
        message: 'Karakter Yang Boleh Digunakan hanya huruf'
      },
    }
  },
gaji_ibu: {
    message: 'Gaji Tidak Benar',
    validators: {
      notEmpty: {
        message: 'Gaji Harus Diisi'
      },
      stringLength: {
        min: 0,
        max: 30,
        message: 'Gaji Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
      },
      regexp: {
        regexp: /^[0-9+]+$/,
        message: 'Format Tidak Benar'
      },
    }
  },
nohp_ibu: {
    message: 'No HP Tidak Benar',
    validators: {
      notEmpty: {
        message: 'No HP Harus Diisi'
      },
      stringLength: {
        min: 10,
        max: 30,
        message: 'No Hp Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
      },
      regexp: {
        regexp: /^[0-9+]+$/,
        message: 'Format Tidak Benar'
      },
    }
  },
  alamat : {
    message: 'Alamat Tidak Benar',
    validators: {
      notEmpty: {
        message: 'Alamat Harus Diisi'
      },
      stringLength: {
        min: 10,
        max: 100,
        message: 'Alamat Harus Lebih dari 10 Huruf dan Maksimal 100 Huruf'
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
