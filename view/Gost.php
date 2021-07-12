
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>	
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>
    <link rel="stylesheet" type="text/css" href="svojstva.css">
    <script src="chart.js"></script>
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
    <!--</form>-->

</body>
</html>