<?php

class Reservation
{
	public $id_reservation, $id_lecture_hall,$id_user,$reservation_start,$reservation_end;

	function __construct($id_reservation, $id_lecture_hall,$id_user,$reservation_start,$reservation_end)
	{
		$this->id_reservation= $id_reservation;
		$this->id_lecture_hall= $id_lecture_hall;
		$this->id_user = $id_user;
        $this->reservation_start=$reservation_start;
		$this->reservation_end=$reservation_end;
		
    }
	//function __get( $prop ) { return $this->$prop; }
	//function __set( $prop, $val ) { $this->$prop = $val; return $this; }
   
}

?>
