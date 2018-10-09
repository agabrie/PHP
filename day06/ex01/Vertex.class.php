#!/usr/bin/php
<?php
	require_once "Color.class.php";
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
			if(array_key_exists("x", $vertex) && array_key_exists("y", $vertex) && array_key_exists("z", $vertex))
			{
				$this->_x = $vertex["x"];
				$this->_y = $vertex["y"];
				$this->_z = $vertex["z"];
			}
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
				echo ($this." constructed.".PHP_EOL);
			}
		}
		function	__destruct()
		{
			if(Vertex::$verbose)
			{
				echo ($this." destructed.".PHP_EOL);
			}
		}
		public static function doc()
		{
			echo file_get_contents("Vertex.doc.txt").PHP_EOL;
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