<?php


include "../config.php";
 
 
 if(isset($_POST['query']))  
 {  
 	  $keyword = strtolower($_POST["query"]);
      $output = '';  
      $query = "SELECT * FROM guru WHERE  LOWER (nm_guru) LIKE '%$keyword%' OR LOWER (nip) LIKE '%$keyword%' ";  
      $result = mysql_query($query);  
      $output = '<ul class="jenglot">';  
      if(mysql_num_rows($result) > 0)  
      {  
           while($row = mysql_fetch_array($result))  
           {  
                $output .= '<li class="jenglot">'.ucwords($row["nm_guru"]).' {' .$row["nip"]. ' } <input type="hidden" name="id_guruq" id="id_guruq" value="'.$row["id_guru"].'"> </li>';  
              
           }  
      }  
      else  
      {  
           $output .= '<li class="jenglot">Data Tidak Ditemukan</li>';  
      }  
      $output .= '</ul>';  
      echo $output;  
 }  
 ?>  

