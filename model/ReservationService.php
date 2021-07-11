<?php

require_once __DIR__ . '/../app/database/db.class.php';
require_once __DIR__ . '/user.class.php';
require_once __DIR__ . '/lecture_hall.class.php';
require_once __DIR__ . '/reservation.class.php';

class ReservationService{

    function getAllUsers()///dohvati sve korisnike
    {
        try
        {
            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT id, username, email, password_hash, is_admin FROM project_users ORDER BY id');
            $st->execute();
        } 
        catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $arr = array();
        while( $row = $st->fetch() )
        {
            $arr[] = new User( $row['id'], $row['username'], $row['password_hash'], $row['email'],$row['is_admin']);
        }

        return $arr;///popis svih korisnika
    }
    
    function getAllLecture_halls()
    {
        try
        {
            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT id, title, floor, capacity FROM project_lecture_halls ORDER BY id');
            $st->execute();
        } 
        catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $arr = array();
        while( $row = $st->fetch() )
        {
            $arr[] = new Lecture_hall( $row['id'], $row['title'],$row['capacity'],$row['floor']);
        }

        return $arr;
    

function getAllReservations()
  { 
    try
    {
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT id_reservation, id_user, id_lecture_hall,reservation_start, reservation_end FROM project_reservations ORDER BY id_reservation');
        $st->execute();
    } 
    catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();
    while( $row = $st->fetch() )
    {
        $arr[] = new Reservation( $row['id_reservation'], $row['id_lecture_hall'], $row['id_user'], $row['reservation_start'],
                           $row['reservation_end']);

    }

    function getAllReservations()
    { 
        try
        {
            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT id_reservation, id_user, id_lecture_hall,reservation_start, reservation_end FROM project_reservations ORDER BY id_reservation');
            $st->execute();
        } 
        catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $arr = array();
        while( $row = $st->fetch() )
        {
            $arr[] = new Reservation( $row['id_reservation'], $row['id_user'], $row['id_lecture_hall'], $row['reservation_start'],
                            $row['reservation_end']);
        }

        return $arr;///popis svih rezervacija

    }

    function checkAdmin($id)///vraca true ukoliko je trenutno ulogirani korisnik Admin
    {
        $arr=$this->getAllUsers();

        foreach($arr as $row)
            if($row->id === $id and $row->isAdmin === 1)
                return true;

        return false;
    }
    
    function checkLogin($username,$password)
    {
        $arr=$this->getAllUsers();

        foreach($arr as $row)
            if($row->username === $username and $row->password_hash === $password)
                return $row->id;


        return false;
    }   
    



    function getUsersReservations($id_user) //prima id usera i dohvaca sve njegove rezervacija
    {  
        $arr=$this->getAllReservations();
        $outputArrayForTitles=[];
        $outputArrayForDates=[];
        foreach($arr as $row)
            if($id_user===$row->id_user)
                {
                    array_push($outputArrayForTitles,$this->getLecture_hallById($row->id_lecture_hall));
                    array_push($outputArrayForDates,$row);
                }                      
        $outputArray=[$outputArrayForTitles,$outputArrayForDates];
        return $outputArray;
    }

function getUsersReservations($id_user) //prima id usera i dohvaca sve njegove rezervacija
{  $arr=$this->getAllReservations();
   $outputArrayForTitles=[];
   $outputArrayForDates=[];
   
   foreach($arr as $row)
          { 
            if($id_user===$row->id_user)
                   { 
                    array_push($outputArrayForTitles,$this->getLecture_hallById($row->id_lecture_hall));
                    array_push($outputArrayForDates,$row);
                    
                   }  }                  
 $outputArray=[$outputArrayForTitles,$outputArrayForDates];
 
 return $outputArray;
}


    function getLecture_hallById($id_lecture_hall)
    { 
        $arr=$this->getAllLecture_halls();
        
        foreach($arr as $row)
        {
            if($row->id===$id_lecture_hall) return $row;
        }
        return false;
    }




    function adminDeleteReservation() //funkcija u kojoj admin brise bilo koju rezervaciju
        {}

    function adminDeleteUser() //admin brise usera
        {}

    function adminDeleteLecture_hall() //admin brise predavaonicu
        {}
    function adminAddLecture_hall() //admin dodaje predavaonicu 
        {}






    function addNewUser($username,$password_hash,$email) //dodavanje sign up, triba popravit email
    { 
        $arr=$this->getAllUsers();

function addNewUser($username,$password_hash,$email) 
    { $arr=$this->getAllUsers();


        foreach($arr as $row)
            if($row->username===$username)
                return false;

        try
        {

            $db = DB::getConnection();
            $db->exec("INSERT INTO project_users (username, password_hash,email,is_admin)" .
            " VALUES ('$username','$password_hash','$email','0')" );
            //$st->execute();

          $db = DB::getConnection();
          $db->exec("INSERT INTO project_users (username, password_hash,email,is_admin)" .
          " VALUES ('$username','$password_hash','$email','0')" );

        } 
        catch( PDOException $e ) 
        { 
            exit( 'PDO error ' . $e->getMessage() ); 
        }
        return true;
    }


    function deleteReservation($reservation_id)
    {

        try
        {
            $db = DB::getConnection();
            $db->exec("DELETE FROM project_reservations WHERE id_reservation LIKE '$reservation_id'" );
            
        } 
        catch( PDOException $e ) 
        { 
            exit( 'PDO error ' . $e->getMessage() ); 
        }


    }
    function newReservation()
    {
        try
        {
            //$db = DB::getConnection();
            
            
        } 
        catch( PDOException $e ) 
        { 
            exit( 'PDO error ' . $e->getMessage() ); 
        }
    }



}
?>
