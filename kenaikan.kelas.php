<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10,1,3));

// TEMPLATE CONTROL
$ui_register_page = 'kenaikan.kelas';


// LOAD HEADER
loadAssetsHead('Kenaikan Kelas Siswa');

?>

<link rel="stylesheet" href="assets/tablesorter/style.css" />
<?php

$cektahun = mysql_query("SELECT * FROM tahun_ajaran WHERE status='1'");
mysql_num_rows($cektahun);
$tahun_ajaransession = mysql_fetch_array($cektahun);          

          // tahun ajaran session
$_SESSION['id_tahun'] = $tahun_ajaransession['id_tahun'];
$_SESSION['thn_ajaran'] = $tahun_ajaransession['thn_ajaran'];
$_SESSION['semester'] = $tahun_ajaransession['semester'];
$_SESSION['status'] = $tahun_ajaransession['status'];
$sql_thn_sblm = mysql_query("SELECT * from tahun_ajaran where id_tahun < {$_SESSION['id_tahun']} order by id_tahun desc limit 1");
$thn_ajaran_sblm = mysql_fetch_array($sql_thn_sblm);
$_SESSION['id_tahun_sblm'] = $thn_ajaran_sblm['id_tahun'];
$_SESSION['thn_ajaran_sblm'] = $thn_ajaran_sblm['thn_ajaran'];
$_SESSION['semester_sblm'] = $thn_ajaran_sblm['semester'];
$_SESSION['status_sblm'] = $thn_ajaran_sblm['status'];
/*form processing*/
if (isset ($_POST["kelas_siswa_simpan"])) { 

    // baca variabel

  $id_kelas     = $_POST['id_kelas'];
  $id_siswa     = $_POST['id_siswa'];
  $id_tahun     = $_SESSION['id_tahun'];

    // validation form kosong
  $pesanError= array();
  if (trim($id_kelas)=="") {
    $pesanError[]="Anda Belum Pilih <b>Kelas</b>.";
  }
  if (trim($id_tahun)=="") {
    $pesanError[]="Tahun Ajaran Belum Diaktifkan.";
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

   $jumlah = count($_POST["id_siswa"]);

   for($i=0; $i < $jumlah; $i++)
   {
     $multisiswa=$_POST['id_siswa'][$i];


     $querytambahmengajar =  mysql_query("INSERT INTO kelas_siswa (id_kelas, id_siswa,  id_tahun) VALUES ( '$id_kelas', '$multisiswa',   '$_SESSION[id_tahun]' )") or die(mysql_error());


   }

    // simpan ke database

   header('location: ./kelas.siswa');





 }
}


?>

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
           <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="Sistem Informasi Akademik SD Negeri II Manangga" title="Sistem Informasi Akademik SD Negeri II Manangga">
         </div>

         <hr class="uk-article-divider">

         <form id="formkelassblm" method="POST" class="uk-form" enctype="multipart/form-data">

           <h1 class="uk-article-title">Masukkan Siswa Ke Kenaikan Kelas<span class="uk-text-large">
            <?php  if (isset($_SESSION['administrator'])) {?>
            { Master Data }</span></h1>
            <?php  }?>
            <br>
            <?php if (isset($_SESSION['administrator'])) { ?>
            <div class="uk-panel uk-panel-box uk-panel-box-secondary">
              <div class="uk-width-3-10">
               <div class="form-group">
                 <code> <label>Pilih Kelas</label></code>
                 <select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="id_kelas" name="id_kelas"  >
                  <option value="">-Pilih Kelas-</option>
                  <?php
                  $kelas =mysql_query("SELECT * FROM kelas order by nm_kelas asc ");
                  while ($datakelas=mysql_fetch_array($kelas)) { ?>
                  <option value="<?php echo $datakelas['id_kelas'];?>"><?php echo $datakelas['nm_kelas'];?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <br>
            <button type="submit" id="pilih_kelas" name="pilih_kelas" class="btn btn-success">Submit</button>

          </div>
          <?php } ?>
        </form>
        <br>
        <form>
          <div class="uk-panel uk-panel-box uk-panel-box-secondary">

           <code><label>Pilih/Checklist Siswa Yang Akan Dimasukkan Ke Kenaikan Kelas</label></code>
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
            <table id="table" class="uk-table uk-table-hover uk-table-striped uk-table-condensed" width="100%" width="100%">
              <thead>
                <tr>

                  <th><h3 class="uk-text-center" >NIS</h3></th>
                  <th><h3 class="uk-text-center" >Nama Siswa</h3></th>

                  <th><h3 class="uk-text-center" >Jenis Kelamin</h3></th>

                  <?php if (isset($_SESSION['administrator'])) { ?>
                  <th><h3 class="uk-text-center">Check List</h3></th>
                  <?php }?>
                </tr>
              </thead>
              <tbody>
                <?php 
                if($_POST['pilih_kelas']){
                  $id_kelas = $_POST['id_kelas'];
                  $pesanError= array();
                  if (trim($id_kelas)=="") {
                    $pesanError[]="Anda Belum Pilih <b>Kelas</b>.";
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


                $query="SELECT * from siswa left join kelas_siswa on kelas_siswa.id_siswa = siswa.id_siswa 
                where siswa.id_siswa not in (select kelas_siswa.id_siswa from kelas_siswa where id_tahun={$_SESSION['id_tahun']}) 
                and id_tahun={$_SESSION['id_tahun_sblm']} and id_kelas=$id_kelas order by nm_siswa asc";
                $exe=mysql_query($query);


                $no=0;
                while ($row=mysql_fetch_array($exe)) { $no++;?>

                <tr>

                  <td ><?php echo $row['nis']?></td>
                  <td ><?php echo $row['nm_siswa']?></td>
                  <td ><?php echo $row['jns_kelamin']?></td>
                  <?php if (isset($_SESSION['administrator'])) { ?>
                  <td width="15%"><div class="uk-text-center">
                    <?php echo "<br><input type='checkbox'  id='id_siswa' value='".$row['id_siswa']."' name='id_siswa[]'/>"; ?>
                  </td>
                  <?php } ?>            
                </tr>
                <?php  } 
                }
                }
                ?>
              </tbody>
            </table>


            <!-- PAGINATION -->
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
                  <a href="javascript:sorter.showall()">Lihat semua</a>
                </div>
              </div>
              <div id="tablelocation">
                <div>
                  <span>Tampilkan</span>
                  <select onchange="sorter.size(this.value)">
                    <option value="5">5</option>
                    <option value="10" selected="selected">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                  </select>
                  <span>Data Per halaman</span>
                </div>
                <div class="page">(Halaman <span id="currentpage"></span> dari <span id="totalpages"></span>)</div>
              </div>
            </div>

            <!-- END Pagination -->

          </div>
        </div>

      </article>
      <br><br><br>
      <div class="uk-form-row">
        <div class="uk-alert">Pastikan semua isian sudah terisi dengan benar!</div>
      </div>
      <div style="text-align:center" class="form-actions no-margin-bottom">
       <button type="submit" id="kelas_siswa_simpan" name="kelas_siswa_simpan" class="btn btn-success">Submit</button>
     </div>
   </div>

 </div>
</div>

</form>
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
   columns:[{index:7, format:' buah', decimals:1}],
   init:true
 });
</script>
<!-- END Table Sorter Script -->

</body>

<?php
// LOAD FOOTER
loadAssetsFoot();

ob_end_flush();
?>
