<?php
	function auth($login, $passwd)
	{
		$pwdir = "../private";
		$pwfile = $pwdir."/adminpasswd";
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
