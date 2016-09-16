<?php
session_start();
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(0, 1, 2, 10));

// TEMPLATE CONTROL
$ui_register_page = 'dashboard';

// LOAD HEADER
loadAssetsHead('Dashboard - E-Learning SMKN 4 Klaten');

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
    			  <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="E-Learning SMK N 4 Klaten" title="E-Learning SMK N 4 Klaten">
    		  </div>

            <hr class="uk-article-divider">
            <h1 class="uk-article-title">Dashboard</h1>
          <br>


              <div class='uk-form-row'>
                <div class='uk-alert'>
                Selamat datang di E-Learning.
                </div>
              </div>

              <div class="panel panel-info">
          <div class="panel-heading">Pengumuman</div>
          <div class="panel-body">
<table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead>
              <tr>


              </tr>
            </thead>
              <tbody>
              <?php

              $nip="SELECT
pengumuman.kd_pengumuman,
pengumuman.nip,
pengumuman.judul_pengumuman,
pengumuman.isi,
pengumuman.tanggal,
guru.nm_guru
FROM
pengumuman
INNER JOIN guru ON pengumuman.nip = guru.nip";
            $lihat=mysql_query($nip);
            $no=0;
            while ($data=mysql_fetch_array($lihat)) { $no++;

            
                ?>

                <div class="col-md-4 col-sm-4 col-xs-4"><strong>Pengumuman dari:</strong> <?php echo $data['nm_guru']?></div></br>
                <div class="col-md-4 col-sm-4 col-xs-4"><strong>Judul: </strong><?php echo $data['judul_pengumuman']?></div></br>
                <div class="col-md-4 col-sm-4 col-xs-4"><strong>Isi: </strong><?php echo $data['isi']?></div>
                </br></br></br>
              
                <?php } ?>            
                </tr>
            
              </tbody>
          </table>

 
                
          </div>
              </div>

		    </article>
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
