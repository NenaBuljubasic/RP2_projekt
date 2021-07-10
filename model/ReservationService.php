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
        $st = $db->prepare( 'SELECT id, username, password_hash, email, has_registered , is_admin FROM project_users ORDER BY id');
        $st->execute();
    } 
    catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();
    while( $row = $st->fetch() )
    {
        $arr[] = new User( $row['id'], $row['username'], $row['password_hash'], $row['email'],
                           $row['has_registered'],$row['is_admin']);
    }

    return $arr;///popis svih korisnika
  }
   
function checkAdmin($id)///vraca true ukoliko je trenutno ulogirani korisnik Admin
     {$arr=$this->getAllUsers();

      foreach($arr as $row)
           if($row->id===$id and $row->isAdmin===1)
                        return true;

      return false;
     }
 
  function checkLogin($username,$password)
      {$arr=$this->getAllUsers();

        foreach($arr as $row)
             if($row->username===$username and $row->password_hash===$password)
                              return $row->id;


      return false;
      }   
 

function getAllReservations()
  {
    try
    {
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT id_reservation, id_user, id_lecture_hall,reservation_start, reservation_end FROM project_reservation ORDER BY id_reservation');
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

function getUsersReservations($id_user) //prima id usera i dohvaca sve njegove rezervacija
{$arr=$this->getAllReservations();
 $outputArray=[];
  foreach($arr as $row)
       {
          if($id_user===$row->id_user)
                        {
                              array_push($outputArray,$row);//dohvaca cijeli redak                        
 
                        }
                     
       }
}


function adminDeleteReservation() //funkcija u kojoj admin brise bilo koju rezervaciju
    {}

function adminDeleteUser() //admin brise usera
    {}

function adminDeleteLecture_hall() //admin brise predavaonicu
    {}
function adminAddLecture_hall() //admin dodaje predavaonicu 
    {}


function reservationDelete($id_user,$id_reservation) ///user deleta svoju rezervaciju
    {$arr=$this->getAllReservations();
     

      foreach($arr as $row)
           if($row->id_user===$id_user and $row->id_reservation===$id_reservation)
                     {
                       
                     }


    }
}
?>