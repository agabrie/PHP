#!/usr/bin/php
<?php
require_once "Objects.class.php";
require_once "Map.class.php";
require_once "Player.class.php";
require_once "Dice.class.php";
Player::$verbose = true;
$pos = new Coordinates(10, 2);
$ship = new Ship(array(	"Position"=>$pos,
						"hp"=>10,
						"attack"=>6,
						"defence"=>2,
						"speed"=>1,
						"accuracy"=>20,
						"direction" => Ship::DOWN
						));
$fleet = array($ship);
$dice = array($d6 = new Dice(6),$d3 = new Dice(3),$d7 = new Dice(7));
$p1 = new Player(array(	"name"=>"Abduraghmaan",
						"ShipId"=>"p1",
						"Dice"=>$dice,
						"Ships"=>$fleet
						));
print($ship.PHP_EOL);
?> 