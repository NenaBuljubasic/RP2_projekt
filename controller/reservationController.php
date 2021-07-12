<?php
require_once __DIR__ . '/../model/reservationService.php';

class ReservationController extends BaseController{
    public function index() 
	{
		
	}
    public function delete()
    {  
        $rs=new ReservationService();
        $arr=$rs->getAllReservations();
        
        foreach($arr as $row)
            if(isset($_POST[$row->id_reservation]))
                       { 
                         
                         $rs->deleteReservation($row->id_reservation);
                      }
     header('Location:index.php?rt=user/login');
   }
    public function reserve()
    { 
       require_once __DIR__.'/../view/reservation_index.php';
    }
    
}


?>
