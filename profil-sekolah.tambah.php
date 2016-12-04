<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

/*template control*/
$ui_register_page     = 'profil-sekolah';
$ui_register_assets   = array('datepicker');

/*load header*/
loadAssetsHead('Tambah Master Profil Sekolah');

/*form processing*/
if (isset ($_POST["profil_simpan"])) { 

    // baca variabel

    $npsn     = $_POST['npsn'];
    $npsn     = str_replace("", "&acute;", $npsn);
    $npsn     = ucwords(strtolower($npsn));

    $status_sekolah     = $_POST['status_sekolah'];
    $bentuk             = $_POST['bentuk'];
    $kodepos             = $_POST['kodepos'];
    $email             = $_POST['email'];
    $website             = $_POST['website'];
    $sk_pendirian             = $_POST['sk_pendirian'];
    $tanggal_pendirian             = $_POST['tanggal_pendirian'];
    $status_pemilik             = $_POST['status_pemilik'];
    $sk_izin             = $_POST['sk_izin'];
    $tanggal_izin             = $_POST['tanggal_izin'];
    $lokasi             = $_POST['lokasi'];
  $id_kec  = $_POST['id_kec'];
  $id_kec  = str_replace("'","&acute;",$id_kec);
  $kota  = $_POST['kota'];
  $kota  = str_replace("'","&acute;",$kota);
  $prov  = $_POST['prov'];
  $prov  = str_replace("'","&acute;",$prov);
  $id_kel  = $_POST['id_kel'];
  $id_kel  = str_replace("'","&acute;",$id_kel);

    // validation form kosong
   $pesanError= array();
  if (trim($npsn)=="") {
    $pesanError[]="Data <b>NPSN</b> Masih Kosong.";
  }
  if (trim($status_sekolah)=="") {
    $pesanError[]="Data <b>Status Sekolah</b> Masih Kosong.";
  }
  if (trim($kodepos)=="") {
    $pesanError[]="Data <b>Kode Pos</b> Masih Kosong.";
  }
  if (trim($email)=="") {
    $pesanError[]="Data <b>Email</b> Masih Kosong.";
  }
 if (trim($website)=="") {
    $pesanError[]="Data <b>Website</b> Masih Kosong.";
  }
 if (trim($sk_pendirian)=="") {
    $pesanError[]="Data <b>SK Pendirian</b> Masih Kosong.";
  }
 if (trim($tanggal_pendirian)=="") {
    $pesanError[]="Data <b>Tanggal Pendirian</b> Masih Kosong.";
  }
 if (trim($lokasi)=="") {
    $pesanError[]="Data <b>Lokasi</b> Masih Kosong.";
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

    // validasi kode kelas pada database
      $cekSql ="SELECT * FROM profil_sekolah WHERE id_sekolah='$id_sekolah'";
      $cekQry = mysql_query($cekSql) or die("Error Query:".mysql_error());
      if (mysql_num_rows($cekQry)>=1) {
        $pesanError[]= "Maaf, ID Sekolah <b>$id_sekolah</b> Sudah Ada, ganti dengan nama lain";
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

            $query = mysql_query("INSERT INTO siswa 
              SET id_user ='$id_user', 
              id_wali='$nis',
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
              foto='$jeneng',
              tahun_masuk='$tahun_masuk',
              tahun_keluar='$tahun_keluar',
              id_kel='$id_kel'

              ") or die(mysql_error());
            $querywali = mysql_query("INSERT INTO wali (id_kel, id_wali, nm_bapak, pekerjaan_bapak, gaji_bapak, nohp_bapak, nm_ibu, pekerjaan_ibu, gaji_ibu, nohp_ibu, alamat)
VALUES ('$id_kel', '$nis', '$nm_bapak', '$pekerjaan_bapak', '$gaji_bapak', '$nohp_bapak', '$nm_ibu', '$pekerjaan_ibu', '$gaji_ibu', '$nohp_ibu', '$alamat')") or die(mysql_error());



          }
          if ($query){
            header('location: ./siswa');
          }
          else { $error = "Uploaded image should be jpg or gif or png"; } 

        }
      }



    // simpan pada form, dan jika form belum terisi
      $datanis  = isset($_POST['nis']) ? $_POST['nis'] : '';
      $datapassword  = isset($_POST['password']) ? $_POST['password'] : '';
      $datanamasiswa  = isset($_POST['nm_siswa']) ? $_POST['nm_siswa'] : '';
      $datatempatlahir  = isset($_POST['tempat_lahir']) ? $_POST['tempat_lahir'] : '';
      $datatanggallahir  = isset($_POST['date_tgl_lahir']) ? $_POST['date_tgl_lahir'] : '';
      $datajeniskelamin  = isset($_POST['jns_kelamin']) ? $_POST['jns_kelamin'] : '';
      $dataagama  = isset($_POST['agama']) ? $_POST['agama'] : '';
      $dataalamat  = isset($_POST['alamat']) ? $_POST['alamat'] : '';
      $dataemail  = isset($_POST['email']) ? $_POST['email'] : '';
      $datanohp  = isset($_POST['no_hp']) ? $_POST['no_hp'] : '';
      $datatahunmasuk = isset($_POST['tahun_masuk']) ? $_POST['tahun_masuk'] : '';
      $datatahunkeluar = isset($_POST['tahun_keluar']) ? $_POST['tahun_keluar'] : '';
      $datakodekelas  = isset($_POST['kd_kelas']) ? $_POST['kd_kelas'] : '';
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
            <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="Sistem Informasi Akademik SDN II Manangga" title="Sistem Informasi Akademik SDN II Manangga">
          </div>
          <hr class="uk-article-divider">
          <h1 class="uk-article-title">Tahun Ajaran <span class="uk-text-large">{ Tambah Data Tahun Ajaran }</span></h1>
          <br>
          <a href="./tahun-ajaran" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Tahun Ajaran"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
             <form id="formtahun" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
        
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="thn_ajaran">Tahun Ajaran<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="thn_ajaran" name="thn_ajaran" value="<?php echo $datanamatahunajaran; ?>" required="required" class="form-control col-md-7 col-xs-12">
            <div class="reg-info">Contoh: 2012/2013</div>
          </div>

        </div>

      <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="semester">Semester<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="semester" id="semester" value="<?php echo $datasemester; ?>" class="form-control col-md-7 col-xs-12">
              <option value="">--- Semester --</option>
              <option value="Ganjil">Ganjil</option>
              <option value="Genap">Genap</option>
            </select>
          </div>
        </div>

        <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" id="tahun_simpan" name="tahun_simpan" class="btn btn-success">Submit</button>
       </div>
     </form>    
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
