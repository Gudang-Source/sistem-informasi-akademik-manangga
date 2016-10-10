<!-- user login -->
<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));

// TEMPLATE CONTROL
$ui_register_page     = 'wali-murid';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Lihat Data Orangtua / Wali Siswa');

//LOAD DATA


  #update data ke database

# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
$edit = mysql_query("SELECT * FROM wali WHERE id_wali='$_GET[id]'");
$rowks  = mysql_fetch_array($edit);


?>

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
          <h1 class="uk-article-title">Guru <span class="uk-text-large">{ Tampil Profil Orangtua / Wali Siswa }</span></h1>
          <br>
          <a href="./wali-murid" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Guru"><i class="uk-icon-angle-left"></i> Kembali</a>
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
                                            <td>Nama Bapak</td>
                                            <td><?php echo $rowks['nm_bapak'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Pekerjaan Bapak</td>
                                            <td><?php echo $rowks['pekerjaan_bapak'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Gaji Bapak</td>
                                            <td><?php echo $rowks['gaji_bapak'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Nomor Telepon</td>
                                            <td><?php echo $rowks['nohp_bapak'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Nama Ibu</td>
                                            <td><?php echo $rowks['nm_ibu'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Pekerjaan Ibu</td>
                                            <td><?php echo $rowks['pekerjaan_ibu'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Gaji Ibu</td>
                                            <td><?php echo $rowks['gaji_ibu'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Nomor Telepon</td>
                                            <td><?php echo $rowks['nohp_ibu'];?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td><?php echo $rowks['alamat'];?></td>
                                            
                                        </tr>
                                                                             
                                    </tbody>

                      </table></div></div>
         
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
