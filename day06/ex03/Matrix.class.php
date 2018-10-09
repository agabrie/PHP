#!/usr/bin/php
<?php
class Matrix
{
	const IDENTITY		= "IDENTITY";
	const TRANSLATION	= "TRANSLATION preset";
	const SCALE			= "SCALE preset";
	const RX			= "Ox ROTATION preset";
	const RY			= "Oy ROTATION preset";
	const RZ			= "Oz ROTATION preset";
	const PROJECTION	= "PROJECTION preset";

	private $_scale;
	private $_identity;
	private $_vtc;
	private $_angle;
	private $_projection;
	private $_matrix;
	private $_preset;
	public static $verbose = false;

	function __construct($matrix)
	{
		$this->_preset = $matrix["preset"];
		$this->_matrix =	array(	"x"=>array("vtcX"=>1, "vtcY"=>0, "vtcZ"=>0, "vtx0"=>0),
									"y"=>array("vtcX"=>0, "vtcY"=>1, "vtcZ"=>0, "vtx0"=>0),
									"z"=>array("vtcX"=>0, "vtcY"=>0, "vtcZ"=>1, "vtx0"=>0),
									"w"=>array("vtcX"=>0, "vtcY"=>0, "vtcZ"=>0, "vtx0"=>1));
		switch($this->_preset)
		{
			case Matrix::TRANSLATION :
				$this->vtc = $matrix["vtc"];
				$this->_matrix["x"]["vtx0"] = $this->vtc->getX();
				$this->_matrix["y"]["vtx0"] = $this->vtc->getY();
				$this->_matrix["z"]["vtx0"] = $this->vtc->getZ();
				break;
			case Matrix::SCALE :
				$this->_scale = $matrix["scale"];
				$this->_matrix["x"]["vtcX"] *= $this->_scale;
				$this->_matrix["y"]["vtcY"] *= $this->_scale;
				$this->_matrix["z"]["vtcZ"] *= $this->_scale;
				break;
			case Matrix::RX :
				$this->_angle = $matrix["angle"];
				break;
			case Matrix::RY :
				$this->_angle = $matrix["angle"];
				break;
			case Matrix::RZ :
				$this->_angle = $matrix["angle"];
				break;
			case Matrix::PROJECTION :
				$this->_fov = $matrix["fov"];
				$this->_ratio = $matrix["ratio"];
				$this->_near = $matrix["near"];
				$this->_far = $matrix["far"];
				break;
			default :
				
				break;
		}
		if	(Matrix::$verbose)
			echo ("Matrix ".$this->getPreset()." instance constructed".PHP_EOL);	
	}
	function	__destruct()
	{
		echo "Matrix instance destructed".PHP_EOL;
	}
	function	getPreset()
	{
		return($this->_preset);
	}
	public static function doc()
	{
		echo file_get_contents("Matrix.doc.txt").PHP_EOL;
	}

	public function __toString()
	{
		return(sprintf(	"M | vtcX | vtcY | vtcZ | vtx0".PHP_EOL.
						"-----------------------------".PHP_EOL.
						"x | %.2f | %.2f | %.2f | %.2f".PHP_EOL.
						"y | %.2f | %.2f | %.2f | %.2f".PHP_EOL.
						"z | %.2f | %.2f | %.2f | %.2f".PHP_EOL.
						"w | %.2f | %.2f | %.2f | %.2f",
						$this->_matrix["x"]["vtcX"],$this->_matrix["x"]["vtcY"],$this->_matrix["x"]["vtcZ"],$this->_matrix["x"]["vtx0"],
						$this->_matrix["y"]["vtcX"],$this->_matrix["y"]["vtcY"],$this->_matrix["y"]["vtcZ"],$this->_matrix["y"]["vtx0"],
						$this->_matrix["z"]["vtcX"],$this->_matrix["z"]["vtcY"],$this->_matrix["z"]["vtcZ"],$this->_matrix["z"]["vtx0"],
						$this->_matrix["w"]["vtcX"],$this->_matrix["w"]["vtcY"],$this->_matrix["w"]["vtcZ"],$this->_matrix["w"]["vtx0"]
					));
	}
}
?>