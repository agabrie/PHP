#!/usr/bin/php
<?php
    function ft_split($string)
    {
        $full = preg_split('/\s+/', $string);
        return($full);
    }
    $arr = ft_split($argv[1]);
    $arr[-1] = $arr[0];
    unset($arr[0]);
    $arr = implode(" ",$arr);
    echo $arr."\n";
?>