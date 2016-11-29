<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));
$act=$_GET['act'];

 $id_kelas_siswa=$_POST['id_kelas_siswa'];
 $id_kelas=$_POST['id_kelas'];



#_________________________________________________________
#HAPUS
##########################################################3
 if( $act=='hapus'){
	?> <script language="JavaScript">alert('Data  Berhasil Dihapus')</script><?php
	$id_kelas_siswa=$_GET['id_kelas_siswa'];
	$hapusmapel=mysql_query("DELETE FROM kelas_siswa WHERE id_kelas_siswa='$id_kelas_siswa'");

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

 $id_kelas_siswa=$_POST['id_kelas_siswa'];
 $id_kelas=$_POST['id_kelas'];

		$updatekelas_siswa=mysql_query("UPDATE kelas_siswa SET id_kelas='$id_kelas' WHERE id_kelas_siswa='$id_kelas_siswa'");
?>
<script language="JavaScript">alert('Data Berhasil Di Edit')</script>
	<script>
 window.location=history.go(-1);
 </script>		
<?php	
} 

#_________________________________________________________
#tambah
##########################################################3
