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
  $password1  = $_POST['password1'];
  $nm_guru  = $_POST['nm_guru'];
  $tmpt_lahir  = $_POST['tmpt_lahir'];
  $date_tgl_lahir0  = $_POST['date_tgl_lahir'];
  $date_tgl_lahir=ubahformatTgl($date_tgl_lahir0);
  $jns_kelamin  = $_POST['jns_kelamin'];
  $agama  = $_POST['agama'];
  $status_guru  = $_POST['status_guru'];
  $gelar_depan  = $_POST['gelar_depan'];
  $gelar_depan_akademik  = $_POST['gelar_depan_akademik'];
  $gelar_belakang  = $_POST['gelar_belakang'];
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
  $email  = $_POST['email'];
  $id_user =2;

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
      if (trim($nip)=="") {
        $pesanError[]="Data <b>NIP</b> masih kosong.";
      }
      if (trim($password)=="") {
        $pesanError[]="Data <b>Password</b> masih kosong.";
      }
      if (trim($password1)=="") {
        $pesanError[]="Data Konfirmasi<b>Password</b> masih kosong.";
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
      if (trim($status_guru)=="") {
        $pesanError[]="Data <b>Status Guru</b> masih kosong.";
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
      if (trim($almt_sekarang)=="") {
        $pesanError[]="Data <b>Alamat Sekarang</b> masih kosong.";
      }
      if (trim($no_hp)=="") {
        $pesanError[]="Data <b>Nomor HP</b> masih kosong.";
      }
      if (trim($email)=="") {
        $pesanError[]="Data <b>Email</b> masih kosong.";
      }
      if (trim($id_user)=="") {
        $pesanError[] = "Data <b>id_user</b> tidak boleh kosong !";    
      }
      if (empty($file_sik_dipilih)){
        $pesanError[] = "Anda Belum Memilih Foto !";    
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

            $query = mysql_query("UPDATE guru 
              SET id_user ='$id_user', 
                nip='$nip', 
                password='$password',
                nm_guru='$nm_guru',
                tmpt_lahir='$tmpt_lahir',
                date_tgl_lahir='$date_tgl_lahir',
                jns_kelamin='$jns_kelamin',
                agama='$agama',
                status_guru='$status_guru',
                gelar_depan='$gelar_depan',
                gelar_depan_akademik='$gelar_depan_akademik',
                gelar_belakang='$gelar_belakang',
                almt_sekarang='$almt_sekarang',
                no_hp='$no_hp',
                email='$email',
                foto='$jeneng',
                id_kel='$id_kel' WHERE id_guru='$_GET[id]'
                ") or die(mysql_error());


          }
          if ($query){
            header('location: ./guru');
          }
          else { $error = "Uploaded image should be jpg or gif or png"; } 

        }
      }

  #update data ke database

# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
$edit = mysql_query("SELECT * FROM guru WHERE id_guru='$_GET[id]'");
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
          <h1 class="uk-article-title">Guru <span class="uk-text-large">{ Tampil Profil Guru }</span></h1>
          <br>
          <a href="./guru" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Guru"><i class="uk-icon-angle-left"></i> Kembali</a>
<!-- <hr class="uk-article-divider"> -->
                <div class="uk-grid" data-uk-grid-margin>
                  <div class="uk-width-medium-1-1">
                    <form id="formguru" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

                      <div class="uk-grid">
                        <div class="uk-width-3-10"><div class="uk-panel uk-panel-box"><div class="sia-profile">

                          <img src="gallery/news/<?=$rowks['foto'];?>">
                          <p style="text-align:center" ;="" font-weight:bold;=""><b><?php echo $rowks['nm_guru'];?></b></p>
                          <p style="text-align:center" ;="" font-weight:bold;=""></p>

                        </div></div></div>
                        <div class="uk-width-7-10">  <div class="uk-panel uk-panel-box">                    <table class="uk-table uk-table-hover  uk-table-condensed">
                        <tbody>
                                        <tr>
                                            <td>NIP</td>
                                            <td><?php echo $rowks['nip'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Nama Guru</td>
                                            <td><?php echo $rowks['nm_guru'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Tanggal Lahir</td>
                                            <td><?php echo $rowks['date_tgl_lahir'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Tempat Lahir</td>
                                            <td><?php echo $rowks['tmpt_lahir'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td><?php echo $rowks['jns_kelamin'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Agama</td>
                                            <td><?php echo $rowks['agama'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Status Guru</td>
                                            <td><?php echo $rowks['status_guru'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Gelar Depan Non Akademik</td>
                                            <td><?php echo $rowks['gelar_depan'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Gelar Depan Akademik</td>
                                            <td><?php echo $rowks['gelar_depan_akademik'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Gelar Belakang</td>
                                            <td><?php echo $rowks['gelar_belakang'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Alamat Rumah</td>
                                            <td><?php echo $rowks['almt_sekarang'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>No. HP</td>
                                            <td><?php echo $rowks['no_hp'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?php echo $rowks['email'];?></td>
                                            
                                        </tr>
                                       
                                    </tbody>

                      </table></div></div>
                      </div>
                      <div class="tm-grid-truncate uk-grid uk-grid-divider uk-text-center" data-uk-grid-margin="">
                                <div class="uk-width-medium-1-3 uk-row-first"><div class="uk-panel uk-panel-box"><div class="sia-profile">
  <p style="text-align:center" ;="" font-weight:bold;="">Selamat Datang</p>
  <img class="sia-profile-image" src="gallery/admin/admin.jpg" alt="">
  <p style="text-align:center" ;="" font-weight:bold;=""><b>admin</b></p>
  <p style="text-align:center" ;="" font-weight:bold;=""></p>

</div></div></div>
                                <div class="uk-width-medium-1-3"><div class="uk-panel uk-panel-box"><code>.uk-width-medium-1-3</code></div></div>
                                <div class="uk-width-medium-1-3"><div class="uk-panel uk-panel-box"><code>.uk-width-medium-1-3</code></div></div>
                            </div>

                      <div class="uk-grid" data-uk-grid-margin="">
                        <div class="uk-width-medium-1-3 uk-row-first">
                          <div class="uk-panel uk-panel-box">
                            <h3 class="uk-panel-title"><i class="uk-icon-user"></i> Panel</h3>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                          </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                          <div class="uk-panel uk-panel-box">
                            <h3 class="uk-panel-title"><i class="uk-icon-home"></i> Panel</h3>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                          </div>
                        </div>
                        <div class="uk-width-medium-1-3">
                          <div class="uk-panel uk-panel-box">
                            <h3 class="uk-panel-title"><i class="uk-icon-bookmark"></i> Panel</h3>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                          </div>
                        </div>
                      </div>
                      <div class="uk-grid">
                        <div class="uk-width-1-2">...</div>
                        <div class="uk-width-1-2">
                          <div class="uk-grid">
                            <div class="uk-width-1-2">...</div>
                            <div class="uk-width-1-2">...</div>
                          </div>
                        </div>
                      </div>
                      <div class="uk-panel">
                        <h3 class="uk-panel-title"><i class="uk-icon-*"></i>.asdasdasdasd</h3>
                      </div>

                      <table border="0" width="500" cellpadding="0" cellspacing="0" class="table">
                        <tbody><tr><th>Nama Produk</th><th>Jumlah</th><th>Harga Satuan</th><th>Sub Total</th></tr><tr><td>4 wheel packing case</td><td>1</td><td>Rp. 200.000</td><td>Rp. 200.000</td></tr><tr><td>Classic Leg Jeans</td><td>1</td><td>Rp. 120.000</td><td>Rp. 120.000</td></tr><tr><td colspan="3" align="right">Total : </td><td>Rp. <b>320.000</b></td></tr>
                          <tr><td colspan="3" align="right">Ongkos Kirim Tujuan Kota Pembeli :</td><td>Rp. <b>0 /Kg</b></td></tr>
                          <tr><td colspan="3" align="right">Total Berat Barang: </td><td><b>1 Kg</b></td></tr>
                          <tr><td colspan="3" align="right">Ongkos Kirim : </td><td>Rp. <b>0</b></td></tr>      
                          <tr><td colspan="3" align="right">Grand Total : </td><td>Rp. <b>320.000</b></td></tr>
                        </tbody></table>
         
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
      max: 18,
      message: 'NIP harus 18 angka.'
    },
     remote: {
      type: 'POST',
      url: 'remote/remote_guru.php',
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
