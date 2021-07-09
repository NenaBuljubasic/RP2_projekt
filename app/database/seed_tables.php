<?php


require_once __DIR__ . '/db.class.php';

seed_table_users();
//seed_table_lecture_halls();
//seed_table_reservations();

exit( 0 );

// ------------------------------------------
function seed_table_users()
{
	$db = DB::getConnection();

	
	try
	{
		$st = $db->prepare( 'INSERT INTO project_users(username, password_hash, email, has_registered, is_admin) VALUES (:username, :password, \'a@b.com\',  \'1\',:is_admin)' );

		$st->execute( array( 'username' => 'marko', 'password' => password_hash( 'markovasifra', PASSWORD_DEFAULT ),'is_admin'=>0 ) );
		$st->execute( array( 'username' => 'luka', 'password' => password_hash( 'lukinasifra', PASSWORD_DEFAULT ),'is_admin'=>0) );
		$st->execute( array( 'username' => 'anja', 'password' => password_hash( 'anjinasifra', PASSWORD_DEFAULT ),'is_admin'=>0 ) );
		$st->execute( array( 'username' => 'stipe', 'password' => password_hash( 'stipinasifra', PASSWORD_DEFAULT ),'is_admin'=>0 ) );
		$st->execute( array( 'username' => 'pero', 'password' => password_hash( 'perinasifra', PASSWORD_DEFAULT ),'is_admin'=>0 ) );
		$st->execute( array( 'username' => 'sime', 'password' => password_hash( 'perinasifra', PASSWORD_DEFAULT ),'is_admin'=>1 ) );
	}
	catch( PDOException $e ) { exit( "PDO error [insert project_users]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu project_users.<br />";
}
/*

// ------------------------------------------
function seed_table_lecture_halls()
{
	$db = DB::getConnection();


	try
	{
		$st = $db->prepare( 'INSERT INTO project_lecture_halls(title,capacity) VALUES (:title, :capacity)' );

		$st->execute( array( 'title' => '201', 'capacity' => 20 ) ); 
		
	}
	catch( PDOException $e ) { exit( "PDO error [project_lecture_halls]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu project_lecture_halls.<br />";
}

// ------------------------------------------
function seed_table_reservations()
{
	$db = DB::getConnection();

	
	try
	{
	$st = $db->prepare( 'INSERT INTO project_reservations( id_user,id_lecture_hall, reservation_start,reservation_end) VALUES (:id_user, :id_lecture_hall, :reservation_start, :reservation_end)' );

	$st->execute( array( 'id_user' => 1, 'id_lecture_hall' => 1, 'reservation_start' => '2011-01-01T15:03:01.012345','reservation_end' => '2011-01-01T15:03:01.012345') );
		
	}
	catch( PDOException $e ) { exit( "PDO error [project_reservations]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu project_reservations<br />";
}*/
?> 
 
 