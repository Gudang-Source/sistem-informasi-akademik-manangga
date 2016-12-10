<!-- user login -->
<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(0));

// TEMPLATE CONTROL
$ui_register_page     = 'info-pribadi-siswa';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Lihat Data Siswa');

//LOAD DATA

# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
      $edit = mysql_query("SELECT * FROM siswa, wali WHERE siswa.id_Wali=wali.id_wali and nis='$_SESSION[usernamesiswa]'");
      $rowks  = mysql_fetch_array($edit);

      ?>
      
      <body>

        <?php
  // LOAD MAIN MENU
        loadMainMenu();
        ?>

        <!-- page content -->
        <div class="uk-container uk-container-center uk-margin-large-top">
          <div class="uk-grid" data-uk-grid-margin data-uk-grid-match>
            <div class="uk-width-medium-1-6 uk-hidden-small">
              <?php loadSidebar() ?>
            </div>
            <div class="uk-width-medium-5-6 tm-article-side">
              <article class="uk-article">
                <div class="uk-vertical-align uk-text-right uk-height-1-1">
                  <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="Sistem Informasi Akademik SD N II Manangga" title="Sistem Informasi Akademik SD N II Manangga">
                </div>
                <hr class="uk-article-divider">
                <h1 class="uk-article-title"> <?php echo ucwords( strtolower($rowks[nm_siswa])); ?> <span class="uk-text-large">{ Lihat Data Pribadi Siswa }</span></h1>
                <br>
                <a href="./guru.siswa" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Siswa"><i class="uk-icon-angle-left"></i> Kembali</a>
                <!-- <hr class="uk-article-divider"> -->
                <form id="formsiswa" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
                  <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-1-1">
                      <form id="formsiswa" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
                        <div class="uk-grid" data-uk-grid-margin>
                          <div class="uk-width-medium-1-1">


                            <div class="uk-grid">
                              <div class="uk-width-3-10">
                               <div class="item form-group">

                                 <ul class="uk-tab uk-tab-left" data-uk-tab="{connect:'#tabs_example2', animation: 'fade'}">
                                  <li ><a href="#">Data Pribadi Siswa</a></li>
                                  <li><a href="#">Data Orangtua Siswa</a></li>


                                </div>


                              </div>

                              <ul id="tabs_example2" class="uk-switcher uk-width-7-10">
                                <li>
                                  <table class="uk-table uk-table-hover  uk-table-condensed"><tr><td><code class="title">Data Pribadi Siswa</code></td><td></td><td></td><td></td><td width="70"> <a href="siswa-siswa.update?id=<?php echo $rowks[id_siswa]?>" ><i  class="uk-icon-pencil"></i> Edit</a><li></li></td> </tr></table>  
           
                                   <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Image <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <div class="col-lg-8">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                          <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="gallery/news/<?=$rowks['foto'];?>"></div>
                                          <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                          <div>
                                                              </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>                






                                  <div class="item form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">NIS<span class="required">*</span>
                                   </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                     <input readonly="readonly"  type="text" id="nis" name="nis" value="<?php echo $rowks['nis'];?>" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                 </div>



                                 <div class="item form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_siswa">Nama Siswa<span class="required">*</span>
                                   </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                     <input readonly="readonly"  type="text" id="nm_siswa" name="nm_siswa" value="<?php echo $rowks['nm_siswa'];?>" required="required" class="form-control col-md-7 col-xs-12">
                                     
                                   </div>
                                 </div>


                                 <div class="item form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password<span class="required">*</span>
                                   </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                     <input readonly="readonly"  type="text" id="password" name="password" value="<?php echo $rowks['password'];?>" required="required" class="form-control col-md-7 col-xs-12">
                                   </div>
                                 </div>


                                 <div class="item form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password1">Konfirmasi Password<span class="required">*</span>
                                   </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                     <input readonly="readonly"  type="text" id="password1" name="password1" value="<?php echo $rowks['password'];?>" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                 </div>



                                 <div class="item form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tempat_lahir">Tempat Lahir<span class="required">*</span>
                                   </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                     <input readonly="readonly"  type="text" id="tempat_lahir" name="tempat_lahir" value="<?php echo $rowks['tempat_lahir'];?>" required="required" class="form-control col-md-7 col-xs-12">
                                   </div>
                                 </div>



                                 <div class="item form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_tgl_lahir">Tanggal Lahir<span class="required">*</span>
                                   </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                     <input readonly="readonly"  type="text" id="date_tgl_lahir" name="date_tgl_lahir" value="<?php echo  date('d/m/Y', strtotime($rowks['date_tgl_lahir'] )); ?>" required="required" class="form-control col-md-7 col-xs-12">
                                   </div>
                                 </div>



                                 <div class="item form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jns_kelamin">Jenis Kelamin<span class="required">*</span>
                                   </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                     <select readonly  type="text" class="form-control chzn-select col-md-7 col-xs-12" id="jns_kelamin" name="jns_kelamin" value="" required>
                                      <option value="">-Pilih Jenis Kelamin-</option> 
                                      <?php
                                      if ($rowks['jns_kelamin']=="Laki-laki") {
                                        ?>
                                        <option value="Laki-laki" selected>Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                        <?php
                                      }
                                      else{ ?>
                                      <option value="Laki-laki" selected>Laki-laki</option>
                                      <option value="Perempuan">Perempuan</option>     
                                      <?php     } 
                                      ?>
                                    </select>




                                  </div>
                                </div>


                                <div class="item form-group">
                                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="agama">Agama<span class="required">*</span>
                                 </label>
                                 <div class="col-md-6 col-sm-6 col-xs-12">
                                   <select readonly  type="text" class="form-control chzn-select col-md-7 col-xs-12" id="agama" name="agama" value="" required>
                                    <option value="">-Pilih Agama-</option>
                                    <?php
                    //MENGAMBIL NAMA PROVINSI YANG DI DATABASE
                                    $agama =mysql_query("SELECT * FROM agama ORDER BY nm_agama asc");
                                    while ($dataagama=mysql_fetch_array($agama)) {
                                     if ($dataagama['id_agama']==$rowks['id_agama']) {
                                       $cek ="selected";
                                     }
                                     else{
                                      $cek= "";
                                    }
                                    echo "<option value=\"$dataagama[id_agama]\" $cek>$dataagama[nm_agama]</option>\n";
                                  }
                                  ?>
                                </select>

                              </div>
                            </div>


                            <?php               
                            $jeng =mysql_query("SELECT *
                              FROM
                              provinsi
                              INNER JOIN kabupaten ON kabupaten.id_prov = provinsi.id_prov
                              INNER JOIN kecamatan ON kecamatan.id_kab = kabupaten.id_kab
                              INNER JOIN kelurahan ON kelurahan.id_kec = kecamatan.id_kec
                              where kelurahan.id_kel='$rowks[id_kel]'
                              ");
                            $datajeng=mysql_fetch_array($jeng);


                            ?>
                            <div class="item form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prov">Provinsi <span class="required">*</span>
                             </label>
                             <div class="col-md-6 col-sm-6 col-xs-12">
                              <select readonly  type="text" class="form-control chzn-select col-md-7 col-xs-12" id="prov" name="prov" value="" required>
                                <option value="">-Pilih Provinsi-</option>
                                <?php
                    //MENGAMBIL NAMA PROVINSI YANG DI DATABASE
                                $provinsi =mysql_query("SELECT * FROM provinsi ORDER BY nama_prov");
                                while ($dataprovinsi=mysql_fetch_array($provinsi)) {
                                 if ($dataprovinsi['id_prov']==$datajeng['id_prov']) {
                                   $cek ="selected";
                                 }
                                 else{
                                  $cek= "";
                                }
                                echo "<option value=\"$dataprovinsi[id_prov]\" $cek>$dataprovinsi[nama_prov]</option>\n";
                              }
                              ?>
                            </select>
                          </div>
                        </div>      


                        <div class="item form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kota">Kabupaten <span class="required">*</span>
                         </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                          <select readonly  type="text" class="form-control chzn-select col-md-7 col-xs-12" id="kota" name="kota" value="" required>
                            <option value="">-Pilih Kabupaten-</option>
                            <?php
                    //MENGAMBIL NAMA kabupaten YANG DI DATABASE
                            $kabupaten =mysql_query("SELECT * FROM kabupaten WHERE id_prov=$datajeng[id_prov] ORDER BY nama_kab");
                            while ($datakabupaten=mysql_fetch_array($kabupaten)) {
                             if ($datakabupaten['id_kab']==$datajeng['id_kab']) {
                               $cek ="selected";
                             }
                             else{
                              $cek= "";
                            }
                            echo "<option value=\"$datakabupaten[id_kab]\" $cek>$datakabupaten[nama_kab]</option>\n";
                          }
                          ?>
                        </select>
                      </div>
                    </div>


                    <div class="item form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_kec">Kecamatan <span class="required">*</span>
                     </label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                      <select readonly  type="text" class="form-control chzn-select col-md-7 col-xs-12" id="id_kec" name="id_kec" value="" required>
                        <option value="">-Pilih Kecamatan-</option>
                        <?php


                    //MENGAMBIL NAMA kecamatan YANG DI DATABASE
                        $kecamatan =mysql_query("SELECT * FROM kecamatan WHERE id_kab=$datajeng[id_kab] ORDER BY nama_kec");
                        while ($datakecamatan=mysql_fetch_array($kecamatan)) {
                         if ($datakecamatan['id_kec']==$datajeng['id_kec']) {
                           $cek ="selected";
                         }
                         else{
                          $cek= "";
                        }
                        echo "<option value=\"$datakecamatan[id_kec]\" $cek>$datakecamatan[nama_kec]</option>\n";
                      }
                      ?>
                    </select>
                  </div>
                </div>      


                <div class="item form-group">
                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_kel">Kelurahan <span class="required">*</span>
                 </label>
                 <div class="col-md-6 col-sm-6 col-xs-12">
                  <select readonly  type="text" class="form-control chzn-select col-md-7 col-xs-12" id="id_kel" name="id_kel" value="" required>
                    <option value="">-Pilih Kelurahan-</option>
                    <?php

                    //MENGAMBIL NAMA kecamatan YANG DI DATABASE
                    $kelurahan =mysql_query("SELECT * FROM kelurahan WHERE id_kec=$datajeng[id_kec] ORDER BY nama_kel");
                    while ($datakelurahan=mysql_fetch_array($kelurahan)) {
                     if ($datakelurahan['id_kel']==$rowks['id_kel']) {
                       $cek ="selected";
                     }
                     else{
                      $cek= "";
                    }
                    echo "<option value=\"$datakelurahan[id_kel]\" $cek>$datakelurahan[nama_kel]</option>\n";
                  }
                  ?>
                </select>
              </div>
            </div>      


            <div class="item form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat Rumah<span class="required">*</span>
             </label>

             <div class="col-md-6 col-sm-6 col-xs-12">
               <input readonly="readonly"  type="text" id="alamat" name="alamat" value="<?php echo $rowks['alamat'];?>" required="required" class="form-control col-md-7 col-xs-12">
               
             </div>
           </div>      



           <div class="item form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email<span class="required">*</span>
             </label>
             <div class="col-md-6 col-sm-6 col-xs-12">
               <input readonly="readonly"  type="text" id="email" name="email" value="<?php echo $rowks['email'];?>" class="form-control col-md-7 col-xs-12">
               
             </div>
           </div>      



           <div class="item form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_hp">No. HP<span class="required">*</span>
             </label>
             <div class="col-md-6 col-sm-6 col-xs-12">
               <input readonly="readonly"  type="text" id="no_hp" name="no_hp" value="<?php echo $rowks['no_hp'];?>" class="form-control col-md-7 col-xs-12">
               
             </div>
           </div>      



           <div class="item form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tahun_masuk">Tahun Masuk<span class="required">*</span>
             </label>
             <div class="col-md-6 col-sm-6 col-xs-12">
               <input readonly="readonly"  type="text" id="tahun_masuk" name="tahun_masuk" value="<?php echo $rowks['tahun_masuk'];?>" required="required" class="form-control col-md-7 col-xs-12">
               
             </div>
           </div>      



           <div class="item form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tahun_keluar">Tahun Keluar<span class="required">*</span>
             </label>
             <div class="col-md-6 col-sm-6 col-xs-12">
               <input readonly="readonly"  type="text" id="tahun_keluar" name="tahun_keluar" value="<?php echo $rowks['tahun_keluar'];?>" required="required" class="form-control col-md-7 col-xs-12">
              
             </div>
           </div> 


          
          <div style="text-align:center" class="form-actions no-margin-bottom">
            <ul class="uk-tab uk-tab-left" data-uk-tab="{connect:'#tabs_example2', animation: 'fade'}">

              <li class="uk-active hidden"><a href="#"></a></li>
              <li ><a href="#"> <button type="button"  class="btn btn-primary">Next >></button></a></li>

            </div>
          </li>

          <li>
            <div class="uk-panel uk-panel-box">    
              
              <table class="uk-table uk-table-hover  uk-table-condensed"><tr><td><code class="title">Data Wali Siswa</code></td><td></td><td></td><td></td><td width="70"><li></li></td> </tr></table>  
                             
              <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_bapak">Nama Bapak<span class="required">*</span>
               </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
                <input readonly="readonly" type="text" id="nm_bapak" name="nm_bapak" value="<?php echo $rowks['nm_bapak'];?>" required="required" class="form-control col-md-7 col-xs-12">
               
              </div>
            </div>

            <div class="item form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pekerjaan_bapak">Pekerjaan Bapak<span class="required">*</span>
             </label>
             <div class="col-md-6 col-sm-6 col-xs-12">
              <input readonly="readonly" type="text" id="pekerjaan_bapak" name="pekerjaan_bapak" value="<?php echo $rowks['pekerjaan_bapak'];?>" required="required" class="form-control col-md-7 col-xs-12">
              
            </div>
          </div>

          <div class="item form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gaji_bapak">Gaji Bapak<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input readonly="readonly" type="text" id="gaji_bapak" name="gaji_bapak" value="<?php echo $rowks['gaji_bapak'];?>" required="required" class="form-control col-md-7 col-xs-12">
          
          </div>
        </div>

        <div class="item form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nohp_bapak">Nomor Telepon<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
          <input readonly="readonly" type="text" id="nohp_bapak" name="nohp_bapak" value="<?php echo $rowks['nohp_bapak'];?>" required="required" class="form-control col-md-7 col-xs-12">
          
        </div>
      </div>

      <div class="item form-group">
       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nm_ibu">Nama Ibu<span class="required">*</span>
       </label>
       <div class="col-md-6 col-sm-6 col-xs-12">
        <input readonly="readonly" type="text" id="nm_ibu" name="nm_ibu" value="<?php echo $rowks['nm_ibu'];?>" required="required" class="form-control col-md-7 col-xs-12">
        
      </div>
    </div>


    <div class="item form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pekerjaan_ibu">Pekerjaan Ibu<span class="required">*</span>
     </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
      <input readonly="readonly" type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" value="<?php echo $rowks['pekerjaan_ibu'];?>" required="required" class="form-control col-md-7 col-xs-12">
    
    </div>
  </div>

  <div class="item form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gaji_ibu">Gaji Ibu<span class="required">*</span>
   </label>
   <div class="col-md-6 col-sm-6 col-xs-12">
    <input readonly="readonly" type="text" id="gaji_ibu" name="gaji_ibu" value="<?php echo $rowks['gaji_ibu'];?>" required="required" class="form-control col-md-7 col-xs-12">
 
  </div>
</div>

<div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nohp_ibu">Nomor Telepon<span class="required">*</span>
 </label>
 <div class="col-md-6 col-sm-6 col-xs-12">
  <input readonly="readonly" type="text" id="nohp_ibu" name="nohp_ibu" value="<?php echo $rowks['nohp_ibu'];?>" required="required" class="form-control col-md-7 col-xs-12">
  
</div>
</div>

<div class="item form-group">
 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat Rumah<span class="required">*</span>
 </label>
 <div class="col-md-6 col-sm-6 col-xs-12">
  <input readonly="readonly" type="text" id="alamat" name="alamat" value="<?php echo $rowks['alamat'];?>" required="required" class="form-control col-md-7 col-xs-12">
  
</div>
</div>







<div style="text-align:center" class="form-actions no-margin-bottom">
  <div class="uk-button-group" data-uk-switcher="{connect:'#tabs_example2'}">
    <button type="button"  class="btn btn-primary"><< Back</button> </div> </li>


  </div>

</li>


</ul>

</form>      
</tr>
</tbody>
</table>

</div></div>

</div>
</div>
</div>
</div>
</div>
</div>



</body>

<?php
// LOAD FOOTER
loadAssetsFoot();

ob_end_flush();
?>
