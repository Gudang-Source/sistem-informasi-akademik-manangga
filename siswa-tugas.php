<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(0, 10));

// TEMPLATE CONTROL
$ui_register_page = 'siswa-tugas';

// LOAD HEADER
loadAssetsHead('Tugas Siswa');

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
          <h1 class="uk-article-title">Tugas Siswa <span class="uk-text-large">
             
         <?php 
		$sql_select= "SELECT * from siswa where nis={$_SESSION['usernamesiswa']}";
        $query_select= mysql_query($sql_select);
        $data = mysql_fetch_array($query_select);
        $kd_kelas = $data['kd_kelas'];
        ?>
         
		  { Kelas <?php echo $kd_kelas ?>  }</span></h1>
        
          <br>
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
								<th><h3 class="uk-text-center">Nama Guru</h3></th>
								<th><h3 class="uk-text-center">Kode Kelas</h3></th>
								<th><h3 class="uk-text-center">Mata Pelajaran</h3></th>
								<th><h3 class="uk-text-center">Lihat Materi</h3></th>

<?php

?>
							</tr>
						</thead>

							<tbody>
						 <?php
							$kelas = $_SESSION['kd_kelas'];
							$sql="SELECT * from mengajar 
							INNER JOIN guru ON guru.nip=mengajar.nip 
							INNER JOIN mapel ON mapel.kd_mapel=mengajar.kd_mapel 
							WHERE kd_kelas = '$kelas'";
							$hasil=mysql_query($sql);
							$no=0;
							while ($data=mysql_fetch_array($hasil)) { $no++;
					
								?>
        
							  <tr>
							  	<td><div class="uk-text-center"><?php echo $no?></div></td>
								<td><div class="uk-text-center"><?php echo $data['nm_guru']?></div></td>
								<td><div class="uk-text-center"><?php echo $data['kd_kelas']?></div></td>

								<td><div class="uk-text-center"><?php echo $data['nm_mapel']?></div></td>
								<td><div class="uk-text-center">
								  <a href="siswa-lihattugas?id=<?php echo $data['kd_mengajar']?>&&kd_kelas=<?php echo $_SESSION['kd_kelas']?>" title="Lihat Tugas" data-uk-tooltip="{pos:'top-left'}" class="btn btn-success">Lihat Tugas</i></a>

								


								 
								</div>

								</td>
				
							  </tr>
<?php } ?>	 
							 
							</tbody>

	
					</table>
				<br><br><br>
	
                
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
