<?php
$floors = [ 
    [//prizemlje, prostorije
        ['koordinata_x'=>0, 'koordinata_y' => 0, 'duljina' => 100, 'sirina' => 100, 'prostorija' => "001"], //ovo je npr za 1.kat sve prostorije
        ['koordinata_x'=>850, 'koordinata_y' => 0, 'duljina' => 150, 'sirina' => 100, 'prostorija' => "Praktikum 2"],
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
        ['koordinata_x'=>500, 'koordinata_y' => 0, 'duljina' => 200, 'sirina' => 100, 'prostorija' => "Praktikum 3"],
        ['koordinata_x'=>700, 'koordinata_y' => 0, 'duljina' => 150, 'sirina' => 100, 'prostorija' => "Praktikum 4"],
        ['koordinata_x'=>850, 'koordinata_y' => 0, 'duljina' => 150, 'sirina' => 100, 'prostorija' => "Praktikum 5"],
        ['koordinata_x'=>0, 'koordinata_y' => 300, 'duljina' => 100, 'sirina' => 100, 'prostorija' => "006"],
        ['koordinata_x'=>100, 'koordinata_y' => 300, 'duljina' => 150, 'sirina' => 100, 'prostorija' => "Ostalo"],
        ['koordinata_x'=>250, 'koordinata_y' => 350, 'duljina' => 150, 'sirina' => 150, 'prostorija' => "005"],
        ['koordinata_x'=>400, 'koordinata_y' => 350, 'duljina' => 150, 'sirina' => 150, 'prostorija' => "004"],
        ['koordinata_x'=>650, 'koordinata_y' => 350, 'duljina' => 150, 'sirina' => 150, 'prostorija' => "003"],
        ['koordinata_x'=>800, 'koordinata_y' => 300, 'duljina' => 100, 'sirina' => 100, 'prostorija' => "108"],
        ['koordinata_x'=>900, 'koordinata_y' => 300, 'duljina' => 100, 'sirina' => 100, 'prostorija' => "107"]
    ]
];
//ode nekako provjerit jel dobro sve ili tako nesto
function sendJSONandExit( $message )
{
    // Kao izlaz skripte poĹˇalji $message u JSON formatu i prekini izvoÄ‘enje.
    header( 'Content-type:application/json;charset=utf-8' );
    echo json_encode( $message );
    flush();
    exit( 0 );
}

$floor = $_POST['floor'];

$message = [];
$message[ 'floor' ] = $floors[$floor];
sendJSONandExit( $message );


?>