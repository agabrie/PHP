#!/usr/bin/php
<?php
	class Render
	{
		private $_width;
		private $_height;
		private $_filename;
		private $_screen;

		const EDGE = 1;
		const VERTEX = 2;
		const RASTERIZE = 3;
		
		public static $verbose = false;
		
		public function __construct($width, $height, $name)
		{
			$this->_width = $width;
			$this->_height = $height;
			$this->_filename = $name;
			$this->_screen = imagecreate($this->_width, $this->_height);
			imagecolorallocate($this->_screen, 0, 0, 0);
			if(Render::$verbose)
				echo "Render instance constructed".PHP_EOL;
		}
		public function	renderVertex( Vertex $screenVertex )
		{
			$color = imagecolorallocate($this->_screen, $screenVertex->getRed(), $screenVertex->getGreen(),$screenVertex->getBlue());
			imagesetpixel($this->_screen, $screenVertex->getX() + $this->_width/2, $screenVertex->getY()+ $this->_height/2, $color);
		}
		
		public function renderEdge(Vertex $a, Vertex $b)
		{
			$color1 = imagecolorallocate($this->_screen, $a->getRed(), $a->getGreen(), $a->getBlue());
			$color2 = imagecolorallocate($this->_screen, $b->getRed(), $b->getGreen(), $b->getBlue());
			imagesetstyle($this->_screen, array($color1, $color2));
			imageline($this->_screen, $a->getX() + $this->_width / 2, $a->getY() + $this->_height / 2, $b->getX() + $this->_width / 2, $b->getY() + $this->_height / 2, IMG_COLOR_STYLED);
		}

		public function renderMesh($triangle, $mode)
		{
			foreach($triangle as $tri)
			{
					$this->renderTriangle($tri, $mode);
			}
		}

		public function renderTriangle( Triangle $triangle, $mode ) 
		{
			$a = $triangle->getA()->opposite();
			$b = $triangle->getB()->opposite();
			$c = $triangle->getC()->opposite();

			if($mode == RENDER::VERTEX)
			{
				$this->renderVertex($a);
				$this->renderVertex($b);
				$this->renderVertex($c);
			}
			if($mode == RENDER::EDGE)
			{
				$this->renderEdge($a, $b);
				$this->renderEdge($b, $c);
				$this->renderEdge($a, $c);
			}

			/*$colorA = imagecolorallocate($this->_screen, $a->getRed(), $a->getGreen(),$a->getBlue());
			imagesetpixel($this->_screen, $a->getX() + $this->_width/2, $a->getY()+ $this->_height/2, $colorA);
			$colorB = imagecolorallocate($this->_screen, $a->getRed(), $a->getGreen(),$a->getBlue());
			imagesetpixel($this->_screen, $b->getX() + $this->_width/2, $b->getY()+ $this->_height/2, $colorB);
			$colorC = imagecolorallocate($this->_screen, $a->getRed(), $a->getGreen(),$a->getBlue());
			imagesetpixel($this->_screen, $c->getX() + $this->_width/2, $c->getY()+ $this->_height/2, $colorC);*/
		}
		public function develop()
		{
			imagepng($this->_screen, $this->_filename);
			imagedestroy($this->_screen);
		}
		public function __destruct()
		{
			if(Render::$verbose)
				echo "Render instance destructed".PHP_EOL;
		}
		public static function doc()
        {
            echo file_get_contents("Render.doc.txt").PHP_EOL;
        }
        public function __toString()
        {
            return(sprintf( "Render ( ".PHP_EOL.
                            "width: %d".PHP_EOL.
                            "height: %d".PHP_EOL.
                            "Name: %s".PHP_EOL.
                            " )", $this->_width, $this->_height, $this->_filename));
        }
	}
?>