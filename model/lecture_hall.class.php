<?php

class Lecture_hall
{
	public $id, $title, $capacity,$floor;

	function __construct( $id, $title, $capacity, $floor)
	{
		$this->id = $id;
		$this->title=$title;
        $this->capacity=$capacity;
		$this->floor=$floor;
	}

	//function __get( $prop ) { return $this->$prop; }
	//function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>