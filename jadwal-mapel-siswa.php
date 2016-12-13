<?php
session_start();

require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(0));

// TEMPLATE CONTROL
$ui_register_page = 'jadwal-mapel-siswa';

// LOAD HEADER
loadAssetsHead('Data Jadwal Mata Pelajaran');

$id_tahun=$_SESSION['id_tahun'];
// FORM PROCESSING
// ... code here ...
    // validation form kosong
$pesanError= array();
if (trim($guru)=="") {
	$pesanError[]="Data <b>Guru</b> Masih Kosong.";
}
if (trim($kd_mapel)=="") {
	$pesanError[]="Data <b>Mata Pelajaran</b> Masih Kosong.";
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
              <?php
$sqls = "SELECT * from kelas_siswa where id_siswa= $_SESSION[id_siswa]";
$results = mysql_query($sqls);
$rows=mysql_fetch_array($results);
$id_kelasab=$rows[id_kelas];
?>



<?php
$sql = "SELECT * from siswa, kelas_siswa where kelas_siswa.id_siswa=siswa.id_siswa AND kelas_siswa.id_kelas='$id_kelasab'";
$result = mysql_query($sql);
$row=mysql_fetch_array($result);
?>
					<h1 class="uk-article-title">Data Jadwal Mata Pelajaran <span class="uk-text-large">
						{ Kelas <b><?php echo "{$row['id_kelas']}";?></b> }</span></h1>
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
										<th>No</th>
										<th>Hari</th>
										<th>Jam Ke</th>
										<th>Mata Pelajaran</th>
										<th>Guru Pengampu</th>
										
										<th>Tahun Ajaran</th>
										
									</tr>
								</thead>
								<tbody>

									<?php 

									$query="SELECT DISTINCT * FROM (
SELECT jadwal.*,hari.nm_hari,sesi.jam,guru.*,tahun_ajaran.thn_ajaran,mapel.nm_mapel
 from jadwal,  kelas_siswa, mapel, hari, sesi, guru, mengajar, tahun_ajaran
WHERE jadwal.id_mengajar=mengajar.id_mengajar
AND jadwal.id_hari=hari.id_hari
AND jadwal.id_sesi=sesi.id_sesi
AND jadwal.id_tahun=tahun_ajaran.id_tahun
AND mengajar.id_kelas=kelas_siswa.id_kelas
AND mengajar.id_guru=guru.id_guru
AND mengajar.kd_mapel=mapel.kd_mapel
AND jadwal.id_tahun='$_SESSION[id_tahun]'
AND kelas_siswa.id_kelas='$row[id_kelas]'
) asd ORDER by nm_hari asc";
									$exe=mysql_query($query);
									$no=0;
									while ($row=mysql_fetch_array($exe)) { $no++;
										?>

<tr>
	<td><?php echo $no;?></td>
	<td><?php echo $row[nm_hari]?></td>
	<td><?php echo $row[jam]?></td>
	<td><?php echo $row[nm_mapel]?></td>

	<td><?php echo $row[gelar_depan]?> <?php echo $row[gelar_depan_akademik]?> <?php echo $row[nm_guru]?>, <?php echo $row[gelar_belakang]?></td>
	
	<td><?php echo $row[thn_ajaran]?></td>
           

	
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
<link rel="stylesheet" href="vendor/formvalidation/css/formValidation.min.css">
<script src="vendor/formvalidation/js/formValidation.min.js"></script>
<script src="vendor/formvalidation/js/framework/uikit.min.js"></script>




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
