<?php
session_start();

require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));
$act=$_GET['act'];

$id_tahun=$_SESSION['id_tahun'];



$kd_mapel=$_POST['kd_mapel'];
$nm_mapel=$_POST['nm_mapel'];

$kkm=$_POST['kkm'];



#_________________________________________________________
#HAPUS
##########################################################3
if( $act=='hapus'){
	
	$id_jadwal=$_GET['id_jadwal'];
	$hapusjadwal=mysql_query("DELETE FROM jadwal WHERE id_jadwal_mapel='$id_jadwal'");

	if ($hapusjadwal) { ?>
	

	<script language="JavaScript">alert('Data Jadwal Mata Pelajaran Berhasil Dihapus')</script>
	<script>
		window.location=history.go(-1);
	</script>		

	<?php	
} 
else {
	?>
	<script language="JavaScript">alert('Data Jadwal Mata Pelajaran GAGAL Dihapus')</script>
	<script>
		window.location=history.go(-1);
	</script>		

	<?php }
} 
#END HAPUS
#_________________________________________________________
#UPDATE
##########################################################3
elseif ( $act=='update'){
	$id_jadwal=$_GET['id_jadwal'];
	$guru=$_POST['guru'];
	$output = preg_replace('/[^0-9]/', '', $guru );
	$cekguru = mysql_query("SELECT * FROM guru WHERE nip='$output'");
	$jikukid_guru = mysql_fetch_array($cekguru);         
	$id_guru = $jikukid_guru['id_guru'];

	$kd_mapel=$_POST['kd_mapel'];
	$id_kelas=$_POST['id_kelas'];
	$id_hari=$_POST['id_hari'];
	$id_sesi=$_POST['id_sesi'];

//// cek tabel mengajar
	$jikukidmengajar = mysql_query("SELECT * FROM mengajar WHERE id_guru='$id_guru' and id_kelas='$id_kelas' and kd_mapel='$kd_mapel' ");
	$datamengajar = mysql_fetch_array($jikukidmengajar);         

	$id_mengajar = $datamengajar['id_mengajar'];
	$updatejadwalmapel=mysql_query("UPDATE jadwal SET id_mengajar='$id_mengajar' , id_hari='$id_hari' , id_sesi='$id_sesi' , id_tahun='$id_tahun' where id_jadwal_mapel='$id_jadwal' ");

	if ($updatejadwalmapel) { ?>
	

	<script language="JavaScript">alert('Data Jadwal Mata Pelajaran Berhasil Diubah')</script>
	<script>
		window.location=history.go(-1);
	</script>		

	<?php	
} 
else {
	?>
	<script language="JavaScript">alert('Data Jadwal Mata Pelajaran GAGAL Diubah')</script>
	<script>
		window.location=history.go(-1);
	</script>		

	<?php }
} 

#_________________________________________________________
#tambah
##########################################################3

elseif ( $act=='tambah'){

	$guru=$_POST['guru'];
	$output = preg_replace('/[^0-9]/', '', $guru );
	$cekguru = mysql_query("SELECT * FROM guru WHERE nip='$output'");
	$jikukid_guru = mysql_fetch_array($cekguru);         
	$id_guru = $jikukid_guru['id_guru'];

	$kd_mapel=$_POST['kd_mapel'];
	$id_kelas=$_POST['id_kelas'];
	$id_hari=$_POST['id_hari'];
	$id_sesi=$_POST['id_sesi'];
//// cek tabel mengajar
	$jikukidmengajar = mysql_query("SELECT * FROM mengajar WHERE id_guru='$id_guru' and id_kelas='$id_kelas' and kd_mapel='$kd_mapel' ");
	$datamengajar = mysql_fetch_array($jikukidmengajar);

	

	$id_mengajar = $datamengajar['id_mengajar'];

	
	$tambahjadwal=mysql_query("INSERT INTO jadwal SET id_mengajar='$id_mengajar' , id_hari='$id_hari' , id_sesi='$id_sesi' , id_tahun='$id_tahun' ");
	if ($tambahjadwal) { 

//  			$jikukidkelassiswa = mysql_query("SELECT distinct * from (
// 													SELECT kelas_siswa.id_kelas_Siswa id_kelas_siswa, mengajar.kd_mapel,  siswa.nis nis, siswa.nm_siswa nm_siswa, kelas_siswa.id_kelas kelas 
// 													FROM siswa, kelas_Siswa, mengajar, jadwal
// 													WHERE siswa.id_siswa=kelas_Siswa.id_siswa
// 													and jadwal.id_mengajar=mengajar.id_mengajar
// 													and mengajar.id_kelas=kelas_Siswa.id_kelas
// 													and mengajar.kd_mapel = '$kd_mapel'
// 													and jadwal.id_tahun='$id_tahun'
// 													) ss
// 											");
			$jikukidkelassiswa = mysql_query("SELECT distinct * from (
													SELECT nilai.id_kelas_siswa, nilai.kd_mapel
													FROM nilai, kelas_siswa 
													WHERE kelas_siswa.id_kelas_siswa=nilai.id_kelas_siswa
													and nilai.kd_mapel = '$kd_mapel'
													and kelas_siswa.id_kelas = '$id_kelas'
													and nilai.id_tahun='$id_tahun'
													) ceksiswa
											");
			$jumlahe = mysql_num_rows($jikukidkelassiswa);  
			if ($jumlahe<0){
					mysql_query("INSERT INTO nilai (id_kelas_siswa, kd_mapel, id_tahun)  SELECT distinct * from (
													SELECT kelas_siswa.id_kelas_Siswa , mengajar.kd_mapel, jadwal.id_tahun
													FROM siswa, kelas_Siswa, mengajar, jadwal
													WHERE siswa.id_siswa=kelas_Siswa.id_siswa
													and jadwal.id_mengajar=mengajar.id_mengajar
													and mengajar.id_kelas=kelas_Siswa.id_kelas
													and mengajar.kd_mapel = '$kd_mapel'
													and jadwal.id_tahun='$id_tahun'
													) ss ");
			}else{
				
			}


		?>
	

	<script language="JavaScript">alert('Data Jadwal Mata Pelajaran Berhasil Ditambah')</script>
	<script>
		window.location=history.go(-1);
	</script>		

	<?php	
} 
else {
	?>
	<script language="JavaScript">alert('Data Jadwal Mata Pelajaran GAGAL Ditambah')</script>
	<script>
		window.location=history.go(-1);
	</script>		

	<?php }
} ?>
?>
