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
    }


    function getAllReservations()
    { 
        try
        {
            $db = DB::getConnection();
            $st = $db->prepare( 'SELECT id_reservation, id_lecture_hall, id_user,reservation_start, reservation_end FROM project_reservations ORDER BY id_reservation');
            $st->execute();
        } 
        catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $arr = array();
        while( $row = $st->fetch() )
        {
            $arr[] = new Reservation( $row['id_reservation'], $row['id_lecture_hall'], $row['id_user'], $row['reservation_start'],
                            $row['reservation_end']);
        }

        return $arr;///popis svih rezervacija

    }

    function checkAdmin($id)///vraca true ukoliko je trenutno ulogirani korisnik Admin
    {
        $arr=$this->getAllUsers();
       
        foreach($arr as $row)
        {
         
         if($row->id === $id && $row->is_admin === '1')
              return true;}

        return false;
    }
    
    function checkLogin($username,$password)
    {
        $arr=$this->getAllUsers();

        foreach($arr as $row)
            if($row->username === $username)///provjeri lozinku
                    {
                    // if(password_verify($password,$row->password_hash))
                                return $row->id;
                    }


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


function getUserId($username)
   {$arr=$this->getAllUsers();

    foreach($arr as $row)
         if($row->username===$username) return $row->id;

    return false;
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





function addNewUser($username,$password_hash,$email) 
    { $arr=$this->getAllUsers();


        foreach($arr as $row)
            if($row->username===$username)
                return false;

        try
        { $hash=password_hash($password_hash,PASSWORD_DEFAULT);

            $db = DB::getConnection();
            $db->exec("INSERT INTO project_users (username, password_hash,email,is_admin)" .
            " VALUES ('$username','$hash','$email','0')" );
            //$st->execute();

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
    function newReservation($start, $end, $hall, $user, $date)
    {
        
        try
        {
        
            $temp = explode('/', $date);
            $date1 = $temp[2] . '-' . $temp[0] . '-' . $temp[1];

            $arr=$this->getAllLecture_halls();
            $hall1 = 0;
            foreach($arr as $row)
            {
                if($row->title === $hall) 
                    $hall1 = $row->id; //ne radi za praktikume
            }
            $start1 =$date1 . ' ' . $start . ':00'; 
            $end1 = $date1 . ' ' . $end . ':00'; 
            
            $current_date = new DateTime('now');
            $begin = new DateTime($start1);
            $endd = new DateTime($end1);

            if($current_date >= $begin)
            {
                return -3; //ako je krivi
            }
            if($begin >= $endd)
            {
                return -1;
            }
            
            $start2 = date ('Y-m-d H:i:s', strtotime($start1));
            $end2 = date ('Y-m-d H:i:s', strtotime($end1));
            
            

            //provjera
            $db = DB::getConnection();
            $st = $db->prepare('SELECT id_lecture_hall, reservation_start, reservation_end from project_reservations');
            $st->execute();

            $arr = array();
            $pr = 0;
            while( $row = $st->fetch() )
            {
                $dt = new DateTime($row['reservation_start']);
                $dd = $dt -> format('Y-m-d H:i:s');
                if( $start2 >= $row['reservation_start']  and $start2 < $row['reservation_end']  and (int)$row['id_lecture_hall'] === (int)$hall1) 
                {
                   return -2;// -2 za koliziju s rezervacijom iz baze
                }
            }
  
            $db = DB::getConnection();
            $db->exec("INSERT INTO project_reservations (id_user, id_lecture_hall, reservation_start, reservation_end)" .
            " VALUES ('$user','$hall1','$start2', '$end2' )");
            
            
            return 1; //1 za sve ok
            
            
        } 
        catch( PDOException $e ) 
        { 
            exit( 'PDO error ' . $e->getMessage() ); 
        }
    }


    
}
?>
