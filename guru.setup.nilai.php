<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1));

// TEMPLATE CONTROL
$ui_register_page = 'guru.setup.nilai';


// LOAD HEADER
loadAssetsHead('Setup Nilai');
if (isset ($_POST["nilai_tampilkan"]) ){ 


	 $id_guru       = $_POST['id_guru'];
	
	 $id_kelas       = $_POST['id_kelas'];
	
	 $kd_mapel       = $_POST['kd_mapel'];
	

	
	

}
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
$thn_ajaran = substr($_SESSION['thn_ajaran'], 0,4);
$thn_ajaran = (int)$thn_ajaran;
$thn_ajaran--;
$thn_ajaran = (string)$thn_ajaran;
$sql_thn_sblm = mysql_query("SELECT * from tahun_ajaran where mid(thn_ajaran,1,4) = '$thn_ajaran'");
$thn_ajaran_sblm = mysql_fetch_array($sql_thn_sblm);
$_SESSION['id_tahun_sblm'] = $thn_ajaran_sblm['id_tahun'];
$_SESSION['thn_ajaran_sblm'] = $thn_ajaran_sblm['thn_ajaran'];
$_SESSION['semester_sblm'] = $thn_ajaran_sblm['semester'];
$_SESSION['status_sblm'] = $thn_ajaran_sblm['status'];
/*form processing*/


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

						<h1 class="uk-article-title">Setup Nilai<span class="uk-text-large">

							<?php  if (isset($_SESSION['id_guru'])) { ?>
							{ Master Data }</span></h1>
							<?php  }?>
							<br>
							<div class="uk-form-row">
								<div class="uk-progress uk-progress-mini uk-progress-primary uk-progress-striped uk-active">
									<div class="uk-progress-bar" id="nilai_progress" style="width: 0%;"></div>
								</div>
							</div>
							<?php if (isset($_SESSION['id_guru'])) { ?>
							<div class="uk-panel uk-panel-box uk-panel-box-secondary">
								<input type="hidden" name="id_guru" id="id_guru" value="<?php echo $_SESSION['id_guru']; ?>">
								<div class="uk-width-3-10">
									<div class="form-group">
										<code> <label>Pilih Mata Pelajaran</label></code>
										<select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="kd_mapel" name="kd_mapel"  >
											<option value="">-Pilih Mata Pelajaran-</option>
											<?php 
											$mapel = mysql_query("SELECT kd_mapel, nm_mapel FROM mapel where kd_mapel in (SELECT mapel.kd_mapel FROM mapel left join mengajar on mengajar.kd_mapel=mapel.kd_mapel 
												right join jadwal on jadwal.id_mengajar=mengajar.id_mengajar
												where mengajar.id_guru='$_SESSION[id_guru]' 
												) order by nm_mapel asc");
											
											while($k = mysql_fetch_array($mapel)){
												echo "<option value=\"".$k['kd_mapel']."\">".$k['nm_mapel']."</option>\n";
											}
											?>
										</select>
									</div>
								</div>
								<br>
								<br>
								<div class="uk-width-3-10">
									<div class="form-group">
										<code> <label>Pilih Kelas</label></code>
										<select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="id_kelas" name="id_kelas"  >
											<option value="">-Pilih Kelas-</option>               
										</select>
									</div>
								</div>
								<br>
								<br>
								
								<br>
								<div class="uk-form-row">
									<button type="submit" value="Lihat" name="nilai_tampilkan" id="nilai_tampilkan" class="btn btn-success" title="Tampilkan Laporan" disabled><i class="uk-icon-search"></i> Lihat</button>
								</div>

							</div>
							
						</form>
						<?php } ?>
						<br>
						
						
						<form id="forminputnilai" method="POST" action="action.setup.nilai?act=input" class="uk-form" enctype="multipart/form-data">
							<div class="uk-panel uk-panel-box uk-panel-box-secondary">
								<code><label>Masukan Presentase Nilai</label></code>
								<?php if (isset ($_POST["nilai_tampilkan"]) ) : ?>
									<div class="uk-form-row">
										<?php 
										
										$exe123  = mysql_query("SELECT * FROM mengajar,mapel,kelas 
											where mengajar.id_kelas=kelas.id_kelas 
											and mengajar.kd_mapel=mapel.kd_mapel 
											and mengajar.kd_mapel='$kd_mapel'
											and mengajar.id_kelas='$id_kelas'"); 
										$keterangane=mysql_fetch_array($exe123); 
										

										?>
										
									</div>
									<div class="uk-alert uk-alert-sucess">
									<div class="uk-form-row">
										
											<label class="uk-form-label">Mata Pelajaran : <span class="uk-text-success"><?php echo $keterangane[nm_mapel];?></span></label>
											<br><label class="uk-form-label">Kelas : <span class="uk-text-success"><?php echo $keterangane[nm_kelas];?></span></label>
											<br><label class="uk-form-label">KKM : <span class="uk-text-success"><?php echo $keterangane[kkm];?></span></label>
										</div>
										</div>
									<br>
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

													<th><h3 class="uk-text-center" >NO</h3></th>
													<th><h3 class="uk-text-center" >Komponen Nilai</h3></th>
													<th><h3 class="uk-text-center" >Presentase </h3></th>



												</tr>
											</thead>
											<tbody>
												<?php 
												$exes  = mysql_query("SELECT * FROM setup_nilai WHERE 
													 id_tahun='$_SESSION[id_tahun]'
													and kd_mapel='$kd_mapel'
													and id_kelas='$id_kelas'
													and id_guru='$id_guru'
													");
												$rows=mysql_fetch_array($exes);
												?>

													<tr>
														<td><div class="uk-text-center">1</div></td>
														<td><div class="uk-text-left">Ulangan Harian</div></td>
														<td><div class="uk-text-center"><input type="text" id="uh" name="uh" value="<?php echo $rows[uh]; ?>" onkeyup="convertAngka(this);"  class="uk-form-width-small">  %</div></td>
													</tr>
													<tr>
														<td><div class="uk-text-center">2</div></td>
														<td><div class="uk-text-left">Tugas</div></td>
														<td><div class="uk-text-center"><input type="text" id="t" name="t" value="<?php echo $rows[t]; ?>" onkeyup="convertAngka(this);"  class="uk-form-width-small">  %</div></td>
													</tr>
													<tr>
														<td><div class="uk-text-center">3</div></td>
														<td><div class="uk-text-left">Ujian Tengah Semester</div></td>
														<td><div class="uk-text-center"><input type="text" id="uts" name="uts" value="<?php echo $rows[uts]; ?>" onkeyup="convertAngka(this);"  class="uk-form-width-small">  %</div></td>
													</tr>
													<tr>
														<td><div class="uk-text-center">4</div></td>
														<td><div class="uk-text-left">Ujian Akhir Semester</div></td>
														<td><div class="uk-text-center"><input type="text" id="uas" name="uas" value="<?php echo $rows[uas]; ?>" onkeyup="convertAngka(this);"  class="uk-form-width-small">  %</div></td>
													</tr>
														<script type="text/javascript">
															function convertAngka(objek) {

																a = objek.value;
																b = a.replace(/[^\d]/g,"");

																objek.value = b;

															}            
														</script>
													
													
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
									<div class="uk-form-row">
										<div class="uk-alert">Pastikan semua isian sudah terisi dengan benar!</div>
									</div>
									<input type="hidden" name="id_setup_nilai" value="<?php echo $rows[id_setup_nilai]; ?>">
									<input type="hidden" name="id_tahun" value="<?php echo $rows[id_tahun]; ?>">
									
									<input type="hidden" name="sik" value="<?php echo $sik ?>">
									<div style="text-align:center" class="form-actions no-margin-bottom">
										<button type="submit" id="simpan_nilai" name="simpan_nilai" class="btn btn-success">Simpan</button>
									</div>
								</form>
							<?php endif; ?>
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
			<script>
				$(document).ready(function (){
  // FORM SUBMIT and PROGRESS BAR CONTROL
  $('#kd_mapel').on('change', function(){
  	validate();
  	progress();
  	var id_guru = $("#id_guru").val();
  	var kd_mapel = $("#kd_mapel").val();
  	var komponen_nilai = $("#komponen_nilai").val();
  	$.ajax({
  		url: "inc/jikuk_kelas_nilai.php",
  		data: "kd_mapel="+kd_mapel+"&id_guru="+id_guru,
  		cache: false,
  		success: function(msg){
  			$('select[name="id_kelas"]').html(msg);
  		}
  	});

  });

  $('#id_kelas').on('change', function(){
  	validate();
  	progress();
  });

  $('#komponen_nilai').on('change', function(){
  	validate();
  	progress();
  });

  //download excel


});


				function validate(){
					if (
						$('#kd_mapel').val() != '' &&
						$('#id_kelas').val() != '' &&
						$('#komponen_nilai').val() != ''
						) {

						$('#nilai_tampilkan').prop('disabled', false);
				}
				else {
					$('#nilai_tampilkan').prop('disabled', true);
				}
			}

			function progress(){
				var w1 = ($('#kd_mapel').val() != '') ? 33 : 0;
				var w2 = ($('#id_kelas').val() != '') ? 33 : 0;
				var w3 = ($('#komponen_nilai').val() != '') ? 34 : 0;
				wt = w1 + w2 + w3;
				$('#nilai_progress').css('width', wt+'%');
//	jikukkelas();
}




</script>

<!-- END Table Sorter Script -->

</body>

<?php
// LOAD FOOTER
loadAssetsFoot();

ob_end_flush();
?>
