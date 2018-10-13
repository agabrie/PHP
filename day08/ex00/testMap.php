#!/usr/bin/php
<?php
require_once "Objects.class.php";
require_once "Map.class.php";
require_once "Player.class.php";
require_once "Dice.class.php";
Player::$verbose = true;
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['dir1']))
{
	if($_POST["dir1"]== "D")
        movePlayer();
}else
{
	$pos = new Coordinates(10, 2);
	$ship = new Ship(array(	"Position"=>$pos,
						"hp"=>10,
						"attack"=>6,
						"defence"=>2,
						"speed"=>1,
						"accuracy"=>20,
						"direction" => Ship::DOWN
						));
	$ship2 = new Ship(array(	"Position"=>$pos,
						"hp"=>10,
						"attack"=>6,
						"defence"=>2,
						"speed"=>1,
						"accuracy"=>20,
						"direction" => Ship::DOWN
						));
	$fleet = array($ship);
	$fleet2 = array($ship2);

	$dice = array($d6 = new Dice(6),$d3 = new Dice(3),$d7 = new Dice(7));
	$p1 = new Player(array(	"name"=>"Abduraghmaan",
						"ShipId"=>"p1",
						"Dice"=>$dice,
						"Ships"=>$fleet
						));
	$p2 = new Player(array(	"name"=>"Enemy",
						"ShipId"=>"p2",
						"Dice"=>$dice,
						"Ships"=>$fleet2
						));

	$objs = array($ship, $ship2);
	$mapsize = new Coordinates(150, 100);
	print($ship.PHP_EOL);
	$map = new Map(array("objects" => $objs, "size" => $mapsize));
}
$map::drawMap();
function movePlayer()
{
           
}

?> 

