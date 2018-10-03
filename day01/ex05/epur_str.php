#!/usr/bin/php
<?php
    $arr = preg_split('/\s/', $argv[1]);
    $args = 1;
    $string = ""; 
    foreach($arr as $word)
    {
        if(!$word)
            continue;
        $string = $string." ";
        $string = $string.$word;
    }
    echo trim($string)."\n";
?>