#!/usr/bin/php
<?php
    function ft_is_sort($av)
    {
        $arr = $av;
        sort($arr);
        return ($av == $arr);
    }
?>