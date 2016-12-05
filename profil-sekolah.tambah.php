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

          $query = mysql_query("INSERT INTO profil_sekolah 
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
          id_kel='$id_kel'
          ") or die(mysql_error());

          }
          if ($query){
            header('location: ./profil-sekolah');
          }

        }


    // simpan pada form, dan jika form belum terisi
      $datanpsn             = isset($_POST['npsn']) ? $_POST['npsn'] : '';
      $datastatussekolah    = isset($_POST['status_sekolah']) ? $_POST['status_sekolah'] : '';
      $databentuk           = isset($_POST['bentuk']) ? $_POST['bentuk'] : '';
      $dataalamatsekolah    = isset($_POST['alamat_sekolah']) ? $_POST['alamat_sekolah'] : '';
      $datakodepos          = isset($_POST['kodepos']) ? $_POST['kodepos'] : '';
      $dataemail            = isset($_POST['email']) ? $_POST['email'] : '';
      $datawebsite          = isset($_POST['website']) ? $_POST['website'] : '';
      $dataskpendirian      = isset($_POST['sk_pendirian']) ? $_POST['sk_pendirian'] : '';
      $datatanggalpendirian = isset($_POST['tanggal_pendirian']) ? $_POST['tanggal_pendirian'] : '';
      $datastatuspemilik    = isset($_POST['status_pemilik']) ? $_POST['status_pemilik'] : '';
      $dataskizin           = isset($_POST['sk_izin']) ? $_POST['sk_izin'] : '';
      $datatanggalizin      = isset($_POST['tanggal_izin']) ? $_POST['tanggal_izin'] : '';
      $datalokasi           = isset($_POST['lokasi']) ? $_POST['lokasi'] : '';
      $datakel              = isset($_POST['id_kel']) ? $_POST['id_kel'] : '';
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

      <script type="text/javascript" src="assets/tiny_mce/tiny_mce_src.js"></script>
      <script type="text/javascript">

            //http://cariprogram.blogspot.com
            //nuramijaya@gmail.com

            tinyMCE.init({

              mode : "textareas",

              // ===========================================
              // Set THEME to ADVANCED
              // ===========================================

              theme : "advanced",

              // ===========================================
              // INCLUDE the PLUGIN
              // ===========================================

              plugins : "jbimages,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

              // ===========================================
              // Set LANGUAGE to EN (Otherwise, you have to use plugin's translation file)
              // ===========================================

              language : "en",

              theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
              theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
              theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",

              // ===========================================
              // Put PLUGIN'S BUTTON on the toolbar
              // ===========================================

              theme_advanced_buttons4 : "jbimages,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",

              theme_advanced_toolbar_location : "top",
              theme_advanced_toolbar_align : "left",
              theme_advanced_statusbar_location : "bottom",
              theme_advanced_resizing : true,

              // ===========================================
              // Set RELATIVE_URLS to FALSE (This is required for images to display properly)
              // ===========================================

              relative_urls : false

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
          <h1 class="uk-article-title">Profil Sekolah <span class="uk-text-large">{ Tambah Data Profil Sekolah }</span></h1>
          <br>
          <a href="./profil-sekolah" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Tahun Ajaran"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
             <form id="formprofil" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
        
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="npsn">Isi Data NPSN (Nomor Pokok Sekolah Nasional)<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="npsn" name="npsn" value="<?php echo $datanpsn; ?>" required="required" class="form-control col-md-7 col-xs-12">
            <div class="reg-info"></div>
          </div>

        </div>

      <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status_sekolah">Status Sekolah <span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="status_sekolah" id="status_sekolah" value="<?php echo $datastatussekolah; ?>" class="form-control col-md-7 col-xs-12">
              <option value="">--- Status Sekolah --</option>
              <option value="Negeri">Sekolah Negeri / Sekolah Pemerintah</option>
              <option value="Swasta">Sekolah Swasta / Sekolah Non-Pemerintah</option>
            </select>
          </div>
        </div>

      <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bentuk">Bentuk Sekolah <span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="bentuk" id="bentuk" value="<?php echo $databentuk; ?>" class="form-control col-md-7 col-xs-12">
              <option value="">--- Bentuk Sekolah --</option>
              <option value="Negeri">Sekolah Dasar (SD) / Sederajat</option>
              <option value="Negeri">Sekolah Menengah Pertama (SMP) / Sederajat</option>
              <option value="Negeri">Sekolah Menengah Atas (SMA) / Sederajat</option>
            </select>
          </div>
        </div>

       <hr class="uk-article-divider">
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
                    <label class="control-label col-md-63 col-sm-3 col-xs-12" for="id_kel">Kelurahan <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="id_kel" name="id_kel" required>
                        <option value="">-Pilih Kelurahan-</option>
                      </select>
                      <div class="reg-info">Wajib Pilih  Kelurahan  </div>
                    </div>
                  </div>

                  <div class="item form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kodepos">Kode Pos<span class="required">*</span>
                   </label>
                   <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="kodepos" name="kodepos" value="<?php echo $datakodepos; ?>" required="required" class="form-control col-md-7 col-xs-12">
                    <div class="reg-info">Contoh: 55283.</div>
                  </div>
                </div>

                  <div class="item form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat_sekolah">Alamat Lengkap<span class="required">*</span>
                   </label>
                   <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="alamat_sekolah" name="alamat_sekolah" value="<?php echo $dataalamatsekolah; ?>" required="required" class="form-control col-md-7 col-xs-12">
                    <div class="reg-info">Contoh: Jalan Kenangan, Kota Barat, Depok, Yogyakarta.</div>
                  </div>
                </div>

       <hr class="uk-article-divider">

                  <div class="item form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Surat Elektronik (Email)<span class="required">*</span>
                   </label>
                   <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="email" name="email" value="<?php echo $dataemail; ?>" required="required" class="form-control col-md-7 col-xs-12">
                    <div class="reg-info">Contoh: sekolah@email.com.</div>
                  </div>
                </div>

                  <div class="item form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Alamat Situs (Website)<span class="required">*</span>
                   </label>
                   <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="website" name="website" value="<?php echo $datawebsite; ?>" required="required" class="form-control col-md-7 col-xs-12">
                    <div class="reg-info">Contoh: http://situs-sekolah.ac.id</div>
                  </div>
                </div>

       <hr class="uk-article-divider">

                  <div class="item form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sk_pendirian">Nomor Surat Keputusan Pendirian Sekolah (SK Pendirian) <span class="required">*</span>
                   </label>
                   <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="sk_pendirian" name="sk_pendirian" value="<?php echo $dataskpendirian; ?>" required="required" class="form-control col-md-7 col-xs-12">
                    <div class="reg-info">Contoh:</div>
                  </div>
                </div>

                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal_pendirian">Tanggal Pendirian Sekolah<span class="required">*</span>
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="tanggal_pendirian" name="tanggal_pendirian" value="<?php echo $datatanggalpendirian; ?>" required="required" class="form-control col-md-7 col-xs-12" data-uk-datepicker="{format:'DD/MM/YYYY'}" >
                      <div class="reg-info">Format: <code>DD/MM/YYYY</code></div>
                      <div class="reg-info">Contoh: 31/12/1994</div>
                      </div>
                  </div>

                  <div class="item form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status_pemilik">Status Kepemilikan Sekolah <span class="required">*</span>
                   </label>
                   <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="status_pemilik" name="status_pemilik" value="<?php echo $datastatuspemilik; ?>" required="required" class="form-control col-md-7 col-xs-12">
                    <div class="reg-info">Contoh: Pemerintah Daerah</div>
                  </div>
                </div>

                  <div class="item form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sk_izin">Nomor Surat Izin Operasional (SK Izin Operasional) <span class="required">*</span>
                   </label>
                   <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="sk_izin" name="sk_izin" value="<?php echo $dataskizin; ?>" required="required" class="form-control col-md-7 col-xs-12">
                    <div class="reg-info">Contoh: Pemerintah Daerah</div>
                  </div>
                </div>

                  <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal_izin">Tanggal Izin Operasional<span class="required">*</span>
                    </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="tanggal_izin" name="tanggal_izin" value="<?php echo $datatanggalizin; ?>" required="required" class="form-control col-md-7 col-xs-12" data-uk-datepicker="{format:'DD/MM/YYYY'}" >
                      <div class="reg-info">Format: <code>DD/MM/YYYY</code></div>
                      <div class="reg-info">Contoh: 31/12/1994</div>
                      </div>
                  </div>

       <hr class="uk-article-divider">

        <div class="form-group">
          <label for="content">Lokasi Sekolah<span class="required">*</span></label>
          <textarea class="form-control" name="content" id="content" rows="3"></textarea>
          <div class="reg-info">Contoh:</div>
        </div>



        <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" id="profil_simpan" name="profil_simpan" class="btn btn-success">Submit</button>
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
