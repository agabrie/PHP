#!/usr/bin/php
<?php
    $arr = preg_split('/\s+/', $argv[1]); 
    foreach($arr as $word)
        $string = $string." ".$word;
    echo trim($string)."\n";
?>