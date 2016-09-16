<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(0));

// TEMPLATE CONTROL
$ui_register_page = 'siswa-tugas';

// LOAD HEADER
loadAssetsHead('Data Tugas dari Guru');

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
          <h1 class="uk-article-title">Lihat Detail Tugas dari Guru <span class="uk-text-large">
         
     
         
		  { Detail Tugas }</span></h1>
          <br>

         <a href="./siswa-tugas" class="uk-button" type="button" title="Kembali ke Data Guru Mengajar">Kembali</a>
         <a href="./siswa-upload-tugas" class="uk-button uk-button-success" type="button" title="Kembali ke Data Guru Mengajar">Unggahan Siswa</a>
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
								<th><h3 class="uk-text-center">Nama Tugas</h3></th>
								<th><h3 class="uk-text-center">Pengampu</h3></th>
								<th><h3 class="uk-text-center">Nama File</h3></th>
								<th><h3 class="uk-text-center">Judul Tugas</h3></th>
								<th><h3 class="uk-text-center">Size</h3></th>
								<th><h3 class="uk-text-center">Waktu Upload</h3></th>
								<th><h3 class="uk-text-center">Aksi</h3></th>

							</tr>
						</thead>

							<tbody>
						  <?php 
			$sql_select= "SELECT
tugas.nama_file,
tugas.judul_tugas,
tugas.keterangan,
tugas.size,
tugas.waktu,
tugas.kd_tugas,
mapel.nm_mapel,
mengajar.nip,
guru.nm_guru,
mapel.kd_mapel
FROM
tugas
INNER JOIN mapel ON tugas.kd_mapel = mapel.kd_mapel
INNER JOIN mengajar ON mengajar.kd_mapel = mapel.kd_mapel
INNER JOIN guru ON tugas.nip = guru.nip AND mengajar.nip = guru.nip

WHERE mengajar.kd_mengajar='$_GET[id]' AND tugas.kd_kelas='$_GET[kd_kelas]' ";

     	   $query_select= mysql_query($sql_select);
     	   $no=0;
						while ($data=mysql_fetch_array($query_select)) { $no++;
  
						
					 ?>
        
							  <tr>
							  	<td><div class="uk-text-center"><?php echo $no?></div></td>
								<td><div class="uk-text-center"><?php echo $data['nm_mapel']?></div></td>
								<td><div class="uk-text-center"><?php echo $data['nm_guru']?></div></td>
								<td><div class="uk-text-center"><?php echo $data['nama_file']?></div></td>
								<td><div class="uk-text-center"><?php echo $data['judul_tugas']?></a></div></td>
								<td><div class="uk-text-center"><?php echo $data['size']?></div></td>
								<td><div class="uk-text-center"><?php echo $data['waktu']?></div></td>

								<td><div class="uk-text-center">
								 <a href="aksi.download.tugas?id=<?php echo $data['kd_tugas']?>" title="Unduh Tugas" data-uk-tooltip="{pos:'top-left'}" class="btn btn-success">Unduh Tugas</i></a>
								 <a href="siswa-tugas.tambah?id=<?php echo $data['nip']?>&&kd_kelas=<?php echo $_SESSION['kd_kelas']?>&&kd_mapel=<?php echo $data['kd_mapel']?>&&judul_tugas=<?php echo $data['judul_tugas']?>&&nis=<?php echo $_SESSION['usernamesiswa']?>" title="Unggah Tugas" data-uk-tooltip="{pos:'top-left'}" class="btn">Kumpulkan Tugas</i></a>
								 
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
