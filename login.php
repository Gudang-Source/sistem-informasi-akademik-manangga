<?php
require ( __DIR__ . '/init.php');
doUserAuthRedirect();

// TEMPLATE CONTROL
$ui_register_page = 'login';

// LOAD HEADER
loadAssetsHead('Login');

// FORM PROCESSING
if( isset($_POST['login']) ){
	include('config.php');
	
	session_start();
	
	//tangkap data dari form login
	$username = $_POST['username'];
	$password = $_POST['password'];	 
	
	
	//untuk mencegah sql injection
	//kita gunakan mysql_real_escape_string
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);
	
	
	//cek data yang dikirim, apakah kosong atau tidak
	if (empty($username) && empty($password)) {
		//kalau username dan password kosong
		header('location:login?error=1');
		break;
	}
	
	else if (empty($username)) {
		//kalau username saja yang kosong
		header('location:login?error=2');
		break;
	}
	
	else if (empty($password)) {
		//kalau password saja yang kosong
		header('location:login?error=3');
		break;
	}
	
	 
	$op = $_GET['op'];

//>>>>>>>>>>>>>>>SISWA<<<<<<<<<<<<<<<<<
	if($op=="in") {
			if(strlen($username)==9){
				$cek = mysql_query("SELECT * FROM user, siswa WHERE user.id_user=siswa.id_user AND nis='$username' AND password='$password'");
				if(mysql_num_rows($cek)==1){//jika berhasil akan bernilai 1
					$c = mysql_fetch_array($cek);

					$_SESSION['id_user'] = $c['id_user'];
					$_SESSION['usernamesiswa'] = $c['nis'];
					$_SESSION['tingkat_user'] = $c['tingkat_user'];

					$cektahun = mysql_query("SELECT * FROM tahun_ajaran WHERE status='1'");
					mysql_num_rows($cektahun);
					$tahun_ajaransession = mysql_fetch_array($cektahun);					

					// tahun ajaran session
					$_SESSION['id_tahun'] = $tahun_ajaransession['id_tahun'];
					$_SESSION['thn_ajaran'] = $tahun_ajaransession['thn_ajaran'];
					$_SESSION['semester'] = $tahun_ajaransession['semester'];
					$_SESSION['status'] = $tahun_ajaransession['status'];
					// tahun ajaran end
					

					header("location:dashboard");
				}
			}
//>>>>>>>>>>>>>>ADMIN<<<<<<<<<<<<<<<<
			elseif(strlen($username)==5){
				$administrator="administrator";
				$cek = mysql_query("SELECT * FROM user, admin WHERE user.id_user=admin.id_user AND username='$username' AND password='$password' AND administrator=$administrator");
				if(mysql_num_rows($cek)==1){//jika berhasil akan bernilai 1
					$c = mysql_fetch_array($cek);
					$_SESSION['id_user'] = $c['id_user'];
					$_SESSION['usernameadmin'] = $c['username'];
					$_SESSION['tingkat_user'] = $c['tingkat_user'];
					$_SESSION['administrator'] = $c['administrator'];
					
					$cektahun = mysql_query("SELECT * FROM tahun_ajaran WHERE status='1'");
					mysql_num_rows($cektahun);
					$tahun_ajaransession = mysql_fetch_array($cektahun);					

					// tahun ajaran session
					$_SESSION['id_tahun'] = $tahun_ajaransession['id_tahun'];
					$_SESSION['thn_ajaran'] = $tahun_ajaransession['thn_ajaran'];
					$_SESSION['semester'] = $tahun_ajaransession['semester'];
					$_SESSION['status'] = $tahun_ajaransession['status'];
					// tahun ajaran end

					header("location:dashboard");
				}
			}
//>>>>>>>>>>>>>>>PEGAWAI<<<<<<<<<<<<<<<	
			elseif(strlen($username)==10){
				$cek = mysql_query("SELECT * FROM user, pegawai WHERE pegawai.id_user=user.id_user AND id_pegawai='$username' AND password='$password'");
				if(mysql_num_rows($cek)==1){//jika berhasil akan bernilai 1
					$c = mysql_fetch_array($cek);
					$_SESSION['id_user'] = $c['id_user'];
					$_SESSION['usernametu'] = $c['id_pegawai'];
					$_SESSION['tingkat_user'] = $c['tingkat_user'];

					$cektahun = mysql_query("SELECT * FROM tahun_ajaran WHERE status='1'");
					mysql_num_rows($cektahun);
					$tahun_ajaransession = mysql_fetch_array($cektahun);					

					// tahun ajaran session
					$_SESSION['id_tahun'] = $tahun_ajaransession['id_tahun'];
					$_SESSION['thn_ajaran'] = $tahun_ajaransession['thn_ajaran'];
					$_SESSION['semester'] = $tahun_ajaransession['semester'];
					$_SESSION['status'] = $tahun_ajaransession['status'];
					// tahun ajaran end
					header("location:dashboard");
				}
			}
//>>>>>>>>>>>>>>>>>GURU PIKET<<<<<<<<<<<<<<<<<
			elseif(strlen($username)==18){
				date_default_timezone_set("asia/jakarta");
				$a_hari = array(1=>"Senin","Selasa","Rabu","Kamis","Jumat", "Sabtu");
				$hari = $a_hari[date("N")];	
				$cek = mysql_query("SELECT * FROM user, guru WHERE user.id_user=guru.id_user AND nip='$username' AND password='$password' AND hari = '$hari'");
				if(mysql_num_rows($cek)==1){//jika berhasil akan bernilai 1
					$c = mysql_fetch_array($cek);
					$_SESSION['id_user'] = $c['id_user'];
					$_SESSION['usernameguru'] = $c['nip'];
					$_SESSION['tingkat_user'] = $c['tingkat_user'];
					$_SESSION['hari'] = $c['hari'];

					$cektahun = mysql_query("SELECT * FROM tahun_ajaran WHERE status='1'");
					mysql_num_rows($cektahun);
					$tahun_ajaransession = mysql_fetch_array($cektahun);					

					// tahun ajaran session
					$_SESSION['id_tahun'] = $tahun_ajaransession['id_tahun'];
					$_SESSION['thn_ajaran'] = $tahun_ajaransession['thn_ajaran'];
					$_SESSION['semester'] = $tahun_ajaransession['semester'];
					$_SESSION['status'] = $tahun_ajaransession['status'];
					// tahun ajaran end
					header("location:dashboard");
				}
				else{
//>>>>>>>>>>>>>>>>> GURU BK <<<<<<<<<<<<<<<
					$jabatan="Guru BK";
					$cek = mysql_query("SELECT * FROM user, guru WHERE guru.id_user=user.id_user AND nip='$username' AND password='$password' AND jabatan = '$jabatan'");
					if(mysql_num_rows($cek)==1){//jika berhasil akan bernilai 1
						$c = mysql_fetch_array($cek);
						$_SESSION['id_user'] = $c['id_user'];
						$_SESSION['usernameguru'] = $c['nip'];
						$_SESSION['tingkat_user'] = $c['tingkat_user'];
						$_SESSION['jabatan'] = $c['jabatan'];

						$cektahun = mysql_query("SELECT * FROM tahun_ajaran WHERE status='1'");
					mysql_num_rows($cektahun);
					$tahun_ajaransession = mysql_fetch_array($cektahun);					

					// tahun ajaran session
					$_SESSION['id_tahun'] = $tahun_ajaransession['id_tahun'];
					$_SESSION['thn_ajaran'] = $tahun_ajaransession['thn_ajaran'];
					$_SESSION['semester'] = $tahun_ajaransession['semester'];
					$_SESSION['status'] = $tahun_ajaransession['status'];
					// tahun ajaran end
						header("location:dashboard");		
					}
					else{
		//>>>>>>>>>>>>>>>> GURU <<<<<<<<<<<<<<<<<<
						$cek = mysql_query("SELECT * FROM user, guru WHERE guru.id_user=user.id_user AND nip='$username' AND password='$password'");
						if(mysql_num_rows($cek)==1){//jika berhasil akan bernilai 1
							$c = mysql_fetch_array($cek);
							$_SESSION['id_user'] = $c['id_user'];
							$_SESSION['usernameguru'] = $c['nip'];
							$_SESSION['tingkat_user'] = $c['tingkat_user'];

							$cektahun = mysql_query("SELECT * FROM tahun_ajaran WHERE status='1'");
					mysql_num_rows($cektahun);
					$tahun_ajaransession = mysql_fetch_array($cektahun);					

					// tahun ajaran session
					$_SESSION['id_tahun'] = $tahun_ajaransession['id_tahun'];
					$_SESSION['thn_ajaran'] = $tahun_ajaransession['thn_ajaran'];
					$_SESSION['semester'] = $tahun_ajaransession['semester'];
					$_SESSION['status'] = $tahun_ajaransession['status'];
					// tahun ajaran end
							
							header("location:dashboard");
						}
						else {
							//kalau username ataupun password tidak terdaftar di database
							header('location:login?error=4');
						}
					}
				}
		}
		}
	}
	elseif($op=="out"){
		unset($_SESSION['id_user']);
		unset($_SESSION['username']);
		unset($_SESSION['usernamesiswa']);
		unset($_SESSION['usernametu']);
		unset($_SESSION['usernameadmin']);
		unset($_SESSION['usernameguru']);
		unset($_SESSION['tingkat_user']);
		unset($_SESSION['hari']);
		unset($_SESSION['jabatan']);
		header("location:login");
	}


?>

<body>


  <div class="uk-container uk-container-center uk-margin-top uk-margin-bottom uk-margin-top">

	  <div class="uk-vertical-align uk-text-right uk-height-1-1">
		<img class="uk-margin-bottom" width="500px" height="70px" src="assets/images/banner.png" alt="Sistem Informasi Akademik SDN II Manangga" title="Sistem Informasi Akademik SDN II Manangga">
	  </div>

    <hr class="uk-article-divider">
    <article class="uk-article">
      <h1 class="uk-article-title uk-text-center">Login</h1>
	  <br>
        <div class="uk-panel uk-width-1-2 uk-container-center uk-text-center">
			<?php
				//kode php ini kita gunakan untuk menampilkan pesan eror
				if (!empty($_GET['error'])) {
					if ($_GET['error'] == 1) {
						echo '<h3><center><font color="red">Username dan Password kosong!</font></center></h3>';
					}
					else if ($_GET['error'] == 2) {
						echo '<h3><center><font color="red">Username belum diisi!</font></center></h3>';
					}
					else if ($_GET['error'] == 3) {
						echo '<h3><center><font color="red">Password belum diisi!</font></center></h3>';
					}
					else if ($_GET['error'] == 4) {
						echo '<h3><center><font color="red">Username atau Password salah!</font></center></h3>';
					}
				}
			?>
          <form class="uk-form uk-form-stacked" name="login" method="post" action="login.php?op=in">

            <div class="uk-form-row">
              <div class="uk-form-controls"><input type="text" name="username" placeholder="Username" class="uk-form-large" required></div>
            </div>

            <div class="uk-form-row">
              <div class="uk-form-controls"><input type="password" name="password" placeholder="Password" class="uk-form-large" required>
			  </div>
            </div>

            <div class="uk-form-row">
              <button type="submit" value="login" name="login" class="uk-button uk-button-large uk-button-success" title="Login"><i class="uk-icon-unlock-alt"></i> Login</button>
            </div>

          </form>

        </div>
    </article>
  </div>
  </div>
</body>
</br>
</br>
</br>
</br>
</br>
<?php
// LOAD FOOTER
loadAssetsFoot();
ob_end_flush();
?>