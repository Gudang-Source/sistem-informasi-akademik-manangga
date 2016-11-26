<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));
$act=$_GET['act'];

 $kd_mapel=$_POST['kd_mapel'];
 $nm_mapel=$_POST['nm_mapel'];

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
elseif ( $act=='update'){
 $kd_mapellama=$_GET['kd_mapel'];
 $nm_mapel=$_POST['nm_mapel'];
 $kd_mapel=$_POST['kd_mapel'];
 $kkm=$_POST['kkm'];

		$updatemapel=mysql_query("UPDATE mapel SET  kkm='$kkm', kd_mapel='$kd_mapel' , nm_mapel='$nm_mapel' WHERE kd_mapel='$kd_mapellama'");
?>
<script language="JavaScript">alert('Data Mata Pelajaran Berhasil Di Edit')</script>
	<script>
 window.location=history.go(-1);
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
<script language="JavaScript">alert('Data Mata Pelajaran Berhasil Di ditambah')</script>
	<script>
 window.location=history.go(-1);
 </script>		
<?php	
} ?>
?>
