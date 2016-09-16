<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(0));

// TEMPLATE CONTROL
$ui_register_page = 'siswa-tugas';

// LOAD HEADER
loadAssetsHead('Data Tugas dari Guru');
$nis      =$_POST['nis'];
$nip      =$_POST['nip'];
$kd_mapel  =$_POST['kd_mapel'];
$kd_kelas  =$_POST['kd_kelas'];
$juduL_tugasa    =$_POST['judul_tugasa'];
$keterangan =$_POST['ketarangan'];
$judule =$_POST['judule'];
$valid    =0;

date_default_timezone_set('Asia/Jakarta');
$action = $_GET['action'];
if ($action=="tambah") {

  if (isset($_FILES['userfile'])) {

  $tmpName=$_FILES['userfile']['tmp_name'];

  if ($nis=="" || $nip=="" || $kd_mapel=="" || $kd_kelas==""|| $judule==""|| !is_uploaded_file($tmpName)) {
   
    echo '<script>';
    echo 'alert("Isi Data Dengan Lengkap")';
    echo '</script>';
    header('location:siswa-tugas.tambah.php'); 
    $valid = 1;
  }
  $fileSize     = $_FILES['userfile']['size'];
  $fileType     = $_FILES['userfile']['type'];
  $fileName   = $_FILES['userfile']['name'];
  $info       = pathinfo($fileName);
  $ukuran     = 2000000;
  $extensiList  = array("doc","docx","pdf","ppt","pptx","xls","xlsx");
  $pisah      = explode(".",$fileName);
  $ekstensi     = $pisah[1];

  $fp   = fopen($tmpName, 'r');
  $konten = fread($fp, filesize($tmpName));
  $konten = addslashes($konten);
  fclose($fp);

  if (!get_magic_quotes_gpc()) {
    # code...
    $fileName = addslashes($fileName);
  }

  if (!in_array($ekstensi, $extensiList)) {
    # code...
    echo '<script>';
    echo 'alert("Type File Tidak Sesuai")';
    echo '</script>';
    echo '<script>window.location="siswa-tugas.tambah.php"</script>';
    $valid = 1;
  }if($fileSize >= $ukuran){
    echo '<script>';
    echo 'alert("Maaf Ukuran File Terlalu Besar")';
    echo '</script>';
    echo '<script>window.location="siswa-tugas.tambah.php"</script>';
    $valid = 1;
  }
   if ($valid !=1) {
    # code...
    $query = "INSERT INTO tugas_siswa (kd_tugas_siswa, nama_file, size, judul_tugas, nip, nis, kd_kelas, kd_mapel, waktu, type, content)".
    "VALUES (NULL, '$fileName', '$fileSize', '$judule', '$nip', '$nis','$kd_kelas', '$kd_mapel', sysdate() , '$fileType' , '$konten')";
    $data=mysql_query($query);


    if ($data) {
      # code...
      echo '<script>';
      echo 'alert("Data Berhasil Diupload")';
      echo '</script>';
      echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=aksi_tugas_siswa.php\">";
    } else{
      echo '<script>';
      echo 'alert("Data Gagal Diupload")';
      echo '</script>';
      echo '<script>window.location="aksi_tugas_siswa.php"</script>';

    }
    
  }
}

} elseif ($action=="delete") {
  # code...
  $kd_materi   =$_POST['kd_materi'];

  $delete="DELETE from siswa where kd_siswa='$kd_siswa'";
  $delete_query=mysql_query($delete);
  
  if ($delete_query) {
  # code...
    ?>
     <script language="javaScript">alert('data berhasil dihapus');</script><?php 
     header('location:lihat_tugas_siswa.php?nis='.$nis.'&&k_mapel='.$k_mapel);
 //   echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=lihat_materi.php?nip='$nip'&&k_mapel='$k_mapel'\">";

  }else{
    ?><script language="JavaScript">alert('Data Gagal Dihapus');</script><?PHP
    echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=lihat_tugas_siswa.php\">";
  }
}

?>