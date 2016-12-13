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
	$uh=$_POST['uh'];
 
	$t=$_POST['t'];
 
	$uts=$_POST['uts'];
 
	$uas=$_POST['uas'];
 
 	$id_tahun_aktif=$_POST['id_tahun'];
 
	$id_setup_nilai=$_POST['id_setup_nilai'];

		
		$queryupdate =  mysql_query("UPDATE setup_nilai 
									set uh='$uh', 
									 t='$t',
									 uts='$uts',
									 uas='$uas',
									 id_tahun='$id_tahun_aktif'
									where id_setup_nilai='$id_setup_nilai' ") ;

	
	?>
	<script language="JavaScript">alert('Data Setup Nilai Berhasil Di Update')</script>
	<script>
		window.location.href = 'guru.setup.nilai';
	</script>		
	<?php	
} 


?>
