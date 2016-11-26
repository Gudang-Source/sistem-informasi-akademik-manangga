<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));

// TEMPLATE CONTROL
$ui_register_page = 'Manajemen Jadwal';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Manajemen Jadwal');

// FORM PROCESSING
if (isset ($_POST["jadwalmapel_simpan"]) ){ 

      // baca variabel
    
    $id_tahun     = $_POST['id_tahun'];
    $id_tahun     = str_replace("", "&acute;", $id_tahun);

    $id_mengajar     = $_POST['id_mengajar'];
    $id_mengajar     = str_replace("", "&acute;", $id_mengajar);

    $kd_mapel     = $_POST['kd_mapel'];
    $kd_mapel     = str_replace("", "&acute;", $kd_mapel);

    $id_sesi     = $_POST['id_sesi'];
    $id_sesi     = str_replace("", "&acute;", $id_sesi);

    $id_hari     = $_POST['id_hari'];
    $id_hari     = str_replace("", "&acute;", $id_hari);

    $id_semester     = $_POST['id_semester'];
    $id_semester     = str_replace("", "&acute;", $id_semester);

        // validation form kosong
   $pesanError= array();
  if (trim($id_tahun)=="") {
    $pesanError[]="Data <b>Tahun</b> Masih Kosong.";
  }
  if (trim($id_mengajar)=="") {
    $pesanError[]="Data <b>Guru</b> Masih Kosong.";
  }
  if (trim($kd_mapel)=="") {
    $pesanError[]="Data <b>Mapel</b> Masih Kosong.";
  }
    if (trim($id_sesi)=="") {
    $pesanError[]="Data <b>Sesi</b> Masih Kosong.";
  }
  if (trim($id_hari)=="") {
    $pesanError[]="Data <b>ID Guru</b> Masih Kosong.";
  }
    if (trim($id_semester)=="") {
    $pesanError[]="Data <b>ID Semester</b> Masih Kosong.";
  }

    // jika ada error dari validasi form
     if (count($pesanError)>=1) {
    echo "<div class='mssgBox'>";
    echo "<img src ='../images/attention.png'><br><hr>";
    $noPesan= 0;
    foreach ($pesanError as $indeks => $pesan_tampil) {
      $noPesan++;
      echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
     }
    echo "</div><br />";
    }

    else{

    // simpan ke database
  $querytambahjadwal = mysql_query("INSERT INTO jadwal (id_tahun, id_mengajar, kd_mapel, id_sesi, id_hari, id_semester) 
    VALUES ( '$id_tahun' , '$id_mengajar' , '$kd_mapel' , '$id_sesi' , '$id_hari' , '$id_semester' )") or die(mysql_error());


  if ($querytambahekstrakurikuler){
    header('location: ./jdawal-mapel-admin');
    }
  }
}

//Variable Pos
    // simpan pada form, dan jika form belum terisi
  $datatahun                  = isset($_POST['id_tahun']) ? $_POST['id_tahun'] : '';
  $datamengajar               = isset($_POST['id_mengajar']) ? $_POST['id_mengajar'] : '';
  $datamapel                  = isset($_POST['kd_mapel']) ? $_POST['kd_mapel'] : '';
  $datasesi                   = isset($_POST['id_sesi']) ? $_POST['id_sesi'] : '';
  $datahari                   = isset($_POST['id_hari']) ? $_POST['id_hari'] : '';
  $datasemester               = isset($_POST['id_semester']) ? $_POST['id_semester'] : '';
?>

<link rel="stylesheet" href="assets/tablesorter/style.css" />
<body>

  <?php
  // LOAD MAIN MENU
  loadMainMenu();
  ?>

  <div class="uk-container uk-container-center">

    <div class="uk-grid uk-margin-large-top" data-uk-grid-margin data-uk-grid-match>

      <div class="uk-width-medium-1-6 uk-hidden-small">
        <?php loadSidebar() ?>
      </div>

      <div class="uk-width-medium-5-6 tm-article-side">
        <article class="uk-article">

      <div class="uk-vertical-align uk-text-right uk-height-1-1">
        <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="Sistem Informasi Akademik SDN II Manangga" title="Sistem Informasi Akademik SDN II Manangga">
      </div>
      
          <hr class="uk-article-divider">
          <h1 class="uk-article-title">Master Data Manajemen Jadwal <span class="uk-text-large">{ Tambah Master Data Manajemen Jadwal }</span></h1>
          <br>
          <a href="./jadwal-mapel-admin" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Master Manajemen Jadwal"><i class="uk-icon-angle-left"></i> Kembali</a>
          <!-- <hr class="uk-article-divider"> -->
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
             <form id="formjadwalmapel" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_mengajar">Pilih Pengampu<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="id_mengajar" id="id_mengajar" value="<?php echo $dataidguru; ?>" class="form-control col-md-7 col-xs-12">
              <option value="">--- Guru --</option>
              <?php
              $query = "SELECT * from guru";
              $hasil = mysql_query($query);
              while ($data = mysql_fetch_array($hasil))
              {
                echo "<option value=".$data['id_guru'].">".$data['nm_guru']."</option>";
              }
              ?>
            </select>
          </div>
       </div>
       <br>
       <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="">Pilih Kelas<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="" id="" class="form-control col-md-7 col-xs-12">
              <option value="">--- Pilih Kelas --</option>
              <?php
              $query = "SELECT * from kelas";
              $hasil = mysql_query($query);
              while ($data = mysql_fetch_array($hasil))
              {
                echo "<option value=".$data['id_kelas'].">".$data['nm_kelas']."</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <br>
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kd_mapel">Pilih Mata Pelajaran<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="kd_mapel" id="kd_mapel" value="<?php echo $datamapel; ?>" class="form-control col-md-7 col-xs-12">
              <option value="">--- Pilih Mata Pelajaran --</option>
              <?php
              $query = "SELECT * from mapel";
              $hasil = mysql_query($query);
              while ($data = mysql_fetch_array($hasil))
              {
                echo "<option value=".$data['kd_mapel'].">".$data['nm_mapel']."</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <br>
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_hari">Pilih Hari<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="id_hari" id="id_hari" class="form-control col-md-7 col-xs-12">
              <option value="">--- Pilih Hari --</option>
              <?php
              $query = "SELECT * from hari";
              $hasil = mysql_query($query);
              while ($data = mysql_fetch_array($hasil))
              {
                echo "<option value=".$data['id_hari'].">".$data['nm_hari']."</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <br>
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_sesi">Pilih Hari<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="id_sesi" id="id_sesi" class="form-control col-md-7 col-xs-12">
              <option value="">--- Pilih Jam --</option>
              <?php
              $query = "SELECT * from sesi";
              $hasil = mysql_query($query);
              while ($data = mysql_fetch_array($hasil))
              {
                echo "<option value=".$data['id_sesi'].">".$data['jam']."</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <br>
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_tahun">Pilih Tahun Ajaran<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="id_tahun" id="id_tahun" class="form-control col-md-7 col-xs-12">
              <option value="">--- Pilih Tahun Ajaran --</option>
              <?php
              $query = "SELECT * from tahun_ajaran";
              $hasil = mysql_query($query);
              while ($data = mysql_fetch_array($hasil))
              {
                echo "<option value=".$data['id_tahun'].">".$data['thn_ajaran']."</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <br>
        <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_semester">Pilih Semester<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <select name="id_semester" id="id_semester" class="form-control col-md-7 col-xs-12">
              <option value="">--- Pilih Semester --</option>
              <?php
              $query = "SELECT * from semester";
              $hasil = mysql_query($query);
              while ($data = mysql_fetch_array($hasil))
              {
                echo "<option value=".$data['id_semester'].">".$data['nm_semester']."</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <br>
<br>
       <div style="text-align:center" class="form-actions no-margin-bottom">
         <button type="submit" id="jadwalmapel_simpan" name="jadwalmapel_simpan " class="btn btn-success">Submit</button>
       </div>
     </form>    
</div>
</div>
</div>    
 
</body>


  
  <!-- Table Sorter Script -->
  <script type="text/javascript" src="assets/tablesorter/script.js"></script>
  <script type="text/javascript">
    var sorter = new TINY.table.sorter('sorter','table',{
      headclass:'head',
      ascclass:'asc',
      descclass:'desc',
      evenclass:'evenrow',
      oddclass:'oddrow',
      evenselclass:'evenselected',
      oddselclass:'oddselected',
      paginate:true,
      size:20,
      colddid:'columns',
      currentid:'currentpage',
      totalid:'totalpages',
      startingrecid:'startrecord',
      endingrecid:'endrecord',
      totalrecid:'totalrecords',
      hoverid:'selectedrow',
      pageddid:'pagedropdown',
      navid:'tablenav',
      sortcolumn:0,
      sortdir:0,
      columns:[{index:3, format:' buah', decimals:1}],
      init:true
    });
  </script>
  <!-- END Table Sorter Script -->
  

<?php
// ADDITIONAL SCRIPTS
$scripts = <<<'JS'
<script>
// FORM SUBMIT and PROGRESS BAR CONTROL
$(document).ready(function (){
  $('#nip, #nm_guru, #password, #brg_tgl_terima , #jns_kelamin, #agama, #status, #kd_mapel, #jabatan, #almt_sekarang, #no_hp, #email, #hari, #foto').on('change', function(){
    validate();
    progress();
  });
});

function validate(){
  if (
    $('#nip').val().length > 0 &&
    $('#nm_guru').val().length > 0 &&
    $('#password').val().length > 0 &&
    $('#brg_tgl_terima').val().length > 0 &&
    $('#tmpt_lahir').val().length &&
    $('#jns_kelamin').val().length > 0 &&
    $('#agama').val().length > 0 &&
    $('#status').val().length > 0 &&
    $('#kd_mapel').val().length > 0 &&
    $('#jabatan').val().length > 0 &&
    $('#almt_sekarang').val().length > 0 &&
    $('#no_hp').val().length > 0 &&
    $('#email').val().length > 0 &&
    $('#hari').val().length > 0 &&
    $('#foto').val().length > 0 
    ) 
{
    $('#guru_simpan').prop('disabled', false);
  }
  else {
    $('#guru_simpan').prop('disabled', true);
  }
}
function progress(){
  var w1 = ($('#nip').val().length > 0) ? 6 : 0;
  var w2 = ($('#nm_guru').val().length > 0) ? 6 : 0;
  var w3 = ($('#password').val().length != '') ? 6 : 0;
  var w4 = ($('#brg_tgl_terima').val().length > 0) ? 6 : 0;
  var w5 = ($('#tmpt_lahir').val().length > 0) ? 6 : 0;
  var w6 = ($('#jns_kelamin').val().length > 0) ? 6 : 0;
  var w7 = ($('#agama').val().length != '') ? 6 : 0;
  var w8 = ($('#status').val().length > 0) ? 6 : 0;
  var w9 = ($('#kd_mapel').val().length > 0) ? 6 : 0;
  var w10 = ($('#jabatan').val().length > 0) ? 6 : 0;
  var w11 = ($('#almt_sekarang').val().length != '') ? 16 : 0;
  var w12 = ($('#no_hp').val().length > 0) ? 6 : 0;
  var w13 = ($('#email').val().length > 0) ? 6 : 0;
  var w14 = ($('#hari').val().length > 0) ? 6 : 0;
  var w15 = ($('#foto').val().length != '') ? 6 : 0;

  var wt = w1 + w2 + w3 + w4+ w5 + w6 + w7 + w8 + w9 + w10 + w11 + w12 + w13 + w14 + w15;
  $('#guru_progress').css('width', wt+'%');
}
</script>

JS;
// LOAD FOOTER
loadAssetsFoot();

ob_end_flush();
?>