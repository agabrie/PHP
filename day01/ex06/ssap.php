#!/usr/bin/php
<?php
    function ft_split($string)
    {
        $full = preg_split('/\s+/', $string);
        return($full);
    }

    function ssapnosort($av, $ac)
    {
        $i = 0;
        for($num = 1; $num < $ac; $num++)
        {
            $stuff = ft_split($av[$num]);
            foreach($stuff as $things)
            {
                $arr[$i] = $things;
                $i++;
            }
        }
        return ($arr);
    }

    $arr = ssapnosort($argv, $argc);
    sort($arr);
    foreach($arr as $elem)
        echo $elem."\n";
?>