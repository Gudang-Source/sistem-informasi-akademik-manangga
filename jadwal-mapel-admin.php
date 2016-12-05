<?php
session_start();

require ( __DIR__ . '/init.php');
checkUserAuth();
checkUserRole(array(0,1,2,10));

// TEMPLATE CONTROL
$ui_register_page = 'jadwal-mapel-admin';

// LOAD HEADER
loadAssetsHead('Master Data Jadwal Mata Pelajaran');

$id_tahun=$_SESSION['id_tahun'];
// FORM PROCESSING
// ... code here ...
    // validation form kosong
$pesanError= array();
if (trim($guru)=="") {
  $pesanError[]="Data <b>Guru</b> Masih Kosong.";
}
if (trim($kd_mapel)=="") {
  $pesanError[]="Data <b>Mata Pelajaran</b> Masih Kosong.";
}
if (trim($kkm)=="") {
  $pesanError[]="Data <b>KKM</b> Masih Kosong.";
}
?>
<script type="text/javascript">

function asd(){
    var id_guru = $("#guru").val();
    $.ajax({
      url: "inc/jikuk_mapel_mengajar.php",
      data: "id_guru="+id_guru,
      cache: false,
      success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
           // $("modaltambah #kd_mapel").html(msg);
            $('#modaltambah select[name="kd_mapel"]').html(msg);
            $('select[name="kd_mapel"]').html(msg);
          }
        });
  }
  function asdedit(){
    var id_guru = $("#guru").val();
    $.ajax({
      url: "inc/jikuk_mapel_mengajar.php",
      data: "id_guru="+id_guru,
      cache: false,
      success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
           // $("modaltambah #kd_mapel").html(msg);
            $('#modaltambah select[name="kd_mapel"]').html(msg);
            $('select[name="kd_mapel"]').html(msg);
          }
        });
  }

  function jikukkelas(){
    var id_guru = $("#guru").val();
    var kd_mapel = $("#kd_mapel").val();
    $.ajax({
      url: "inc/jikuk_kelas_mengajar.php",
      data: "kd_mapel="+kd_mapel+"&id_guru="+id_guru,
      cache: false,
      success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
           // $("modaltambah #kd_mapel").html(msg);
            $('#modaltambah select[name="id_kelas"]').html(msg);
          }
        });
  }

   function jikuksesi(){
    var id_guru = $("#guru").val();
    var kd_mapel = $("#kd_mapel").val();
    var id_kelas = $("#id_kelas").val();
    var id_hari = $("#id_hari").val();
    $.ajax({
      url: "inc/jikuk_sesi_mengajar.php",
      data: "kd_mapel="+kd_mapel+"&id_guru="+id_guru+"&id_kelas="+id_kelas+"&id_hari="+id_hari,
      cache: false,
      success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
           // $("modaltambah #kd_mapel").html(msg);
            $('#modaltambah select[name="id_hari"]').html(msg);
          }
        });
  }
 // });
</script>
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
            <img class="uk-margin-bottom" width="500px" height="50px" src="assets/images/banner.png" alt="" title="">
          </div>

          <hr class="uk-article-divider">
          <h1 class="uk-article-title">Master Jadwal Mata Pelajaran <span class="uk-text-large">
            <?php  if (isset($_SESSION['administrator'])) {?>
            { Master Data }</span></h1>
            <?php  }?>
            <br>
            <?php if (isset($_SESSION['administrator'])) { ?>
            <button  data-uk-modal="{target:'#modaltambah'}" class="uk-button uk-button-success" type="button" title="Tambah Data Mata Pelajaran"><i class="uk-icon-plus"></i> Mata Pelajaran</button>
            <?php } ?>
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
              <table id="table" class="uk-table uk-table-hover uk-table-striped uk-table-condensed" width="100%" width="100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Mata Pelajaran</th>
                    <th>Kelas</th>
                    <th>Hari</th>
                    <th>Jam Ke</th>
                    <th>Tahun Ajaran</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>

                  <div id="modaltambah" class="uk-modal">
                    <div class="uk-modal-dialog">
                      <button type="button" class="uk-modal-close uk-close"></button>
                      <div class="uk-modal-header">
                        <h2>Tambah Data Jadwal Mata Pelajaran</h2>
                      </div>
                      <form role="form" id="formmapel" action="jadwal.action?act=tambah" enctype="multipart/form-data" method="POST" >
                        <div class="form-group">
                          <label>Nama Guru</label>
                          <script type="text/javascript">
                          function nglebokkenilaiidguru(){
                            $('#id_gurus').val($('#id_guru').val('#id_guru'));
                          }
                          </script>
                          <input type="text" name="guru" id="guru" onkeyup="asd()" class="form-control" placeholder="Cari Nama / NIP" />  
                          <input type="hidden" name="id_gurus" id="id_gurus"  class="form-control" />  
                       
                         
                          <div id="guruList"></div>  
                        </div>

                        <div class="form-group">
                          <label>Mata Pelajaran</label>
                            <select name="kd_mapel"  id="kd_mapel" value="" onchange="jikukkelas()" class="form-control">
                              <option value="">--- Pilih Mapel --</option>
                            </select>
                          <div class="reg-info">Contoh: Bahasa Sunda</div>
                        </div>

                        <div class="item form-group">
                           <label>Pilih Kelas<span class="required">*</span></label>
                             <div>
                              <select name="id_kelas" id="id_kelas" class="form-control">
                                 <option value=""> Pilih Kelas </option>
                                
                              </select>
                            </div>
                        </div>

                        <div class="item form-group">
                           <label>Pilih Hari<span class="required">*</span></label>
                             <div>
                              <select name="id_hari" id="id_hari" class="form-control">
                                 <option value="">--- Pilih Hari --</option>
                                 <?php
                                 $query = "SELECT * from hari";
                                 $hasil = mysql_query($query);
                                 while ($data = mysql_fetch_array($hasil))
                                 {
                                    echo "<option value=".$data['id_hari'].">".$data['nm_hari']."</option>";
                                  }
                                  ?>
                              </select>
                            </div>
                        </div>
                        <div class="item form-group">
                           <label>Pilih Jam Pelajaran<span class="required">*</span></label>
                             <div>
                              <select name="id_sesi" id="id_sesi" class="form-control">
                                 <option value="">--- Pilih Jam Pelajaran --</option>
                                 <?php
                                 $query = "SELECT * from sesi";
                                 $hasil = mysql_query($query);
                                 while ($data = mysql_fetch_array($hasil))
                                 {
                                    echo "<option value=".$data['id_sesi'].">".$data['jam']."</option>";
                                  }
                                  ?>
                              </select>
                            </div>
                        </div>
                        <div class="uk-modal-footer uk-text-right">
                          <button type="button" class="uk-button uk-modal-close ">Cancel</button>
                          <button type="submit" class="uk-button uk-button-primary">Save</button>
                        </div>
                        <input type="hidden" name="tambah" value="tambah">
                      </form>

                    </div>
                  </div>

                  <?php 

                  $query="SELECT guru.nm_guru, guru.nip , jadwal.id_jadwal_mapel, mapel.kd_mapel,mengajar.id_mengajar, mapel.nm_mapel, kelas.nm_kelas, hari.nm_hari, sesi.jam, tahun_ajaran.thn_ajaran, tahun_ajaran.semester, mengajar.id_guru FROM jadwal, sesi, hari, mengajar, mapel, guru, kelas, tahun_ajaran 
                  		where jadwal.id_mengajar=mengajar.id_mengajar 
                  		and jadwal.id_sesi=sesi.id_sesi
                  		and jadwal.id_hari=hari.id_hari
                  		and mengajar.id_guru=guru.id_guru
                  		and mengajar.id_kelas=kelas.id_kelas
                  		and mengajar.kd_mapel=mapel.kd_mapel
                  		and jadwal.id_tahun=tahun_ajaran.id_tahun
                  		and jadwal.id_tahun='$id_tahun' 
                  		order by hari.nm_hari asc";
                  $exe=mysql_query($query);
                  $no=0;
                  while ($row=mysql_fetch_array($exe)) { $no++;

                    $id_jadwal=$row['id_jadwal'];
                    $id_gurumengajar=$row[mengajar.id_guru];
                    ?>



                    <div id="modal<?php echo $id_jadwal ;?>" class="uk-modal">
                      <div class="uk-modal-dialog">
                        <button type="button" class="uk-modal-close uk-close"></button>
                        <div class="uk-modal-header">
                          <h2>Lihat Data Mata Pelajaran</h2>
                        </div>
                        
                        <div class="form-group">
                          <label>Kode Mata Pelajaran</label>
                          <input class="form-control" name="kd_mapel" id="kd_mapel" value="<?php echo $row['kd_mapel']; ?>" readonly  required  />

                        </div>

                        <div class="form-group">
                          <label>Mata Pelajaran</label>
                          <input class="form-control" name="nm_mapel" id="nm_mapel" value="<?php echo $row['nm_mapel']; ?>" readonly required />
                        </div>

                        <div class="form-group">
                          <label>KKM Mata Pelajaran</label>
                          <input class="form-control" name="kkm"  id="kkm" value="<?php echo $row['kkm']; ?>" readonly required  />
                        </div>

                        <div class="uk-modal-footer uk-text-right">
                          <button type="button" class="uk-button uk-modal-close ">Cancel</button>
                          <button data-uk-modal="{target:'#modaledit<?php echo $id_jadwal ;?>'}" class="uk-button uk-button-primary">Edit</button>
                        </div>


                      </div>
                    </div>

                    <div id="modaledit<?php echo $id_jadwal ;?>" class="uk-modal">
                     <script>  
           $(document).ready(function(){  
            $('#guruedit').keyup(function(){  
             var query = $(this).val();  
             if(query != '')  
             {  
              $.ajax({  
               url:"remote/search_nip.php",  
               method:"POST",  
               data:{query:query},  
               success:function(data)  
               {  
                $('#guruList').fadeIn();  
                $('#guruList').html(data);  
              }  
            });  
            }  
          });  
            $(document).on('click', 'li', function(){  
             $('#guru').val($(this).text());  
             $('#guruList').fadeOut();  
             $ak=$('#id_gurus').val($(this).html());
             $('#id_gurus1').val($('#id_guruq').val());
             $('#id_gurus12').val($('#id_gurus1').val());
              asd()
           });  
          });  
         </script>
                      <div class="uk-modal-dialog">
                        <button type="button" class="uk-modal-close uk-close"></button>
                        <div class="uk-modal-header">
                          <h2>Edit Data Mata Pelajaran</h2>
                        </div>
                        <form role="form" method="post" action="jadwal.action?act=update&&id_jadwal=<?php echo $id_jadwal;  ?>" enctype="multipart/form-data" >
                         <div class="form-group">
                          <label>Nama Guru</label>
                          <script type="text/javascript">
                          function nglebokkenilaiidguru(){
                            $('#id_gurus').val($('#id_guru').val('#id_guru'));
                          }
                          </script>
                          <input type="text" name="guru" id="guruedit" onkeyup="asdedit()" value="<?php echo ucwords($row["nm_guru"]).' {' .$row["nip"]. ' }' ?>" class="form-control" placeholder="Cari Nama / NIP" />  
                          <input type="hidden" name="id_gurus" id="id_gurus"  class="form-control" />  
                       
                         
                          <div id="guruList"></div>  
                        </div>

                        <div class="form-group">
                          <label>Mata Pelajaran</label>
                            <select name="kd_mapel"  id="kd_mapel" onchange="jikukkelas()" class="form-control">
                              <option value="">--- Pilih Mapel --</option>
                              	<?php
                   
                            $mapels =mysql_query("SELECT kd_mapel, nm_mapel FROM mapel where kd_mapel in (SELECT mapel.kd_mapel FROM mapel left join mengajar on mengajar.kd_mapel=mapel.kd_mapel 
					where mengajar.id_guru='$row[id_guru]' 
					) order by nm_mapel asc");
                            while ($datamapel=mysql_fetch_array($mapels)) {
                             if ($datamapel['kd_mapel']==$row['kd_mapel']) {
                               $cek ="selected";
                             }
                             else{
                              $cek= "";
                            }
                            echo "<option value=\"$datamapel[kd_mapel]\" $cek>$datamapel[nm_mapel]</option>\n";
                          }
                          ?>
                            </select>
                          <div class="reg-info">Contoh: Bahasa Sunda</div>
                        </div>

                        <div class="item form-group">
                           <label>Pilih Kelas<span class="required">*</span></label>
                             <div>
                              <select name="id_kelas" id="id_kelas" class="form-control">
                                 <option value=""> Pilih Kelas </option>
                                
                              </select>
                            </div>
                        </div>

                        <div class="item form-group">
                           <label>Pilih Hari<span class="required">*</span></label>
                             <div>
                              <select name="id_hari" id="id_hari" class="form-control">
                                 <option value="">--- Pilih Hari --</option>
                                 <?php
                                 $query = "SELECT * from hari";
                                 $hasil = mysql_query($query);
                                 while ($data = mysql_fetch_array($hasil))
                                 {
                                    echo "<option value=".$data['id_hari'].">".$data['nm_hari']."</option>";
                                  }
                                  ?>
                              </select>
                            </div>
                        </div>
                        <div class="item form-group">
                           <label>Pilih Jam Pelajaran<span class="required">*</span></label>
                             <div>
                              <select name="id_sesi" id="id_sesi" class="form-control">
                                 <option value="">--- Pilih Jam Pelajaran --</option>
                                 <?php
                                 $query = "SELECT * from sesi";
                                 $hasil = mysql_query($query);
                                 while ($data = mysql_fetch_array($hasil))
                                 {
                                    echo "<option value=".$data['id_sesi'].">".$data['jam']."</option>";
                                  }
                                  ?>
                              </select>
                            </div>
                        </div>
                        <div class="uk-modal-footer uk-text-right">
                          <button type="button" class="uk-button uk-modal-close ">Cancel</button>
                          <button type="submit" class="uk-button uk-button-primary">Save</button>
                        </div>
                        <input type="hidden" name="tambah" value="tambah">
                      </form>

                      </div>
                    </div>


                    

                    <tr>
                      <td><?php echo $no;?></td>
                      <td><?php echo $row[nm_guru]?></td>
                      <td><?php echo $row[nip]?></td>
                      <td><?php echo $row[nm_mapel]?></td>
                      <td><?php echo $row[nm_kelas]?></td>
                      <td><?php echo $row[nm_hari]?></td>
                      <td><?php echo $row[jam]?></td>
                      <td><?php echo $row[thn_ajaran]?></td>
                      <td><?php echo $row[semester]?></td>                

                      <?php if (isset($_SESSION['administrator'])) { ?>
                      <td>
                        <button class="uk-button" data-uk-modal="{target:'#modal<?php echo $id_jadwal ;?>'}"><i class="uk-icon-search"></i></button>
                        <button class="uk-button" data-uk-modal="{target:'#modaledit<?php echo $id_jadwal ;?>'}"><i class="uk-icon-pencil"></i></button>
                        <a href="jadwal.action?act=hapus&&id_jadwal=<?php echo $id_jadwal; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" title="Hapus" data-uk-tooltip="{pos:'top-left'}" class="uk-button uk-button-small uk-button-danger"><i class="uk-icon-remove"></i></a>

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

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
            <style>  
             ul.jenglot{  
              background-color:#eee;  
              cursor:pointer;  
            }  
            li.jenglot{  
              padding:12px;  
            }  
          </style>  <br /><br />  
          

          <script>  
           $(document).ready(function(){  
            $('#guru').keyup(function(){  
             var query = $(this).val();  
             if(query != '')  
             {  
              $.ajax({  
               url:"remote/search_nip.php",  
               method:"POST",  
               data:{query:query},  
               success:function(data)  
               {  
                $('#guruList').fadeIn();  
                $('#guruList').html(data);  
              }  
            });  
            }  
          });  
            $(document).on('click', 'li', function(){  
             $('#guru').val($(this).text());  
             $('#guruList').fadeOut();  
             $ak=$('#id_gurus').val($(this).html());
             $('#id_gurus1').val($('#id_guruq').val());
             $('#id_gurus12').val($('#id_gurus1').val());
              asd()
           });  
          });  
         </script>  

       </article>
       <br><br><br>
     </div>

   </div>
 </div>

 <script src="assets/validator/js/bootstrapValidator.min.js" type="text/javascript"></script>
 <link rel="stylesheet" href="vendor/formvalidation/css/formValidation.min.css">
 <script src="vendor/formvalidation/js/formValidation.min.js"></script>
 <script src="vendor/formvalidation/js/framework/uikit.min.js"></script>




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
