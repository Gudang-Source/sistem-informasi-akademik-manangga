<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

/*template control*/
$ui_register_page     = 'wali';
$ui_register_assets   = array('datepicker');

/*load header*/
loadAssetsHead('Tambah Master Data Orangtua/Wali Siswa');

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


$query = mysql_query("INSERT INTO wali (nm_bapak, pekerjaan_bapak, gaji_bapak, nohp_bapak, nm_ibu, pekerjaan_ibu, gaji_ibu, nohp_ibu, alamat)
VALUES ('$nm_bapak', '$pekerjaan_bapak', '$gaji_bapak', '$nohp_bapak', '$nm_ibu', '$pekerjaan_ibu', '$gaji_ibu', '$nohp_ibu', '$alamat')") or die(mysql_error());

if ($query){
  header('location: ./wali-murid');
  }
}
}

    // simpan pada form, dan jika form belum terisi
  $datanamabapak        = isset($_POST['nm_bapak']) ? $_POST['nm_bapak'] : '';
  $datapekerjaanbapak   = isset($_POST['pekerjaan_bapak']) ? $_POST['pekerjaan_bapak'] : '';
  $datagajibapak        = isset($_POST['gaji_bapak']) ? $_POST['gaji_bapak'] : '';
  $datanohpbapak        = isset($_POST['nohp_bapak']) ? $_POST['nohp_bapak'] : '';
  $datanamaibu          = isset($_POST['nm_ibu']) ? $_POST['nm_ibu'] : '';
  $datapekerjaanibu     = isset($_POST['pekerjaan_ibu']) ? $_POST['pekerjaan_ibu'] : '';
  $datagajiibu          = isset($_POST['gaji_ibu']) ? $_POST['gaji_ibu'] : '';
  $datanohpibu          = isset($_POST['nohp_ibu']) ? $_POST['nohp_ibu'] : '';
  $dataalamat           = isset($_POST['alamat']) ? $_POST['alamat'] : '';

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
            <input type="text" id="nm_bapak" name="nm_bapak" value="<?php echo $datanamabapak; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pekerjaan_bapak">Pekerjaan Bapak<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="pekerjaan_bapak" name="pekerjaan_bapak" value="<?php echo $datapekerjaanbapak; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gaji_bapak">Gaji Bapak<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="gaji_bapak" name="gaji_bapak" value="<?php echo $datagajibapak; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nohp_bapak">Nomor Telepon<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nohp_bapak" name="nohp_bapak" value="<?php echo $datanohpbapak; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_ibu">Nama Ibu<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nm_ibu" name="nm_ibu" value="<?php echo $datanamaibu; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>


        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pekerjaan_ibu">Pekerjaan Ibu<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" value="<?php echo $datapekerjaanibu; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

       <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gaji_ibu">Gaji Ibu<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="gaji_ibu" name="gaji_ibu" value="<?php echo $datagajiibu; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

       <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nohp_ibu">Nomor Telepon<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nohp_ibu" name="nohp_ibu" value="<?php echo $datanohpibu; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
        </div>

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat Rumah<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="alamat" name="alamat" value="<?php echo $dataalamat; ?>" required="required" class="form-control col-md-7 col-xs-12">
          </div>
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
  } ,
    nis : {
     validators: {
      notEmpty: {
       message: 'Harus Isi NIS'
     },
      stringLength: {
        min: 1,
        max: 5,
        message: 'NIP maksimal 5 angka.'
      },
     remote: {
      type: 'POST',
      url: 'remote/remote_siswa.php',
      message: 'Nama Siswa Telah Tersedia'
    },
   }
 }, 
nm_siswa: {
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
  password: {
    message: 'Data Password Tidak Benar',
    validators: {
      notEmpty: {
        message: 'Password Harus Diisi'
      },
      stringLength: {
        min: 1,
        max: 30,
        message: 'Nama kelurahan Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
      },
      different: {
        field: 'email',
        message:'Password Harus Beda dengan Email'
      },          
    }
  },
  password1: {
    message: 'Data Password Tidak Benar',
    validators: {
      identical:{
        field:'password',
        message: 'Konfirmasi Password Harus Sama Dengan Password'
      },
      notEmpty: {
        message: 'Password Harus Diisi'
      },
      stringLength: {
        min: 1,
        max: 30,
        message: 'Nama kelurahan Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
      },
      different: {
        field: 'email',
        message:'Password Harus Beda dengan Email'
      },
    }
  },
  tmpt_lahir : {
    validators: {
      notEmpty: {
        message: 'Harus diisi tempat lahir'
      }
    }
  },    
  jns_kelamin : {
    validators: {
      notEmpty: {
        message: 'Harus Pilih Jenis Kelamin'
      }
    }
  }, 
  agama : {
    validators: {
      notEmpty: {
        message: 'Harus Pilih Agama'
      }
    }
  },    
  prov : {
    validators: {
      notEmpty: {
        message: 'Harus Pilih Provinsi'
      }
    }
  },    
  kota : {
    validators: {
      notEmpty: {
        message: 'Harus Pilih Kabupaten'
      }
    }
  }, 
  id_kec : {
    validators: {
      notEmpty: {
        message: 'Harus Pilih Kecamatan'
      }
    }
  }, 
  id_kel : {
    validators: {
      notEmpty: {
        message: 'Harus Pilih Kelurahan'
      }
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
  no_hp: {
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
  email: {
    validators:{
      notEmpty: {
        message: 'Email Harus Diisi'
      },
      emailAddress:{
        message: 'Email Tidal valid'
      },
      remote: {
        type: 'POST',
        url: './remote/remote_email_guru.php',
        message: 'Email Sudah Tersedia'
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
