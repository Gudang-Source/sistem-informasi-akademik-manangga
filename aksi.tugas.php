<?php
// user login
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(0));

// TEMPLATE CONTROL
$ui_register_page = 'siswa-tugas';

// LOAD HEADER
loadAssetsHead('Data Tugas dari Guru');


if($action == "Tambah")
{

	$nip=$_REQUEST['nip'];
	$nis=$_REQUEST['nis'];
	$kd_mapel=$_REQUEST['kd_mapel'];	
	$kd_kelas=$_REQUEST['kd_kelas'];	
	$judul_tugas=$_REQUEST['judul_tugas'];
	$valid=0;	

	if (isset($_REQUEST['action'])&&$_FILES['userfile'])
	{
				
		$tmpName = $_FILES['userfile']['tmp_name'];	

	if  (empty($nip)||empty($nis)|| empty($kode_mapel) || empty($kode_kelas) || !is_uploaded_file($tmpName) || empty($judul) || empty($jenis))
	{
		echo '<script>alert("Mohon isi data dengan lengkap")</alert>';
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=upload_tugas.php\">";
		$valid = 1;
	}
	
	$fileSize 	= $_FILES['userfile']['size'];
	$fileType	= $_FILES['userfile']['type'];
	$fileName	= $_FILES['userfile']['name'];
	$info		= pathinfo($fileName);
	$ukuran		= 2000000;
	$extensiList= array("doc","docx","pdf","ppt","pptx","xls","xlsx", "txt");
	$pisah 			= explode(".",$fileName);
	$ekstensi 		= $pisah[1];


	$fp 	= fopen($tmpName, 'r');
	$konten = fread($fp, filesize($tmpName));
	$konten = addslashes($konten);
	fclose($fp);

	if(!get_magic_quotes_gpc())
	{
		$fileName = addslashes($fileName);
	}

	if(!in_array($ekstensi,$extensiList))
	{
		echo '<script>alert("File tidak sesuai")</script>';
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=upload_tugas.php\">";
		$valid= 1;
	}
     
    if($fileSize >= $ukuran)
    {
    	echo '<script>alert("Ukuran file terlalu besar")</script>';
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=upload_tugas.php\">";
		$valid= 1;
	}
	if($valid != 1)
	{
		
		$query = "INSERT INTO tugas_siswa (kd_tugas, juduL_tugas, nama_file, type, size, kd_mapel, kd_kelas, nip, nis, tanggal, content)
				  VALUES (NULL, '$judul', '$fileName', '$fileType', '$fileSize', '$jenis','$kd_mapel', '$kd_kelas', '$nip', '$nis', sysdate(), '$konten')";
		
		$data=mysql_query($query);
		 
		if($data)
		{
			echo "<script> alert('Data berhasil di upload')</script>";
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=tugas.php\">";
		} else 

		{
			echo "<script> alert('Data gagal di upload')</script>";
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=upload_tugas.php\">";
		}

}	
}
}