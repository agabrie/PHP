#!/usr/bin/php
<?php
    function do_op($num1, $char, $num2)
    {
        switch ($char)
        {
            case "+":
                return($num1 + $num2);
            case "-":
                return($num1 - $num2);
            case "*":
                return($num1 * $num2);
            case "/":
                return($num1 / $num2);
            case "%":
                return($num1 % $num2);
            default:
                break;
        }
    }
    if($argc == 4)
        echo do_op(trim($argv[1]), trim($argv[2]),trim($argv[3]));
    else
        echo "Incorrect Parameters";
    echo "\n";
?>