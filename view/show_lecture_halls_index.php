
<?php require_once __SITE_PATH . '/view/_header.php'; ?>
<form action="index.php?rt=reservation/delete" method="post">
<label for="table">
<table>
<?php 
 echo "<tr>";
 echo "<th>Prostorije</th>";
 echo "<th>Pocetak rezervacije</th>";
 echo "<th>Kraj rezervacije</th>";
 echo "<th>Otkazi:</th>";
 echo "</tr>";

for($i=0;$i<sizeof($arr1);$i++)
     { echo "<tr>";
       echo "<td>";
       echo $arr1[$i]->title;
       echo "</td>";
       echo "<td>";
       echo $arr2[$i]->reservation_start;
       echo "</td>";
       echo "<td>";
       echo $arr2[$i]->reservation_end;
       echo "</td>";
       echo "<td>" ?>
       
        <input type="checkbox" name="delete" value="<?php echo $arr2[$i]->id_reservation; ?>">     
         <?php  echo  "</td>";                

       echo "</tr>";
     }
?>
</table>
</label>
<input type="submit" name="button" value="Otkazi rezervaciju">
</form>
<?php require_once __SITE_PATH . '/view/_footer.php'; ?>