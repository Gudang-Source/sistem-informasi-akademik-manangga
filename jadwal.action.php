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
	$querycek = mysql_query("SELECT * FROM jadwal, mengajar where jadwal.id_mengajar=mengajar.id_mengajar and jadwal.id_jadwal_mapel='$id_jadwal'");
	$datasikdihapus=mysql_fetch_array($querycek);
	$id_gurusikdihapus=$datasikdihapus['id_guru'];
	$id_kelassikdihapus=$datasikdihapus['id_kelas'];
	$kd_mapelsikdihapus=$datasikdihapus['kd_mapel'];
	$id_tahunsikdihapus=$datasikdihapus['id_tahun'];

	$querycekkelassiswa = mysql_query("SELECT * FROM kelas_siswa where id_kelas='$id_kelassikdihapus' and id_tahun='$id_tahunsikdihapus'");
	$hapussetupnilai=mysql_query("DELETE FROM setup_nilai WHERE kd_mapel='$kd_mapelsikdihapus' and id_kelas='$id_kelassikdihapus' and id_guru='$id_gurusikdihapus' and id_tahun='$id_tahunsikdihapus' ");

	while ($datasikdihapuskelas=mysql_fetch_array($querycekkelassiswa)){
					$hapusdatanilai=mysql_query("DELETE FROM nilai WHERE kd_mapel='$kd_mapelsikdihapus' and id_kelas_siswa='$datasikdihapuskelas[id_kelas_siswa]' and id_tahun='$id_tahunsikdihapus' ");
	
		}
	$hapusjadwal=mysql_query("DELETE FROM jadwal WHERE id_jadwal_mapel='$id_jadwal'");

	if ($hapusjadwal) { 
	
		?>
	

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

	if ($updatejadwalmapel) { 

	
		?>
	

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
	
	if($tambahjadwal){
	$querycek = mysql_query("SELECT * FROM nilai, siswa, kelas_siswa 
	where nilai.id_kelas_siswa=kelas_siswa.id_kelas_siswa
	and kelas_siswa.id_siswa=siswa.id_siswa  
	and nilai.id_tahun='$_SESSION[id_tahun]'
	and nilai.kd_mapel='$kd_mapel'
	and kelas_siswa.id_kelas='$id_kelas'
	order by siswa.nm_siswa asc");
	$jumlahe=mysql_num_rows($querycek);
	if ($jumlahe<1){
		
		$lebokke=mysql_query("INSERT INTO nilai (id_kelas_siswa, kd_mapel, id_tahun)  SELECT id_kelas_siswa, kd_mapel, id_tahun from ( SELECT distinct * from (
													SELECT kelas_siswa.id_kelas_siswa , mengajar.kd_mapel, jadwal.id_tahun
													FROM siswa, kelas_Siswa, mengajar, jadwal
													WHERE siswa.id_siswa=kelas_Siswa.id_siswa
													and jadwal.id_mengajar=mengajar.id_mengajar
													and mengajar.id_kelas=kelas_Siswa.id_kelas
													and mengajar.kd_mapel = '$kd_mapel'
													and jadwal.id_tahun='$_SESSION[id_tahun]'
													) ss) asd ");

				
				$queryceksetup = mysql_query("SELECT * FROM setup_nilai 
													   WHERE id_tahun='$_SESSION[id_tahun]'
															and kd_mapel='$kd_mapel'
															and id_kelas='$id_kelas'
															and id_guru='$id_guru'
											")or die(mysql_error());
				$jumlahesetup=mysql_num_rows($queryceksetup);

			

				if ($jumlahesetup<1){
				
						$lebokkesetup=mysql_query("INSERT INTO setup_nilai (id_guru, kd_mapel, id_kelas,  id_tahun, uh, t,uts,uas)  
																	value  ('$id_guru', '$kd_mapel', '$id_kelas', '$id_tahun', 20 , 20, 30, 40)
												  ")or die(mysql_error());
						
				}else{
					
				}

		
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
