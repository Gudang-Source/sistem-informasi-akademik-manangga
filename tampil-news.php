<?php
session_start();
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(0, 1, 2, 10));

// TEMPLATE CONTROL
$ui_register_page = 'dashboard';

// LOAD HEADER
loadAssetsHead('Dashboard');

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
    			  <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="Sistem Informasi Akademik SMAN 2 Playen" title="Sistem Informasi Akademik SMAN 2 Playen">
    		  </div>

            <hr class="uk-article-divider">
            <h1 class="uk-article-title">Dashboard</h1> 
            <br>
            <?php
            include "config.php";
          $id=$_GET['id'];
          $sql="select * from berita where id_berita={$id}";
          $result=mysql_query($sql);
          $row=mysql_fetch_array($result); ?>
              <div class="uk-form-row">
                <div class="uk-alert">
                <h2><code><?php echo"{$row['judul_berita']}";?></code></h2>
                  <span class="uk-text-success">Jum'at, 12 September 2014 18:51:45 WIB</span><br><br><img style="width:500px; float:left; margin:0px; margin-right: 8px;" src="<?php echo"gallery/news/{$row['gambar']}";?>" alt=""><?php echo "{$row['keterangan']}";?>
                   <a class="uk-button uk-button-primary"  href="./dashboard" style="margin: 2; float: right; color: #FFF;">Kembali</a>            
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
