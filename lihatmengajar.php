<!-- user login -->
<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));

// TEMPLATE CONTROL
$ui_register_page     = 'mengajar';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Lihat Data Mengajar');

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
        <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="E-Learning SMK 4 Klaten" title="E-Learning SMK 4 Klaten">
      </div>
      
      <hr class="uk-article-divider">
          <h1 class="uk-article-title">Lihat Data Mengajar <span class="uk-text-large">
          <?php  if (isset($_SESSION['pengguna'])) {?>
      { Master Data }</span></h1>
          <?php  }?>
          <br>
          <?php if (isset($_SESSION['pengguna'])) { ?>
            <a href="./mengajar" class="uk-button" type="button" title="Kembali ke Data Guru Mengajar">Kembali</a>
          <a href="./mengajar.tambah" class="uk-button uk-button-success" type="button" title="Tambah Data Guru Mengajar"><i class="uk-icon-plus"></i> Guru Mengajar</a>
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
        <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead>
              <tr>
              
                <th><h3 class="uk-text-center">Nama Guru</h3></th>
                <th><h3 class="uk-text-center">Mata Pelajaran</h3></th>
                <th><h3 class="uk-text-center">Kelas yang Diampu</h3></th>
                <?php if (isset($_SESSION['pengguna'])) { ?>
                <th><h3 class="uk-text-center">Aksi</h3></th>
                <?php }?>
              </tr>
            </thead>
            <tbody>
              <?php
              $query="SELECT * FROM mengajar
              INNER JOIN guru ON guru.nip = mengajar.nip
              INNER JOIN mapel ON mapel.kd_mapel = mengajar.kd_mapel
              WHERE mengajar.nip = '$_GET[nip]'";
              $query=mysql_query($query); 
              $no=0;
              while ($data=mysql_fetch_array($query)) { $no++; 

              $nip = $data['nip'];
              $nm_guru = $data['nm_guru'];   
              $nm_mapel = $data['nm_mapel'];   
              $kd_kelas = $data['kd_kelas'];   
            ?>
            <tr>
         
               
                <td><div class="uk-text-center"><?php echo $nm_guru?></div></td>
                <td><div class="uk-text-center"><?php echo $nm_mapel?></div></td>
                <td><div class="uk-text-center"><?php echo $kd_kelas?></div></td>
                      <?php if (isset($_SESSION['pengguna'])) { ?>
                <td><div class="uk-text-center">
                  <a href="mengajar.update?id=<?php echo $data['kd_mengajar']?>" title="Sunting" data-uk-tooltip="{pos:'top-left'}" class="uk-button uk-button-small"><i class="uk-icon-pencil"></i></a>
                  <a href="mengajar.hapus?id=<?php echo $data['kd_mengajar']?>" onclick="return confirm('Apakah anda yakin akan menghapus data Kelas: <?php echo $row[1] ?> ini?')" title="Hapus" data-uk-tooltip="{pos:'top-left'}" class="uk-button uk-button-small uk-button-danger"><i class="uk-icon-remove"></i></a>
                
                </div>
                </td>
                <?php } ?>            
                </tr>
                <?php  } ?>
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
