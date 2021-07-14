<?php

class ReservationController extends BaseController{
    public function index() 
	{
		
	}
    public function delete()//brise rezervaciju i vraca na stranicu za ispis rezervacija
    {  
        $rs=new ReservationService();
        $arr=$rs->getAllReservations();
        
        foreach($arr as $row)
            if(isset($_POST[$row->id_reservation]))
            { 
                $rs->deleteReservation($row->id_reservation);
            }
     header('Location:index.php?rt=user/show');
   }

    public function reserve()
    {
        $this->registry->template->show( 'reservation_index' );
        $rs=new ReservationService();
        
        $user = $_SESSION['user_id'];
        if(isset($_POST['reserve']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['hall']) && ($_POST['date'] != ""))
        {
            $pr = $rs->newReservation($_POST['start'],$_POST['end'],$_POST['hall'], $user , $_POST['date'] );//morat će nešto slat                        

        }

    }
    
    
}


?>
