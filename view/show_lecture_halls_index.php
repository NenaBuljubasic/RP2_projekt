
<?php require_once __SITE_PATH . '/view/_header.php'; ?>
<?php require_once __SITE_PATH . '/view/toolbar_index.php'; ?>
<form action="index.php?rt=reservation/delete" method="post">
    <div id="wrapper">
            <label for="table">
            <table>
            <?php 
            
                echo "<tr>";
                echo "<th>Prostorije</th>";
                echo "<th>Pocetak rezervacije</th>";
                echo "<th>Kraj rezervacije</th>";
                echo "<th></th>";
                echo "</tr>";
            if(sizeof($arr1))
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
                    
                    <input type="checkbox" name="<?php echo $arr2[$i]->id_reservation; ?>" value="">     
                    <?php  echo  "</td>";                
                echo  "</tr>";  
                }

            ?>
            </table>
            </label>
            <input type="submit" name="button" value="Izbrisi rezervaciju">
    </div>
</form>
<?php require_once __SITE_PATH . '/view/_footer.php'; ?>