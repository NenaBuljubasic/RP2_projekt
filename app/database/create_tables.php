<?php


require_once __DIR__ . '/db.class.php';

//create_table_users();
create_table_lecture_halls();
//create_table_reservations();

exit( 0 );

// --------------------------
function has_table( $tblname )
{
	$db = DB::getConnection();
	
	try
	{
		$st = $db->query( 'SELECT DATABASE()' );
		$dbname = $st->fetch()[0];

		$st = $db->prepare( 
			'SELECT * FROM information_schema.tables WHERE table_schema = :dbname AND table_name = :tblname LIMIT 1' );
		$st->execute( ['dbname' => $dbname, 'tblname' => $tblname] );
		if( $st->rowCount() > 0 )
			return true;
	}
	catch( PDOException $e ) { exit( "PDO error [show tables]: " . $e->getMessage() ); }

	return false;
}
/*

function create_table_users()
{ 

	$db = DB::getConnection();

	if( has_table( 'project_users' ) )
		exit( 'Tablica project_users vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS project_users (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'username varchar(50) NOT NULL,' .
			'password_hash varchar(255) NOT NULL,'.
			'email varchar(50) ,' .
			'is_admin int)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create project_users]: " . $e->getMessage() ); }

	echo "Napravio tablicu project_users.<br />";
}
*/


function create_table_lecture_halls()
{
	$db = DB::getConnection();

	if( has_table( 'project_lecture_halls' ) )
		exit( 'Tablica project_lecture_halls vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS project_lecture_halls (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'title varchar(100) NOT NULL,' .
			'capacity int NOT NULL,' .
			'floor int NOT NULL)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create project_lecture_halls]: " . $e->getMessage() ); }

	echo "Napravio tablicu project_lecture_halls.<br />";
}
/*
function create_table_reservations()
{
	$db = DB::getConnection();

	if( has_table( 'project_reservations' ) )
		exit( 'Tablica project_reservations vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS project_reservations (' .
			'id_reservation int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'id_user INT NOT NULL,' .
			'id_lecture_hall INT NOT NULL,' .
			'reservation_start datetime NOT NULL,'.
			'reservation_end datetime NOT NULL)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create project_reservations]: " . $e->getMessage() ); }

	echo "Napravio tablicu project_reservations.<br />";
}
*/
?> 