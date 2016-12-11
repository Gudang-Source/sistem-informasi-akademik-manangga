<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1));

// TEMPLATE CONTROL
$ui_register_page = 'guru.nilai.tambah';


// LOAD HEADER
loadAssetsHead('Input Nilai Siswa');
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

						<h1 class="uk-article-title">Input Nilai<span class="uk-text-large">

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
								<div class="uk-width-3-10">
									<div class="form-group">
										<code> <label>Pilih Komponen Nilai</label></code>
										<select type="text" class="form-control chzn-select col-md-7 col-xs-12" id="komponen_nilai" name="komponen_nilai"  >
											<option value="">-Pilih Komponen-</option>               
											<option value="uh1"> Ulangan Harian 1 </option>               
											<option value="uh2"> Ulangan Harian 2 </option>               
											<option value="uh3"> Ulangan Harian 3 </option>               
											<option value="uh4"> Ulangan Harian 4 </option>               
											<option value="uh5"> Ulangan Harian 5 </option>               
											<option value="uh6"> Ulangan Harian 6 </option>               
											<option value="uh7"> Ulangan Harian 7 </option>  
											<option value="t1"> Tugas 1 </option>               
											<option value="t2"> Tugas 2 </option>               
											<option value="t3"> Tugas 3 </option>               
											<option value="t4"> Tugas 4 </option>               
											<option value="t5"> Tugas 5 </option>               
											<option value="t6"> Tugas 6 </option>               
											<option value="t7"> Tugas 7 </option>              
											<option value="uts"> Ujian Tengah Semester </option>               
											<option value="uas"> Ujian Akhir Semester </option>               
										</select>
									</div>
								</div>
								<br>
								<div class="uk-form-row">
									<button type="submit" value="Lihat" name="nilai_tampilkan" id="nilai_tampilkan" class="btn btn-success" title="Tampilkan Laporan" disabled><i class="uk-icon-search"></i> Lihat</button>
								</div>

							</div>
							
						</form>
						<?php } ?>
						<br>
						
						
						<form id="forminputnilai" method="POST" action="action.nilai?act=input" class="uk-form" enctype="multipart/form-data">
							<div class="uk-panel uk-panel-box uk-panel-box-secondary">
								<code><label>Masukan Nilai</label></code>
								<?php if (isset ($_POST["nilai_tampilkan"]) ) : ?>
									<div class="uk-form-row">
										<?php 
										
										$exe123  = mysql_query("SELECT * FROM mengajar,mapel,kelas 
											where mengajar.id_kelas=kelas.id_kelas 
											and mengajar.kd_mapel=mapel.kd_mapel 
											and mengajar.kd_mapel='$kd_mapel'
											and mengajar.id_kelas='$id_kelas'"); 
										$keterangane=mysql_fetch_array($exe123); 
										$sik=$_POST[komponen_nilai];
										if($sik=='uh1'){
											$namakomponen='Ulangan Harian 1';
											$rowtampilkomponen=$rows[uh1];
										}
										elseif ($sik=='uh2') {
											$rowtampilkomponen=$rows[uh2];
											$namakomponen='Ulangan Harian 2';
										}
										elseif ($sik=='uh3') {
											$rowtampilkomponen=$rows[uh3];
											$namakomponen='Ulangan Harian 3';
										}
										elseif ($sik=='uh4') {
											$rowtampilkomponen=$rows[uh4];
											$namakomponen='Ulangan Harian 4';
										}
										elseif ($sik=='uh5') {
											$rowtampilkomponen=$rows[uh5];
											$namakomponen='Ulangan Harian 5';
										}
										elseif ($sik=='uh6') {
											$rowtampilkomponen=$rows[uh6];
											$namakomponen='Ulangan Harian 6';
										}
										elseif ($sik=='uh7') {
											$rowtampilkomponen=$rows[uh7];
											$namakomponen='Ulangan Harian 7';
										}
										elseif($sik=='t1'){
											$rowtampilkomponen=$rows[t1];
											$namakomponen='Tugas 1';
										}
										elseif ($sik=='t2') {
											$rowtampilkomponen=$rows[t2];
											$namakomponen='Tugas 2';
										}
										elseif ($sik=='t3') {
											$rowtampilkomponen=$rows[t3];
											$namakomponen='Tugas 3';
										}
										elseif ($sik=='t4') {
											$rowtampilkomponen=$rows[t4];
											$namakomponen='Tugas 4';
										}
										elseif ($sik=='t5') {
											$rowtampilkomponen=$rows[t5];
											$namakomponen='Tugas 5';
										}
										elseif ($sik=='t6') {
											$rowtampilkomponen=$rows[t6];
											$namakomponen='Tugas 6';
										}
										elseif ($sik=='t7') {
											$rowtampilkomponen=$rows[t7];
											$namakomponen='Tugas 7';
										}
										elseif ($sik=='uts') {
											$rowtampilkomponen=$rows[uts];
											$namakomponen='Ujian Tengah Semester';
										}
										elseif ($sik=='uas') {
											$rowtampilkomponen=$rows[uas];
											$namakomponen='Ujian Akhir Semester';
										}
										elseif ($sik=='nilaiakhir') {
											$rowtampilkomponen=$rows[nilaiakhir];
											$namakomponen='Nilai Akhir';
										}

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
													<th><h3 class="uk-text-center" >NIS</h3></th>
													<th><h3 class="uk-text-center" >Nama Siswa</h3></th>

													<th><h3 class="uk-text-center" >Jenis Kelamin</h3></th>
													<th><h3 class="uk-text-center" >Nilai <?php echo $_POST['komponen_nilai'] ?></h3></th>



												</tr>
											</thead>
											<tbody>
												<?php 
												$no=0;
												$exes  = mysql_query("SELECT distinct * FROM ( SELECT distinct nilai.*, siswa.* FROM nilai, siswa, kelas_siswa, kelas, mengajar 
													where nilai.id_kelas_siswa=kelas_siswa.id_kelas_siswa
													and kelas_siswa.id_siswa=siswa.id_siswa  
													and mengajar.id_kelas=kelas_siswa.id_kelas  
													and nilai.id_tahun='$_SESSION[id_tahun]'
													and nilai.kd_mapel='$kd_mapel'
													and kelas_siswa.id_kelas='$id_kelas'
													and mengajar.id_guru='$id_guru'
													order by siswa.nm_siswa asc
													) 
												JSKDJS
												group by id_siswa order by nm_siswa asc
												");
												while($rows=mysql_fetch_array($exes)) { 

													$tugasakhir=($rows['t1']+$rows['t2']+$rows['t3']+$rows['t4']+$rows['t5']+$rows['t6']+$rows['t7'])/7;
													$uhakhir=($rows['uh1']+$rows['uh2']+$rows['uh3']+$rows['uh4']+$rows['uh5']+$rows['uh6']+$rows['uh7'])/7;
													$no++; ?>

													<tr>

														<td><div class="uk-text-center"><input type="hidden" name="id_nilai_input[]" value="<?php echo $rows[id_nilai]?>" ><?php echo $no?></div></td>
														<td><div class="uk-text-center"><input type="hidden" name="id_kelas_siswa_input[]" value="<?php echo $rows[id_kelas_siswa]?>" > <?php echo $rows[nis]?></div></td>
														<td><div class="uk-text-left"><?php echo ucwords( strtolower($rows[nm_siswa]))?></div></td>
														<td><div class="uk-text-center"><?php echo $rows[jns_kelamin]?></div></td>
														<td><div class="uk-text-center"><input type="text" id="<?php echo $sik ?>[]" name="<?php echo $sik ?>[]" value="<?php echo $rows[$sik]; ?>" onkeyup="convertAngka(this);"  class="uk-form-width-small"></div></td>

														<script type="text/javascript">
															function convertAngka(objek) {

																a = objek.value;
																b = a.replace(/[^\d]/g,"");

																objek.value = b;

															}            
														</script>
													</tr>
													<?php  } 

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
									<div class="uk-form-row">
										<div class="uk-alert">Pastikan semua isian sudah terisi dengan benar!</div>
									</div>
									<input type="hidden" name="id_kelas_input" value="<?php echo $id_kelas ?>">
									<input type="hidden" name="kd_mapel_input" value="<?php echo $kd_mapel ?>">
									<input type="hidden" name="id_tahun_input" value="<?php echo $_SESSION[id_tahun] ?>">
									<input type="hidden" name="sik" value="<?php echo $sik ?>">
									<div style="text-align:center" class="form-actions no-margin-bottom">
										<button type="submit" id="simpan_nilai" name="simpan_nilai" class="btn btn-success">Submit</button>
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
