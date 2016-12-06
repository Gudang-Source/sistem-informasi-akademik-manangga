<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));
$act=$_GET['act'];

 $id_mengajar=$_POST['id_mengajar'];
 $id_guru=$_POST['id_guru'];
 $mapel=$_POST['mapel'];
 $kelas=$_POST['kelas'];



#_________________________________________________________
#HAPUS
##########################################################3
 if( $act=='hapus'){
	?> <script language="JavaScript">alert('Data Mengajar Berhasil Dihapus')</script><?php
	$id_mengajars=$_GET['id_mengajars'];
	$hapusmengajar=mysql_query("DELETE FROM mengajar WHERE id_mengajar='$id_mengajars'");

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
 $id_mengajarss=$_GET['id_meng'];
 $mapelss=$_POST['mapel'];
 $kelasss=$_POST['kelas'];

		$updatemengajar=mysql_query("UPDATE mengajar SET  id_kelas='$kelasss', kd_mapel='$mapelss' WHERE id_mengajar='$id_mengajarss'");
?>
<script language="JavaScript">alert('Data Mengajar Berhasil Diedit')</script>
	<script>
 window.location=history.go(-1);
 </script>		
<?php	
} 

#_________________________________________________________
#tambah
##########################################################3

elseif ( $act=='tambah'){
 $id_mengajarss=$_GET['id_meng'];
 $mapel1=$_POST['mapel'];
 $kelas1=$_POST['kelas'];
 $id_guru1=$_POST['id_guru'];
 
		$updatemengajar=mysql_query("INSERT INTO mengajar SET id_guru='$id_guru1' , id_kelas='$kelas1', kd_mapel='$mapel1'");
?>
<script language="JavaScript">alert('Data Mengajar Berhasil Ditambah')</script>
	<script>
 window.location=history.go(-1);
 </script>		
<?php	
} ?>
?>
