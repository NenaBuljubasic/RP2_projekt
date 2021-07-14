
<?php



class UserController extends BaseController{
  public function index() 
	{
		$this->registry->template->show( 'login_index' );
	}
public function login()//provjera je li korisnik u bazi
	 { 
		
	 	$ps = new ReservationService();
	  
		if(!isset($_SESSION["user_id"]))
			{ 
				$_SESSION["username"] = $_POST["username"];
			
				$provjera = $ps->checkLogin( $_SESSION["username"],$_POST["password"]);
				if($provjera===false) {require_once __DIR__.'/../view/try_again.php'; //prebaci me nazad u formu za ulogiravanje
					                   exit;}
				//else $_SESSION["user_id"]=$provjera;
				

			}
		
			
			if($ps->checkAdmin($_SESSION["user_id"]) === true)
			{
					$arr1=array();
					$arr1=$ps->getAllUsersReservations()[0];
					$arr2=array();
					$arr2=$ps->getAllUsersReservations()[1];
					
					require_once __DIR__.'/../view/show_lecture_halls_index.php';

			}
			else
			{
				$arr1=array();
				$arr1=$ps->getUsersReservations($_SESSION['user_id'])[0];
				$arr2=array();
				$arr2=$ps->getUsersReservations($_SESSION['user_id'])[1];
			}
						
			
			
			require_once __DIR__.'/../view/show_lecture_halls_index.php';
					
					
			}
		public function show()//vraca popis rezervacija
		{
			if(isset($_SESSION["username"]))
				$_SESSION["username"] = NULL;
			$ps = new ReservationService();
			if($ps->checkAdmin($_SESSION["user_id"]) === true)
			{
					$arr1=array();
					$arr1=$ps->getAllUsersReservations()[0];
					$arr2=array();
					$arr2=$ps->getAllUsersReservations()[1];
					
					
			}
			else
			{
				$arr1=array();
				$arr1=$ps->getUsersReservations($_SESSION['user_id'])[0];
				$arr2=array();
				$arr2=$ps->getUsersReservations($_SESSION['user_id'])[1];
				
			}
			require_once __DIR__.'/../view/show_lecture_halls_index.php';
		}
			
	public function signup()//funkcija za dodavanje novog korisnika
      {
        if($_POST["username"]==="" or $_POST["password"]==="")
		     {  session_destroy();
				
				require_once __DIR__.'/../view/signup_index.php';

				exit;  
			 }



        $ps = new ReservationService();
			$_SESSION['username'] = $_POST["username"];
            $email=$_POST["email"];
			if($ps->addNewUser($_SESSION['username'],$_POST['password'],$email))
			      {
					$_SESSION['user_id']=$ps->getUserId($_SESSION['username']);
					
					require_once __DIR__.'/../view/reservation_index.php';
				  }	   
		     else
			 require_once __DIR__.'/../view/signup_index.php';
		} 


   public function logout()//odjava, zavrsava sesiju
       {
			session_destroy();
		   require_once __DIR__.'/../view/site_index.php';
         }


public function unlogged()
   { $ps = new ReservationService();

	  //$ps->$_POST["row"];
   }
public function administrator()
   { 

	   $ps=new ReservationService();
	 $id=$ps->getUserId($_POST["username"]);
	 


    if($ps->checkAdmin($id)===true && $id!==false && $ps->checkLogin($_POST["username"],$_POST["password"])!=false)
	{
		$arr1=array();
		$arr1=$ps->getAllUsersReservations()[0];
		$arr2=array();
		$arr2=$ps->getAllUsersReservations()[1];
		
		require_once __DIR__.'/../view/show_lecture_halls_index.php';
		//require_once __DIR__.'/../view/administrator_site_index.php';
	}
	else
	{
		$_POST["username"] = NULL;
		$_POST["password"] = NULL;
		if(isset($_SESSION["username"]))
			$_SESSION["username"] = NULL;
		require_once __DIR__.'/../view/administrator_index.php';
	}
           
   }
}
?>

