<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1));

// TEMPLATE CONTROL
$ui_register_page = 'nilai';

// LOAD HEADER
loadAssetsHead('Nilai');


if (isset ($_POST["lap_tampilkan"]) ){ 

  $dkelas       = $_POST['dkelas'];
  $lap_bulan       = $_POST['lap_bulan'];
  $lap_tahun       = $_POST['lap_tahun'];
  
  $query = "SELECT
          ruang.nama,
          inspeksi.id_inspeksi,
          barang.nama,
          barang.merek,
          barang.jumlah,
          barang.satuan_jmlh,
          inspeksi.kondisi,
          inspeksi.tgl_inspeksi
          FROM
          barang
          INNER JOIN inspeksi ON inspeksi.id_barang = barang.id_barang
          INNER JOIN ruang ON barang.id_ruang = ruang.id_ruang
          WHERE inspeksi.tgl_inspeksi LIKE '$lap_tahun-$lap_bulan-%' and ruang.id_ruang = '$dkelas' ";
}


?>

 <script type="text/javascript">
      	var htmlobjek;
      	$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=dkelas>
  $("#dkelas").change(function(){
  	var dkelas = $("#dkelas").val();
  	$.ajax({
  		url: "inc/jikuk_mapel.php",
  		data: "dkelas="+dkelas,
  		cache: false,
  		success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=dmapel>
            $("#dmapel").html(msg);
        }
    });
  });
  $("#dmapel").change(function(){
  	var dmapel = $("#dmapel").val();
  	$.ajax({
  		url: "inc/jikuk_semester.php",
  		data: "dmapel="+dmapel,
  		cache: false,
  		success: function(msg){
  			$("#jkuk_semester").html(msg);
  		}
  	});
  });


  $("#id_kec").change(function(){
  	var id_kec = $("#id_kec").val();
  	$.ajax({
  		url: "inc/jikuk_kelurahan.php",
  		data: "id_kec="+id_kec,
  		cache: false,
  		success: function(msg){
  			$("#id_kel").html(msg);
  		}
  	});
  });
});

      </script>
<link rel="stylesheet" href="assets/tablesorter/style.css" />

<body>

  <?php
  // LOAD MAIN MENU
  loadMainMenu();
  ?>

   <div class="uk-container uk-container-center uk-margin-large-top">
    <div class="uk-grid" data-uk-grid-margin data-uk-grid-match>
      <div class="uk-width-medium-1-6 uk-hidden-small">
        <?php loadSidebar() ?>
      </div>
      <div class="uk-width-medium-5-6 tm-article-side">
        <article class="uk-article">
    		  <div class="uk-vertical-align uk-text-right uk-height-1-1">
    			  <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="SI Inventaris" title="SI Inventaris">
    		  </div>
    		  <hr class="uk-article-divider">
          <h1 class="uk-article-title">Laporan <span class="uk-text-large">{ Manajemen }</span></h1>
          <br>
          <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-1">
              <form class="uk-form uk-form-stacked" method="POST" >
                <div class="uk-form-row">
                  <div class="uk-progress uk-progress-mini uk-progress-primary uk-progress-striped uk-active">
                    <div class="uk-progress-bar" id="lap_progress" style="width: 0%;"></div>
                  </div>
                </div>
                
                <div class="uk-form-row">
                  <label class="uk-form-label" for="">Pilih Ruang<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls">
                    <select name="dkelas" id="dkelas" class="" data-uk-tooltip="{pos:'bottom-left'}" title="Ruang inspeksi" required>                 
                     <option value="">--- Pilih Ruangan ---</option>
                     <?php 
                      $query_ruang = mysql_query("select * from ruang");
                      while ($pilih_ruang = mysql_fetch_array($query_ruang)) { 
                       echo "<option value=$pilih_ruang[0]> $pilih_ruang[1] </option>";
                      } 
                     ?>
                    </select>
                 </div>
				</div>
				<div class="uk-form-row">
                  <label class="uk-form-label" for="">Pilih Mata Pelajaran<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls">
                    <select name="dmapel" id="dmapel" class="" data-uk-tooltip="{pos:'bottom-left'}" title="Mata Pelajaran" required>                 
                     <option value="">--- Pilih Mata Pelajaran ---</option>
                     
                    </select>
                 </div>
				</div>
                <div class="uk-form-row">
                  <label class="uk-form-label" for="">Pilih Waktu Pelaporan<span class="uk-text-danger">*</span></label>
                  <div class="uk-form-controls">
                    <select name="lap_bulan" id="lap_bulan" class="" data-uk-tooltip="{pos:'bottom-left'}" title="Bulan inspeksi" required>                 
                     <option value="">---Bulan---</option>
                     <option value="%%">Semua Bulan</option>
                     <option value="01">Januari</option>
                     <option value="02">Februari</option>
                     <option value="03">Maret</option>
                     <option value="04">April</option>
                     <option value="05">Mei</option>
                     <option value="06">Juni</option>
                     <option value="07">Juli</option>
                     <option value="08">Agustus</option>
                     <option value="09">September</option>
                     <option value="10">Oktober</option>
                     <option value="11">November</option>
                     <option value="12">Desember</option>
                    </select>
                    <select name="lap_tahun" id="lap_tahun" class="" data-uk-tooltip="{pos:'bottom-left'}" title="Tahun inspeksi" required>
                     <option value="">---Tahun---</option>
                     <option value="20%%">Semua Tahun</option>
                     <option value="2010">2010</option>
                     <option value="2011">2011</option>
                     <option value="2012">2012</option>
                     <option value="2013">2013</option>
                     <option value="2014">2014</option>
                     <option value="2015">2015</option>
                     <option value="2016">2016</option>
                     <option value="2017">2017</option>
                     <option value="2018">2018</option>
                   </select>
                 </div>
                </div>
                <div class="uk-form-row">
                  <button type="submit" value="Tampilkan Laporan" name="lap_tampilkan" id="lap_tampilkan" class="uk-button uk-button-success" title="Tampilkan Laporan" disabled><i class="uk-icon-search"></i> Tampilkan Laporan</button>
                </div>
                <br><br>

                <?php if (isset ($_POST["lap_tampilkan"]) ) : ?>
        				<div class="uk-form-row">
        					<?php $exe  = mysql_query($query); 
        						$ruang=mysql_fetch_array($exe); ?>
        					<label class="uk-form-label">Laporan Ruang : <span class="uk-text-success"><?php echo $ruang[0];?></span></label>
        					<label class="uk-form-label">Waktu Laporan : <span class="uk-text-success"><?php if($lap_bulan=='%%'){
        																								echo ' Semua Bulan, ';
        																							}
        																							else if($lap_bulan=='01'){
        																								echo ' Januari, ';
        																							}
        																							else if($lap_bulan=='02'){
        																								echo ' Februari, ';
        																							}
        																							else if($lap_bulan=='03'){
        																								echo ' Maret, ';
        																							}
        																							else if($lap_bulan=='04'){
        																								echo ' April, ';
        																							}
        																							else if($lap_bulan=='05'){
        																								echo ' Mei, ';
        																							}
        																							else if($lap_bulan=='06'){
        																								echo ' Juni, ';
        																							}
        																							else if($lap_bulan=='07'){
        																								echo ' Juli, ';
        																							}
        																							else if($lap_bulan=='08'){
        																								echo ' Agustus, ';
        																							}
        																							else if($lap_bulan=='09'){
        																								echo ' September, ';
        																							}
        																							else if($lap_bulan=='10'){
        																								echo ' Oktober, ';
        																							}
        																							else if($lap_bulan=='11'){
        																								echo ' November, ';
        																							}
        																							else if($lap_bulan=='12'){
        																								echo ' Desember, ';
        																							}																					
        																							?>
                                            					<?php
                                                      if($lap_tahun=='20%%'){
                              													echo ' Semua Tahun';
                              											   }
                              											   else{
                              												  echo $lap_tahun;
                              											  }
                              												?></span></label>
        				</div>
              </form>
			  
        		
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
        								<th><h3 class="uk-text-center">ID</h3></th>
        								<th><h3 class="uk-text-center">Nama</h3></th>
        								<th><h3 class="uk-text-center">Merek</h3></th>
        								<th><h3 class="uk-text-center">Jumlah</h3></th>
        								<th><h3 class="uk-text-center">Keterangan</h3></th>
        								<th><h3 class="uk-text-center">Waktu Inspeksi</h3></th>
        							</tr>
        						</thead>
                    <tbody>
                      <?php 
                      $exe  = mysql_query($query);
                      while($row=mysql_fetch_array($exe)) { ?>
                      <tr>
                        <td><div class="uk-text-center"><?php echo $row[1]?></div></td>
                        <td><?php echo $row[2]?></td>
                        <td><?php echo $row[3]?></td>
                        <td><?php echo $row[4].' '.$row[5]?></td>
                        <td><div class="uk-text-center"><?php echo $row[6]?></div></td>
                        <td><div class="uk-text-center"><?php echo date ("d-m-Y",strtotime($row[7]))?></div></td>
                      </tr>
                      <?php } ?>
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

              <hr class="uk-article-divider">
              <form class="uk-form uk-margin-top" method="post">
                <div class="uk-form-row">
                  <button type="submit" id="tombolExport" value="Cetak Laporan" name="lap_cetak" class="uk-button uk-button-primary" title="Cetak Laporan"><i class="uk-icon-print"></i> Cetak Laporan</button>
                </div>
              </form>
            <?php endif; ?>
            </div>
          </div>
        </article>
      </div>
    </div>
  </div><br><br><br>
  
  	<div style="display: none;">
        					<table border="0" id="exportTable">
        						<thead>
									<tr>
										<td colspan="6"><h2>Laporan Ruang:&nbsp;<?php echo $ruang[0];?></h2></td>
									</tr>
									<tr>
										<td colspan="6"><h2>Waktu Laporan:&nbsp;<?php if($lap_bulan=='%%'){
        																								echo ' Semua Bulan, ';
        																							}
        																							else if($lap_bulan=='01'){
        																								echo ' Januari, ';
        																							}
        																							else if($lap_bulan=='02'){
        																								echo ' Februari, ';
        																							}
        																							else if($lap_bulan=='03'){
        																								echo ' Maret, ';
        																							}
        																							else if($lap_bulan=='04'){
        																								echo ' April, ';
        																							}
        																							else if($lap_bulan=='05'){
        																								echo ' Mei, ';
        																							}
        																							else if($lap_bulan=='06'){
        																								echo ' Juni, ';
        																							}
        																							else if($lap_bulan=='07'){
        																								echo ' Juli, ';
        																							}
        																							else if($lap_bulan=='08'){
        																								echo ' Agustus, ';
        																							}
        																							else if($lap_bulan=='09'){
        																								echo ' September, ';
        																							}
        																							else if($lap_bulan=='10'){
        																								echo ' Oktober, ';
        																							}
        																							else if($lap_bulan=='11'){
        																								echo ' November, ';
        																							}
        																							else if($lap_bulan=='12'){
        																								echo ' Desember, ';
        																							}																					
        																							?>
                                            					<?php
																	if($lap_tahun=='20%%'){
                              													echo ' Semua Tahun';
                              											   }
                              											   else{
                              												  echo $lap_tahun;
                              											  }
                              									?>
												</h2>
										</td>
									</tr>
									<tr>
										<td>
										</td>
									</tr>
        							<tr>
        								<th><h3>ID</h3></th>
        								<th><h3>Nama</h3></th>
        								<th><h3>Merek</h3></th>
        								<th><h3>Jumlah</h3></th>
        								<th><h3>Keterangan</h3></th>
        								<th><h3>Waktu Inspeksi</h3></th>
        							</tr>
        						</thead>
								<tbody>
								  <?php 
								  $exe  = mysql_query($query);
								  while($row=mysql_fetch_array($exe)) { ?>
								  <tr>
									<td><?php echo $row[1]?></td>
									<td><?php echo $row[2]?></td>
									<td><?php echo $row[3]?></td>
									<td><?php echo $row[4].' '.$row[5]?></td>
									<td><?php echo $row[6]?></td>
									<td><?php echo date ("d-m-Y",strtotime($row[7]))?></td>
								  </tr>
								  <?php } ?>
								  <tr>
									<td></td>
								  </tr>
								  <tr>
									<td></td>
								  </tr>
								  <tr>
										<td colspan="6">Dicetak pada:
											<script type='text/javascript'>
												var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
												var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
												var date = new Date();
												var day = date.getDate();
												var month = date.getMonth();
												var thisDay = date.getDay(),
												thisDay = myDays[thisDay];
												var yy = date.getYear();
												var year = (yy < 1000) ? yy + 1900 : yy;
												document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
											</script>
											| Pukul: 
											<span id="clock">  </span> <!-- Show Clock -->
													
											<!--Javascript CLOCK-->
											<script type="text/javascript">
												function startTime() {
													var today=new Date(),
													curr_hour=today.getHours(),
													curr_min=today.getMinutes(),
													curr_sec=today.getSeconds();
													curr_hour=checkTime(curr_hour);
													curr_min=checkTime(curr_min);
													curr_sec=checkTime(curr_sec);
													document.getElementById('clock').innerHTML=curr_hour+":"+curr_min+":"+curr_sec;
												}
												function checkTime(i) {
													if (i<10) {
														i="0" + i;
													}
													return i;
												}
												setInterval(startTime, 500);
											</script>
										</td>
									</tr>
								</tbody>
							</table>
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
			size:10,
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
			sum:[3],
			columns:[{index:3, format:' unit', decimals:1}],
			init:true
		});
	</script>
	<!-- END Table Sorter Script -->



</body>
<?php
// ADDITIONAL SCRIPTS
$scripts = <<<'JS'
<script>
$(document).ready(function (){
  // FORM SUBMIT and PROGRESS BAR CONTROL
  $('#lap_bulan').on('change', function(){
    validate();
    progress();
  });

  $('#lap_tahun').on('change', function(){
    validate();
    progress();
  });

  //download excel


});
  

function validate(){
  if (
    $('#lap_bulan').val() != '' &&
    $('#lap_tahun').val() != ''
    ) {

    $('#lap_tampilkan').prop('disabled', false);
  }
  else {
    $('#lap_tampilkan').prop('disabled', true);
  }
}

function progress(){
  var w1 = ($('#lap_bulan').val() != '') ? 50 : 0;
  var w2 = ($('#lap_tahun').val() != '') ? 50 : 0;
  wt = w1 + w2;
  $('#lap_progress').css('width', wt+'%');
}




</script>

JS;

// LOAD FOOTER


?>

<script type="text/javascript" src="assets/exExcel/jquery.base64.js"></script>
<script type="text/javascript" src="assets/exExcel/jquery.btechco.excelexport.js"></script>
<script type="text/javascript">
            $(document).ready(function () {
                $("#tombolExport").click(function () {
                    $("#exportTable").btechco_excelexport({
                        containerid: "exportTable"
                       , datatype: $datatype.Table
                    });
                });
            });
  </script>
<?php
// LOAD FOOTER
loadAssetsFoot();

ob_end_flush();
?>
