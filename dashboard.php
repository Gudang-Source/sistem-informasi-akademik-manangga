<?php
session_start();
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(0, 1, 2, 10));

// TEMPLATE CONTROL
$ui_register_page = 'dashboard';

// LOAD HEADER
loadAssetsHead('Dashboard - Sistem Informasi Akademik SDN II Manangga');

// FORM PROCESSING
// ... code here ...
?>

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
						<img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="Sistem Informasi Akademik SDN II Manangga" title="Sistem Informasi Akademik SDN II Manangga">
					</div>

					<hr class="uk-article-divider">
					<h1 class="uk-article-title">Dashboard</h1>
					<br>


					<div class='uk-form-row'>
						<div class='uk-alert'>
							Selamat datang di Sistem Informasi Akademik.
						</div>
					</div>

					<div class="panel panel-info">
						<div class="panel-heading">Berita</div>
						<div class="panel-body">
							<table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
								<thead>
									<tr>


									</tr>
								</thead>
								<tbody>
									<?php if (isset($_SESSION['administrator'])) { ?>
									<a href="./berita.tambah" class="uk-button uk-button-success" type="button" title="Tambah Data Berita"><i class="uk-icon-plus"></i> Berita</a>
									<br>
									<br>

									<?php } ?>
									<?php
									include "config.php";
									include "./inc/tanggal.php";
									$sql="SELECT * FROM berita order by id_berita desc";            
									$result = mysql_query($sql);
              $num = mysql_num_rows($result); // menghitung jumlah record
                if($num>0){     // jika ditemukan record akan ditampilkan
                while($row = mysql_fetch_array($result)){   // perintah mysql_fetch_array untuk
                	$berapa=500;
                	$tgl=TanggalIndo($row['tgl']);
                	$pukul=$row['pukul'];
                	$artikel=substr($row['content'], 0, $berapa);
                	$jumlah=strlen($row['content']);?>
                	<?php echo"
                	<div class='uk-form-row'>
                		<article class='uk-article'>

                			<a href='./tampil-news?id={$row['id_berita']}'><h1 class='uk-article'>{$row['judul_berita']}</h1></a>
                			<span class='uk-text-success'>Dirilis Pada Tanggal {$tgl} || Pukul 
                				{$pukul}  </span>
                			</br></br>
                			<img style='width:120px; float:left; margin:0px; margin-right: 8px;' src='gallery/news/{$row['gambar']}' alt=''>  $artikel ";?>
                			<?php if($jumlah>600){ echo"
                			<a class='uk-button uk-button-primary'  href='./tampil-news?id={$row['id_berita']}' style='margin: 2; float: right; color: #FFF;'><i class='uk-icon-search'></i> Lihat</a>";?>
                			<?php if(isset($_SESSION['administrator'])){ echo"
                			<a class='uk-button uk-button-primary'  href='./berita.update?id={$row['id_berita']}' style='margin: 2; float: right; color: #FFF;'><i class='uk-icon-pencil'></i> Edit</a>";}?>
                			<?php if(isset($_SESSION['administrator'])){?>
                			<a class="uk-button uk-button-primary"  href="./berita.hapus?id=<?php echo "{$row['id_berita']}";?>&file=<?php echo $row['gambar'];?>" onclick="return : confirm("Apakah anda yakin akan menghapus berita ini?")"; style="margin: 2; float: right; color: #FFF;"><i class="uk-icon-remove"></i> Hapus</a><?php }?> 
                		</article>
                	</div>
                	<?php
                }
            }         }
            else{
            	echo "Tidak ada record";
            }
            ?>
        </article>
    </tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</body>

<?php
// ADDITIONAL SCRIPTS
$scripts = <<<'JS'
<script>
</script>

JS;

// LOAD FOOTER
loadAssetsFoot($scripts);

ob_end_flush();
?>