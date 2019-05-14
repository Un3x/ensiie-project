<?php
namespace Event;
class Event
{

	private $idevent;

	private $title;

	private $type;

	private $day;

	private $start;

	private $place;

	private $idCreator;

	private $public;

	public function setIdEvent($id){
		$this->idevent = $id;
		return  $this;
	}

	public function getIdEvent(){

		return $this->idevent;
	}

	public function setTitle($title){
		$this->title = $title;
		return  $this;
	}

	public function getTitle(){

		return $this->title;
	}

	public function setType($type){
		$this->type = $type;
		return  $this;
	}

	public function getType(){

		return $this->type;
	}

	public function setDay($day){
		$this->day = $day;
		return  $this;
	}

	public function getDay(){

		return $this->day;
	}

	public function setStart($start){
		$this->start = $start;
		return  $this;
	}

	public function getStart(){

		return $this->start;
	}

	public function setPlace($place){
		$this->place = $place;
		return  $this;
	}

	public function getPlace(){

		return $this->place;
	}

	public function setIdCreator($idCreator){
		$this->idCreator = $idCreator;
		return  $this;
	}

	public function getIdCreator(){

		return $this->idCreator;
	}


	public function setPublic($public){
		$this->public = $public;
		return  $this;
	}

	public function getPublic(){

		return $this->public;
	}


}