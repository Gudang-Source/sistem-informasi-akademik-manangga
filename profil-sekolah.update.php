<!-- user login -->
<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));

// TEMPLATE CONTROL
$ui_register_page     = 'profil-sekolah';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Update Data Profil Sekolah');

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
    if (trim($alamat_sekolah)=="") {
       $pesanError[]="Data <b>Alamat Sekolah</b> Masih Kosong.";
     }
      if (empty($file_sik_dipilih)){
        $pesanError[] = "Anda Belum Memilih Foto !";    
      }
      if (empty($file_sik_dipilih)){
        $query = mysql_query("UPDATE profil_sekolah 
          SET npsn='$npsn', 
          status_sekolah='$status_sekolah',
          bentuk='$bentuk',
          alamat_sekolah='$alamat_sekolah',
          kodepos='$kodepos',
          email='$email',
          website='$website',
          sk_pendirian='$sk_pendirian',
          tanggal_pendirian='$tanggal_pendirian',
          status_pemilik='$status_pemilik',
          sk_izin='$sk_izin',
          tanggal_izin='$tanggal_izin',
          lokasi='$lokasi',
          foto='$jeneng',
          id_kel='$id_kel'
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

            $query = mysql_query("UPDATE profil_sekolah 
          SET npsn='$npsn', 
          status_sekolah='$status_sekolah',
          bentuk='$bentuk',
          alamat_sekolah='$alamat_sekolah',
          kodepos='$kodepos',
          email='$email',
          website='$website',
          sk_pendirian='$sk_pendirian',
          tanggal_pendirian='$tanggal_pendirian',
          status_pemilik='$status_pemilik',
          sk_izin='$sk_izin',
          tanggal_izin='$tanggal_izin',
          lokasi='$lokasi',
          foto='$jeneng',
          id_kel='$id_kel'
          ") or die(mysql_error());


          }
          if ($query){
            header('location: ./profil-sekolah');
          }
          else { $error = "Uploaded image should be jpg or gif or png"; } 

        }
      }

  #update data ke database

# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
      $edit = mysql_query("SELECT * FROM profil_sekolah");
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

      </script>
            <script type="text/javascript">
  function convertAngkaNIP(objek) {
    
    a = objek.value;
    b = a.replace(/[^\d]/g,"");
    
    objek.value = b;

  }            
</script>

<script type="text/javascript">
  function convertAngkaHP(objek) {
    
    a = objek.value;
    b = a.replace(/[^\d]/g,"");
    
    objek.value = b;

  }            
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
          <h1 class="uk-article-title">Profil Sekolah <span class="uk-text-large">{ Tampil Profil Sekolah  }</span></h1>
          <br>
          <a href="./profil-sekolah" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Profil Sekolah"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <form id="formprofil" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
              <form id="formprofil" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

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
                           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="npsn">Isi Data NPSN (Nomor Pokok Sekolah Nasional)<span class="required">*</span>
                           </label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                           <input  type="text" id="npsn" name="npsn" onkeyup="convertAngkaNIP(this);" value="<?php echo $rowks['npsn'];?>" required="required" class="form-control col-md-7 col-xs-12">
                            <div class="reg-info"></div>
                          </div> 
                        </div>
                      
                    </tr>

  <tr>
     <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status_sekolah">Status Sekolah<span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <select  name="status_sekolah" id="status_sekolah" value="" class="form-control col-md-7 col-xs-12">
          <option value="">--- Pilih Status Sekolah --</option>
          <?php
          $status_sekolah=mysql_query("SELECT DISTINCT * FROM profil_sekolah GROUP BY status_sekolah ORDER BY status_sekolah");
          while ($datastatussekolah=mysql_fetch_array($status_sekolah)) {
           if ($datastatussekolah['status_sekolah']==$rowks['status_sekolah']) {
             $cek ="selected";
           }
           else{
            $cek= "";
          }
          echo "<option value=\"$datastatussekolah[status_sekolah]\" $cek>$datastatussekolah[status_sekolah]</option>\n";
        }
        ?>
      </select>
      <div class="reg-info">Status Guru hanya Wiyata Bhakti dan Pegawai Negri Sipil(PNS), Pilih Salah Satu!</div>
    </div>
  </div>


</tr>

        <tr>
            <div class="item form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bentuk">Bentuk Sekolah<span class="required">*</span>
             </label>
             <div class="col-md-6 col-sm-6 col-xs-12">
               <select  type="text" class="form-control chzn-select col-md-7 col-xs-12" id="bentuk" name="bentuk" value="" required>
                <option value="">--- Status Sekolah --</option> 
       <?php
        if ($rowks['bentuk']=="SD") {
        ?>
          <option value="SD" selected>Sekolah Dasar (SD) / Sederajat</option>
          <option value="SMP">Sekolah Menengah Pertama (SMP) / Sederajat</option>
          <option value="SMA">Sekolah Menengah Atas (SMA) / Sederajat</option>
        <?php
        }
         else{ ?>
        <option value="SD" selected>Sekolah Dasar (SD) / Sederajat</option>
          <option value="SMP">Sekolah Menengah Pertama (SMP) / Sederajat</option>
          <option value="SMA">Sekolah Menengah Atas (SMA) / Sederajat</option> 
      <?php     } 
      ?>
            </select>

          </div>
        </div>
      </tr>
                    <tr>
                      <div class="item form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_guru">Nama Guru<span class="required">*</span>
                       </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                       <input  type="text" id="nm_guru" name="nm_guru" value="<?php echo $rowks['nm_guru'];?>" required="required" class="form-control col-md-7 col-xs-12">
                        <div class="reg-info">Contoh: Fajar Nurrohmat. Jumlah minimal 1 huruf. Wajib diisi (Tuliskan nama saja, tidak dengan gelar akademik)</div>
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
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tmpt_lahir">Tempat Lahir<span class="required">*</span>
               </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <input  type="text" id="tmpt_lahir" name="tmpt_lahir" value="<?php echo $rowks['tmpt_lahir'];?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
          </tr>
  
      <tr>
        <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_agama">Agama<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
           <select  type="text" class="form-control chzn-select col-md-7 col-xs-12" id="id_agama" name="id_agama" value="" required>
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
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jns_kelamin">Status Guru<span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <select  name="status_guru" id="status_guru" value="" class="form-control col-md-7 col-xs-12">
          <option value="">--- Pilih Status Guru --</option>
          <?php
          $status_guru=mysql_query("SELECT DISTINCT * FROM guru GROUP BY status_guru ORDER BY status_guru");
          while ($datastatusguru=mysql_fetch_array($status_guru)) {
           if ($datastatusguru['status_guru']==$rowks['status_guru']) {
             $cek ="selected";
           }
           else{
            $cek= "";
          }
          echo "<option value=\"$datastatusguru[status_guru]\" $cek>$datastatusguru[status_guru]</option>\n";
        }
        ?>
      </select>
      <div class="reg-info">Status Guru hanya Wiyata Bhakti dan Pegawai Negri Sipil(PNS), Pilih Salah Satu!</div>
    </div>
  </div>


</tr>
<tr>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gelar_depan">Gelar Depan Non Akademik<span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    <input  type="text" id="gelar_depan" name="gelar_depan" value="<?php echo $rowks['gelar_depan'];?>"  class="form-control col-md-7 col-xs-12">
      <div class="reg-info">Kosongkan Jika Tidak Ada Gelar Depan Non Akademik </div>
    </div>
  </div>            
</tr>
<tr>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gelar_depan_akademik">Gelar Depan Akademik<span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    <input  type="text" id="gelar_depan_akademik" name="gelar_depan_akademik" value="<?php echo $rowks['gelar_depan_akademik'];?>"  class="form-control col-md-7 col-xs-12">
      <div class="reg-info">Kosongkan Jika Tidak Ada Gelar Depan Akademik</div>
    </div>
  </div>      
</tr>
<tr>
  <div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gelar_belakang">Gelar Belakang<span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
    <input  type="text" id="gelar_belakang" name="gelar_belakang" value="<?php echo $rowks['gelar_belakang'];?>"  class="form-control col-md-7 col-xs-12">
      <div class="reg-info">Kosongkan Jika Tidak Ada Gelar Belakang</div>
    </div>
  </div>      
</tr>
<tr>
  <?php               
  $jeng =mysql_query("SELECT *
    FROM
    provinsi
    INNER JOIN kabupaten ON kabupaten.id_prov = provinsi.id_prov
    INNER JOIN kecamatan ON kecamatan.id_kab = kabupaten.id_kab
    INNER JOIN kelurahan ON kelurahan.id_kec = kecamatan.id_kec
    where kelurahan.id_kel='$rowks[id_kel]'
    ");
  $datajeng=mysql_fetch_array($jeng);


  ?>
  <div class="item form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prov">Provinsi <span class="required">*</span>
   </label>
   <div class="col-md-6 col-sm-6 col-xs-12">
    <select  type="text" class="form-control chzn-select col-md-7 col-xs-12" id="prov" name="prov" value="" required>
      <option value="">-Pilih Provinsi-</option>
      <?php
                    //MENGAMBIL NAMA PROVINSI YANG DI DATABASE
      $provinsi =mysql_query("SELECT * FROM provinsi ORDER BY nama_prov");
      while ($dataprovinsi=mysql_fetch_array($provinsi)) {
       if ($dataprovinsi['id_prov']==$datajeng['id_prov']) {
         $cek ="selected";
       }
       else{
        $cek= "";
      }
      echo "<option value=\"$dataprovinsi[id_prov]\" $cek>$dataprovinsi[nama_prov]</option>\n";
    }
    ?>
  </select>
</div>
</div>      
</tr>
<tr>
  <div class="item form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kota">Kabupaten <span class="required">*</span>
   </label>
   <div class="col-md-6 col-sm-6 col-xs-12">
    <select  type="text" class="form-control chzn-select col-md-7 col-xs-12" id="kota" name="kota" value="" required>
      <option value="">-Pilih Kabupaten-</option>
      <?php
                    //MENGAMBIL NAMA kabupaten YANG DI DATABASE
      $kabupaten =mysql_query("SELECT * FROM kabupaten WHERE id_prov=$datajeng[id_prov] ORDER BY nama_kab");
      while ($datakabupaten=mysql_fetch_array($kabupaten)) {
       if ($datakabupaten['id_kab']==$datajeng['id_kab']) {
         $cek ="selected";
       }
       else{
        $cek= "";
      }
      echo "<option value=\"$datakabupaten[id_kab]\" $cek>$datakabupaten[nama_kab]</option>\n";
    }
    ?>
  </select>
</div>
</div>
</tr>
<tr>
  <div class="item form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_kec">Kecamatan <span class="required">*</span>
   </label>
   <div class="col-md-6 col-sm-6 col-xs-12">
    <select  type="text" class="form-control chzn-select col-md-7 col-xs-12" id="id_kec" name="id_kec" value="" required>
      <option value="">-Pilih Kecamatan-</option>
      <?php


                    //MENGAMBIL NAMA kecamatan YANG DI DATABASE
      $kecamatan =mysql_query("SELECT * FROM kecamatan WHERE id_kab=$datajeng[id_kab] ORDER BY nama_kec");
      while ($datakecamatan=mysql_fetch_array($kecamatan)) {
       if ($datakecamatan['id_kec']==$datajeng['id_kec']) {
         $cek ="selected";
       }
       else{
        $cek= "";
      }
      echo "<option value=\"$datakecamatan[id_kec]\" $cek>$datakecamatan[nama_kec]</option>\n";
    }
    ?>
  </select>
</div>
</div>      
</tr>
<tr>
  <div class="item form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_kel">Kelurahan <span class="required">*</span>
   </label>
   <div class="col-md-6 col-sm-6 col-xs-12">
    <select  type="text" class="form-control chzn-select col-md-7 col-xs-12" id="id_kel" name="id_kel" value="" required>
      <option value="">-Pilih Kelurahan-</option>
      <?php

                    //MENGAMBIL NAMA kecamatan YANG DI DATABASE
      $kelurahan =mysql_query("SELECT * FROM kelurahan WHERE id_kec=$datajeng[id_kec] ORDER BY nama_kel");
      while ($datakelurahan=mysql_fetch_array($kelurahan)) {
       if ($datakelurahan['id_kel']==$rowks['id_kel']) {
         $cek ="selected";
       }
       else{
        $cek= "";
      }
      echo "<option value=\"$datakelurahan[id_kel]\" $cek>$datakelurahan[nama_kel]</option>\n";
    }
    ?>
  </select>
</div>
</div>      
</tr>
<tr>
  <div class="item form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="almt_sekarang">Alamat Rumah<span class="required">*</span>
   </label>

   <div class="col-md-6 col-sm-6 col-xs-12">
   <input  type="text" id="almt_sekarang" name="almt_sekarang" value="<?php echo $rowks['almt_sekarang'];?>" required="required" class="form-control col-md-7 col-xs-12">
    <div class="reg-info">Wajib diisi data alamat rumah sekarang, isi data alamat rumah sekarang dengan lengkap</div>
  </div>
</div>      
</tr>
<tr>
  <div class="item form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_hp">No. HP<span class="required">*</span>
   </label>
   <div class="col-md-6 col-sm-6 col-xs-12">
   <input  type="text" id="no_hp" name="no_hp" onkeyup="convertAngkaHP(this);" value="<?php echo $rowks['no_hp'];?>" required="required" class="form-control col-md-7 col-xs-12">
    <div class="reg-info">Wajib Isi Data No Hp</div>
  </div>
</div>      
</tr>
<tr>
  <div class="item form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email<span class="required">*</span>
   </label>
   <div class="col-md-6 col-sm-6 col-xs-12">
   <input  type="text" id="email" name="email" value="<?php echo $rowks['email'];?>" required="required" class="form-control col-md-7 col-xs-12">
    <div class="reg-info">Email Wajib Diisi </div>
  </div>
</div>      
</tr>
<tr>
  <div class="uk-form-row">
    <div class="uk-alert">Pastikan semua isian sudah terisi dengan benar!</div>
  </div>
  <div style="text-align:center" class="form-actions no-margin-bottom">
   <button type="submit" id="kepala-sekolah_simpan" name="kepala-sekolah_simpan" class="btn btn-success">Submit</button>
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
            message: 'NIP minimal 18 angka.'
          },
          
        }
      },
      nm_guru: {
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
      id_agama : {
        validators: {
          notEmpty: {
            message: 'Harus Pilih Agama'
          }
        }
      },    
      status_guru : {
        validators: {
          notEmpty: {
            message: 'Harus Pilih Status Guru'
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
      almt_sekarang : {
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




    }
  });
</script>


</body>

<?php
// LOAD FOOTER
loadAssetsFoot();

ob_end_flush();
?>
