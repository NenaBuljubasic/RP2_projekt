<?php

require_once __DIR__ . '/../app/db.class.php';

class ReservationService{

function getAllUsers()///dohvati sve korisnike
   {
    try
    {
        $db = DB::getConnection();
        $st = $db->prepare( 'SELECT id, username, password_hash, email, has_registered FROM project_users ORDER BY id');
        $st->execute();
    } 
    catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();
    while( $row = $st->fetch() )
    {
        $arr[] = new User( $row['id'], $row['username'], $row['password_hash'], $row['email'],
                           $row['has_registered']);
    }

    return $arr;///popis svih korisnika
  }
   

function addNewSale($id_product,$id_user)
  {
   $db = DB::getConnection();

  
   try
   {
	   $st = $db->prepare( 'INSERT INTO project_user(i) VALUES (:id_product, :id_user)' );

	   $st->execute( array( 'id_product' =>$id_product , 'id_user' =>$id_user)); 
   }
   catch( PDOException $e ) { exit( "PDO error [dz2_products]: " . $e->getMessage() ); }
 }











}

?>