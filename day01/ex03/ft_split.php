#!/usr/bin/php
<?php
    function ft_split($string)
    {
        $x = 0;
        $y = 0;
        $arr = str_split($string);
        foreach($arr as $char)
        {
            if($char == " ")
            {
                $x++;
                continue;
            }
            $full[$x] = $full[$x].$char;
            
        }
        sort($full);
        return($full);
    }
?>