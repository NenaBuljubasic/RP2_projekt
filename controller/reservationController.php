<?php
require_once __DIR__ . '/../model/reservationService.php';

class ReservationController extends BaseController{
    public function index() 
	{
		
	}
    public function delete()
    { //treba mi date i prostorija
        $rs=new ReservationService();
        $rs->deleteReservation($_POST["delete"]);
    }
    public function reserve()
    {
        $rs=new ReservationService();
        $rs->newReservation(/*$_POST["delete"]*/);//morat će nešto slat
        require_once __DIR__.'/../view/reservation_index.php';
    }
    
}


?>
