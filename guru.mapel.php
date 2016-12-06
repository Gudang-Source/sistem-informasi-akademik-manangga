<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1));

// TEMPLATE CONTROL
$ui_register_page = 'guru.mapel';

// LOAD HEADER
loadAssetsHead('Data Mata Pelajaran');

// FORM PROCESSING
// ... code here ...
    // validation form kosong
   $pesanError= array();
  if (trim($kd_mapel)=="") {
    $pesanError[]="Data <b>Kode Mata Pelajaran</b> Masih Kosong.";
  }
  if (trim($nm_mapel)=="") {
    $pesanError[]="Data <b>Nama Mata Pelajaran</b> Masih Kosong.";
  }
  if (trim($kkm)=="") {
    $pesanError[]="Data <b>KKM</b> Masih Kosong.";
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
						<img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="" title="">
					</div>

					<hr class="uk-article-divider">
					<h1 class="uk-article-title">Data Mata Pelajaran <span class="uk-text-large">
						<?php  if (isset($_SESSION['id_guru'])) {?>
						{ Data Mata Pelajaran Yang Di Ampu}</span></h1>
						<?php  }?>
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
							<table id="table" class="uk-table uk-table-hover uk-table-striped uk-table-condensed" width="100%" width="100%">
								<thead>
									<tr>
										<th><h3 class="uk-text-center">No</h3></th>

										<th><h3 class="uk-text-center" >Nama Mata Pelajaran</h3></th>
										<th><h3 class="uk-text-center" >Kriteria Kelulusan Minimal</h3></th>
										<th><h3 class="uk-text-center" >Kelas</h3></th>
										
									</tr>
								</thead>
								<tbody>

								

									<?php 

									$query="SELECT * FROM mapel, mengajar, kelas 
									where mengajar.id_kelas=kelas.id_kelas 
									and mengajar.kd_mapel=mapel.kd_mapel 
									and mengajar.id_guru='$_SESSION[id_guru]' 
									order by mapel.nm_mapel asc";
									$exe=mysql_query($query);
									$no=0;
									while ($row=mysql_fetch_array($exe)) { $no++;

										$kd_mapel=$row['kd_mapel'];
										?>




										<tr>
											<td><div class="uk-text-center"><?php echo $no?></div></td>

											<td><div class="uk-text-center"><?php echo $row[nm_mapel]?></div></td>
											<td><div class="uk-text-center"><?php echo $row[kkm]?></div></td>
											<td><div class="uk-text-center"><?php echo $row[nm_kelas]?></div></td>
														
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

<script src="assets/validator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/vendor/formvalidation/css/formValidation.min.css">
<link rel="stylesheet" href="/asset/css/demo.css">
<script src="/vendor/formvalidation/js/formValidation.min.js"></script>
<script src="/vendor/formvalidation/js/framework/uikit.min.js"></script>




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
