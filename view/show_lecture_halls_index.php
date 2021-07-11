
<?php require_once __SITE_PATH . '/view/_header1.php'; ?>
<form action="index.php?rt=reservation/delete" method="post">
<label for="table">
<table>
<?php 
    echo "<tr>";
    echo "<th>Prostorije</th>";
    echo "<th>Pocetak rezervacije</th>";
    echo "<th>Kraj rezervacije</th>";
    echo "<th></th>";
    echo "</tr>";

    for($i = 0;$i < sizeof($arr1); $i++) // sta je arr1
    { 
        echo "<tr>";
        echo "<td>";
        echo $arr1[$i]->title;
        echo "</td>";
        echo "<td>";
        echo $arr2[$i]->reservation_start; // zasto arr2?
        echo "</td>";
        echo "<td>";
        echo $arr2[$i]->reservation_end;
        echo "</td>";
        echo "<td>" ?>
        
        <input type="checkbox" name="delete" value="<?php echo $arr2[$i]->id_reservation; ?>">     
        <?php  echo  "</td>";                
        if($i > 0)
        {
            echo "<td>" ?>
            <button type="submit" name="button" value="Otkazi rezervaciju"></button>
            <?php   echo "</td>";
        }
        else  
          echo "<tr>";


    }
?>
</table>
</label>

</form>
<?php require_once __SITE_PATH . '/view/_footer.php'; ?>