<?php
$pwdir = "../private";
$pwfile = $pwdir."/passwd";
    function auth($login, $passwd)
    {
        $hashed = hash("sha1",$passwd);
        if(file_exists($pwfile))
        {
            $array = unserialize(file_get_contents($pwfile));
            foreach($array as $elem)
            {
                if($elem["login"] === $login && $elem["passwd"] === $hashed)
                    return true;
            }
            return false;
        }
        else
            return false;
    }
?>