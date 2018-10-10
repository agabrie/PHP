#!/usr/bin/php
<?php
	require_once '../ex01/Vertex.class.php';
	require_once '../ex02/Vector.class.php';
	require_once '../ex03/Matrix.class.php';
	class Camera
	{
		private $_origin;
		private $_orient;
		//private $_width = 0.0;
		//private $_height = 0.0;
		private $_ratio = 0;
		private $_fov;
		private $_near;
		private $_far;
		private $_tT;
		private $_tR;
		private $_view;
		private $_project;
		private $_oppv;

		public static $verbose = false;

		function __construct($camera)
		{
			$this->_origin = $camera["origin"];
			$this->_orient = $camera["orientation"];
			if(array_key_exists("width", $camera) && array_key_exists("height",$camera))
			{
				//$this->_width = /2;
				//$this->_height = /2;
				//$camera["ratio"] = ($this->_width)/($this->_height);
				$camera["ratio"] = ($camera["width"])/($camera["height"]);
			}
			$this->_ratio = $camera["ratio"];
			$this->_fov = $camera["fov"];
			$this->_near = $camera["near"];
			$this->_far = $camera["far"];

			$this->_tT = $this->gettT();
			$this->_tR = $this->getDiagSym($this->_orient);
			$this->_view = $this->_tR->mult($this->_tT);
			$this->_project = new Matrix(array(	"preset"=>Matrix::PROJECTION,
												"fov"=>$this->_fov,
												"ratio"=>$this->_ratio,
												"near"=>$this->_near,
												"far"=>$this->_far
											));
			if(Camera::$verbose)
				echo "Camera instance constructed".PHP_EOL;
		}
		function __destruct()
		{
			if(Camera::$verbose)
				echo "Camera instance destructed".PHP_EOL;
		}
		public function gettT()
		{
			if($this->_tT)
				return $this->tT;
			$oppv = new Vector(array("dest" => $this->_origin));
			return new Matrix(array("preset"=>Matrix::TRANSLATION, "vtc"=>$oppv->opposite()));
		}
		public function getDiagSym(Matrix $mat)
		{
			$temp = clone($mat);
			for($i = 0;$i<4;$i++)
				for($j = 0;$j<4;$j++)
					$temp->_matrix[($i)][$j] = $mat->_matrix[($j)][$i];
			return($temp);
		}
		public function watchVertex(Vertex $worldVertex)
		{
			$vert = $this->_tR->transformVertex($worldVertex);
            $vtx = $this->_project->transformVertex($vert);
            $vtx->setX($vtx->getX() * $this->_ratio);
            $vtx->setY($vtx->getY());
            $vtx->setColor($worldVertex->getColor());
            return ($vtx);
        }
		public function doc()
		{
			echo file_get_contents("Camera.doc.txt").PHP_EOL;
		}
		public function __toString()
		{
			return(sprintf("Camera(".PHP_EOL.
			"+ Origine: %s".PHP_EOL.
			"+ tT:".PHP_EOL.
			"%s".PHP_EOL.
			"+ tR:".PHP_EOL.
			"%s".PHP_EOL.
			"+ tR->mult( tT ):".PHP_EOL.
			"%s".PHP_EOL.
			"+ Proj:".PHP_EOL.
			"%s".PHP_EOL.
			")",$this->_origin, $this->_tT, $this->_tR,$this->_view, $this->_project));
		}
	}
?>