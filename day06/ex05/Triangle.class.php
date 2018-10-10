#!/usr/bin/php
<?php
    class Triangle
    {
        private $_a;
        private $_b;
        private $_c;
        public static $verbose = false;

        public function __construct($vertices)
        {
            $this->_a = $vertices["A"];
            $this->_b = $vertices["B"];
            $this->_c = $vertices["C"];
            if(Triangle::$verbose)
                echo "Triangle instance constructed".PHP_EOL;
        }

        public function __destruct()
        {
            if(Triangle::$verbose)
                echo "Triangle instance destructed".PHP_EOL;
        }
        public static function doc()
        {
            echo file_get_contents("Triangle.doc.txt").PHP_EOL;
        }
        public function __toString()
        {
            return(sprintf( "Triangle ( ".PHP_EOL.
                            "A: %s".PHP_EOL.
                            "B: %s".PHP_EOL.
                            "C: %s".PHP_EOL.
                            " )", $this->_a, $this->_b, $this->_c));
        }
    }
?>