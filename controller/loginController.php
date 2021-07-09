<?php 
require_once __DIR__ . '/../model/reservationService.php';

class LoginController extends BaseController
{
	public function index() 
	{
	  $this->registry->template->show( 'login_index' );
	}
	public function korisnik()
	{
		if( isset($_POST["gumb"]))
		{$ps = new ReservationService();
			$username = $_POST["username"];
			$password = $_POST["password"];  //nzm jeli sigurno ovako slat password
			$provjera = $ps->checkLogin( $username, $password);
			if( $provjera) //sada cemo zapamtit zasad samo id u SESSION-u, lako cemo kasnije i druge stvari ako treba
			{
			   $ja=$_SESSION['user_id']=$provjera;
			   require_once __DIR__.'/../view/lecture_halls_index.php';
				
		    }
			else
			{
				require_once __DIR__.'/../view/try_again.php'; //prebaci me nazad u formu za ulogiravanje
			}
		}
	}
	



}; 

?>
