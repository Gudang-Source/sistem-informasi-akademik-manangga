<?php
include('../koneksi.php');

$action=$_REQUEST['action'];

if($action == "Tambah")
{

	$guru=$_REQUEST['guru'];	
	$mapel=$_REQUEST['mapel'];	
	$kelas=$_REQUEST['kelas'];	
	$judul=ucwords($_REQUEST['judul']);	
	$valid=0;	

	if (isset($_REQUEST['action'])&&$_FILES['userfile'])
	{

		$tmpName = $_FILES['userfile']['tmp_name'];	

		if (!is_uploaded_file($tmpName) || empty($tmpName) || empty($judul))
		{
			echo '<script>alert("Mohon isi data dengan lengkap")</alert>';
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=upload_materi.php\">";
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
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"10;URL=upload_materi.php\">";
			$valid= 1;
		}

		if($fileSize >= $ukuran)
		{
			echo '<script>alert("Ukuran file terlalu besar")</script>';
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"10;URL=upload_materi.php\">";
			$valid= 1;
		}
		if($valid != 1)
		{

			$query = "INSERT INTO materi (id_materi, nama_file, size, judul, nip_guru, kode_kelas, kode_mapel, waktu, type, content)
			VALUES (NULL, '$fileName', '$fileSize', '$judul', '$guru', '$kelas', '$mapel', sysdate(), '$fileType', '$konten')";			

			$data=mysql_query($query);

			if($data)
			{
				echo "<script> alert('Data berhasil di upload')</script>";
				echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=materi.php\">";
			} else 

			{
				echo "<script> alert('Data gagal di upload')</script>";
				echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=materi.php\">";
			}

		}	
	}

}

elseif ($action == "delete") {
	$id_materi = $_REQUEST['id_materi'];
	$delete = "delete from materi where id_materi='$id_materi'";
	$hapus = mysql_query($delete);

	if ($hapus) {
		echo '<script>alert("Data berhasil dihapus")</script>';
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=materi.php\">";
	}
	else{
		echo '<script>alert("Data gagal dihapus")</script>';
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=materi.php\">";
	}
}



?>