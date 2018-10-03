#!/usr/bin/php
<?PHP

function args_to_tab($var){

$tab = implode(" ", $var);
$tab = explode(" ", $tab);
$tmp = array_shift($tab);
unset($tmp);
return ($tab);
}

$tab = args_to_tab($argv);

foreach ($tab as $elem){
    if (($elem[0] >= 'a' && $elem[0] <= 'z') || ($elem[0] >= 'A' && $elem[0] <= 'Z'))
        $alpha[] = $elem;
    else if ($elem[0] >= '0' && $elem[0] <= '9')
        $num[] = $elem;
    else
        $other[] = $elem;
}

sort($num, SORT_STRING);
natcasesort($alpha);
sort($other);

foreach ($alpha as $elem) {
 echo $elem."\n";
}
foreach ($num as $elem) {
 echo $elem."\n";
}
foreach ($other as $elem) {
 echo $elem."\n";
}

?>