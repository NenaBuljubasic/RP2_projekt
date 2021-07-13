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
        $this->registry->template->show( 'reservation_index' );
        $rs=new ReservationService();
        
        $user = $_SESSION['user_id'];
        if(isset($_POST['reserve']))
        {
            $pr = $rs->newReservation($_POST['start'],$_POST['end'],$_POST['hall'], $user , $_POST['date'] );//morat će nešto slat                        
            //if($pr === -1)
                //$this->registry->template->show( 'r_index' );// ovo promijenit
            
            
        }
        //$this->registry->template->show( 'reservation_index' );
        //require_once __DIR__.'/../view/reservation_index.php';
    }
    
}


?>
