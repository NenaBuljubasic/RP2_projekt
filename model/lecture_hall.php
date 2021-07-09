<?php

class User
{
	public $id, $title, $capacity;

	function __construct( $id, $title, $capacity)
	{
		$this->id = $id;
		$this->title=$title;
        $this->capacity=$capacity;
	}

	//function __get( $prop ) { return $this->$prop; }
	//function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>