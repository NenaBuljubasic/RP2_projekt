<?php
    require_once __DIR__ . '/../app/database/db.class.php';
    require_once __DIR__ . '/user.class.php';
    require_once __DIR__ . '/lecture_hall.class.php';
    require_once __DIR__ . '/reservation.class.php';

    
    function sendJSONandExit( $message )
    {
        header( 'Content-type:application/json;charset=utf-8' );
        echo json_encode( $message );
        flush();
        exit( 0 );
    }
    function sendErrorAndExit($messageText){
        $message = [];
        $message['error'] = $messageText;
        sendJSONandExit($message);
    }

    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }

    if(!isset($_POST['floor']))
        sendErrorAndExit("You must select floor. Please, try again!");
    if(!isset($_POST['my_date']))
        sendErrorAndExit("You have to select date from datepicker. Please, try again!");
    
    $floor = $_POST['floor'];
    $my_date = $_POST['my_date'];
 
    $message = [];
    //debug_to_console($floor);
    //debug_to_console("Ovo je u gost.php");
    //debug_to_console(gettype($my_date));
        
    
        $tempic = getReservationsByDate($floor, $my_date);
        //debug_to_console("OVO JE TIP: " . gettype($tempic));
        //$message["rezervacije"] = $tempic;
        $message = $tempic;
        sendJSONandExit($message);

    //Dohvati iz baze podatke - pazi da kat zgrade i datum odgovaraju

    function getReservationsByDate($floor, $my_date)
    {
        try
        {
            $db = DB::getConnection();
            $st = $db->prepare('SELECT floor, id, reservation_start, reservation_end from project_lecture_halls, project_reservations WHERE id = id_lecture_hall ORDER BY id');
            $st->execute();
        } 
        catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    
        $return = array();
        while( $row = $st->fetch()){
            $dt = new DateTime($row['reservation_start']);
            $dd = new DateTime($row['reservation_end']);
            $date = $dt->format('Y-m-d');
            if($row['floor'] === $floor)
            {
                $array_enter = [];
                $array_database = [];
                $temp = explode("-",$my_date);
                foreach($temp as $el)
                    $array_enter[] = (int)$el;
                $temp2 = explode("-",$date);
                foreach($temp2 as $el2)
                    $array_database[] = (int)$el2;
                //debug_to_console(gettype($array_enter[0]));
                //debug_to_console(gettype($array_database[2]));

                if($array_enter[0] === $array_database[0] and $array_enter[1] === $array_database[1] and $array_enter[2] === $array_database[2])
                {
                    //debug_to_console("RADIIIIIIIIIIIIIIII");
                    $time_s = $dt->format('H:m:s');
                    $time_e = $dd->format('H:m:s');
                    $begin =(int)(explode(":", $time_s)[0]);
                    $end = (int)(explode(":",$time_e)[0]);
                    //$temp = $row['id'] . "," . $begin . "," . $end;
                    //array_push($return, $temp);
                    $return[] = array($row['id'] => $begin . "," . $end);
                }
            }
        }
        return $return;
    }

?>