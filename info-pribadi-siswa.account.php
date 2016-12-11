<!-- user login -->
<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(0));

// TEMPLATE CONTROL
$ui_register_page     = 'info-pribadi-siswa.account';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Konfigurasi Akun Siswa');

//LOAD DATA

    # MEMBUAT NILAI DATA PADA FORM
    # SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)


    $data_password_lama= isset($_POST['password_lama']) ?  $_POST['password_lama'] : '';
    $data_password_baru= isset($_POST['password_baru']) ?  $_POST['password_baru'] : '';
    $data_password_ulangi= isset($_POST['password_ulangi']) ?  $_POST['password_ulangi'] : '';

$mySql = "SELECT * FROM siswa ";
$myQry = mysql_query($mySql);
$myData= mysql_fetch_array($myQry);

    # TOMBOL SIMPAN DIKLIK
      if (isset($_POST['buttonsubmit'])) {
# baca variabel 
              $passwordasli=$_POST['password_baru'];
              $password_baruasli=$_POST['password_baru'];
              $password_baru=md5($_POST['password_baru'],"g4r4m");
                  
                  $password_lama = $_POST['password_lama'];
                  $username = $_POST['username'];
                  
                  $password_ulangiasli = $_POST['password_ulangi'];
                  $password_ulangi=md5($_POST['password_baru'],"g4r4m");

      $pesanError= array();
      if (trim($username)=="") {
        $pesanError[] = "Data <b>Username</b> tidak boleh kosong !";    
      }
      if (trim($password_lama)=="") {
        $pesanError[] = "Data <b>Password Lama</b> tidak boleh kosong !";    
      }
      if (trim($password_baruasli)=="") {
        $pesanError[] = "Data <b>Password Baru</b> tidak boleh kosong !";    
      }
      if (trim($password_ulangi)=="") {
        $pesanError[] = "Data <b>Konfirmasi Password Baru</b> tidak boleh kosong !";    
      }

 #JIKA ADA PESAN ERROR DARI VALIDASI FORM 
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
          $r=mysql_fetch_array(mysql_query("SELECT * FROM siswa"));
              if ($password_lama==$r['password_asli']){
                // Pastikan bahwa password baru yang dimasukkan sebanyak dua kali sudah cocok
                if ($_POST[password_baruasli]==$_POST[password_ulangiasli]){
                  mysql_query("UPDATE siswa SET username='$username',  password = '$password_baru', password_asli='$password_baruasli' ");
                  echo "<script>alert('Update Account Berhasil'); window.location = './logout'</script>";
                }
                else{
                echo "<script>alert('Password baru yang anda masukkan tidak sama'); window.location = './info-pribadi-siswa.account'</script>";
                }
              }
              else{
              echo "<script>alert('Password Lama anda salah'); window.location = './info-pribadi-siswa.account'</script>";
              }
              }
    
    }

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
                <h1 class="uk-article-title"> <?php echo ucwords( strtolower($rowks[nm_siswa])); ?> <span class="uk-text-large">{ Konfigurasi Akun Siswa }</span></h1>
                <br>
                <a href="./guru.siswa" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Siswa"><i class="uk-icon-angle-left"></i> Kembali</a>
                <!-- <hr class="uk-article-divider"> -->
                   <form id="formadmin" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
    <div class="alert alert-info" role="alert" id="removeWarning">
      <span class="glyphicon " aria-hidden="true"></span>
      <span class="sr-only"></span>
      Data Account - Ubah Password
    </div>
    <div class="item form-group">
       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span>
       </label>
       <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="username" name="username" required value="<?php echo $myData['username'] ?>"  class="form-control col-md-7 col-xs-12">
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password Lama<span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="password" id="password_lama" name="password_lama" required   class="form-control col-md-7 col-xs-12">
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password Baru<span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="password" id="password_baru" name="password_baru" required   class="form-control col-md-7 col-xs-12">
      </div>
    </div>
    <div class="item form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password1">Konfirmasi Password Baru <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="password" id="password_ulangi" name="password_ulangi"  required class="form-control col-md-7 col-xs-12">
      </div>
    </div>
    <input type="hidden" id="pass" name="pass" value="<?php echo $myData['password_asli'] ?>"  required class="form-control col-md-7 col-xs-12">

    
    <div style="text-align:center" class="form-actions no-margin-bottom">
     <button type="submit" id="buttonsubmit" name="buttonsubmit" class="btn btn-success">Submit</button>
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
