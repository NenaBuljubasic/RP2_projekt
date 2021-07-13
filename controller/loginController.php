<?php 


class LoginController extends BaseController
{
	public function index() 
	{
		$this->registry->template->show( 'login_index' );
	}
	
	public function signup()
    {
        $ps = new ReservationService();
		$username = $_POST["username"];
		$password_hash=$_POST["password"];
		$email=$_POST["email"];
		if($ps->addNewUser($username,$password_hash,$email))
		{
			$arr1=array();
			$arr1=$ps->getUsersReservations($_SESSION['user_id'])[0];
			$arr2=array();
			$arr2=$ps->getUsersReservations($_SESSION['user_id'])[1];  
			
			require_once __DIR__.'/../view/show_lecture_halls_index.php';
		}	   
		else
			require_once __DIR__.'/../view/try_again.php';
	}

}; 

?>
