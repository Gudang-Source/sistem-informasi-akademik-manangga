<!-- user login -->
<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1,10,24));

// TEMPLATE CONTROL
$ui_register_page     = 'info-pribadi-guru.account';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Konfigurasi Akun Guru');

//LOAD DATA

    # MEMBUAT NILAI DATA PADA FORM
    # SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)

if (isset($_POST['account_simpan'])) {

  #baca variabel
  $nip          = $_POST['nip'];
  $password     = $_POST['password'];
  $password1  = $_POST['password1'];
 
  #validasi form kosong
   
      if (empty($file_sik_dipilih)){
        $query = mysql_query("UPDATE guru 
          SET nip='$nip', 
          password='$password'") or die(mysql_error());
         $edit = mysql_query("SELECT * FROM guru WHERE id_guru='$_SESSION[id_guru]'");
            $rowks  = mysql_fetch_array($edit);

 
      }

  #jika ada pesan error validasi form
      if (count($pesanError)>=1) {
        echo "
        <div class='alert alert-danger alert-dismissable'>
          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
          $noPesan= 0;
          foreach ($pesanError as $indeks => $pesan_tampil) {
            $noPesan++;
            echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
          }
          echo "</div><br />";
        }

        else{

            $query = mysql_query("UPDATE guru 
              SET nip='$nip', 
              password='$password'
              WHERE id_guru='$_SESSION[id_guru]'") or die(mysql_error());

            $edit = mysql_query("SELECT * FROM guru WHERE id_guru='$_SESSION[id_guru]'");
            $rowks  = mysql_fetch_array($edit);

          }
          if ($query){
            header('location: ./info-pribadi-guru');
          }
          else { $error = "Uploaded image should be jpg or gif or png"; } 

        }
  
  #update data ke database

# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
              $datapassword  = isset($_POST['password']) ? $_POST['password'] : '';

      $edit = mysql_query("SELECT * FROM guru WHERE id_guru='$_SESSION[id_guru]'");
      $rowks  = mysql_fetch_array($edit);

      ?>

      
      <body>

        <?php
  // LOAD MAIN MENU
        loadMainMenu();
        ?>

        <!-- page content -->
        <div class="uk-container uk-container-center uk-margin-large-top">
          <div class="uk-grid" data-uk-grid-margin data-uk-grid-match>
            <div class="uk-width-medium-1-6 uk-hidden-small">
              <?php loadSidebar() ?>
            </div>
            <div class="uk-width-medium-5-6 tm-article-side">
              <article class="uk-article">
                <div class="uk-vertical-align uk-text-right uk-height-1-1">
                  <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="Sistem Informasi Akademik SD N II Manangga" title="Sistem Informasi Akademik SD N II Manangga">
                </div>
                <hr class="uk-article-divider">
                <h1 class="uk-article-title"> <?php echo ucwords( strtolower($rowks[nm_guru])); ?> <span class="uk-text-large">{ Konfigurasi Akun Guru }</span></h1>
                <br>

                <!-- <hr class="uk-article-divider"> -->
                   <form id="formakun" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
    <div class="alert alert-info" role="alert" id="removeWarning">
      <span class="glyphicon " aria-hidden="true"></span>
      <span class="sr-only"></span>
      Data Account - Ubah Password
    </div>
    <div class="item form-group">
       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nip">Username <span class="required">*</span>
       </label>
       <div class="col-md-6 col-sm-6 col-xs-12">
        <input readonly="readonly" type="text" id="nip" name="nip" required value="<?php echo $rowks['nip'] ?>"  class="form-control col-md-7 col-xs-12">
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="passwordlama">Password Lama<span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input readonly="readonly" type="text" id="passwordlama" name="passwordlama" required value="<?php echo $rowks['password'] ?>"   class="form-control col-md-7 col-xs-12">
      </div>
    </div>
                           <div class="item form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password Baru<span class="required">*</span>
                           </label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="password" name="password" value="<?php echo $datapassword; ?>" required="required" class="form-control col-md-7 col-xs-12">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password1">Konfirmasi Password Baru<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="password1" name="password1" value="<?php echo $datapassword; ?>" required="required" class="form-control col-md-7 col-xs-12">
                          </div>
                        </div>

    
    <div style="text-align:center" class="form-actions no-margin-bottom">
     <button type="submit" id="account_simpan" name="account_simpan" class="btn btn-success">Submit</button>
    </div>
    </form>
</tr>
</tbody>
</table>

</div></div>

</div>
</div>
</div>
</div>
</div>
</div>



</body>

<?php
// LOAD FOOTER
loadAssetsFoot();

ob_end_flush();
?>
