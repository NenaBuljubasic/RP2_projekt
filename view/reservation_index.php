<?php require_once __SITE_PATH . '/view/_header.php'; ?>
<?php require_once __SITE_PATH . '/view/toolbar_index.php'; ?>
    <form class="reservation" method="post" action="<?php echo __SITE_URL . '/index.php?rt=prostorije/reserve'?>">
        <p>Datum: <input type="text" id="datepicker"></p>
        <p>
            <label for="start">Od:</label>

            <select name="start" id="start"> <!--nzm jel ovo pametnije nekako drukcije-->
                <option value="8" name="beginHour">08:00</option>  <!--dodaj-->
                <option value="9">09:00</option>
                <option value="10">10:00</option>
                <option value="11">11:00</option>
                <option value="10">10:00</option>
                <option value="11">11:00</option>
                <option value="12">12:00</option>
                <option value="13">13:00</option>
                <option value="14">14:00</option>
                <option value="15">15:00</option>
                <option value="16">16:00</option>
                <option value="17">17:00</option>
                <option value="18">18:00</option>
                <option value="19">19:00</option>
            </select>

            <label for="end">Do:</label>

            <select name="end" id="end">
                <option value="9" name="endHour">09:00</option>
                <option value="10">10:00</option>
                <option value="11">11:00</option>
                <option value="10">10:00</option>
                <option value="11">11:00</option>
                <option value="12">12:00</option>
                <option value="13">13:00</option>
                <option value="14">14:00</option>
                <option value="15">15:00</option>
                <option value="16">16:00</option>
                <option value="17">17:00</option>
                <option value="18">18:00</option>
                <option value="19">19:00</option>
                <option value="20">20:00</option>

            </select>
        </p>
        <input type="radio" name="floor" value="0" /> Prizemlje <br />
        <input type="radio" name="floor" value="1" /> Prvi kat <br />
        <button type="sumbit" id="prikaz">Prikaz</button>   <br/>
        <canvas width="1000" height="500" id="cnv" style="border: solid 1px;"></canvas>
        <br>
    </form>


           

        <script>
            $(document).ready(function(){                
                $( "#datepicker" ).datepicker();
                $("#prikaz").on('click', check);
                //$("#cnv").on('click', dostupnost);
                $("#cnv").on('click', info);
 
                
            })
            var brojac = 0;
            var current_floor = -1; // u dostupnosti ne dat nista na klik jer nije odabran kat
            var canvas = $( "#cnv" ).get(0);
            var ctx = canvas.getContext( "2d" );
            function check() //ja bi ode odma obojala one koje su slobodne! --> ne treba mi klik za bojanje, već klik za rezervaciju!
            {
                if(brojac > 0)
                    $( "#balon" ).remove();
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                var kat = $('input[name=floor]:checked').val()
                current_floor = kat;
                alert("pozvalo se");
                $.ajax(
                {
                    url: '@Url.Action("reserve","Prostorije")',
                    data: { floor:kat },
                    dataType: "json",
                    success: function( data )
                    {
                        alert("uspia");
                        console.log( data.floor.length);
                        for(var i = 0; i < data.floor.length; i++)
                        {
                            ctx.beginPath();
                            ctx.rect(data.floor[i]['koordinata_x'], data.floor[i]['koordinata_y'], data.floor[i]['duljina'], data.floor[i]['sirina']);
                            ctx.stroke(); 
                            ctx.fillText(data.floor[i]['prostorija'],data.floor[i]['koordinata_x']+(data.floor[i]['duljina']/2),data.floor[i]['koordinata_y']+(data.floor[i]['sirina']/2));
                        }
                        
                    },
                    failure:function(data)
                    {
                        alert("nesupjelo!");
                    },
                    error:function(data)
                    {
                        alert("err!");
                    }
                } );
            }
            function dostupnost()//ovo se cini jako opterecujuce s mouse moveom!
            {
                var rect = this.getBoundingClientRect();    
                var x = event.clientX - rect.left, y = event.clientY - rect.top;
                var odabrana = null;
                if(current_floor === -1)
                {
                    alert("Niste odabrali kat!");
                    return;
                }
                $.ajax(
                {
                    url: "floors.php",
                    data: { floor:current_floor },
                    dataType: "json",
                    success: function( data )
                    {
                        var isItRectangle = 0;
                        console.log( data.floor.length);
                        for(var i = 0; i < data.floor.length; i++)
                        {
                            
                            if( x >= data.floor[i]['koordinata_x'] && x <= data.floor[i]['koordinata_x']+data.floor[i]['duljina'])
                            {
                                if( y >= data.floor[i]['koordinata_y'] && y <= data.floor[i]['koordinata_y']+data.floor[i]['sirina'])
                                {
                                    //ctx.fillStyle = "rgba(0, 105, 255, 0.7)";// bojat će po dostupnosti
                                    //ctx.fillRect(data.floor[i]['koordinata_x'], data.floor[i]['koordinata_y'], data.floor[i]['duljina'], data.floor[i]['sirina']);
                                    isItRectangle = 1;
                                    //ctx.fillStyle= "rgb(0, 0, 0)";
                                    odabrana = data.floor[i]['prostorija'];
                                    var c = $("#datepicker").val();
                                    alert("Želite li rezervirati "+odabrana+"?"+c);
                                    return;
                                }
                            }
                        }
                        ctx.fillStyle= "rgb(0, 0, 0)";
                    }                         
                } );
            }
            function info()
            {
                
                if(brojac > 0)
                    $( "#balon" ).remove();
                brojac = 1;
                
                var div = $( "<div></div>" );
                var rect = this.getBoundingClientRect();    
                var x = event.clientX - rect.left, y = event.clientY - rect.top;
                //alert(x+" "+y);
                var odabrana = 0;


                $.ajax(
                {
                    url: "floors.php",
                    data: { floor:current_floor },
                    dataType: "json",
                    success: function( data )
                    {
                        
                        for(var i = 0; i < data.floor.length; i++)
                        {
                            
                            if( x >= data.floor[i]['koordinata_x'] && x <= data.floor[i]['koordinata_x']+data.floor[i]['duljina'])
                            {
                                //alert("x valja");
                                if( y >= data.floor[i]['koordinata_y'] && y <= data.floor[i]['koordinata_y']+data.floor[i]['sirina'])
                                {
                                    odabrana = data.floor[i]['prostorija']; //sad iz baze pročitat kapacitet!
                                    //alert("Želite li");
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
                                            "Kapacitet prostorije " + odabrana //gore počitat koordinate i lipo vratit kapacitet točan
                                        );

                                    $( "body" ).append( div );
                                    return;
                                }
                            }
                        }
                        
                        
                        
                    }
                }
                );
                            
            }
                
                
            
        </script>
<?php require_once __SITE_PATH . '/view/_footer.php'; ?>


