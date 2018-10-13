#!/usr/bin/php
<?php
session_start();
class Coordinates
{
	private $x;
	private $y;

	function	__construct($x, $y)
	{
		$this->x = $x;
		$this->y = $y;
	}
	function getX()
	{
		return($this->x);
	}
	function getY()
	{
		return($this->y);
	}

	function setX($x)
	{
		$this->x = $x;
	}
	function setY($y)
	{
		$this->y = $y;
	}
}
class Map
{
	private static $size;
	private static $objects;

	function __construct($map)
	{
		Map::$objects = $map["objects"];
		Map::$size = $map["size"];
	}

	function setSize($x, $y)
	{
		Map::$size->setX($x);
		Map::$size->setY($y);
	}

	static function drawMap()
	{
		$html = "";
		$html .= "<html><head><link rel=\"stylesheet\" type=\"text/css\" href=\"format.css\"></head><center><table>";
		//echo "<br>".PHP_EOL;
		for($y = 0;$y < Map::$size->getY();$y++)
		{
			
			$html .= "<tr>";
			for($x = 0; $x < Map::$size->getX();$x++)
			{
				if(($obj = Map::checkForObject($x, $y)) instanceof Objects)
				{
					$html .= Map::placeObject($obj,$x, $y);
				}
				else
				{
					$html .= Map::placeEmpty($x, $y);
				}
			}
			//echo "<br>".PHP_EOL;
			$html .= "</tr>";
		}
		$html .= "</table></center><form action=\"testMap.php\" method=\"post\"><input type=\"submit\" name=\"dir1\" value=\"Down\" /></form></a></html>";

		//header("Location : index.php");
		echo $html;
	}
	function	placeEmpty($x, $y)
	{
		
		return "<td class='cell' id='empty'></td>";
	}
	function	placeObject(Objects $obj, $x, $y)
	{
		return "<td class='".$obj->getClass()."' id='".($obj->getId()?$obj->getId():"")."'></td>";
	}

	function	checkForObject($x, $y)
	{
		foreach(Map::$objects as $object)
		{
			if($x == $object->getX() && $y == $object->getY())
			{
				//echo "There is an object of type ".get_class($object)." here ".$x.",".$y." .".PHP_EOL;
				return $object;
			}
		}
		return NULL;
	}
}
?>