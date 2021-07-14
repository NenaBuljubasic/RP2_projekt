<?php require_once __SITE_PATH . '/view/_header1.php'; ?>
<?php require_once __SITE_PATH . '/view/toolbar_index.php'; ?>
<form class="reservation" method="post" action="<?php echo __SITE_URL . '/index.php?rt=reservation/reserve'?>" >
    <div id="wrapper">
        Datum: <input type="text" id="datepicker" name="date">

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
                <option value="003" name="hall">003</option>
                <option value="004" name="hall">004</option>
                <option value="005" name="hall">005</option>
                <option value="006" name="hall">006</option>
                <option value="101" name="hall">101</option>
                <option value="102" name="hall">102</option>
                <option value="103" name="hall">103</option>
                <option value="104" name="hall">104</option>
                <option value="105" name="hall">105</option>
                <option value="107" name="hall">107</option>
                <option value="108" name="hall">108</option>
                <option value="PR3" name="hall">Praktikum 3</option>
                <option value="PR4" name="hall">Praktikum 4</option>
                <option value="PR5" name="hall">Praktikum 5</option>

            </select>


            
            <br/>
        <input type="radio" name="floor" value="0" id="radio"/> Prizemlje <br />
        <input type="radio" name="floor" value="1" id="radio"/> Prvi kat <br />
     
        
        
        <canvas width="1000" height="500" id="cnv" style="border: solid 1px;"></canvas>
        <br/>
        <button type="sumbit" id="reserve" name="reserve">Rezerviraj</button> 
   
        

	</ul>
        <br>       
    

</div>  
</form>
<script>
    $( function() {
    $( "#datepicker" ).datepicker();
    } );
    $(document).ready(function(){  
        $("input[name='floor']").change(draw);   
        $("#cnv").on('click', info);        
    });

    var brojac = 0;
    var current_floor = -1; 
    var canvas = $( "#cnv" ).get(0);
    var ctx = canvas.getContext( "2d" );
    
    function info()
    {
        
        if(brojac > 0)
            $( "#balon" ).remove();
        brojac = 1;
        
        var div = $( "<div></div>" );
        var rect = this.getBoundingClientRect();    
        var x = event.clientX - rect.left, y = event.clientY - rect.top;
        
        var odabrana = 0;

        if(! $("input[name=floor]").is(':checked') )
            return;
        var kat = $('input[name=floor]:checked').val();
        
        
        $.ajax(
        {
            url: location.protocol + "//" + location.hostname  + location.pathname.replace('index.php', '') + '/model/floors1.php',
            data: { floor:kat , x:x, y:y},
            //dataType: "json",
            type:"POST",
            success: function( data )
            {
                console.log(data);
                clicked = data.hall; //sad iz baze proÄŤitat kapacitet!
                capacity = data.capacity;
                //alert("Ĺ˝elite li");
                div
                    .prop( "id", "balon" )
                    .css(
                    {
                        "position": "absolute",
                        "left": x + rect.left + 20,
                        "top": y + rect.top + 20,
                        "border": "solid 1px",
                        "background-color": "rgb(245, 245, 255)",
                        "padding": "5px"
                    } )
                    .html(
                        "Kapacitet prostorije " + clicked + ": " + capacity //gore poÄŤitat koordinate i lipo vratit kapacitet toÄŤan
                    );

                $( "body" ).append( div );
                return;
                        
                
                
                
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        }
        );
               
    }

    function draw()
    {
        if(brojac > 0)
            $( "#balon" ).remove();
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        var kat = $('input[name=floor]:checked').val();
        /*if( (kat != 0) || (kat != 1))
            kat = 0;*/
        current_floor = kat;


        $.ajax(
        {
            url: location.protocol + "//" + location.hostname  + location.pathname.replace('index.php', '') + '/app/floors.php',
            type:"POST",
            data: { floor:kat },
            //dataType: "json",
            success: function( data )
            {
                console.log(data);
                //console.log( data.floor.length);
                for(var i = 0; i < data.floor.length; i++)
                {
                    ctx.beginPath();
                    ctx.rect(data.floor[i]['koordinata_x'], data.floor[i]['koordinata_y'], data.floor[i]['duljina'], data.floor[i]['sirina']);
                    ctx.stroke(); 
                    ctx.fillText(data.floor[i]['prostorija'],data.floor[i]['koordinata_x']+(data.floor[i]['duljina']/2),data.floor[i]['koordinata_y']+(data.floor[i]['sirina']/2));
                }
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        } );
    }
     
</script>

           

       
<?php require_once __SITE_PATH . '/view/_footer.php'; ?>


