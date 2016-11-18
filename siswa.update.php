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
$password1  = $_POST['password1'];
$nm_siswa     = $_POST['nm_siswa'];
$tempat_lahir     = $_POST['tempat_lahir'];
$date_tgl_lahir0  = $_POST['date_tgl_lahir'];
$date_tgl_lahir=ubahformatTgl($date_tgl_lahir0);
$jns_kelamin     = $_POST['jns_kelamin'];
$agama     = $_POST['agama'];
$id_kec  = $_POST['id_kec'];
$id_kec  = str_replace("'","&acute;",$id_kec);
$kota  = $_POST['kota'];
$kota  = str_replace("'","&acute;",$kota);
$prov  = $_POST['prov'];
$prov  = str_replace("'","&acute;",$prov);
$id_kel  = $_POST['id_kel'];
$id_kel  = str_replace("'","&acute;",$id_kel);
$almt_sekarang = $_POST['almt_sekarang'];
$no_hp  = $_POST['no_hp'];
$telp     = $_POST['telp'];
$kd_kelas    = $_POST['kd_kelas'];
$tahun_masuk = $_POST['tahun_masuk'];
$tahun_keluar = $_POST['tahun_keluar'];
$id_user =3;

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

  $nama_foto = $_FILES["file"]["name"];
      $file_sik_dipilih = substr($nama_foto, 0, strripos($nama_foto, '.')); // strip extention
      $bagian_extensine = substr($nama_foto, strripos($nama_foto, '.')); // strip name
      $ukurane = $_FILES["file"]["size"];

  #validasi form kosong
  $pesanError= array();
      if (trim($nis)=="") {
        $pesanError[]="Data <b>NIS</b> masih kosong.";
      }
      if (trim($password)=="") {
        $pesanError[]="Data <b>Password</b> masih kosong.";
      }
      if (trim($password1)=="") {
        $pesanError[]="Data Konfirmasi<b>Password</b> masih kosong.";
      }
      if (trim($nm_siswa)=="") {
        $pesanError[]="Data <b>Nama Siswa</b> masih kosong.";
      }
      if (trim($tempat_lahir)=="") {
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
      if (trim($prov)=="") {
        $pesanError[] = "Data <b>Provinsi</b> tidak boleh kosong !";    
      }
      if (trim($kota)=="") {
        $pesanError[] = "Data <b>Kabupaten</b> tidak boleh kosong !";    
      }
      if (trim($id_kec)=="") {
        $pesanError[]="Data <b>Kecamatan</b> Masih kosong !!";
      }
      if (trim($id_kel)=="") {
        $pesanError[]="Data <b>Kelurahan</b> Masih kosong !!";
      }
      if (trim($alamat)=="") {
        $pesanError[]="Data <b>Alamat Sekarang</b> masih kosong.";
      }
      if (trim($no_hp)=="") {
        $pesanError[]="Data <b>Nomor HP</b> masih kosong.";
      }
      if (trim($email)=="") {
        $pesanError[]="Data <b>Email</b> masih kosong.";
      }
      if (trim($tahun_masuk)=="") {
        $pesanError[]="Data <b>Tahun Masuk</b> masih kosong.";
      }
      if (trim($tahun_keluar)=="") {
        $pesanError[]="Data <b>Tahun Kelurahan</b> masih kosong.";
      }
      if (trim($id_user)=="") {
        $pesanError[] = "Data <b>id_user</b> tidak boleh kosong !";    
      }
      if (empty($file_sik_dipilih)){
            $query = mysql_query("UPDATE siswa 
              SET id_user ='$id_user', 
                nis='$nis', 
                password='$password',
                nm_siswa='$nm_siswa',
                tempat_lahir='$tempat_lahir',
                date_tgl_lahir='$date_tgl_lahir',
                jns_kelamin='$jns_kelamin',
                id_agama='$agama',
                alamat='$alamat',
                email='$email',
                no_hp='$no_hp',
                tahun_masuk='tahun_keluar',
               WHERE id_siswa='$_GET[id]'
                ") or die(mysql_error());
      }
   
  #jika ada pesan error validasi form
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

    if(($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/pjpeg")){
            $lokasi = 'gallery/news/';


            $file = md5(rand(1000,1000000000))."-".$nama_foto;
            $newfilename = $file . $bagian_extensine;
            $jeneng=str_replace(' ','-',$file);
            $url = $lokasi . $jeneng;
            $filename = compress_image($_FILES["file"]["tmp_name"], $url, 80); 

            $query = mysql_query("UPDATE siswa 
              SET id_user ='$id_user', 
                nis='$nis', 
                password='$password',
                nm_siswa='$nm_siswa',
                tempat_lahir='$tempat_lahir',
                date_tgl_lahir='$date_tgl_lahir',
                jns_kelamin='$jns_kelamin',
                id_agama='$agama',
                alamat='$alamat',
                email='$email',
                no_hp='$no_hp',
                tahun_masuk='tahun_keluar',
                WHERE id_siswa='$_GET[id]'
                ") or die(mysql_error());

          }
          if ($query){
            header('location: ./siswa');
          }
          else { $error = "Uploaded image should be jpg or gif or png"; } 

        }
      }

  #update data ke database

# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
$edit = mysql_query("SELECT * FROM siswa WHERE id_siswa='$_GET[id]'");
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

<!-- page content -->
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
          <h1 class="uk-article-title">Manajemen Siswa <span class="uk-text-large">{ Edit Siswa }</span></h1>
          <br>
          <a href="./siswa" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Siswa"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <form id="formsiswa" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
              <form id="formsiswa" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

                <div class="uk-grid">
                  <div class="uk-width-3-10"><div class="uk-panel uk-panel-box">
                     <div class="item form-group">
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="col-lg-8">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                          <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="gallery/news/<?=$rowks['foto'];?>"></div>
                          <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                          <div>
                            <span class="btn btn-file btn-primary btn-xs"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" accept="image/*" name="file" id="file" placeholder="file" /></span>
                            <a href="#" class="btn btn-danger btn-xs fileupload-exists" data-dismiss="fileupload">Remove</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                   
                  </div></div>
                  <div class="uk-width-7-10">  <div class="uk-panel uk-panel-box">                    
                    <table class="uk-table uk-table-hover  uk-table-condensed">
                      <tbody>
                        <tr>
                          <div class="item form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">NIS<span class="required">*</span>
                           </label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                           <input  type="text" id="nis" name="nis" value="<?php echo $rowks['nis'];?>" required="required" class="form-control col-md-7 col-xs-12">
                           <div class="reg-info">Contoh: 55550. Wajib Diisi (Digunakan sebagai username untuk login)</div>
                          </div>
                        </div>
                      
                    </tr>
                    <tr>
                      <div class="item form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_siswa">Nama Siswa<span class="required">*</span>
                       </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       <input  type="text" id="nm_siswa" name="nm_siswa" value="<?php echo $rowks['nm_siswa'];?>" required="required" class="form-control col-md-7 col-xs-12">
                        <div class="reg-info">Contoh: Ripa Gemah Nuripah</div>
                      </div>
                    </div>
                  </tr>
                  <tr>
                   <div class="item form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password<span class="required">*</span>
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                     <input  type="text" id="password" name="password" value="<?php echo $rowks['password'];?>" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                </tr>
                <tr>
                 <div class="item form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password1">Konfirmasi Password<span class="required">*</span>
                   </label>
                   <div class="col-md-6 col-sm-6 col-xs-12">
                   <input  type="text" id="password1" name="password1" value="<?php echo $rowks['password'];?>" required="required" class="form-control col-md-7 col-xs-12">
                     <div class="reg-info">Contoh: 126500182411. Jumlah minimal 6 karakter. Harus Sama dengan Password. Wajib diisi (Digunakan untuk login)</div>
                   </div>
                 </div>
               </tr>

            <tr>
              <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tempat_lahir">Tempat Lahir<span class="required">*</span>
               </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <input  type="text" id="tempat_lahir" name="tempat_lahir" value="<?php echo $rowks['tempat_lahir'];?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </tr>

               <tr>
                <div class="item form-group">
                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_tgl_lahir">Tanggal Lahir<span class="required">*</span>
                 </label>
                 <div class="col-md-6 col-sm-6 col-xs-12">
                 <input  type="text" id="date_tgl_lahir" name="date_tgl_lahir" value="<?php echo $rowks['date_tgl_lahir'];?>" required="required" class="form-control col-md-7 col-xs-12" data-uk-datepicker="{format:'YYYY/DD/MM'}" >
                          <div class="reg-info">Format: <code>DD/MM/YYYY</code></div>
                          <div class="reg-info">Contoh: 31/12/1994</div>
                </div>
              </div>
            </tr>

          <tr>
            <div class="item form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jns_kelamin">Jenis Kelamin<span class="required">*</span>
             </label>
             <div class="col-md-6 col-sm-6 col-xs-12">
               <select  type="text" class="form-control chzn-select col-md-7 col-xs-12" id="jns_kelamin" name="jns_kelamin" value="" required>
                <option value="">-Pilih Jenis Kelamin-</option> 
       <?php
        if ($rowks['jns_kelamin']=="Laki-laki") {
        ?>
          <option value="Laki-laki" selected>Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        <?php
        }
         else{ ?>
          <option value="Laki-laki" selected>Laki-laki</option>
          <option value="Perempuan">Perempuan</option>     
      <?php     } 
      ?>
            </select>




          </div>
        </div>
      </tr>
      <tr>
        <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="agama">Agama<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
           <select  type="text" class="form-control chzn-select col-md-7 col-xs-12" id="agama" name="agama" value="" required>
            <option value="">-Pilih Agama-</option>
          <?php
                    //MENGAMBIL NAMA PROVINSI YANG DI DATABASE
      $agama =mysql_query("SELECT * FROM agama ORDER BY nm_agama asc");
      while ($dataagama=mysql_fetch_array($agama)) {
       if ($dataagama['id_agama']==$rowks['id_agama']) {
         $cek ="selected";
       }
       else{
        $cek= "";
      }
      echo "<option value=\"$dataagama[id_agama]\" $cek>$dataagama[nm_agama]</option>\n";
    }
    ?>
         </select>

       </div>
     </div>
   </tr>

<tr>
  <div class="item form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat Rumah<span class="required">*</span>
   </label>

   <div class="col-md-6 col-sm-6 col-xs-12">
   <input  type="text" id="alamat" name="alamat" value="<?php echo $rowks['alamat'];?>" required="required" class="form-control col-md-7 col-xs-12">
    <div class="reg-info">Wajib diisi data alamat rumah sekarang, isi data alamat rumah sekarang dengan lengkap</div>
  </div>
</div>      
</tr>

<tr>
  <div class="item form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email<span class="required">*</span>
   </label>
   <div class="col-md-6 col-sm-6 col-xs-12">
   <input  type="text" id="email" name="email" value="<?php echo $rowks['email'];?>" class="form-control col-md-7 col-xs-12">
    <div class="reg-info">Email Wajib Diisi </div>
  </div>
</div>      
</tr>

<tr>
  <div class="item form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_hp">No. HP<span class="required">*</span>
   </label>
   <div class="col-md-6 col-sm-6 col-xs-12">
   <input  type="text" id="no_hp" name="no_hp" value="<?php echo $rowks['no_hp'];?>" class="form-control col-md-7 col-xs-12">
    <div class="reg-info">Wajib Isi Data No Hp</div>
  </div>
</div>      
</tr>

<tr>
  <div class="item form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tahun_masuk">Tahun Masuk<span class="required">*</span>
   </label>
   <div class="col-md-6 col-sm-6 col-xs-12">
   <input  type="text" id="tahun_masuk" name="tahun_masuk" value="<?php echo $rowks['tahun_masuk'];?>" required="required" class="form-control col-md-7 col-xs-12">
    <div class="reg-info">Wajib Isi Data Tahun Masuk</div>
  </div>
</div>      
</tr>

<tr>
  <div class="item form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tahun_keluar">Tahun Keluar<span class="required">*</span>
   </label>
   <div class="col-md-6 col-sm-6 col-xs-12">
   <input  type="text" id="tahun_keluar" name="tahun_keluar" value="<?php echo $rowks['tahun_keluar'];?>" required="required" class="form-control col-md-7 col-xs-12">
    <div class="reg-info">Wajib Isi Data Tahun Keluar</div>
  </div>
</div>      

  <div class="uk-form-row">
    <div class="uk-alert">Pastikan semua isian sudah terisi dengan benar!</div>
  </div>
  <div style="text-align:center" class="form-actions no-margin-bottom">
   <button type="submit" id="siswa_simpan" name="siswa_simpan" class="btn btn-success">Submit</button>
 </div>
</form>      
</tr>
</tbody>
</table>

</div></div>

</div>
</div>
</div>
</div>
</div>
</div>

<script src="assets/validator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/vendor/formvalidation/css/formValidation.min.css">
<link rel="stylesheet" href="/asset/css/demo.css">
<script src="/vendor/formvalidation/js/formValidation.min.js"></script>
<script src="/vendor/formvalidation/js/framework/uikit.min.js"></script>

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
     
    }
  },

  tahun_masuk: {
    message: 'Tahun Masuk Tidak Benar',
    validators: {
      notEmpty: {
        message: 'Tahun Masuk Harus Diisi'
      },
      stringLength: {
        min: 4,
        max: 4,
        message: 'Tahun Masuk Harus 4 Digit'
      },
      regexp: {
        regexp: /^[0-9+]+$/,
        message: 'Format Tidak Benar'
      },

    }
  },
  tahun_keluar: {
    message: 'Tahun Keluar Tidak Benar',
    validators: {
      notEmpty: {
        message: 'Tahun Keluar Harus Diisi'
      },
      stringLength: {
        min: 4,
        max: 4,
        message: 'Tahun Keluar Harus 4 Digit'
      },
      regexp: {
        regexp: /^[0-9+]+$/,
        message: 'Format Tidak Benar'
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
