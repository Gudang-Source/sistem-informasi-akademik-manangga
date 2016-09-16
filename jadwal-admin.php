		<?php 
session_start();
			  include "../assetadmin/head.php";
			  include "../assetadmin/header-nduwur.php";
			  include "../assetadmin/pinggirane.php";
			  include "../assetadmin/keterangane-profile.php";
			  include "../inc/koneksi.php";
			  ?>
		<ul id="crumbs"><li><a href="input-jadwal.php" title="Perkuliahan">INPUT JADWAL</a></li></ul>
		<?php
		if($_POST){
			$sql6="INSERT INTO jadwal VALUES(NULL, '{$_POST['kelas']}','{$_POST['nip']}','{$_POST['thn_ajaran']}','{$_POST['mapel']}','{$_POST['jam']}','{$_POST['hari']}','{$_POST['semester']}')";
			if(mysql_query($sql6)){
				echo "<h2>BERHASIL DISIMPAN</h2>";
			}
			else{
				echo "<h2>GAGAL DISIMPAN</h2>";
			}
		}
		?>
		<form action="" method="post" name="input_jadwal">
		<table class="table-snippet">
		<tbody>
		<?php 
		$sql="select nip, nm_guru from guru";
		$result=mysql_query($sql);
		$jsArray = "var nm_guru = new Array();";    
                        
		 ?>
		<tr><td class="snippet-label">NIP</td><td>: <select name="nip" onchange="ubah(this.value)">
			<option>--Pilih NIP--</option>
			<?php
			while($row = mysql_fetch_array($result)){
			?>echo $row['nama'];
			<option value="<?php echo $row['nip']; ?>"><?php echo $row['nip']; ?></option>
			<?php
			$jsArray .= "nm_guru['" . $row['nip'] . "'] = {name:'" . addslashes($row['nm_guru']) . "'};";
			}?>
		</select></td></tr>
	<tr>
		<td class="snippet-label">Nama</td>
		<td class="reg-input">: <input maxlength="25" style="width:200px" type="text" name="nm_guru" id="nmm_guru" disabled="">
		<script type="text/javascript">
                        <?php echo $jsArray;?>
                        function ubah(id){
                            document.getElementById('nmm_guru').value=nm_guru[id].name;
                            
                        }
                    </script>
		</td>
	</tr>
	<?php
	$sql2="select kd_mapel, nm_mapel from mapel";
	$result2=mysql_query($sql2);
	?>
		<tr><td class="snippet-label">Pelajaran</td><td>: 
		<select name="mapel">
			<option>--Pilih Mata Pelajaran</option>
			<?php
			while($row2=mysql_fetch_array($result2)){
			?>
			<option value="<?php echo $row2['kd_mapel']; ?>"><?php echo $row2['nm_mapel']; ?></option>
			<?php
			}
			?>
		</select>
		<?php
		$sql3="select kd_kelas, nm_kelas from kelas";
		$result3=mysql_query($sql3);
		?>
		<tr><td class="snippet-label">Kelas</td><td>: 
		<select name="kelas">
			<option>--Pilih Kelas--</option>
			<?php
			while($row3=mysql_fetch_array($result3)){
				?>
				<option value="<?php echo $row3['kd_kelas']; ?>"><?php echo $row3['nm_kelas'] ?></option>
				<?php
			}
			?>
		</select>
		<tr><td class="">Hari</td><td>: 
		<select name="hari">
			<option>--Pilih Hari--</option>
			<option value="Senin">Senin</option>
			<option value="Selasa">Selasa</option>
			<option value="Rabu">Rabu</option>
			<option value="Kamis">Kamis</option>
			<option value="Jumat">Jumat</option>
			<option value="Sabtu">Sabtu</option>
		</select>
		<tr><td class="snippet-label">Jam Ke</td><td>: 
		<select name="jam">
			<option>--Pilih Jam--</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
		</select>
		<?php
		$sql4="select id_tahun, thn_ajaran from thn_ajaran";
		$result4=mysql_query($sql4);
		?>
		<tr><td class="snippet-label">Tahun Ajaran</td><td>: 
		<select name="thn_ajaran">
			<option>--Pilih Tahun Ajaran--</option>
			<?php
			while($row4=mysql_fetch_array($result4)){
				?>
				<option value="<?php echo $row4['id_tahun']; ?>"><?php echo $row4['thn_ajaran']; ?></option>
				<?php
			}
			?>
		</select>
		<?php
		$sql5="select id_semester, semester from semester";
		$result5=mysql_query($sql5);
		?>
		<tr><td class="snippet-label">Semester</td><td>: 
		<select name="semester">
			<option>--Pilih Semester--</option>
			<?php
				while($row5=mysql_fetch_array($result5)){
					?>
					<option value="<?php echo $row5['id_semester']; ?>"><?php echo $row5['semester']; ?></option>
					<?php
				}
			?>
		</select></td></tr><br><br><br>
</tbody>
</table>
		<table>
		<tbody>
		<tr>
			<td><input type="submit" value="Simpan" class="btn-uin btn btn-inverse btn btn-small"></td>
			<td><input type="reset" value="Reset" class="btn-uin btn btn-inverse btn btn-small"></td>
			</form>	
<form action="preview-jadwal.php" name="jadwal-preview">
			<td><a href="preview-jadwal.php"><button type="text" class="btn-uin btn btn-inverse btn btn-small">Preview Jadwal</button></a></td>		
</form>		
			<span class="txtasmt"></span></td></tr>
		</tbody>
		</table>				

			<h2>JADWAL MATA PELAJARAN
		
		</h2>
		<table class="table table-bordered table-hover">
		<thead>
			<tr>
			<th class="tac">No</th>
			<th class="tac">Nama</th>
			<th class="tac">NIP</th>
			<th class="tac">Mata Pelajaran</th>
			<th class="tac">Kelas</th>
			<th class="tac">Hari</th>
			<th class="tac">Jam Ke</th>
			<th class="tac">Tahun Ajaran</th>
			<th class="tac">Semester</th>
			<th class="tac">Action</th>	
					</tr>
		</thead>
		<?php
		$sql7="SELECT guru.nm_guru, guru.nip, mapel.nm_mapel, kelas.nm_kelas, hari.hari, jam, thn_ajaran.thn_ajaran, semester.semester FROM hari,jadwal,guru,mapel,kelas,thn_ajaran,semester WHERE jadwal.nip=guru.nip AND jadwal.kd_mapel=mapel.kd_mapel AND jadwal.kd_kelas=kelas.kd_kelas AND jadwal.id_tahun=thn_ajaran.id_tahun AND jadwal.id_semester=semester.id_semester AND jadwal.id_hari=hari.id_hari order by thn_ajaran desc";
		$result7=mysql_query($sql7);
		$i=1;
		while ($row7=mysql_fetch_array($result7)){
		?>
<tbody>
		<tr>
			<td class="tac"><?php echo $i; ?></td>
			<td class="tac"><?php echo $row7['nm_guru']; ?></td>
			<td class="tac"><?php echo $row7['nip']; ?></td>
			<td class="tac"><?php echo $row7['nm_mapel']; ?></td>
			<td class="tac"><?php echo $row7['nm_kelas']; ?></td>
			<td class="tac"><?php echo $row7['hari']; ?></td>
			<td class="tac"><?php echo $row7['jam']; ?></td>
			<td class="tac"><?php echo $row7['thn_ajaran']; ?></td>
			<td class="tac"><?php echo $row7['semester']; ?></td>
			<td class="tac"><?php
					echo "<a href='detail-kelas.php?id={$row['kd_kelas']}'>Detail</a> | <a href='edit-kelas.php?id={$row['kd_kelas']}'>Edit</a> | ";?>
					<a href=<?php echo"delete-kelas.php?id={$row['kd_kelas']}";?> onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"> Delete</a> </td></tr> 
				
		</tr>
			</tbody>
			<?php 
			$i=$i+1;
			} 
			?>
		</table>	
			<table class="table-snippet">
	</table>		
		

	</div>
<?php include "../assetadmin/ngresiki-div.php"; 
			  include "../assetadmin/ngisorane.php";?>