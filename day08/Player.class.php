#!/usr/bin/php
<?php

class player
{
	private $name;
	private $ships;
	private $dice;
	private $shipIds;
	static $verbose = false;
	function	__construct($player)
	{
		$this->name = $player["name"];
		$this->shipIds = $player["ShipId"];
		$this->ships = new Fleet(array("Ships"=>$player["Ships"],"playerId"=>$this->shipIds));
		$this->dice = new DiceBox($player["Dice"]);

		if(Player::$verbose)
			echo "Player ".$this->name." created!".PHP_EOL;
	}

	function addtofleet($ship)
	{
		$this->ships->addShip($ship);
	}
}

class Ship extends Objects
{
	private $hp;
	private $attack;
	private $defence;
	private $speed;
	private $accuracy;
	const UP = "UP";
	const DOWN = "DOWN";
	const LEFT = "LEFT";
	const RIGHT = "RIGHT";
	function __construct($ship)
	{
		$ship["Class"] = "ship";
		parent::__construct($ship);
		$this->hp = $ship["hp"];
		$this->attack = $ship["attack"];
		$this->defence = $ship["defence"];
		$this->speed = $ship["speed"];
		$this->accuracy = $ship["accuracy"];
		$this->direction = $ship["direction"];
	}
	function	__toString()
	{
		return(sprintf(	"Ship ( Owner : %s, ". 
						"HP : %d,".
						" Attack : %d,".
						" Defence : %d,".
						" Speed : %d,".
						" Accuracy : %d,".
						" Direction : %s".
						" )",
						$this->getId(),
						$this->hp, 
						$this->attack,
						$this->defence,
						$this->speed,
						$this->accuracy,
						$this->direction));
	}
	function __destruct()
	{
		echo "You Died".PHP_EOL;
	}
	function takeHit()
	{
		$this->hp--;
		if($this->hp <= 0)
		{
			$this->__destruct();
		}
	}
}
class Fleet
{
	private $player;
	private $fleet;
	function __construct($fleet)
	{
		$this->player = $fleet["playerId"];
		$this->fleet = $fleet["Ships"];
		foreach($this->fleet as $ship)
		{
			$this->forceJoin($ship);
		}
	}

	function forceJoin(Ship $ship)
	{
		$ship->setId($this->player);
	}
	function addship($ship)
	{
		$this->forceJoin($ship);
		$this->fleet[] = $ship;
	}
}
?>