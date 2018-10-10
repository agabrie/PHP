#!/usr/bin/php
<?php
require_once '../ex01/Vertex.class.php';
require_once '../ex02/Vector.class.php';
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
	public $_matrix;
	private $_preset;
	public static $verbose = false;

	function __construct($matrix)
	{
		$this->_preset = $matrix["preset"];
		$this->_matrix =	array(	array(1, 0, 0, 0),
									array(0, 1, 0, 0),
									array(0, 0, 1, 0),
									array(0, 0, 0, 1));
		switch($this->_preset)
		{
			case Matrix::TRANSLATION :
				$this->_vtc = $matrix["vtc"];
				$this->_matrix[0][3] = $this->_vtc->getX();
				$this->_matrix[1][3] = $this->_vtc->getY();
				$this->_matrix[2][3] = $this->_vtc->getZ();
				break;
			case Matrix::SCALE :
				$this->_scale = $matrix["scale"];
				$this->_matrix[0][0] *= $this->_scale;
				$this->_matrix[1][1] *= $this->_scale;
				$this->_matrix[2][2] *= $this->_scale;
				break;
			case Matrix::RX :
				$this->_angle = $matrix["angle"];
				$this->_matrix[1][1] = cos($this->_angle);
				$this->_matrix[1][2] = -sin($this->_angle);
				$this->_matrix[2][1] = sin($this->_angle);
				$this->_matrix[2][2] = cos($this->_angle);
				break;
			case Matrix::RY :
				$this->_angle = $matrix["angle"];
				$this->_matrix[0][0] = cos($this->_angle);
				$this->_matrix[0][2] = sin($this->_angle);
				$this->_matrix[2][0] = -sin($this->_angle);
				$this->_matrix[2][2] = cos($this->_angle);
				break;
			case Matrix::RZ :
				$this->_angle = $matrix["angle"];
				$this->_matrix[0][0] = cos($this->_angle);
				$this->_matrix[0][1] = -sin($this->_angle);
				$this->_matrix[1][0] = sin($this->_angle);
				$this->_matrix[1][1] = cos($this->_angle);
				break;
			case Matrix::PROJECTION :
				$this->_fov = deg2rad($matrix["fov"]);
				$this->_ratio = $matrix["ratio"];
				$this->_near = $matrix["near"];
				$this->_far = $matrix["far"];
				$this->_matrix[0][0] = 1/($this->_ratio*tan($this->_fov/2));
				$this->_matrix[1][1] =  1/(tan($this->_fov/2));
				$this->_matrix[2][2] = ($this->_near + $this->_far)/($this->_near - $this->_far);
				$this->_matrix[3][2] = -1;
				$this->_matrix[2][3] = 2*($this->_near * $this->_far)/($this->_near - $this->_far);
				$this->_matrix[3][3] = 0;
				break;
			default :
				
				break;
		}
		if	(Matrix::$verbose)
			echo ("Matrix ".$this->getPreset()." instance constructed".PHP_EOL);	
	}
	function	__destruct()
	{
		if	(Matrix::$verbose)
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
	public function	mult(Matrix $rhs)
	{
		$ret = clone($rhs);
		$ret->_matrix = array(	array(0, 0, 0, 0),
								array(0, 0, 0, 0),
								array(0, 0, 0, 0),
								array(0, 0, 0, 0));
		for($i = 0; $i < 4; $i++)
		{
			for($j = 0; $j < 4; $j++)
			{
				for($k = 0;$k < 4;$k++)
				{
					$ret->_matrix[$i][$j] += $this->_matrix[$i][$k] * $rhs->_matrix[$k][$j];
					
				}
				/*$ret->_matrix[$i][$j] = $this->_matrix[$i][0] * $rhs->_matrix[0][$j] +
                            $this->_matrix[$i][1] * $rhs->_matrix[1][$j] +
                            $this->_matrix[$i][2] * $rhs->_matrix[2][$j] +
							$this->_matrix[$i][3] * $rhs->_matrix[3][$j];
				*/
			}
		}
		return($ret);
	}
	public function transformVertex(Vertex $vert)
	{
		$x =  $vert->getX()*$this->_matrix[0][0] + $vert->getY()*$this->_matrix[0][1] + $vert->getZ()*$this->_matrix[0][2]+ $vert->getW()*$this->_matrix[0][3];
		$y =  $vert->getX()*$this->_matrix[1][0] + $vert->getY()*$this->_matrix[1][1] + $vert->getZ()*$this->_matrix[1][2]+ $vert->getW()*$this->_matrix[1][3];
		$z =  $vert->getX()*$this->_matrix[2][0] + $vert->getY()*$this->_matrix[2][1] + $vert->getZ()*$this->_matrix[2][2]+ $vert->getW()*$this->_matrix[2][3];
		$w =  $vert->getX()*$this->_matrix[3][0] + $vert->getY()*$this->_matrix[3][1] + $vert->getZ()*$this->_matrix[3][2]+ $vert->getW()*$this->_matrix[3][3];
		
		return(new Vertex(array("x"=>$x, "y"=>$y, "z"=>$z, "w"=>$w)));
	}
	public function __toString()
	{
		return(sprintf(	"M | vtcX | vtcY | vtcZ | vtxO".PHP_EOL.
						"-----------------------------".PHP_EOL.
						"x | %.2f | %.2f | %.2f | %.2f".PHP_EOL.
						"y | %.2f | %.2f | %.2f | %.2f".PHP_EOL.
						"z | %.2f | %.2f | %.2f | %.2f".PHP_EOL.
						"w | %.2f | %.2f | %.2f | %.2f",
						$this->_matrix[0][0],$this->_matrix[0][1],$this->_matrix[0][2],$this->_matrix[0][3],
						$this->_matrix[1][0],$this->_matrix[1][1],$this->_matrix[1][2],$this->_matrix[1][3],
						$this->_matrix[2][0],$this->_matrix[2][1],$this->_matrix[2][2],$this->_matrix[2][3],
						$this->_matrix[3][0],$this->_matrix[3][1],$this->_matrix[3][2],$this->_matrix[3][3]
					));
	}
}
?>