#!/usr/bin/php
<?php
	require_once '../ex00/Color.class.php';
	class Vertex
	{
		private $_color;
		private $_x = 0.00;
		private $_y = 0.00;
		private $_z = 0.00;
		private $_w = 1.00;
		public static $verbose = false;
		function __construct(array $vertex)
		{
			$this->_color = new Color(array("rgb"=>0xffffff));
			
			$this->_x = $vertex["x"];
			$this->_y = $vertex["y"];
			$this->_z = $vertex["z"];
			if(array_key_exists("w", $vertex))
			{
				$this->_w = $vertex["w"];
			}
			if(array_key_exists("color", $vertex))
			{
				$this->_color = $vertex["color"];
			}
			if(Vertex::$verbose)
			{
				echo ($this." constructed".PHP_EOL);
			}
		}
		function	__destruct()
		{
			if(Vertex::$verbose)
			{
				echo ($this." destructed".PHP_EOL);
			}
		}
		public static function doc()
		{
			echo file_get_contents("Vertex.doc.txt").PHP_EOL;
		}
		// Accessors
		public function getX()
		{
			return($this->_x);
		}
		public function getY()
		{
			return($this->_y);
		}
		public function getZ()
		{
			return($this->_z);
		}
		public function getW()
		{
			return($this->_w);
		}
		public function getColor()
		{
			return($this->_color);
		}
		public function	getRed()
		{
			
			return($this->_color->getRed());
		}
		public function	getGreen()
		{
			return($this->_color->getGreen());
		}
		public function	getBlue()
		{
			return($this->_color->getBlue());
		}
		// Mutators
		public function setX($x)
		{
			$this->_x = $x;
		}
		public function setY($y)
		{
			$this->_y = $y;
		}
		public function setZ($z)
		{
			$this->_z = $z;
		}
		public function setW($w)
		{
			$this->_w = $w;
		}
		public function setColor($color)
		{
			$this->_color = $color;
		}

		public function	sub($vert)
		{
			$x = $this->_x - $vert->getX();
			$y = $this->_y - $vert->getY();
			$z = $this->_z - $vert->getZ();
			$w = $this->_w - $vert->getW();
			$color = $this->_color->sub($vert->_color);
			return(new Vertex(array("x"=>$x,"y"=>$y,"z"=>$z,"w"=>$w,"color"=>$color)));
		}
		public function opposite()
		{
			$x = -$this->getX();
			$y = -$this->getY();
			$z = -$this->getZ();
			$color = $this->getColor();
			$vert = new Vertex(array("x"=>$x, "y"=>$y,"z"=>$z, "color"=>$color));
			return($vert);
		}
		public function __toString()
		{
			$string = sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f )",$this->_x, $this->_y,$this->_z, $this->_w);
			if(Vertex::$verbose)
			{
				$string = sprintf("Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s )",$this->_x, $this->_y,$this->_z, $this->_w, $this->_color);
			}
			return $string;
		}
	}
?>