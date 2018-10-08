#!/usr/bin/php
<?php
$doc = include("Color.doc.txt");
class Color
{
	private $red = 0;
	private $blue = 0;
	private $green = 0;
	public	static $verbose = false;
	
	function __construct(array $rgb)
	{
		
		if($rgb["rgb"] !== "")
		{
			$this->red = (($rgb["rgb"]>>16) & 0xff);
			$this->green = (($rgb["rgb"]>>8) & 0xff);
			$this->blue = (($rgb["rgb"]) & 0xff);
		}
		if(array_key_exists("red", $rgb))
		{
			$this->red = $rgb["red"];
		}
		if(array_key_exists("green", $rgb))
		{
			$this->green = $rgb["green"];
		}
		if(array_key_exists("blue", $rgb))
		{
			$this->blue = $rgb["blue"];
		}
		if(Color::$verbose)
			echo ($this->__toString()." constructed.".PHP_EOL);
	}
	function __destruct()
	{
		if(Color::$verbose)
			echo ($this->__toString()." destructed.".PHP_EOL);
	}
	public static function doc()
	{
		return $doc.PHP_EOL;
	}
	function setColor($red, $green, $blue)
	{
		$this->red = $red;
		$this->green = $green;
		$this->blue = $blue;
	}

	function	add(Color $rhs)
	{
		$r =  $this->red + $rhs->red;
		$g =  $this->green + $rhs->green;
		$b =  $this->blue + $rhs->blue;
		return(new Color(array("red"=>$r ,"green"=>$g, "blue"=>$b)));
	}
	function getColor()
	{
		return(Color($red, $green, $blue));
	}
	function	sub(Color $rhs)
	{
		$r =  $this->red - $rhs->red;
		$g =  $this->green - $rhs->green;
		$b =  $this->blue - $rhs->blue;
		return(new Color(array("red"=>$r ,"green"=>$g, "blue"=>$b)));
	}
	function	mult($f)
	{
		$r =  $this->red * $f;
		$g =  $this->green * $f;
		$b =  $this->blue * $f;
		return(new Color(array("red"=>$r ,"green"=>$g, "blue"=>$b)));
	}

	function __toString()
	{
		return (sprintf("Color( red:%5d, green:%5d, blue:%5d)", $this->red,$this->green,$this->blue));
	}
}
/*Color::$verbose = True;

$color = new Color(array( "red" => 0xff, 'green' => 0   , 'blue' => 0    ) );
echo "OK\n";
print($color     . PHP_EOL );*/
?>