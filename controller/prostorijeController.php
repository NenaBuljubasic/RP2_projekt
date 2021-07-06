<?php 

class ProstorijeController extends BaseController
{
	public function index() 
	{
		session.start(); //dodat session.destroy() u log out
        	//$this->registry->template->show( 'products_index' );
	}
	public function korisnik()
	{
		$ps = new Prostorije();
		if( isset($_POST["gumb"]))
		{
			$username = $_POST["username"];
			$password = $_POST["password"];  //nzm jeli sigurno ovako slat password
			$provjera = $ps->provjeriLogin( $username, $password);
			if( $provjera === true)
			{
				//$korisnik = $_SESSION ['user_id']; //ovo promijenit kad promijenim bazu
				$this->registry->template->show( 'prostorije_index' );
			}
		}
	}
	



}; 

?>
