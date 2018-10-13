<?php
class Objects
{
	private $coords;
	private $class;
	private $id = "empty";
	static $verbose = false;
	function __construct($obj)
	{
		$this->coords = $obj["Position"];
		$this->class = $obj["Class"];
	}
	function setId($id)
	{
		$this->id = $id;
	}
	function getClass()
	{
		return($this->class);
	}
	function getId()
	{
		return($this->id);
	}
	function getX()
	{
		return($this->coords->getX());
	}
	function	moveDown($amount)
	{
		$this->coords->setY($this->getY()+$amount);
	}
	function getY()
	{
		return($this->coords->getY());
	}
}
?>