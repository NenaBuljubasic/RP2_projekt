<?php require_once __SITE_PATH . '/view/_header1.php'; ?>
    <form class="reservation" method="post" action="<?php echo __SITE_URL . '/index.php?rt=reservation/reserve'?>">
        <p>Datum: <input type="text" id="datepicker" name="date"></p>
        <p>
            <label for="start">Od:</label>

            <select name="start" id="start"> 
                <option value="08" name="08:00">08:00</option>
                <option value="09" name="09:00">09:00</option>
                <option value="10" name="10:00">10:00</option>
                <option value="11" name="11:00">11:00</option>
                <option value="12" name="12:00">12:00</option>
                <option value="13" name="13:00">13:00</option>
                <option value="14" name="14:00">14:00</option>
                <option value="15" name="15:00">15:00</option>
                <option value="16" name="16:00">16:00</option>
                <option value="17" name="17:00">17:00</option>
                <option value="18" name="18:00">18:00</option>
                <option value="19" name="19:00">19:00</option>
            </select>

            <label for="end">Do:</label>

            <select name="end" id="end">
                <option value="09" name="09:00">09:00</option>
                <option value="10" name="10:00">10:00</option>
                <option value="11" name="11:00">11:00</option>
                <option value="12" name="12:00">12:00</option>
                <option value="13" name="13:00">13:00</option>
                <option value="14" name="14:00">14:00</option>
                <option value="15" name="15:00">15:00</option>
                <option value="16" name="16:00">16:00</option>
                <option value="17" name="17:00">17:00</option>
                <option value="18" name="18:00">18:00</option>
                <option value="19" name="19:00">19:00</option>
                <option value="20" name="20:00">20:00</option>

            </select>

            <label for="hall">Prostorija:</label>

            <select name="hall" id="hall">
                <option value="001" name="hall">001</option>
                <option value="PR2" name="hall">Praktikum 2</option>
                <option value="002" name="hall">002</option>
                <option value="003" name="hall">10:00</option>
                <option value="004" name="hall">11:00</option>
                <option value="005" name="hall">12:00</option>
                <option value="006" name="hall">13:00</option>
                <option value="101" name="hall">14:00</option>
                <option value="102" name="hall">15:00</option>
                <option value="103" name="hall">16:00</option>
                <option value="104" name="hall">17:00</option>
                <option value="105" name="hall">18:00</option>
                <option value="107" name="hall">19:00</option>
                <option value="108" name="hall">20:00</option>
                <option value="PR3" name="hall">10:00</option>
                <option value="PR4" name="hall">10:00</option>
                <option value="PR5" name="hall">10:00</option>

            </select>


            

        </p>
        <!--<input type="radio" name="floor" value="0" /> Prizemlje <br />
        <input type="radio" name="floor" value="1" /> Prvi kat <br />
        <button type="sumbit" id="reserve" name="reserve">Rezerviraj</button>   <br/>--zasad ne
        
        <!--<canvas width="1000" height="500" id="cnv" style="border: solid 1px;"></canvas>  nisam uspila zasad-->

	</ul>
        <br>
    </form>
<script>
    $( function() {
    $( "#datepicker" ).datepicker();
  } );
$(document).ready(function(){                
                
    
    
});

        



 


</script>

           

       
<?php require_once __SITE_PATH . '/view/_footer.php'; ?>


