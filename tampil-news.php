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
    			  <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="Sistem Informasi Akademik SDN II Manangga" title="Sistem Informasi Akademik SDN II Manangga">
    		  </div>

            <hr class="uk-article-divider">
            <h1 class="uk-article-title">Berita Hari Ini</h1> 
            <hr class="uk-article-divider">
            <br>
              <a class="uk-button uk-button-primary"  href="./dashboard" style="margin: 2; color: #FFF;">< Kembali</a>                   <?php
            include "config.php";
            include "./inc/tanggal.php";
          $id=$_GET['id'];
          $sql="select * from berita where id_berita={$id}";
          $result=mysql_query($sql);
          $row=mysql_fetch_array($result); 
$tgl=$row['tgl'];
$pukul=$row['pukul'];
          ?>
<br>
<br>

              <div class="uk-form-row">
                <article class="uk-article">
                
            <div class="uk-panel uk-panel-box">
              <div class="uk-overflow-container">
                <table>
                  <tbody>
                    <tr>
                    <h2 style="float:center;"><?php echo"{$row['judul_berita']}";?></h1>
                  <h7><span class="label label-default">Dirilis Pada Tanggal <?php 
echo TanggalIndo($tgl).' || Pukul ';
                  echo $pukul ?></span></h7>
                  </br></br>
                    <div class="col-xs-6 col-md-3">
                  <img class="thumbnail" src="<?php echo"gallery/news/{$row['gambar']}";?>" alt=""></div>
                    <td><?php echo "{$row['content']}";?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <br>
                      
                </article>
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
