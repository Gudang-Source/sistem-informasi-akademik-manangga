<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(0,1, 10));

// TEMPLATE CONTROL
$ui_register_page = 'siswa-profilsekolah';

// LOAD HEADER
loadAssetsHead('Profil Sekolah');

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
			  <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="Sistem Informasi Akademik SD N II Manangga" title="Sistem Informasi Akademik SD N II Manangga">
		  </div>
		  
		  <hr class="uk-article-divider">
          <h1 class="uk-article-title">Profil Sekolah <span class="uk-text-large">
		  { SD Negeri II Manangga }</span></h1>
          <br>
		   <br><br>
		  
					<div class="panel panel-info">
					<div class="panel-heading">Profil Sekolah</div>
					<div class="panel-body">

					<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4"><strong>NPSN</strong></div>
					<div class="col-md-7 col-sm-7 col-xs-7">
					<div class="npsn">: 0</div></div>
					</div>

					<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4">
					<strong>Status Sekolah</strong></div>
					<div class="col-md-7 col-sm-7 col-xs-7">
					<div class="status-sekolah">: Negeri</div></div></div>

					<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4"><strong>Bentuk Pendidikan</strong></div>
					<div class="col-md-7 col-sm-7 col-xs-7">
					<div class="bentuk-pendidikan">: Sekolah Dasar (SD))</div></div></div>

					<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4">
					<strong>Alamat</strong></div>
					<div class="col-md-7 col-sm-7 col-xs-7">
					<div>: Rancageneng</div></div></div>

					<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4">
					<strong>Dusun</strong></div>
					<div class="col-md-7 col-sm-7 col-xs-7">
					<div class="dusun">: Rancageneng</div></div></div>

					<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4"><strong>Desa / Kelurahan</strong></div>
					<div class="col-md-7 col-sm-7 col-xs-7">
					<div class="desa">: Sukajaya</div></div></div>

					<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4"><strong>Kecamatan</strong></div>
					<div class="col-md-7 col-sm-7 col-xs-7">
					<div class="kecamatan">: Bungursari </div></div></div>

					<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4"><strong>Kabupaten</strong></div>
					<div class="col-md-7 col-sm-7 col-xs-7">
					<div class="kabupaten">: Kota Tasikmalaya</div></div></div>

					<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4"><strong>Propinsi</strong></div>
					<div class="col-md-7 col-sm-7 col-xs-7">
					<div class="propinsi">: Prop. Jawa Barat</div></div></div>

					<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4"><strong>Kode Pos</strong></div>
					<div class="col-md-7 col-sm-7 col-xs-7">
					<div class="kode-pos">: -</div></div></div>

					<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4"><strong>Email</strong></div>
					<div class="col-md-7 col-sm-7 col-xs-6">
					<div class="email">: sdnmanangga2@yahoo.co.id</div></div></div>

					<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4"><strong>Website</strong></div>
					<div class="col-md-7 col-sm-7 col-xs-6">
					<div class="website"><a href="http://smkn4klaten.sch.id" target="_blank">: -</a></div></div></div></div></div>
				  
              		<div class="panel panel-info">
					<div class="panel-heading">Dokumen dan Perijinan</div>
					<div class="panel-body">

					<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4"><strong>SK Pendirian Sekolah</strong></div>
					<div class="col-md-7 col-sm-7 col-xs-7">
					<div>: -</div></div>
					</div>

					<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4"><strong>Tanggal SK Pendirian</strong></div>
					<div class="col-md-7 col-sm-7 col-xs-7">
					<div>: -</div></div>
					</div>

					<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4"><strong>Status Kepemilikan</strong></div>
					<div class="col-md-7 col-sm-7 col-xs-7">
					<div>: Pemerintah Daerah</div></div>
					</div>

					<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4"><strong>SK Izin Operasional</strong></div>
					<div class="col-md-7 col-sm-7 col-xs-7">
					<div>: -</div></div>
					</div>

					<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-4"><strong>Tanggal SK Izin Operasional</strong></div>
					<div class="col-md-7 col-sm-7 col-xs-7">
					<div>: -</div></div>
					</div>

					</div></div>	
					<div class="panel panel-info">
					<div class="panel-heading">Lokasi Sekolah</div>
					<div class="panel-body">
					<iframe src="https://www.google.com/maps/embed?pb=!1m21!1m12!1m3!1d63318.19109432808!2d108.13944394226712!3d-7.310353614222741!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m6!3e4!4m3!3m2!1d-7.3115!2d108.1725!4m0!5e0!3m2!1sen!2sid!4v1474775852963" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div></div>	
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
