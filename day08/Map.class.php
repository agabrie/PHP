#!/usr/bin/php
<?php
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
	private $size;
	private $objects;

	function __construct($map)
	{
		$this->objects = $map["objects"];
		$this->size = $map["size"];
	}

	function setSize($x, $y)
	{
		$this->size->setX($x);
		$this->size->setY($y);
	}

	function drawMap()
	{
		echo "<center><table>";
		for($y = 0;$y < $this->y;$y++)
		{
			echo "<tr>";
			for($x = 0; $x < $this->x;$x++)
			{
				if(($obj = $this->checkForObject($x, $y)) instanceof Objects)
				{
					$this->placeObject($obj,$x, $y);
				}
				else
				{
					$this->placeEmpty($x, $y);
				}
			}
			echo "</tr>";
		}
		echo "</table></center>";
	}
	function	placeEmpty($x, $y)
	{
		echo "<td class='cell' id='empty'></td>";
	}
	function	placeObject(Objects $obj, $x, $y)
	{
		echo "<td class='".$obj->getClass()."' id='".($obj->getId()?$obj->getId():"")."'></td>";
	}

	function	checkForObject($x, $y)
	{
		foreach($this->objects as $object)
		{
			if($x = $object->getX() && $y == $object->getY())
			{
				echo "There is an object of type ".get_class($object)." here.".PHP_EOL;
				return $object;
			}
		}
		return NULL;
	}
}
?>