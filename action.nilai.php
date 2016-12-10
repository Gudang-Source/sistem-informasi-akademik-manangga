<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1));
$act=$_GET['act'];

$kd_mapel=$_POST['kd_mapel_input'];
$id_kelas=$_POST['id_kelas_input'];

$kkm=$_POST['kkm'];



#_________________________________________________________
#HAPUS
##########################################################3
if( $act=='hapus'){
	?> <script language="JavaScript">alert('Data Mata Pelajaran Berhasil Dihapus')</script><?php
	$kd_mapel=$_GET['kd_mapel'];
	$hapusmapel=mysql_query("DELETE FROM mapel WHERE kd_mapel='$kd_mapel'");

	?>
	<script>
		window.location=history.go(-1);
	</script>		
	<?php			
}
#END HAPUS
#_________________________________________________________
#UPDATE
##########################################################3
elseif ( $act=='input'){
	$id_nilai_input=$_POST['id_nilai_input'];
	$kd_mapel=$_POST['kd_mapel_input'];
	$id_kelas_siswa=$_POST['id_kelas_siswa_input'];
	$sik=$_POST['sik'];
	$id_tahun_aktif=$_POST['id_tahun_input'];
	

	$jumlah = count($id_nilai_input);

	for($i=0; $i < $jumlah; $i++)
	{
		$multi_id_kelas_siswa=$id_kelas_siswa[$i];
		$multi_id_nilai_siswa=$id_nilai_input[$i];
		$multi_nilai=$_POST[$sik][$i];
		

		$queryupdate =  mysql_query("UPDATE nilai set $sik='$multi_nilai' where id_nilai='$multi_id_nilai_siswa' ") ;


	}
	
	?>
	<script language="JavaScript">alert('Data Nilai Berhasil Di Input')</script>
	<script>
		window.location.href = 'guru.nilai.tambah';
	</script>		
	<?php	
} 

#_________________________________________________________
#tambah
##########################################################3

elseif ( $act=='tambah'){
	$kd_mapellama=$_GET['kd_mapel'];
	$nm_mapel=$_POST['nm_mapel'];
	$kd_mapel=$_POST['kd_mapel'];
	$kkm=$_POST['kkm'];
	
	$updatemapel=mysql_query("INSERT INTO mapel SET nm_mapel='$nm_mapel' , kkm='$kkm', kd_mapel='$kd_mapel'");
	?>
	<script language="JavaScript">alert('Data Mata Pelajaran Berhasil Ditambah')</script>
	<script>
		window.location.href = 'guru.nilai.tambah'; 
	</script>		
	<?php	
} ?>
?>
