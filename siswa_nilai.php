<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(0));

// TEMPLATE CONTROL
$ui_register_page = 'siswa_nilai';

// LOAD HEADER
loadAssetsHead('Daftar Nilai Siswa');

// FORM PROCESSING
// ... code here ...
?>
<?php $queryjikuksiswa  = mysql_query("SELECT * FROM siswa, kelas_siswa 
                                      where siswa.id_siswa=kelas_siswa.id_siswa
                                      and kelas_siswa.id_tahun='$_SESSION[id_tahun]'
                                      and kelas_siswa.id_siswa='$_SESSION[id_siswa]'
                                      "); 
                      $datasiswane=mysql_fetch_array($queryjikuksiswa);
                      $dataid_kelas_siswane=$datasiswane[id_kelas_siswa];
                      $dataid_kelase=$datasiswane[id_kelas];
                       ?>


<link rel="stylesheet" href="assets/tablesorter/style.css" />
<body>

  <?php
  // LOAD MAIN MENU
  loadMainMenu();
  ?>

  <div class="uk-container uk-container-center">

    <div class="uk-grid uk-margin-large-top" data-uk-grid-margin data-uk-grid-match>

      <div class="uk-width-medium-1-6 uk-hidden-small">
        <?php loadSidebar() ?>
      </div>

      <div class="uk-width-medium-5-6 tm-article-side">
        <article class="uk-article">    
    
      <div class="uk-vertical-align uk-text-right uk-height-1-1">
        <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="E-Learning SMK 4 Klaten" title="E-Learning SMK 4 Klaten">
      </div>
      
      <hr class="uk-article-divider">
          <h1 class="uk-article-title">Daftar Nilai Siswa <span class="uk-text-large">
      { Data Nilai }</span></h1>

          <br>


       <br><br>
      
        <div id="tablewrapper">
          <div id="tableheader">
            <div class="search">
              <select id="columns" onchange="sorter.search('query')"></select>
              <input type="text" id="query" onkeyup="sorter.search('query')" />
            </div>
            <span class="details">
              <div>Data <span id="startrecord"></span>-<span id="endrecord"></span> dari <span id="totalrecords"></span></div>
              <div><a href="javascript:sorter.reset()">(atur ulang)</a></div>
            </span>
          </div>
          <table cellpadding="0" cellspacing="0" border="0" id="table" class="table" width="100%" width="100%">
        
            <thead>
              <tr>

                          <th><h3 class="uk-text-center" >NO</h3></th>
                          <th><h3 class="uk-text-center" >Mata Pelajaran</h3></th>
                          <th><h3 class="uk-text-center" >Pengampu</h3></th>
                          <th><h3 class="uk-text-center" >Total Nilai Ulangan Harian   </h3></th>
                          <th><h3 class="uk-text-center" >Total Nilai Tugas  </h3></th>
                          <th><h3 class="uk-text-center" >UTS </h3></th>
                          <th><h3 class="uk-text-center" >UAS </h3></th>
                          <th><h3 class="uk-text-center" >Nilai Akhir</h3></th>                       
                          <th><h3 class="uk-text-center">Option</h3></th>
             </tr>
            </thead>
              <tbody>
              <?php 
              $query="SELECT distinct * from (
                      select guru.nm_guru,guru.id_guru, mapel.nm_mapel, mapel.kkm ,nilai.*
                      from nilai, mengajar, guru, mapel, jadwal
                      where nilai.kd_mapel=mengajar.kd_mapel
                      and mengajar.kd_mapel=mapel.kd_mapel
                      and mengajar.id_guru=guru.id_guru
                      and mengajar.id_mengajar=jadwal.id_mengajar
                      and nilai.id_tahun='$_SESSION[id_tahun]'
                      and nilai.id_kelas_siswa='$dataid_kelas_siswane'
                      ) asd ORDER BY nm_mapel ASC
                    ";
              $exe=mysql_query($query);
              $no=0;
              while ($rows=mysql_fetch_array($exe)) { $no++;
                  
                        $exesetup  = mysql_query("SELECT * FROM setup_nilai WHERE 
                           id_tahun='$_SESSION[id_tahun]'
                          and kd_mapel='$rows[kd_mapel]'
                          and id_kelas='$dataid_kelase'
                          and id_guru='$rows[id_guru]'
                          ");
                        $rowsetup=mysql_fetch_array($exesetup);
                        

                  $id_nilai=$rows[id_nilai]; 

                          $tugasakhir=($rows['t1']+$rows['t2']+$rows['t3']+$rows['t4']+$rows['t5']+$rows['t6']+$rows['t7'])/7;
                          $uhakhir=($rows['uh1']+$rows['uh2']+$rows['uh3']+$rows['uh4']+$rows['uh5']+$rows['uh6']+$rows['uh7'])/7;

                          $tugasakhirpersen=(($rows['t1']+$rows['t2']+$rows['t3']+$rows['t4']+$rows['t5']+$rows['t6']+$rows['t7'])/7) * $rowsetup[t]/100;
                          $uhakhirpersen=(($rows['uh1']+$rows['uh2']+$rows['uh3']+$rows['uh4']+$rows['uh5']+$rows['uh6']+$rows['uh7'])/7 ) * $rowsetup[uh]/100;
                          $utspersen=$rows[uts] * $rowsetup[uts]/100;
                          $uaspersen=$rows[uas] * $rowsetup[uas]/100;

                          $nilaiakhirfix=$tugasakhirpersen + $uhakhirpersen + $utspersen + $uaspersen;
                          $nilaiakhirfix=round($nilaiakhirfix,2);
                          
                ?>

                <div id="modal<?php echo $id_nilai ;?>" class="uk-modal">
                      <div class="uk-modal-dialog">
                        <button type="button" class="uk-modal-close uk-close"></button>
                        <div class="uk-modal-header">
                          <h2>Lihat Data Nilai <span class="value">{ KKM : <?php echo $rows[kkm];?> }</span></h2>
                        </div>
                        
                          <div class="form-group">
                            <label>Mata Pelajaran</label>
                            <input readonly onkeyup="convertAngka(this);" class="form-control" readonly name="nis" id="nis" value="<?php echo $rows['nm_mapel']; ?>"   required  />
                            
                          </div>

                          <div class="form-group">
                            <label>Guru Pengampu</label>
                            <input readonly class="form-control" name="nm_siswa" id="nm_siswa" readonly value="<?php echo $rows['nm_guru']; ?>"  required />
                                  
                          </div>

                          
                          <div class="form-group">
                            <label>Ulangan Harian 1</label>
                            <input readonly onkeyup="convertAngka(this);" class="form-control" name="uh1"  id="uh1" value="<?php echo $rows['uh1']; ?>"  required  />
                                <div class="reg-info">Contoh: 80</div>
                          </div>
                          <div class="form-group">
                            <label>Ulangan Harian 2</label>
                            <input readonly onkeyup="convertAngka(this);" class="form-control" name="uh1"  id="uh1" value="<?php echo $rows['uh1']; ?>"  required  />
                                <div class="reg-info">Contoh: 80</div>
                          </div>
                          <div class="form-group">
                            <label>Ulangan Harian 2</label>
                            <input readonly onkeyup="convertAngka(this);" class="form-control" name="uh2"  id="uh2" value="<?php echo $rows['uh2']; ?>"  required  />
                                <div class="reg-info">Contoh: 80</div>
                          </div>
                          <div class="form-group">
                            <label>Ulangan Harian 3</label>
                            <input readonly onkeyup="convertAngka(this);" class="form-control" name="uh3"  id="uh3" value="<?php echo $rows['uh3']; ?>"  required  />
                                <div class="reg-info">Contoh: 80</div>
                          </div>
                          <div class="form-group">
                            <label>Ulangan Harian 4</label>
                            <input readonly onkeyup="convertAngka(this);" class="form-control" name="uh4"  id="uh4" value="<?php echo $rows['uh4']; ?>"  required  />
                                <div class="reg-info">Contoh: 80</div>
                          </div>
                          <div class="form-group">
                            <label>Ulangan Harian 5</label>
                            <input readonly onkeyup="convertAngka(this);" class="form-control" name="uh5"  id="uh5" value="<?php echo $rows['uh5']; ?>"  required  />
                                <div class="reg-info">Contoh: 80</div>
                          </div>
                          <div class="form-group">
                            <label>Ulangan Harian 6</label>
                            <input readonly onkeyup="convertAngka(this);" class="form-control" name="uh6"  id="uh6" value="<?php echo $rows['uh6']; ?>"  required  />
                                <div class="reg-info">Contoh: 80</div>
                          </div>
                          <div class="form-group">
                            <label>Ulangan Harian 7</label>
                            <input readonly onkeyup="convertAngka(this);" class="form-control" name="uh7"  id="uh7" value="<?php echo $rows['uh7']; ?>"  required  />
                                <div class="reg-info">Contoh: 80</div>
                          </div>
                          <div class="form-group">
                            <label>Tugas 1</label>
                            <input readonly onkeyup="convertAngka(this);" class="form-control" name="t1"  id="t1" value="<?php echo $rows['t1']; ?>"  required  />
                                <div class="reg-info">Contoh: 80</div>
                          </div>
                          <div class="form-group">
                            <label>Tugas 2</label>
                            <input readonly onkeyup="convertAngka(this);" class="form-control" name="t2"  id="t2" value="<?php echo $rows['t2']; ?>"  required  />
                                <div class="reg-info">Contoh: 80</div>
                          </div>
                          <div class="form-group">
                            <label>Tugas 3</label>
                            <input readonly onkeyup="convertAngka(this);" class="form-control" name="t3"  id="t3" value="<?php echo $rows['t3']; ?>"  required  />
                                <div class="reg-info">Contoh: 80</div>
                          </div>
                          <div class="form-group">
                            <label>Tugas 4</label>
                            <input readonly onkeyup="convertAngka(this);" class="form-control" name="t4"  id="t4" value="<?php echo $rows['t4']; ?>"  required  />
                                <div class="reg-info">Contoh: 80</div>
                          </div>
                          <div class="form-group">
                            <label>Tugas 5</label>
                            <input readonly onkeyup="convertAngka(this);" class="form-control" name="t5"  id="t5" value="<?php echo $rows['t5']; ?>"  required  />
                                <div class="reg-info">Contoh: 80</div>
                          </div>
                          <div class="form-group">
                            <label>Tugas 6</label>
                            <input readonly onkeyup="convertAngka(this);" class="form-control" name="t6"  id="t6" value="<?php echo $rows['t6']; ?>"  required  />
                                <div class="reg-info">Contoh: 80</div>
                          </div>
                          <div class="form-group">
                            <label>Tugas 7</label>
                            <input readonly onkeyup="convertAngka(this);" class="form-control" name="t7"  id="t7" value="<?php echo $rows['t7']; ?>"  required  />
                                <div class="reg-info">Contoh: 80</div>
                          </div>
                          <div class="form-group">
                            <label>Ujian Tengah Semester</label>
                            <input readonly onkeyup="convertAngka(this);" class="form-control" name="uts"  id="uts" value="<?php echo $rows['uts']; ?>"  required  />
                                <div class="reg-info">Contoh: 80</div>
                          </div>
                          <div class="form-group">
                            <label>Ujian Akhir Semester</label>
                            <input readonly onkeyup="convertAngka(this);" class="form-control" name="uas"  id="uas" value="<?php echo $rows['uas']; ?>"  required  />
                                <div class="reg-info">Contoh: 80</div>
                          </div>
                          <div class="form-group">
                            <label>Nilai Akhir { KKM : <?php echo $rows[kkm];?> }</label>
                            <?php 
                            if ($nilaiakhirfix >= $rows[kkm]) {
                              $warna='success';
                            }else{
                              $warna='danger';
                            }
                            ?>
                            
                            <div class="uk-alert uk-alert-<?php echo $warna ?>" data-uk-alert="">
                               
                                <p><?php echo $nilaiakhirfix?> </p>
                            </div>
                                <div class="reg-info"><span class="value"></span></div>
                          </div>

                          <div class="uk-modal-footer uk-text-right">
                            <button type="button" class="uk-button uk-modal-close ">Cancel</button>
                           
                          </div>
                          <input readonly type="hidden" name="edit" value="edit">
                        

                      </div>
                    </div>
                          <tr>

                            <td><div class="uk-text-center"><?php echo $no?></div></td>
                            <td><div class="uk-text-center"><?php echo $rows[nm_mapel]?></div></td>
                            <td><div class="uk-text-left"><?php echo ucwords( strtolower($rows[nm_guru]))?></div></td>
                            
                            <td><div class="uk-text-center"><?php echo $uhnopersen=round($uhakhir,2) ;?></div></td>
                            <td><div class="uk-text-center"><?php echo round($tugasakhir,2);?></div></td>
                            <td><div class="uk-text-center"><?php if($rows[uts]==''){echo "0"; }else{echo $rows[uts];}?></div></td>
                            <td><div class="uk-text-center"><?php if($rows[uas]==''){echo "0"; }else{echo $rows[uas];}?></div></td>
                            <?php 
                            if ($nilaiakhirfix >= $rows[kkm]) {
                              $warna='<span class="uk-badge uk-badge-notification uk-badge-success">'.$nilaiakhirfix.'</span>';
                            }else{
                              $warna='<span class="uk-badge uk-badge-notification uk-badge-danger">'.$nilaiakhirfix.'</span>';
                            }
                            ?>

                            <td><div class="uk-text-center"><?php echo $warna;?></div></td>

                           
                            <td width="15%"><div class="uk-text-center">
                              <button class="uk-button" data-uk-modal="{target:'#modal<?php echo $id_nilai ;?>'}"><i class="uk-icon-search"></i></button>
                              

                            </td>
                         </tr>
                          <?php  } 
                          
                          ?>
                        </tbody>
                      </table>
          
          
                <!-- PAGINATION -->
                  <div id="tablefooter">
                    <div id="tablenav">
                      <div>
                        <img src="assets/tablesorter/images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
                        <img src="assets/tablesorter/images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
                        <img src="assets/tablesorter/images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
                        <img src="assets/tablesorter/images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
                      </div>
                      <div>
                        <select id="pagedropdown"></select>
                      </div>
                      <div>
                        <a href="javascript:sorter.showall()">Lihat semua</a>
                      </div>
                    </div>
                      <div id="tablelocation">
                      <div>
                        <span>Tampilkan</span>
                        <select onchange="sorter.size(this.value)">
                        <option value="5">5</option>
                          <option value="10" selected="selected">10</option>
                          <option value="20">20</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                        </select>
                        <span>Data Per halaman</span>
                      </div>
                        <div class="page">(Halaman <span id="currentpage"></span> dari <span id="totalpages"></span>)</div>
                      </div>
                  </div>
                <!-- END Pagination -->
        </div>
          
        </article>
    <br><br><br>
      </div>

    </div>
  </div>
  
  <!-- Table Sorter Script -->
  <script type="text/javascript" src="assets/tablesorter/script.js"></script>
  <script type="text/javascript">
    var sorter = new TINY.table.sorter('sorter','table',{
      headclass:'head',
      ascclass:'asc',
      descclass:'desc',
      evenclass:'evenrow',
      oddclass:'oddrow',
      evenselclass:'evenselected',
      oddselclass:'oddselected',
      paginate:true,
      size:20,
      colddid:'columns',
      currentid:'currentpage',
      totalid:'totalpages',
      startingrecid:'startrecord',
      endingrecid:'endrecord',
      totalrecid:'totalrecords',
      hoverid:'selectedrow',
      pageddid:'pagedropdown',
      navid:'tablenav',
      sortcolumn:0,
      sortdir:0,
      columns:[{index:7, format:' buah', decimals:1}],
      init:true
    });
  </script>
  <!-- END Table Sorter Script -->
  
</body>

<?php
// LOAD FOOTER
loadAssetsFoot();

ob_end_flush();
?>
