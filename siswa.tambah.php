<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

/*template control*/
$ui_register_page     = 'siswa';
$ui_register_assets   = array('datepicker');

/*load header*/
loadAssetsHead('Tambah Master Data Siswa');

/*form processing*/
if (isset ($_POST["siswa_simpan"])) { 

    // baca variabel

  $nis     = $_POST['nis'];
  $password     = $_POST['password'];
  $password1  = $_POST['password1'];
  $nm_siswa     = $_POST['nm_siswa'];
  $tmpt_lahir     = $_POST['tmpt_lahir'];
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
  if (trim($nohp_bapak)=="") {
    $pesanError[]="Data <b>No Handphone Bapak</b> Masih Kosong.";
  }
  if (trim($nm_ibu)=="") {
    $pesanError[]="Data <b>Nama Ibu</b> Masih Kosong.";
  }
  if (trim($pekerjaan_ibu)=="") {
    $pesanError[]="Data <b>Pekerjaan Ibu</b> Masih Kosong.";
  }
    if (trim($nohp_ibu)=="") {
    $pesanError[]="Data <b>No Handphone Ibu</b> Masih Kosong.";
  }
    if (trim($alamat)=="") {
    $pesanError[]="Data <b>Alamat</b> Masih Kosong.";
  }

    // validation form kosong
  
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

      $pesanError= array();
      if (trim($nis)=="") {
        $pesanError[]="Data <b>NIS</b> Masih Kosong.";
      }
      if (trim($password)=="") {
        $pesanError[]="Data <b>Password</b> Masih Kosong.";
      }
      if (trim($password1)=="") {
        $pesanError[]="Data Konfirmasi<b>Password</b> masih kosong.";
      }
      if (trim($nm_siswa)=="") {
        $pesanError[]="Data <b>Nama Siswa</b> Masih Kosong.";
      }
      if (trim($tmpt_lahir)=="") {
        $pesanError[]="Data <b>Tempat Lahir</b> Masih Kosong.";
      }
      if (trim($date_tgl_lahir)=="") {
        $pesanError[]="Data <b>Tanggal Lahir</b> Masih Kosong.";
      }
      if (trim($jns_kelamin)=="") {
        $pesanError[]="Data <b>Jenis Kelamin</b> Masih Kosong.";
      }
      if (trim($agama)=="") {
        $pesanError[]="Data <b>Agama</b> Masih Kosong.";
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

      if (trim($no_hp)=="") {
        $pesanError[]="Data <b>Nomor Telepon</b> Masih Kosong.";
      }
      if (trim($id_user)=="") {
        $pesanError[] = "Data <b>id_user</b> tidak boleh kosong !";    
      }
      if (empty($file_sik_dipilih)){
        $pesanError[] = "Anda Belum Memilih Foto !";    
      }

      if (trim($tahun_masuk)=="tahun_masuk") {
        $pesanError[]="Data <b>Tahun Masuk</b> Masih Kosong.";
      }
      if (trim($tahun_keluar)=="tahun_keluar") {
        $pesanError[]="Data <b>Kode Kelas</b> Masih Kosong.";
      }

    // validasi kode kelas pada database
      $cekSql ="SELECT * FROM siswa WHERE nis='$nis'";
      $cekQry = mysql_query($cekSql) or die("Error Query:".mysql_error());
      if (mysql_num_rows($cekQry)>=1) {
        $pesanError[]= "Maaf, siswa dengan NIS <b>$nis</b> Sudah Ada, ganti dengan nama lain";
      }

      $id=isset($_GET['kd_kelas'])?$_GET['kd_kelas']:'';
      $sql_var="select * from kelas where kd_kelas= '$id'";
      $hasil=mysql_query($sql_var);
      $data=mysql_fetch_array($hasil);

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

          if(($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/pjpeg")){
            $lokasi = 'gallery/news/';

             //$jeneng = $id_pegawai.'.jpg';

            $file = md5(rand(1000,1000000000))."-".$nama_foto;
            $newfilename = $file . $bagian_extensine;
            $jeneng=str_replace(' ','-',$file);
            $url = $lokasi . $jeneng;
            $filename = compress_image($_FILES["file"]["tmp_name"], $url, 80); 

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
  <script type="text/javascript">
  function convertAngkaNIS(objek) {
    
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
  <script type="text/javascript">
  function convertAngkaGaji(objek) {
    
    a = objek.value;
    b = a.replace(/[^\d]/g,"");
    
    objek.value = b;

  }            
</script>
  <script type="text/javascript">
  function convertAngka(objek) {
    
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
                <h1 class="uk-article-title">Siswa <span class="uk-text-large">{ Tambah Master Data Siswa }</span></h1>
                <br>
                <a href="./siswa" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Siswa"><i class="uk-icon-angle-left"></i> Kembali</a>

                <hr class="uk-article-divider">

                <div class="uk-grid" data-uk-grid-margin>
                  <div class="uk-width-medium-1-1">
                   <form id="formsiswa" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

                    <div class="uk-grid" data-uk-grid-margin>
                      <div class="uk-width-medium-1-1">


                        <div class="uk-grid">
                          <div class="uk-width-3-10">
                           <div class="item form-group">

                             <ul class="uk-tab uk-tab-left" data-uk-tab="{connect:'#tabs_example2', animation: 'fade'}">
                              <li ><a href="#">Data Pribadi Siswa</a></li>
                              <li><a href="#">Data Orangtua Siswa</a></li>


                            </div>


                          </div>

                          <ul id="tabs_example2" class="uk-switcher ">
                            <li>
                              <div class="uk-panel uk-panel-box"> 
                               <code class="title">Data Pribadi Siswa</code>
                               <hr class="uk-article-divider">                
                               <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Image <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="col-lg-8">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                      <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="./assets/fileupload/images/nopict.jpg" alt="" /></div>
                                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                      <div>
                                        <span class="btn btn-file btn-primary btn-xs"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" accept="image/*" name="file" id="file" placeholder="file" /></span>
                                        <a href="#" class="btn btn-danger btn-xs fileupload-exists" data-dismiss="fileupload">Remove</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="item form-group">
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">NIS<span class="required">*</span>
                               </label>
                               <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="nis" name="nis" value="<?php echo $datanis; ?>" onkeyup="convertAngkaNIS(this);" required="required" class="form-control col-md-7 col-xs-12">
                                <div class="reg-info">Contoh: 151601001. Wajib Diisi Minimal 9 Karakter (Digunakan sebagai username untuk login)</div>
                              </div>
                            </div>

                            <div class="item form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_siswa">Nama Siswa<span class="required">*</span>
                             </label>
                             <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="nm_siswa" name="nm_siswa" value="<?php echo $datanamasiswa; ?>" required="required" class="form-control col-md-7 col-xs-12">
                              <div class="reg-info">Contoh: Ripa Gemah Nuripah</div>
                            </div>
                          </div>

                          <div class="item form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nip">Password<span class="required">*</span>
                           </label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="password" name="password" value="<?php echo $datapassword; ?>" required="required" class="form-control col-md-7 col-xs-12">
                            <div class="reg-info">Contoh: 55550.</div>
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password1">Konfirmasi Password<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="password1" name="password1" value="<?php echo $datapassword; ?>" required="required" class="form-control col-md-7 col-xs-12">
                            <div class="reg-info">Contoh: 55550.</div>
                          </div>
                        </div>

                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_tgl_lahir">Tanggal Lahir<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="date_tgl_lahir" name="date_tgl_lahir" value="<?php echo $datatanggallahir; ?>" required="required" class="form-control col-md-7 col-xs-12" data-uk-datepicker="{format:'DD/MM/YYYY'}" >
                            <div class="reg-info">Format: <code>DD/MM/YYYY</code></div>
                            <div class="reg-info">Contoh: 31/12/1994</div>
                          </div>
                        </div>


                        <div class="item form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tmpt_lahir">Tempat Lahir<span class="required">*</span>
                         </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="tmpt_lahir" name="tmpt_lahir" value="<?php echo $datatempatlahir; ?>" required="required" class="form-control col-md-7 col-xs-12">
                          <div class="reg-info">Contoh: Tasikmalaya.</div>
                        </div>
                      </div>


                      <div class="item form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jns_kelamin">Jenis Kelamin<span class="required">*</span>
                       </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="jns_kelamin" id="jns_kelamin" value="<?php echo $datajeniskelamin; ?>" class="form-control col-md-7 col-xs-12">
                          <option value="">--- Pilih Jenis Kelamin --</option>
                          <option value="Laki-Laki">Laki-Laki</option>
                          <option value="Perempuan">Perempuan</option>
                        </select>
                      </div>
                    </div>

                    <div class="item form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="agama">Agama<span class="required">*</span>
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                      <select name="agama" id="agama" value="<?php echo $dataagama; ?>" class="form-control col-md-7 col-xs-12">
                        <option value="">--- Pilih agama yang dianut --</option>
                        <?php
                    //MENGAMBIL NAMA PROVINSI YANG DI DATABASE
                        $agama =mysql_query("SELECT * FROM agama ORDER BY nm_agama");
                        while ($dataagama=mysql_fetch_array($agama)) {
                          echo "<option value=\"$dataagama[id_agama]\">$dataagama[nm_agama]</option>\n";
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prov">Provinsi <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="prov" name="prov" required>
                        <option value="">-Pilih Provinsi-</option>
                        <?php
                    //MENGAMBIL NAMA PROVINSI YANG DI DATABASE
                        $provinsi =mysql_query("SELECT * FROM provinsi ORDER BY nama_prov");
                        while ($dataprovinsi=mysql_fetch_array($provinsi)) {
                          echo "<option value=\"$dataprovinsi[id_prov]\">$dataprovinsi[nama_prov]</option>\n";
                        }
                        ?>
                      </select>
                      <div class="reg-info">Wajib Pilih  Provinsi  </div>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kota">Kabupaten <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="kota" name="kota" required>
                        <option value="">-Pilih Kabupaten-</option>
                      </select>
                      <div class="reg-info">Wajib Pilih  Kabupaten  </div>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_kec">Kecamatan <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="id_kec" name="id_kec" required>
                        <option value="">-Pilih Kecamatan-</option>
                      </select>
                      <div class="reg-info">Wajib Pilih  Kecamatan  </div>
                    </div>
                  </div>
                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_kel">Kelurahan <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="id_kel" name="id_kel" required>
                        <option value="">-Pilih Kelurahan-</option>
                      </select>
                      <div class="reg-info">Wajib Pilih  Kelurahan  </div>
                    </div>
                  </div>

                  <div class="item form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat Rumah<span class="required">*</span>
                   </label>
                   <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="alamat" name="alamat" value="<?php echo $dataalamat; ?>" required="required" class="form-control col-md-7 col-xs-12">
                    <div class="reg-info">Contoh: Jalan Kenangan, Kota Barat, Depok, Yogyakarta.</div>
                  </div>
                </div>

                <div class="item form-group">
                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email</span>
                 </label>
                 <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="email" name="email" value="<?php echo $dataemail; ?>" class="form-control col-md-7 col-xs-12">
                  <div class="reg-info">Contoh: ripagemah@mail.com</div>
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_hp">No. HP<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="no_hp" name="no_hp" value="<?php echo $datanohp; ?>" onkeyup="convertAngkaHP(this);" required="required" class="form-control col-md-7 col-xs-12">
                  <div class="reg-info">Contoh: 08123456789. Wajib Isi Data Nomor Handphone yang Dapat Dihubungi.</div>
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tahun_masuk">Tahun Masuk<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="tahun_masuk" name="tahun_masuk" value="<?php echo $datatahunmasuk; ?>" onkeyup="convertAngka(this);" required="required" class="form-control col-md-7 col-xs-12">
                  <div class="reg-info">Contoh: 2012.</div>
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tahun_keluar">Tahun Keluar<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="tahun_keluar" name="tahun_keluar" value="<?php echo $datatahunkeluar; ?>" onkeyup="convertAngka(this);" required="required" class="form-control col-md-7 col-xs-12">
                  <div class="reg-info">Contoh: 2018.</div>
                </div>
              </div>


              <div class="uk-form-row">
                <div class="uk-alert">Pastikan semua isian sudah terisi dengan benar!</div>
              </div>
              <div style="text-align:center" class="form-actions no-margin-bottom">
                <ul class="uk-tab uk-tab-left" data-uk-tab="{connect:'#tabs_example2', animation: 'fade'}">

                  <li class="uk-active hidden"><a href="#"></a></li>
                  <li ><a href="#"> <button type="button"  class="btn btn-primary">Next >></button></a></li>

                </div>
              </li>

              <li>
                <div class="uk-panel uk-panel-box">    
                  <code class="title">Data Wali Siswa</code>
                  <hr class="uk-article-divider">                 
                  <div class="item form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_bapak">Nama Bapak<span class="required">*</span>
                   </label>
                   <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="nm_bapak" name="nm_bapak" value="<?php echo $datanamabapak; ?>" required="required" class="form-control col-md-7 col-xs-12">
                    <div class="reg-info">Contoh: Sule Sunata</div>
                  </div>
                </div>

                <div class="item form-group">
                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pekerjaan_bapak">Pekerjaan Bapak<span class="required">*</span>
                 </label>
                 <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="pekerjaan_bapak" name="pekerjaan_bapak" value="<?php echo $datapekerjaanbapak; ?>" required="required" class="form-control col-md-7 col-xs-12">
                  <div class="reg-info">Contoh: Komedian</div>
                </div>
              </div>
              <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gaji_bapak">Gaji Bapak</span>
               </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="gaji_bapak" name="gaji_bapak" value="<?php echo $datagajibapak; ?>" onkeyup="convertAngkaGaji(this);" rclass="form-control col-md-7 col-xs-12">
                <div class="reg-info">Contoh: 3500000</div>
              </div>
            </div>

            <div class="item form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nohp_bapak">Nomor Telepon<span class="required">*</span>
             </label>
             <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" id="nohp_bapak" name="nohp_bapak" value="<?php echo $datanohpbapak; ?>" onkeyup="convertAngkaHP(this);" required="required" class="form-control col-md-7 col-xs-12">
              <div class="reg-info">Contoh: 08123456789</div>
            </div>
          </div>
                <hr class="uk-article-divider">
          <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_ibu">Nama Ibu<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="nm_ibu" name="nm_ibu" value="<?php echo $datanamaibu; ?>" required="required" class="form-control col-md-7 col-xs-12">
            <div class="reg-info">Contoh: Awkarin Nurhidayah</div>
          </div>
        </div>


        <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pekerjaan_ibu">Pekerjaan Ibu<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" value="<?php echo $datapekerjaanibu; ?>" required="required" class="form-control col-md-7 col-xs-12">
          <div class="reg-info">Contoh: Youtuber</div>
        </div>
      </div>

      <div class="item form-group">
       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gaji_ibu">Gaji Ibu </span>
       </label>
       <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="gaji_ibu" name="gaji_ibu" value="<?php echo $datagajiibu; ?>" onkeyup="convertAngkaGaji(this);" class="form-control col-md-7 col-xs-12">
        <div class="reg-info">Contoh: 6500000</div>
      </div>
    </div>

    <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nohp_ibu">Nomor Telepon<span class="required">*</span>
     </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="text" id="nohp_ibu" name="nohp_ibu" value="<?php echo $datanohpibu; ?>" onkeyup="convertAngkaHP(this);" required="required" class="form-control col-md-7 col-xs-12">
      <div class="reg-info">Contoh: 08123456789</div>
    </div>
  </div>

  <div class="item form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat Rumah<span class="required">*</span>
   </label>
   <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="alamat" name="alamat" value="<?php echo $dataalamat; ?>" required="required" class="form-control col-md-7 col-xs-12">
    <div class="reg-info">Contoh: Jalan Kenanga, Depok, Sleman, Yogyakarta</div>
  </div>
</div>


</div>






<div class="uk-form-row">
  <div class="uk-alert">Pastikan semua isian sudah terisi dengan benar!</div>
</div>
<div style="text-align:center" class="form-actions no-margin-bottom">
  <div class="uk-button-group" data-uk-switcher="{connect:'#tabs_example2'}">
    <button type="button"  class="btn btn-primary"><< Back</button> </div> <button type="submit" id="siswa_simpan" name="siswa_simpan" class="btn btn-success">Submit</button></li>


  </div>

</li>


</ul>
</form>    
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div>
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
          min: 9,
          max: 9,
          message: 'NIS 9 karakter.'
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
          message: 'Karakter Yang Boleh Digunakan Hanya Huruf'
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
          message: 'Nama Kelurahan Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
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
          message: 'Konfirmasi Password Harus sama dengan Password'
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
          message: 'Harus Diisi Tempat lahir'
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
          min: 1,
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
        emailAddress:{
          message: 'Email Tidak valid'
        },
        remote: {
          type: 'POST',
          url: './remote/remote_email_siswa.php',
          message: 'Email Sudah Tersedia'
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
