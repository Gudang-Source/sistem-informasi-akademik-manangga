<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));

// TEMPLATE CONTROL
$ui_register_page = 'Manajemen Jadwal';

// LOAD HEADER
loadAssetsHead('Manajemen Jadwal');

// FORM PROCESSING
if (isset ($_POST["mapel_simpan"]) ){ 

 function ubahformatTgl($tanggal) {
    $pisah    = explode('/',$tanggal);
    $urutan   = array($pisah[2],$pisah[1],$pisah[0]);
    $satukan  = implode('/',$urutan);
    return $satukan;
  }
//Variable Pos
  }
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
          <h1 class="uk-article-title">Set Jadwal Mata Pelajaran <span class="uk-text-large">{ Setting }</span></h1>
          <form class="uk-form uk-form-stacked" method="post" enctype="multipart/form-data">
                <div class="uk-form-row">
                  <div class="uk-progress uk-progress-mini uk-progress-primary uk-progress-striped uk-active">
                    <div class="uk-progress-bar" id="guru_progress" style="width: 0%;"></div>
                  </div>
                </div>
          <br>
<?php 
    $sql="select nip, nm_guru from guru";
    $result=mysql_query($sql);
    $jsArray = "var nm_guru = new Array();";                         
     ?>
    <table>
    <tbody>
    <tr>
      <td class="reg-label">NIP</td>
      <td> <select name="nip" onchange="ubah(this.value)">
           <option>--Pilih NIP--</option>
            <?php
            while($row = mysql_fetch_array($result)){
            ?>echo $row['nama'];
            <option value="<?php echo $row['nip']; ?>"><?php echo $row['nip']; ?></option>
            <?php
            $jsArray .= "nm_guru['" . $row['nip'] . "'] = {name:'" . addslashes($row['nm_guru']) . "'};";
            }?>
            </select></td>
    </tr>
    <tr>
      <td class="reg-label">Nama</td>
      <td class="reg-input"><input maxlength="25" style="width:200px" type="text" name="nm_guru" id="nmm_guru" disabled="">
      <script type="text/javascript">
                          <?php echo $jsArray;?>
                          function ubah(id){
                              document.getElementById('nmm_guru').value=nm_guru[id].name;
                              
                          }
                      </script></td>
    </tr>
    <tr>
        <td class="reg-label"><?php
            $sql2="select kd_mapel, nm_mapel from mapel";
            $result2=mysql_query($sql2);
            ?> Pelajaran</td>
        <td> <select name="mapel"><option>--Pilih Mata Pelajaran</option>
            <?php
            while($row2=mysql_fetch_array($result2)){
            ?>
            <option value="<?php echo $row2['kd_mapel']; ?>"><?php echo $row2['nm_mapel']; ?></option>
            <?php
            }
            ?>
            </select></td>
        <?php
        $sql3="select kd_kelas, nm_kelas from kelas";
        $result3=mysql_query($sql3);
        ?>
    </tr>
    <tr>
      <td class="reg-label">Kelas</td>
      <td><select name="kelas"><option>--Pilih Kelas--</option>
          <?php
          while($row3=mysql_fetch_array($result3)){
            ?>
            <option value="<?php echo $row3['kd_kelas']; ?>"><?php echo $row3['nm_kelas'] ?></option>
            <?php
          }
          ?>
        </select></td>
    </tr>
    <tr>
      <td class="">Hari</td><td><select name="hari">
          <option>--Pilih Hari--</option>
          <option value="Senin">Senin</option>
          <option value="Selasa">Selasa</option>
          <option value="Rabu">Rabu</option>
          <option value="Kamis">Kamis</option>
          <option value="Jumat">Jumat</option>
          <option value="Sabtu">Sabtu</option>
        </select></td>
    </tr>
    <tr>
      <td class="reg-label">Jam Ke</td><td><select name="jam">
      <option>--Pilih Jam--</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      </select></td>
    </tr>
      <?php
      $sql4="select id_tahun, thn_ajaran from thn_ajaran";
      $result4=mysql_query($sql4);
      ?>
    <tr>
    <td class="reg-label">Tahun Ajaran</td><td><select name="thn_ajaran">
      <option>--Pilih Tahun Ajaran--</option>
      <?php
      while($row4=mysql_fetch_array($result4)){
        ?>
        <option value="<?php echo $row4['id_tahun']; ?>"><?php echo $row4['thn_ajaran']; ?></option>
        <?php
      }
      ?>
      </select></td>
    </tr>
    <?php
    $sql5="select id_semester, semester from semester";
    $result5=mysql_query($sql5);
    ?>
    <tr>
      <td class="reg-label">Semester</td><td><select name="semester">
          <option>--Pilih Semester--</option>
          <?php
            while($row5=mysql_fetch_array($result5)){
              ?>
              <option value="<?php echo $row5['id_semester']; ?>"><?php echo $row5['semester']; ?></option>
              <?php
            }
          ?>
        </select></td>
    </tr>
</tbody>
</table>
    <table>
    <tbody>
    <tr>
      <td><button type="submit" value="Simpan Data" name="mapel_simpan" id="mapel_simpan" class="btn-uin btn btn-inverse btn btn-small" title="Simpan Data Mapel" disabled><i class="uk-icon-paper-plane"></i> Simpan</button></form></td>
      <td><input type="reset" value="Reset" class="btn-uin btn btn-inverse btn btn-small"></td>
      <td><form action="preview-jadwal.php" name="jadwal-preview"><a href="preview-jadwal.php"><button type="text" class="btn-uin btn btn-inverse btn btn-small">Preview Jadwal</button></a></form></td>    
      <span class="txtasmt"></span></td>
    </tr>
    </tbody>
    </table>        
      <h2>JADWAL MATA PELAJARAN
    </h2>

          

 <br><br>
      
        <div id="tablewrapper">
          <div id="tableheader">
            <div class="search">
              <select id="columns" onchange="sorter.search('query')"></select>
              <input type="text" id="query" onkeyup="sorter.search('query')" />
            </div>
            <span class="details">
              <div>Data <span id="startrecord"></span>-<span id="endrecord"></span> dari <span id="totalrecords"></span></div>
              <div><a href="javascript:sorter.reset()">(atur ulang)</a></div>
            </span>
          </div>
          <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead>
              <tr>
                <th><h3 class="uk-text-center">No</h3></th>
                <th><h3 class="uk-text-center">Nama</h3></th>
                <th><h3 class="uk-text-center">NIP</h3></th>
                <th><h3 class="uk-text-center">Mata Pelajaran</h3></th>
                <th><h3 class="uk-text-center">Kelas</h3></th>
                <th><h3 class="uk-text-center">Hari</h3></th>
                <th><h3 class="uk-text-center">Jam Ke</h3></th>
                <th><h3 class="uk-text-center">Tahun Ajaran</h3></th>
                <th><h3 class="uk-text-center">Semester</h3></th>
                <th><h3 class="uk-text-center">Aksi</h3></th>
              </tr>
            </thead>
              <tbody>
              <?php 
              $query="select * from user";
              $exe=mysql_query($query);
              while ($row=mysql_fetch_array($exe)) { ?>

                <tr>
                <td><div class="uk-text-center"><?php echo $row[0]?></div></td>
                <td><div class="uk-text-center"><?php echo $row[1]?></td></div>
                <td><div class="uk-text-center"><?php if($row[1]==1){
                          echo 'Petugas';
                          }
                          else if($row[1]==0){
                          echo 'Pimpinan';
                          }
                          else if($row[1]==10){
                          echo 'Admin';
                          }
                    ?></td>
                <td><div class="uk-text-center"><?php echo $row[2]?></td></div>
                <td><div class="uk-text-center"><?php echo $row[3]?></td></div>
                <td><div class="uk-text-center"><?php echo $row[2]?></td></div>
                <td><div class="uk-text-center"><?php echo $row[3]?></td></div>
                <td><div class="uk-text-center"><?php echo $row[3]?></td></div>
                <td><div class="uk-text-center"><?php echo $row[3]?></td></div>                
                <td><div class="uk-text-center">
                  <a href="pengguna.update?id=<?php echo $row[0]?>" title="Sunting" data-uk-tooltip="{pos:'top-left'}" class="uk-button uk-button-small"><i class="uk-icon-pencil"></i></a>
                  <a href="pengguna.hapus?id=<?php echo $row[0]?>" onclick="return confirm('Apakah anda yakin akan menghapus data pengguna: <?php echo $row[2] ?> ini?')" title="Hapus" data-uk-tooltip="{pos:'top-left'}" class="uk-button uk-button-small uk-button-danger"><i class="uk-icon-remove"></i></a>
                </td></div>
                </tr>
                <?php  } ?>
              </tbody>
          </table>
          
          <div id="tablefooter">
            <div id="tablenav">
              <div>
                <img src="assets/tablesorter/images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                <img src="assets/tablesorter/images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                <img src="assets/tablesorter/images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                <img src="assets/tablesorter/images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
              </div>
              <div>
                <select id="pagedropdown"></select>
              </div>
              <div>
                <a href="javascript:sorter.showall()">Tampilkan semua</a>
              </div>
            </div>
            <!-- PAGINATION -->
              <div>
                <span>Tampilkan</span>
                <select onchange="sorter.size(this.value)">
                <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="20" selected="selected">20</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                </select>
                <span>Data Per halaman</span>
              </div>
              <div id="tablelocation">
                <div class="page">Halaman <span id="currentpage"></span> dari <span id="totalpages"></span></div>
              </div>
            <!-- END Pagination -->
          </div>
        </div>
          
        </article>
    <br><br><br>
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