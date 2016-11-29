<!-- user login -->
<?php
require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(10));

// TEMPLATE CONTROL
$ui_register_page     = 'mengajar';
$ui_register_assets   = array('datepicker');

// LOAD HEADER
loadAssetsHead('Lihat Data Mengajar');

// FORM PROCESSING
// ... code here ...
?>
 <?php
            $sqll = "SELECT * FROM guru WHERE id_guru='$_GET[id]'";
            $resultl = mysql_query($sqll);
            $rowsl=mysql_fetch_array($resultl); 
            ?> 

<link rel="stylesheet" href="assets/tablesorter/style.css" />
<body>

  <?php
  // LOAD MAIN MENU
  loadMainMenu();
  ?>

  <div id="modaltambah" class="uk-modal">
                        <div class="uk-modal-dialog">
                          <button type="button" class="uk-modal-close uk-close"></button>
                          <div class="uk-modal-header">
                            <h2>Tambah Data Mengajar </h2>
                          </div>

                          <form role="form" method="post" action="mengajar.action?act=tambah" enctype="multipart/form-data" >
                            <div class="form-group">
                              <label>NIP. </label>
                              <input class="form-control" name="nip" value="<?php echo $rowsl['nip']; ?>" readonly  required  />
                              <input class="form-control" type="hidden" name="id_guru" value="<?php echo $rowsl['id_guru'];  ?>" readonly  required  />
                              <input class="form-control" type="hidden" name="id_mengajar" value="<?php echo $rowsl['id_guru'];  ?>" readonly  required  />
                            </div>

                            <div class="form-group">
                              <label>Nama Pengajar</label>
                              <input class="form-control" name="nm_penerima" value="<?php echo $rowsl['nm_guru']; ?>" readonly required  />
                            </div>


                            <div class="form-group">
                              <label>Mata Pelajaran</label>
                              <select class="form-control" name="mapel" required id="mapel">
                                <?php

                                $cekmapel =mysql_query("SELECT * FROM mapel ");
                                while ($datamapel=mysql_fetch_array($cekmapel)) {
                                 

                               echo "<option value=\"$datamapel[kd_mapel]\" >$datamapel[nm_mapel]</option>";
                                }
                                ?>
                              </select>
                            </div>

                            <div class="form-group">
                              <label>Kelas</label>
                              <select class="form-control" name="kelas" required id="kelas">
                                <?php

                                $cekkelas =mysql_query("SELECT * FROM kelas ");
                                while ($datakelas=mysql_fetch_array($cekkelas)) {
                                

                               echo "<option value=\"$datakelas[id_kelas]\" >$datakelas[id_kelas]</option>";
                                }
                                ?>
                              </select>
                            </div>

                            <div class="uk-modal-footer uk-text-right">
                              <button type="button" class="uk-button uk-modal-close ">Cancel</button>
                              <button type="submit" class="uk-button uk-button-primary">Save</button>
                            </div>
                              <input type="hidden" name="edit" value="edit">
                          </form>

                        </div>
                      </div>

  <div class="uk-container uk-container-center">

    <div class="uk-grid uk-margin-large-top" data-uk-grid-margin data-uk-grid-match>

      <div class="uk-width-medium-1-6 uk-hidden-small">
        <?php loadSidebar() ?>
      </div>

      <div class="uk-width-medium-5-6 tm-article-side">
        <article class="uk-article">    

          <div class="uk-vertical-align uk-text-right uk-height-1-1">
            <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="" title="">
          </div>

          <hr class="uk-article-divider">
          <h1 class="uk-article-title">Data Mengajar  <span class="uk-text-large">
            <?php  if (isset($_SESSION['administrator'])) {?>
            { Master Data }</span></h1>
            <?php  }?>
            <br>
            <?php
            $sqll = "SELECT * FROM guru WHERE id_guru='$_GET[id]'";
            $resultl = mysql_query($sqll);
            $rowsl=mysql_fetch_array($resultl); 
            ?> 
            <br>
            <a href="./guru" class="uk-button uk-button-primary uk-margin-bottom" type="button" title="Kembali ke Manajemen Guru"><i class="uk-icon-angle-left"></i> Kembali</a>
            <?php if (isset($_SESSION['administrator'])) { ?>

            <button  data-uk-modal="{target:'#modaltambah'}" class="uk-button uk-button-success" type="button" title="Tambah Data Mengajar"><i class="uk-icon-plus"></i> Mengajar</button>
            <?php } ?>
            <br>
            <br>
            <br>
            <div class="uk-panel uk-panel-box">
              <div class="uk-overflow-container">
                <table class="uk-table uk-table-condensed uk-text-nowrap">
                  <thead>
                    <tr>
                      <th class="uk-width-1-4">Data Pengampu </th>
                      <th class="uk-width-3-4"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>NIP.</td>
                      <td><?php echo $rowsl['nip'];?></td>
                    </tr>
                    <tr>
                      <td>Nama Guru</td>
                      <td><?php echo $rowsl['nm_guru'];?></td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
            <br>


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

              <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
                <thead>
                  <tr>


                    <th><h3 class="uk-text-center">Mata Pelajaran</h3></th>
                    <th><h3 class="uk-text-center">Kelas yang Diampu</h3></th>
                    <?php if (isset($_SESSION['administrator'])) { ?>
                    <th><h3 class="uk-text-center">Aksi</h3></th>
                    <?php }?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query="SELECT * FROM mengajar
                  INNER JOIN guru ON guru.id_guru = mengajar.id_guru
                  INNER JOIN mapel ON mapel.kd_mapel = mengajar.kd_mapel
                  INNER JOIN kelas ON kelas.id_kelas = mengajar.id_kelas
                  WHERE mengajar.id_guru = '$_GET[id]'";
                  $query=mysql_query($query); 
                  $no=0;
                  while ($data=mysql_fetch_array($query)) { $no++; 

                    $id_mengajar = $data['id_mengajar'];
                    $id_guru = $data['id_guru'];
                    $nip = $data['nip'];
                    $nm_guru = $data['nm_guru'];   
                    $nm_mapel = $data['nm_mapel'];   
                    $id_kelas = $data['nm_kelas'];   
                    ?>
                    <tr>

                      <div id="modal<?php echo $id_mengajar ;?>" class="uk-modal">
                        <div class="uk-modal-dialog">
                          <button type="button" class="uk-modal-close uk-close"></button>
                          <div class="uk-modal-header">
                            <h2>Edit Data Mengajar</h2>
                          </div>
                          <form role="form" method="post" action="mengajar.action?act=update&&id_meng=<?php echo $id_mengajar;  ?>" enctype="multipart/form-data" >
                            <div class="form-group">
                              <label>NIP. </label>
                              <input class="form-control" name="nip" value="<?php echo $nip; ?>" readonly  required  />
                              <input class="form-control" type="hidden" name="id_guru" value="<?php echo $id_guru;  ?>" readonly  required  />
                              <input class="form-control" type="hidden" name="id_mengajar" value="<?php echo $id_mengajar;  ?>" readonly  required  />
                            </div>

                            <div class="form-group">
                              <label>Nama Pengajar</label>
                              <input class="form-control" name="nm_penerima" value="<?php echo $nm_guru; ?>" readonly required  />
                            </div>


                            <div class="form-group">
                              <label>Mata Pelajaran</label>
                              <select class="form-control" name="mapel" required id="mapel">
                                <?php

                                $cekmapel =mysql_query("SELECT * FROM mapel ");
                                while ($datamapel=mysql_fetch_array($cekmapel)) {
                                 if ($datamapel['kd_mapel']==$data['kd_mapel']) {
                                   $cek ="selected";
                                 }
                                 else{
                                  $cek= "";
                                }

                               echo "<option value=\"$datamapel[kd_mapel]\" $cek>$datamapel[nm_mapel]</option>";
                                }
                                ?>
                              </select>
                            </div>

                            <div class="form-group">
                              <label>Kelas</label>
                              <select class="form-control" name="kelas" required id="kelas">
                                <?php

                                $cekkelas =mysql_query("SELECT * FROM kelas ");
                                while ($datakelas=mysql_fetch_array($cekkelas)) {
                                 if ($datakelas['id_kelas']==$data['id_kelas']) {
                                   $cek ="selected";
                                 }
                                 else{
                                  $cek= "";
                                }

                               echo "<option value=\"$datakelas[id_kelas]\" $cek>$datakelas[id_kelas]</option>";
                                }
                                ?>
                              </select>
                            </div>

                            <div class="uk-modal-footer uk-text-right">
                              <button type="button" class="uk-button uk-modal-close ">Cancel</button>
                              <button type="submit" class="uk-button uk-button-primary">Save</button>
                            </div>
                              <input type="hidden" name="edit" value="edit">
                          </form>

                        </div>
                      </div>

                      <td><div class="uk-text-center"><?php echo $nm_mapel?></div></td>
                      <td><div class="uk-text-center"><?php echo $id_kelas?></div></td>
                      <?php if (isset($_SESSION['administrator'])) { ?>
                      <td><div class="uk-text-center">
                       <button class="uk-button" data-uk-modal="{target:'#modal<?php echo $id_mengajar ;?>'}"><i class="uk-icon-pencil"></i></button>
                       <a href="mengajar.action?act=hapus&&id_mengajars=<?php echo $id_mengajar; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" title="Hapus" data-uk-tooltip="{pos:'top-left'}" class="uk-button uk-button-small uk-button-danger"><i class="uk-icon-remove"></i></a>

                     </div>
                   </td>
                   <?php } ?>            
                 </tr>
                 <?php  } ?>
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
