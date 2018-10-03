#!/usr/bin/php
<?php
    function ft_split($string)
    {
        $full = preg_split('/\s+/', $string);
        sort($full);
        return($full);
    }
    $i = 0;
    for($num = 1; $num < $argc; $num++)
    {
        $stuff = ft_split($argv[$num]);
        foreach($stuff as $things)
        {
            $arr[$i] = $things;
            $i++;
        }
    }
    sort($arr);
    foreach($arr as $elem)
        echo $elem."\n";
?>