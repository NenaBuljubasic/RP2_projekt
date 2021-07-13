
<?php

require_once __DIR__ .'/../model/reservationService.php';

class UserController extends BaseController{
  public function index() 
	{
		$this->registry->template->show( 'login_index' );
	}
public function login()
	 { 
	  $ps = new ReservationService();
	  if(!isset($_SESSION["user_id"]))
		{
			$_SESSION["username"] = $_POST["username"];
			$_SESSION["password"] = $_POST["password"];
		}
	  $provjera = $ps->checkLogin( $_SESSION["username"],$_SESSION["password"]);
		
			if( $provjera) //sada cemo zapamtit zasad samo id u SESSION-u, lako cemo kasnije i druge stvari ako treba
			{  $_SESSION['user_id']=$provjera;
				$arr1=array();
				$arr1=$ps->getUsersReservations($_SESSION['user_id'])[0];
				$arr2=array();
				$arr2=$ps->getUsersReservations($_SESSION['user_id'])[1];
				
				require_once __DIR__.'/../view/show_lecture_halls_index.php';
            }
			else
			{
				require_once __DIR__.'/../view/try_again.php'; //prebaci me nazad u formu za ulogiravanje
			}
	 }
		
	public function signup()
      {
        $ps = new ReservationService();
			$_SESSION['username'] = $_POST["username"];
			$_SESSION['password']=$_POST["password"];
            $email=$_POST["email"];
			if($ps->addNewUser($_SESSION['username'],$_SESSION['password'],$email))
			      {
					$_SESSION['user_id']=$ps->getUserId($_SESSION['username']);
					
					require_once __DIR__.'/../view/reservation_index.php';
				  }	   
		     else
			 require_once __DIR__.'/../view/site_index.php';
		} 


   public function logout()
       {
	       session_unset();
		   require_once __DIR__.'/../view/site_index.php';
         }


public function unlogged()
   { $ps = new ReservationService();

	  //$ps->$_POST["row"];
   }
public function administrator()
   { $ps=new ReservationService();
	 $id=$ps->getUserId($_POST["username"]);
	 
     if($ps->checkAdmin($id)===true && $id!==false)
		   require_once __DIR__.'/../view/administrator_site_index.php';
           
   }
}
?>

