<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(1));
$act=$_GET['act'];





#_________________________________________________________
#HAPUS
##########################################################3

#END HAPUS
#_________________________________________________________
#UPDATE
##########################################################3
if ( $act=='input'){
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

elseif ( $act=='update'){
	$id_nilai=$_GET['id_nilai'];
	$uh1=$_POST['uh1'];
	$uh2=$_POST['uh2'];
	$uh3=$_POST['uh3'];
	$uh4=$_POST['uh4'];
	$uh5=$_POST['uh5'];
	$uh6=$_POST['uh6'];
	$uh7=$_POST['uh7'];
	$t1=$_POST['t1'];
	$t2=$_POST['t2'];
	$t3=$_POST['t3'];
	$t4=$_POST['t4'];
	$t5=$_POST['t5'];
	$t6=$_POST['t6'];
	$t7=$_POST['t7'];
	$uts=$_POST['uts'];
	$uas=$_POST['uas'];

	$id_kelas=$_POST['id_kelas'];
	$kd_mapel=$_POST['kd_mapel'];
	$id_kelas_siswa_edit=$_POST['id_kelas_siswa_edit'];
	$id_tahun_edit=$_POST['id_tahun_edit'];
	
	
	$updatemapel=mysql_query("UPDATE nilai SET uh1='$uh1', 
											   uh2='$uh2', 
											   uh3='$uh3', 
											   uh4='$uh4', 
											   uh5='$uh5', 
											   uh6='$uh6', 
											   uh7='$uh7', 
											   t1='$t1', 
											   t2='$t2', 
											   t3='$t3', 
											   t4='$t4', 
											   t5='$t5', 
											   t6='$t6', 
											   t7='$t7', 
											   uts='$uts', 
											   uas='$uas'
							WHERE id_nilai='$id_nilai'
								  AND id_kelas_siswa='$id_kelas_siswa_edit'
								  AND kd_mapel='$kd_mapel'
								  AND id_tahun='$id_tahun_edit'
							");
	?>
	<script language="JavaScript">alert('Data Nilai Berhasil Di Update')</script>
	<script>
		window.location.href = 'guru.nilai'; 
	</script>		
	<?php	
} ?>
?>
