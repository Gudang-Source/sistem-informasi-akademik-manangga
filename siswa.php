<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10,1));

// TEMPLATE CONTROL
$ui_register_page = 'siswa';

// LOAD HEADER
loadAssetsHead('Master Data Siswa');

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
			  <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="E-Learning SMK N 4 Klaten" title="E-Learning SMK N 4 Klaten">
		  </div>
		  
		  <hr class="uk-article-divider">
          <h1 class="uk-article-title">Siswa <span class="uk-text-large">
          <?php  if (isset($_SESSION['pengguna'])) {?>
		  { Master Data }</span></h1>
          <?php  }?>
          <br>
          <?php if (isset($_SESSION['pengguna'])) { ?>
          <a href="./siswa.tambah" class="uk-button uk-button-success" type="button" title="Tambah Data Siswa"><i class="uk-icon-plus"></i> Siswa</a>
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
		  <?php
    $sql_select="select * from kelas";
    $query_select=mysql_query($sql_select); 

   echo "<table cellpadding='0' cellspacing='0' border='0' id='table' class='tinytable'>";
	 echo "<thead>
			<tr>
								<th><h3 class='uk-text-center'>Kode Kelas</h3></th>
								<th><h3 class='uk-text-center'>Nama Kelas</h3></th>
								<th><h3 class='uk-text-center'>Jumlah Siswa</h3></th>
								<th><h3 class='uk-text-center'>Aksi</h3></th>
							</tr>
						</thead>";
        
      while($data=mysql_fetch_array($query_select)){
          $kd_kelas = $data['kd_kelas'];
          $nm_kelas = $data['nm_kelas'];
          $jumlah_siswa = mysql_num_rows(mysql_query("select * from siswa where kd_kelas = '$kd_kelas'"));
          echo "<tr>";
          echo "<td><div class='uk-text-center'>$kd_kelas</td>"; 
          echo "<td><div class='uk-text-center'>$nm_kelas</td>";
          echo "<td><div class='uk-text-center'>$jumlah_siswa</td>";
          echo "<form method='POST' action='lihatsiswa' name='action'>
                <input type='hidden' value='$kd_kelas' name='kd_kelas'>
              
          <td align='center'>
            <a href='lihatsiswa?kd_kelas=$kd_kelas' class='uk-button uk-button-small'>Lihat Siswa</a>
           </form>";
           echo "</td>";
           echo "</tr>";
            }
            echo "</tbody><br>";       
            echo "</table><br>";

    $total_siswa = mysql_num_rows(mysql_query("select * from 	siswa"));
    echo "<center><br><b>Total Seluruh Siswa: $total_siswa</b><br>";

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
