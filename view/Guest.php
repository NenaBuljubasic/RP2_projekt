<?php require_once __SITE_PATH . '/view/_header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>	
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>
    

    <title>First page</title>
</head>
<body>

             <div class="floors">
            <select name="floor" id="floor">
                <option value="ground_floor" name="ground_floor">Ground floor</option>
                <option value="first_floor" name="first_floor">First floor</option>
            </select>
        </div>
        <p>Date: 
            <input type="text" id="my_date_picker">
        </p>
        <button id="show_calendar">Show calendar</button>

        <div id="calendar"></div>
<script>
    $(document).ready(function(){
            $("#my_date_picker").datepicker();

            $("#show_calendar").on("click", send_parameters);
        });

        function send_parameters(){
            var temp_floor = $('#floor').val();
            var floor = 0;
            if (temp_floor === "first_floor")
                floor = 1;
            var temp = $("#my_date_picker").datepicker("getDate");
            if(temp === null)
                alert("You have to select a date!");
            else{
                var my_date = temp.getFullYear() + "-" +  (temp.getMonth()+1) + "-" + temp.getDate();
                //console.log("Ovo je floor: " + floor);
                //console.log("Ovo je my_date:" + my_date);
                $.ajax({
                    url:"/PR/model/guest.php", //PAZITI Hardkodiran put - nije mi radilo drugačije
                    data:{
                        floor:floor,
                        my_date:my_date
                    },
                    //dataType: "text",
                    type: "POST",
                    success:function(data){
                        console.log("Everything went great!" );
                        if(typeof(data.error) === "undefined")
                        {
                            //console.log(data);
                            //console.log(data);
                            crtaj_kalendar((data));
                        }
                    },
                    error:function(xhr, status){
                        console.log("Error: " + status);
                    }
                });
        }
    }

        crtaj_kalendar = function(data){
      
            var tbl = $("<table class='tblCalendar style='text-align: center;margin-left: auto;margin-right: auto;'></table>");

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
                    var time = $("<td style='border-bottom: 1px solid #333;'></td>").html((i+8)+":00");
                    tr.append(time);
                    for(var j = 1; j < 8; j++){
                        var l = j + 1;
                        var temp_colm = $("<td style='border-bottom: 1px solid #333;'></td>");
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
                    var time = $("<td style='border-bottom: 1px solid #333;'></td>").html((i+8)+":00");
                    var p = i + 8;
                    tr.append(time);
                    for(var j = 0; j < 12; j++){
                        var l = j + 9;
                        var temp_colm = $("<td style='border-bottom: 1px solid #333;'></td>");
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
    </script>
</body>
</html>
<?php require_once __SITE_PATH . '/view/_footer.php'; ?>