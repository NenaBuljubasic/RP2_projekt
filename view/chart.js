
        $(document).ready(function(){
            $("#my_date_picker").datepicker();

            $("#show_calendar").on("click", send_parameters);
        });

        function send_parameters(){
            var temp_floor = $('#floor').val();
            var floor = 0;
            if (temp_floor === "first_floor")
                floor = 1;
            //crtaj_kalendar(); // OVO neće ostati ovdje
            var temp = $("#my_date_picker").datepicker("getDate");
            var my_date = temp.getFullYear() + "-" +  (temp.getMonth()+1) + "-" + temp.getDate();
            //console.log("Ovo je floor: " + floor);
            //console.log("Ovo je my_date:" + my_date);
            $.ajax({
                url:location.protocol + "//" + location.hostname  + location.pathname.replace('index.php', '') + 'app/guest.php', //PAZITI na ovo ako ćemo mijenjati mjesto
                data:{
                    floor:floor,
                    my_date:my_date
                },
                //dataType: "text",
                type: "POST",
                success:function(data){
                    console.log("uspjesno sve. povratna informacija: " );
                    if(typeof(data.error) === "undefined")
                    {
                        //console.log(data);
                        //console.log(data);
                        crtaj_kalendar((data));
                    }
                },
                error:function(xhr, status){
                    console.log("Greska: " + status);
                }
            });
        }

        crtaj_kalendar = function(data){
      
            var tbl = $("<table class='tblCalendar'></table>");

            if($('#floor').val() === 'ground_floor'){
                tbl.append($('<th>Time</th>'));
                var first = $('<th>001</th>');
                var second = $('<th id="3">002</th>');
                var prakt = $('<th id="4">PR2</th>');
                var third = $('<th id="5">003</th>');
                var fourth = $('<th id="6">004</th>');
                var fifth = $('<th id="7">005</th>');
                var sixth = $('<th id="8">006</th>');

                tbl.append(first).append(second).append(prakt)
                .append(third).append(fourth).append(fifth).append(sixth);

                for(var i = 0; i < 13; ++i){
                    var tr = $("<tr></tr>");
                    var p = i + 8;
                    var time = $("<td></td>").html((i+8)+":00");
                    tr.append(time);
                    for(var j = 1; j < 8; j++){
                        var l = j + 1;
                        var temp_colm = $("<td></td>");
                        for(var k = 0; k < data.length; k++){
                            for(var key in data[k])
                            {
                                
                                var hours = (data[k][key]).split(",");
                                if(parseInt(key)===l && parseInt(hours[0]) <= p && parseInt(hours[1]) > p)
                                    var temp_colm = $("<td style='background-color: rgb(255, 0, 0)'></td>");
                            }
                        }
                        
                        tr.append(temp_colm);
                    }
                    tbl.append(tr);
                    
                }
                
            }
            else if($('#floor').val() === 'first_floor')
            {
                tbl.append($('<th>Time</th>'));
                var first_f = $('<th>101</th>');
                var second_f = $('<th>102</th>');
                var third_f = $('<th>103</th>');
                var fourth_f = $('<th>104</th>');
                var fifth_f = $('<th>105</th>');
                var prakt3 = $('<th>PR3</th>');
                var prakt4 = $('<th>PR4</th>');
                var prakt5 = $('<th>PR5</th>');
                var seventh_f = $('<th>107</th>');
                var eighth_f = $('<th>108</th>');
		var ninth_f= $('<th>109</th>');
		var tenth_f= $('<th>110</th>');

                tbl.append(first_f)
                    .append(second_f)
                    .append(third_f)
                    .append(fourth_f)
                    .append(fifth_f)
                    .append(prakt3)
                    .append(prakt4)
                    .append(prakt5)
                    .append(seventh_f)
                    .append(eighth_f)
		    .append(ninth_f)
		    .append(tenth_f);

                for(var i = 0; i < 13; ++i){
                    var tr = $("<tr></tr>");
                    var time = $("<td></td>").html((i+8)+":00");
                    var p = i + 8;
                    tr.append(time);
                    for(var j = 0; j < 12; j++){
                        var l = j + 9;
                        var temp_colm = $("<td></td>");
                        for(var k = 0; k < data.length; k++){
                            for(var key in data[k])
                            {
                                
                                var hours = (data[k][key]).split(",");
                                if(parseInt(key)===l && parseInt(hours[0]) <= p && parseInt(hours[1]) > p)
                                    var temp_colm = $("<td style='background-color: rgb(255, 0, 0)'></td>");
                            }
                        }
                        
                        tr.append(temp_colm);
                    }
                    tbl.append(tr);
                }
            }
            $("body").append("<br>");
            $("#calendar").html(tbl);
        }