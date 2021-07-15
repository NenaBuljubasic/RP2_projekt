<?php
    require_once __DIR__ . '/../app/database/db.class.php';
    require_once __DIR__ . '/user.class.php';
    require_once __DIR__ . '/lecture_hall.class.php';
    require_once __DIR__ . '/reservation.class.php';
    $floors = [ 
        [//prizemlje, prostorije
            ['koordinata_x'=>0, 'koordinata_y' => 0, 'duljina' => 100, 'sirina' => 100, 'prostorija' => "001"], //ovo je npr za 1.kat sve prostorije
            ['koordinata_x'=>850, 'koordinata_y' => 0, 'duljina' => 150, 'sirina' => 100, 'prostorija' => "PRAKTIKUM 2"],
            ['koordinata_x'=>100, 'koordinata_y' => 0, 'duljina' => 750, 'sirina' => 100, 'prostorija' => "Ostalo"],
            ['koordinata_x'=>0, 'koordinata_y' => 300, 'duljina' => 100, 'sirina' => 100, 'prostorija' => "006"],
            ['koordinata_x'=>100, 'koordinata_y' => 300, 'duljina' => 150, 'sirina' => 100, 'prostorija' => "Ostalo"],
            ['koordinata_x'=>250, 'koordinata_y' => 350, 'duljina' => 150, 'sirina' => 150, 'prostorija' => "005"],
            ['koordinata_x'=>400, 'koordinata_y' => 350, 'duljina' => 150, 'sirina' => 150, 'prostorija' => "004"],
            ['koordinata_x'=>650, 'koordinata_y' => 350, 'duljina' => 150, 'sirina' => 150, 'prostorija' => "003"],
            ['koordinata_x'=>800, 'koordinata_y' => 300, 'duljina' => 100, 'sirina' => 100, 'prostorija' => "Ostalo"],
            ['koordinata_x'=>900, 'koordinata_y' => 300, 'duljina' => 100, 'sirina' => 100, 'prostorija' => "002"]
        ],
        [//kat 1
            ['koordinata_x'=>0, 'koordinata_y' => 0, 'duljina' => 100, 'sirina' => 100, 'prostorija' => "101"], //ovo je npr za 1.kat sve prostorije
            ['koordinata_x'=>100, 'koordinata_y' => 0, 'duljina' => 100, 'sirina' => 100, 'prostorija' => "102"],
            ['koordinata_x'=>200, 'koordinata_y' => 0, 'duljina' => 100, 'sirina' => 100, 'prostorija' => "103"],
            ['koordinata_x'=>300, 'koordinata_y' => 0, 'duljina' => 100, 'sirina' => 100, 'prostorija' => "104"],
            ['koordinata_x'=>400, 'koordinata_y' => 0, 'duljina' => 100, 'sirina' => 100, 'prostorija' => "105"],
            ['koordinata_x'=>500, 'koordinata_y' => 0, 'duljina' => 200, 'sirina' => 100, 'prostorija' => "PRAKTIKUM 3"],
            ['koordinata_x'=>700, 'koordinata_y' => 0, 'duljina' => 150, 'sirina' => 100, 'prostorija' => "PRAKTIKUM 4"],
            ['koordinata_x'=>850, 'koordinata_y' => 0, 'duljina' => 150, 'sirina' => 100, 'prostorija' => "PRAKTIKUM 5"],
            ['koordinata_x'=>0, 'koordinata_y' => 300, 'duljina' => 100, 'sirina' => 100, 'prostorija' => "006"],
            ['koordinata_x'=>100, 'koordinata_y' => 300, 'duljina' => 150, 'sirina' => 100, 'prostorija' => "Ostalo"],
            ['koordinata_x'=>250, 'koordinata_y' => 350, 'duljina' => 150, 'sirina' => 150, 'prostorija' => "005"],
            ['koordinata_x'=>400, 'koordinata_y' => 350, 'duljina' => 150, 'sirina' => 150, 'prostorija' => "004"],
            ['koordinata_x'=>650, 'koordinata_y' => 350, 'duljina' => 150, 'sirina' => 150, 'prostorija' => "003"],
            ['koordinata_x'=>800, 'koordinata_y' => 300, 'duljina' => 100, 'sirina' => 100, 'prostorija' => "108"],
            ['koordinata_x'=>900, 'koordinata_y' => 300, 'duljina' => 100, 'sirina' => 100, 'prostorija' => "107"]
        ]
    ];
    
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
    
    $floor = $_POST['floor'];

    $hall = NULL;
    $x = $_POST['x'];
    $y = $_POST['y'];

    for($i = 0; $i < count($floors[$floor]); $i++)
    {
        if( $x >= $floors[$floor][$i]['koordinata_x'] && $x <= $floors[$floor][$i]['koordinata_x']+$floors[$floor][$i]['duljina'])
        {
            if( $y >= $floors[$floor][$i]['koordinata_y'] && $y <= $floors[$floor][$i]['koordinata_y']+$floors[$floor][$i]['sirina'])
            {
                $hall = $floors[$floor][$i]['prostorija'];
            }
        }
    }
    
    $message = [];  
    $tempic = getCapacity($hall);
       
    $message['capacity'] = $tempic;
    $message['hall'] = $hall;
    
    sendJSONandExit($message);

    
    
    function getCapacity($hall)
    {
        if($hall[0] == 'P')
        {
            $hall1 = 'PR' . $hall[10];
            $hall = $hall1;
        }  
        try
        {
            $db = DB::getConnection();
            $st = $db->prepare( "SELECT capacity FROM project_lecture_halls " ."WHERE title LIKE :title " );
            $st->execute( array( 'title' => $hall) );
        } 
        catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    
        $capacity=0;

        while( $row = $st->fetch()){
            $capacity = $row['capacity'];            
        }

        return $capacity;
    }

?>