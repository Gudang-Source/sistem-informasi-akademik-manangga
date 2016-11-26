<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(0,1,2,10));

// TEMPLATE CONTROL
$ui_register_page = 'mapel';

// LOAD HEADER
loadAssetsHead('Master Data Mata Pelajaran');

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
						<img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="" title="">
					</div>

					<hr class="uk-article-divider">
					<h1 class="uk-article-title">Mata Pelajaran <span class="uk-text-large">
						<?php  if (isset($_SESSION['administrator'])) {?>
						{ Master Data }</span></h1>
						<?php  }?>
						<br>
						<?php if (isset($_SESSION['administrator'])) { ?>
           	 <button  data-uk-modal="{target:'#modaltambah'}" class="uk-button uk-button-success" type="button" title="Tambah Data Mata Pelajaran"><i class="uk-icon-plus"></i> Mata Pelajaran</button>
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
							<table id="table" class="uk-table uk-table-hover uk-table-striped uk-table-condensed" width="100%" width="100%">
								<thead>
									<tr>
										<th><h3 class="uk-text-center">No</h3></th>

										<th><h3 class="uk-text-center" >Nama Mata Pelajaran</h3></th>
										<th><h3 class="uk-text-center" >Kriteria Kelulusan Minimal</h3></th>
										<?php if (isset($_SESSION['administrator'])) { ?>
										<th><h3 class="uk-text-center">Aksi</h3></th>
										<?php }?>
									</tr>
								</thead>
								<tbody>

								<div id="modaltambah" class="uk-modal">
											<div class="uk-modal-dialog">
												<button type="button" class="uk-modal-close uk-close"></button>
												<div class="uk-modal-header">
													<h2>Tambah Data Mata Pelajaran</h2>
												</div>
												  <form role="form" id="formmapel" action="mapel.action?act=tambah" enctype="multipart/form-data" method="POST" >
													<div class="form-group">
														<label>Kode Mata Pelajaran</label>
														<input class="form-control" name="kd_mapel" id="kd_mapel" value=""   required  />
														
													</div>

													<div class="form-group">
														<label>Nama Mata Pelajaran</label>
														<input class="form-control" name="nm_mapel" id="nm_mapel" value=""  required />
      														<div class="reg-info">Contoh: Bahasa Sunda</div>
													</div>

													<div class="form-group">
														<label>KKM Mata Pelajaran</label>
														<input class="form-control" name="kkm"  id="kkm" value="" required  />
    														<div class="reg-info">Contoh: 65</div>
													</div>

													<div class="uk-modal-footer uk-text-right">
														<button type="button" class="uk-button uk-modal-close ">Cancel</button>
														<button type="submit" class="uk-button uk-button-primary">Save</button>
													</div>
													<input type="hidden" name="tambah" value="tambah">
												</form>

											</div>
										</div>

									<?php 

									$query="SELECT * FROM mapel order by nm_mapel asc";
									$exe=mysql_query($query);
									$no=0;
									while ($row=mysql_fetch_array($exe)) { $no++;

										$kd_mapel=$row['kd_mapel'];
										?>



										<div id="modal<?php echo $kd_mapel ;?>" class="uk-modal">
											<div class="uk-modal-dialog">
												<button type="button" class="uk-modal-close uk-close"></button>
												<div class="uk-modal-header">
													<h2>Lihat Data Mata Pelajaran</h2>
												</div>
												
													<div class="form-group">
														<label>Kode Mata Pelajaran</label>
														<input class="form-control" name="kd_mapel" id="kd_mapel" value="<?php echo $row['kd_mapel']; ?>" readonly  required  />
														
													</div>

													<div class="form-group">
														<label>Nama Mata Pelajaran</label>
														<input class="form-control" name="nm_mapel" id="nm_mapel" value="<?php echo $row['nm_mapel']; ?>" readonly required />
													</div>

													<div class="form-group">
														<label>KKM Mata Pelajaran</label>
														<input class="form-control" name="kkm"  id="kkm" value="<?php echo $row['kkm']; ?>" readonly required  />
													</div>

													<div class="uk-modal-footer uk-text-right">
														<button type="button" class="uk-button uk-modal-close ">Cancel</button>
														<button data-uk-modal="{target:'#modaledit<?php echo $kd_mapel ;?>'}" class="uk-button uk-button-primary">Edit</button>
													</div>
													
										
											</div>
										</div>

										<div id="modaledit<?php echo $kd_mapel ;?>" class="uk-modal">
											<div class="uk-modal-dialog">
												<button type="button" class="uk-modal-close uk-close"></button>
												<div class="uk-modal-header">
													<h2>Edit Data Mata Pelajaran</h2>
												</div>
												<form role="form" method="post" action="mapel.action?act=update&&kd_mapel=<?php echo $kd_mapel;  ?>" enctype="multipart/form-data" >
													<div class="form-group">
														<label>Kode Mata Pelajaran</label>
														<input class="form-control" name="kd_mapel" id="kd_mapel" value="<?php echo $row['kd_mapel']; ?>"   required  />
														
													</div>

													<div class="form-group">
														<label>Nama Mata Pelajaran</label>
														<input class="form-control" name="nm_mapel" id="nm_mapel" value="<?php echo $row['nm_mapel']; ?>"  required />
      														<div class="reg-info">Contoh: Bahasa Sunda</div>
													</div>

													<div class="form-group">
														<label>KKM Mata Pelajaran</label>
														<input class="form-control" name="kkm"  id="kkm" value="<?php echo $row['kkm']; ?>"  required  />
    														<div class="reg-info">Contoh: 65</div>
													</div>

													<div class="uk-modal-footer uk-text-right">
														<button type="button" class="uk-button uk-modal-close ">Cancel</button>
														<button type="submit" class="uk-button uk-button-primary">Save</button>
													</div>
													<input type="hidden" name="edit" value="edit">
												</form>

											</div>
										</div>


										

										<tr>
											<td><div class="uk-text-center"><?php echo $no?></div></td>

											<td><div class="uk-text-center"><?php echo $row[nm_mapel]?></div></td>
											<td><div class="uk-text-center"><?php echo $row[kkm]?></div></td>
											<?php if (isset($_SESSION['administrator'])) { ?>
											<td><div class="uk-text-center">
												<button class="uk-button" data-uk-modal="{target:'#modal<?php echo $kd_mapel ;?>'}"><i class="uk-icon-search"></i></button>
												<button class="uk-button" data-uk-modal="{target:'#modaledit<?php echo $kd_mapel ;?>'}"><i class="uk-icon-pencil"></i></button>
												<a href="mapel.action?act=hapus&&kd_mapel=<?php echo $kd_mapel; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" title="Hapus" data-uk-tooltip="{pos:'top-left'}" class="uk-button uk-button-small uk-button-danger"><i class="uk-icon-remove"></i></a>

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

<script src="assets/validator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/vendor/formvalidation/css/formValidation.min.css">
<link rel="stylesheet" href="/asset/css/demo.css">
<script src="/vendor/formvalidation/js/formValidation.min.js"></script>
<script src="/vendor/formvalidation/js/framework/uikit.min.js"></script>

<script type="text/javascript">
 var modaltambah = $("#modaltambah").serialize();
 var validator = $("#modaltambah").bootstrapValidator({
  framework: 'bootstrap',
  feedbackIcons: {
    valid: "glyphicon glyphicon-ok",
    invalid: "glyphicon glyphicon-remove", 
    validating: "glyphicon glyphicon-refresh"
  }, 
  excluded: [':disabled'],
  fields : {
    kd_mapel : {
     validators: {
      notEmpty: {
       message: 'Harus Pilih Mata Pelajaran'
     },
     remote: {
      type: 'POST',
      url: 'remote/remote_mapel.php',
      message: 'Nama Mata Pelajaran Telah Tersedia'
    },
   }
 }, 
nm_mapel: {
  message: 'Nama Mata Pelajaran Tidak Benar',
  validators: {
    notEmpty: {
      message: 'Nama Mata Pelajaran Harus Diisi'
    },
    stringLength: {
      min: 1,
      max: 30,
      message: 'Nama Mata Pelajaran Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
    },
    regexp: {
      regexp: /^[a-zA-Z0-9_ \. ]+$/,
      message: 'Karakter Boleh Digunakan (Angka, Huruf, Titik, Underscore)'
    },
    remote: {
      type: 'POST',
      url: 'remote/remote_namamapel.php',
      message: 'Nama Mata Pelajaran Telah Tersedia'
    },
kkm: {
  message: 'Isian KKM Tidak Benar',
  validators: {
    notEmpty: {
      message: 'Isian KKM Harus Diisi'
    },
    stringLength: {
      min: 1,
      max: 30,
      message: 'Isian KKM Harus Lebih dari 1 Huruf dan Maksimal 30 Huruf'
    },
    regexp: {
      regexp: /^[a-zA-Z0-9_ \. ]+$/,
      message: 'Karakter Boleh Digunakan (Angka, Huruf, Titik, Underscore)'
    },

  }
}

  }
}

}
});
</script>




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
