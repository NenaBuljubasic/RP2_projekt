<?php

require_once __DIR__ . '/../app/database/db.class.php';
require_once __DIR__ . '/user.class.php';
require_once __DIR__ . '/lecture_hall.class.php';

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
 


}


?>