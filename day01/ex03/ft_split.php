#!/usr/bin/php
<?php
    function ft_split($string)
    {
        $full = preg_split('/\s+/', $string);
        sort($full);
        return($full);
    }
?>