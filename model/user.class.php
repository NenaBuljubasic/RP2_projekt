<?php

class User
{
	public $id, $username, $password_hash, $email, $is_admin;

	function __construct( $id, $username, $password_hash, $email, $is_admin)
	{
		$this->id = $id;
		$this->username = $username;
		$this->email = $email;
		$this->password_hash = $password_hash;
	    $this->id_admin=$is_admin;
	}

	//function __get( $prop ) { return $this->$prop; }
	//function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>

