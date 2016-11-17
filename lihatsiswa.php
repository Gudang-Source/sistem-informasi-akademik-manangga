<!-- user login -->
<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10,1));

// TEMPLATE CONTROL
$ui_register_page     = 'siswa';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Lihat Data Siswa');

// FORM PROCESSING
// ... code here ...
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
          <h1 class="uk-article-title">Lihat Siswa <span class="uk-text-large">
          <?php  if (isset($_SESSION['administrator'])) {?>
      { Master Data }</span></h1>
          <?php  }?>
          <br>
          <?php if (isset($_SESSION['administrator'])) { ?>
          <a href="./siswa.tambah" class="uk-button uk-button-success" type="button" title="Tambah Data Siswa"><i class="uk-icon-plus"></i> Siswa</a>
          <a href="./siswa" class="uk-button uk-button-small" type="button" title="Tambah Data Siswa">Kembali</a>
      <?php } ?>
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
          <?PHP

            $id_kelas = $_REQUEST ['id_kelas'];
            
            $sql_select="select * from siswa where id_kelas= '$id_kelas'";
            $query_select=mysql_query($sql_select); 
             
            echo "<table class='table table-nama' style='border: none; margin-bottom:2%'>";
            echo "<thead><tr>
            <th><h3 class='uk-text-center'>NIS</th>
            <th><h3 class='uk-text-center'>Nama Siswa</th>
            <th><h3 class='uk-text-center'>Kelas</th>
            <th><h3 class='uk-text-center'>Aksi</th>
            </tr></thead>";
            echo "<tbody>";
            $p=0;
            $w=0;
            while($row=mysql_fetch_array($query_select)){
                $nis = $row['nis'];
                $id_siswa = $row['id_siswa'];
                $nm_siswa = $row['nm_siswa'];
                $password = $row['password'];
                $id_kelas = $row['id_kelas'];
                $email = $row['email'];

               
                echo "<td align='center'>$nis</td>"; 
                echo "<td align='center'>$nm_siswa</td>";
                echo "<td align='center'>$id_kelas</td>";
                echo "<form method='POST' action='action_hapus_siswa.php' name='action'>
                <input type='hidden' value='$nis' name='nis'>
                <input type='hidden' value='$id_kelas' name='id_kelas'>

                <td align='center'>

                 <a href='siswa.lihat?id=$id_siswa' title='Lihat' data-uk-tooltip='{pos:'top-left'}'' class='uk-button uk-button-small'><i class='uk-icon-search'></i></a>
                 <a href='siswa.update?id=$nis' title='Sunting' data-uk-tooltip='{pos:'top-left'}'' class='uk-button uk-button-small'><i class='uk-icon-pencil'></i></a>
                 <a href='siswa.hapus?id=$nis' onclick='return confirm('Apakah anda yakin akan menghapus data ini?')' title='Hapus' data-uk-tooltip='{pos:'top-left'}'' class='uk-button uk-button-small uk-button-danger'><i class='uk-icon-remove'></i></a>


                </td>
                </form>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody><br>";       
            echo "</table><br>";


            $jumlah_siswa = mysql_num_rows(mysql_query("SELECT * FROM siswa where nis = '$nis'"));
            ?>
            <center>*Jumlah Siswa Laki-laki: </center>
            <center>*Jumlah Siswa Perempuan: </center>
            <?PHP
            ?>
          
          
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
          
        </article>
    <br><br><br>
      </div>

    </div>
  </div>
  
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
