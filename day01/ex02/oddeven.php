#!/usr/bin/php
<?php
while(1)
{
    echo "Enter a number: ";
    $f = trim(fgets(STDIN));
    if(feof(STDIN))
    {
        echo "\n";
        exit();
    }
    if(is_numeric($f))
    {
        //$f = intval($f);
        if($f % 2 == 0)
            echo "The number ".$f." is even";
        else
            echo "The number ".$f." is odd";
    }
    else
        echo "'".$f."' is not a number";
    echo "\n";
}
?>