<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));

// TEMPLATE CONTROL
$ui_register_page = 'mengajar';

// LOAD HEADER
loadAssetsHead('Master Data Guru Mengajar');

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
        <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="" title="">
      </div>
      
      <hr class="uk-article-divider">
          <h1 class="uk-article-title">Data Mengajar  <span class="uk-text-large">
          <?php  if (isset($_SESSION['administrator'])) {?>
      { Master Data }</span></h1>
          <?php  }?>
          <br>
          <?php if (isset($_SESSION['administrator'])) { ?>
          <a href="./mengajar.tambah" class="uk-button uk-button-success" type="button" title="Tambah Data Mengajar"><i class="uk-icon-plus"></i> Mengajar</a>
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
    $sql_select="SELECT * from mengajar mg, guru g, kelas k, mapel m where mg.id_guru=g.id_guru and mg.id_kelas=k.id_kelas and mg.kd_mapel=m.kd_mapel order by mg.nip asc ";
    $query_select=mysql_query($sql_select); 

   echo "<table cellpadding='0' cellspacing='0' border='0' id='table' class='tinytable'>";
	 echo "<thead>
			<tr>
								<th><h3 class='uk-text-center'>NIP</h3></th>
								<th><h3 class='uk-text-center'>Nama Guru</h3></th>
                <th><h3 class='uk-text-center'>Mata Pelajaran yang Diampu</h3></th>
                <th><h3 class='uk-text-center'>Kelas yang Diampu</h3></th>
								<th><h3 class='uk-text-center'>Aksi</h3></th>
							</tr>
						</thead>";
        
      while($data=mysql_fetch_array($query_select)){
          $nip = $data['nip'];
          $nm_guru = $data['nm_guru'];
          $data2 = "";
          $jumlah = mysql_num_rows(mysql_query("SELECT * FROM mengajar WHERE kd_mengajar = '$kd_mengajar'"));

          while ($data1=mysql_fetch_array($jumlah)){
          $data2=$data1['kd_kelas']." ".$data2;
        }
        $jum_kelas=mysql_num_rows(mysql_query("SELECT kd_kelas from mengajar where nip = '$nip'"));

        $jumlah2 = mysql_num_rows(mysql_query("SELECT DISTINCT kd_mapel from mengajar where nip = '$nip'"));

          echo "<tr>";
          echo "<td><div class='uk-text-center'>$data[nip]</td>"; 
          echo "<td><div class='uk-text-center'>$data[nm_guru]</td>";
          echo "<td><div class='uk-text-center'>$data[nm_mapel]</td>";
          echo "<td><div class='uk-text-center'>$data[nm_kelas]</td>";
          echo "<form method='POST' action='lihatsiswa' name='action'>
                <input type='hidden' value='$nip' name='nip'>
        
          <td align='center'>
            <a href='lihatmengajar?nip=$nip' class='uk-button uk-button-small'>Lihat</a>
           </form>";
           echo "</td>";
           echo "</tr>";
            }
            echo "</tbody><br>";       
            echo "</table><br>";

    $total_mengajar = mysql_num_rows(mysql_query("select * from mengajar"));
    echo "<center><br><b>Total Seluruh mengajar: $total_mengajar</b><br>";

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
