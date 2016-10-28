<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1, 10));

/*template control*/
$ui_register_page     = 'nilai';
$ui_register_assets   = array('datepicker');

/*load header*/
loadAssetsHead('Tambah Data Nilai');

/*form processing*/



?>
     <script type="text/javascript">
        var htmlobjek;
        $(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=prov>
  $("#kel").change(function(){
    var kel = $("#kel").val();
    $.ajax({
      url: "inc/ambil_siswa.php",
      data: "kel="+kel,
      cache: false,
      success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#siswa").html(msg);
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
          <h1 class="uk-article-title">Input Nilai <span class="uk-text-large">{ Tambah Data Nilai }</span></h1>
          <br>
          <a href="./nilai" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Nilai"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
             
          <form id="formnilai" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

      <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kel">Pilih Kelas<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="kel" id="kel" class="form-control col-md-7 col-xs-12">
              <option value="">--- Pilih Kelas --</option>
              <?php
                $kelas =mysql_query("SELECT * FROM kelas ORDER BY nm_kelas");
                  while ($datakelas=mysql_fetch_array($kelas)) {
                     echo "<option value=\"$datakelas[id_kelas]\">$datakelas[nm_kelas]</option>\n";
                  }
              ?>
            </select>
          </div>
        </div>

         <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="siswa">Siswa <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="siswa" name="siswa" required>
                            <option value="">-Pilih Siswa-</option>
                          </select>
                          <div class="reg-info">Daftar Siswa </div>
                        </div>
                      </div>

        <div style="text-align:center" class="form-actions no-margin-bottom">
            <td colspan="3"><div align="center">
    <input type="submit" name="Submit" value="Input Nilai >>" />
    <input type="reset" name="reset" value="Reset" />
    </div></td>
       </div>
     </form>    
</div>
</div>
</div>
</article>
</div>
</div>

<script src="assets/validator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/vendor/formvalidation/css/formValidation.min.css">
<link rel="stylesheet" href="/asset/css/demo.css">
<script src="/vendor/formvalidation/js/formValidation.min.js"></script>
<script src="/vendor/formvalidation/js/framework/uikit.min.js"></script>

<script type="text/javascript">
 var formkelas = $("#formkelas").serialize();
 var validator = $("#formkelas").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "glyphicon glyphicon-ok",
    invalid: "glyphicon glyphicon-remove", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
    
nm_kelas: {
  message: 'Nama Kelas Tidak Benar',
  validators: {
    notEmpty: {
      message: 'Nama Kelas Harus Diisi'
    },
    stringLength: {
      min: 1,
      max: 50,
      message: 'Nama Kelas Harus Lebih dari 1 Huruf dan Maksimal 50 Huruf'
    },
    regexp: {
      regexp: /^[a-zA-Z0-9_ \. ]+$/,
      message: 'Karakter Boleh Digunakan (Angka, Huruf, Titik, Underscore)'
    },
    remote: {
      type: 'POST',
      url: 'remote/remote_namakelas.php',
      message: 'Nama Kelas Telah Tersedia'
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
