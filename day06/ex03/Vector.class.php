#!/usr/bin/php
<?php
class Vector
{
	//private $_mag;
	private $_x;
	private $_y;
	private $_z;
	private $_w = 0.0;

	private $_dest;
	private $orig;
	public static $verbose =false;
	public function __construct(array $vector)
	{
		//$this->_mag = new Vertex(array("x"=>0.0, "y"=>0.0, "z"=>0.0, "w"=>0.0));
		
		$this->_dest = $vector["dest"];
		if(array_key_exists("orig", $vector))
			$this->_orig = $vector["orig"];
		else
			$this->_orig = new Vertex(array("x"=>0.0, "y"=>0.0, "z"=>0.0));
		$this->_x = $this->_dest->getX() - $this->_orig->getX();
		$this->_y = $this->_dest->getY() - $this->_orig->getY();
		$this->_z = $this->_dest->getZ() - $this->_orig->getZ();
		if($vector["dest"]->getW())
			$this->_w = $this->_dest->getW() - $this->_orig->getW();
		if(Vector::$verbose)
			echo $this." constructed.".PHP_EOL;
	}
	public function __destruct()
	{
		if(Vector::$verbose)
			echo $this." destructed.".PHP_EOL;
	}
	public function doc()
	{
		echo file_get_contents("Vector.doc.txt").PHP_EOL;
	}
	public function magnitude()
	{
		return(sqrt(pow($this->getX(), 2)+pow($this->getY(), 2)+pow($this->getZ(), 2)));
	}
	public function	normalize()
	{
		$mag = $this->magnitude();
		if($mag)
		{
			$x = $this->getX() / $mag;
			$y = $this->getY() / $mag;
			$z = $this->getZ() / $mag;
			$vert = new Vertex(array("x"=>$x, "y"=>$y,"z"=>$z));
		}
		else
		$vert = new Vertex(array("x"=>0.0, "y"=>0.0,"z"=>0.0, "w"=>0.0));
		return(new Vector(array("dest" => $vert)));
	}
	public function add(Vector $vector)
	{
		$x = $this->getX() + $vector->getX();
		$y = $this->getY() + $vector->getY();
		$z = $this->getZ() + $vector->getZ();
		$vert = new Vertex(array("x"=>$x, "y"=>$y,"z"=>$z));
		return(new Vector(array("dest" => $vert)));
	}
	public function sub(Vector $vector)
	{
		$x = $this->getX() - $vector->getX();
		$y = $this->getY() - $vector->getY();
		$z = $this->getZ() - $vector->getZ();
		$vert = new Vertex(array("x"=>$x, "y"=>$y,"z"=>$z));
		return(new Vector(array("dest" => $vert)));
	}
	public function opposite()
	{
		$x = -$this->getX();
		$y = -$this->getY();
		$z = -$this->getZ();
		$vert = new Vertex(array("x"=>$x, "y"=>$y,"z"=>$z));
		return(new Vector(array("dest" => $vert)));
	}
	public function scalarProduct($k)
	{
		$x = $this->getX()*$k;
		$y = $this->getY()*$k;
		$z = $this->getZ()*$k;
		$vert = new Vertex(array("x"=>$x, "y"=>$y,"z"=>$z));
		return(new Vector(array("dest" => $vert)));
	}

	public function dotProduct(Vector $vector)
	{
		return $this->getX() * $vector->getX() + $this->getY() * $vector->getY() + $z = $this->getZ() * $vector->getZ();
	}
	public function cos(Vector $rhs)
	{
		return($this->dotProduct($rhs)/($this->magnitude()*$rhs->magnitude()));
	}
	public function	crossProduct(Vector $vector)
	{
		$x = $this->getY()*$vector->getZ() - $vector->getY()*$this->getZ();
		$y = $this->getX()*$vector->getZ() - $vector->getX()*$this->getZ();
		$z = $this->getX()*$vector->getY() - $vector->getX()*$this->getY();
		$vert = new Vertex(array("x"=>$x, "y"=>$y,"z"=>$z));
		return(new Vector(array("dest" => $vert)));
	}
	
	public function __toString()
	{
		return(sprintf("Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )", $this->getX(), $this->getY(), $this->getZ(), $this->getW()));
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
}
?>