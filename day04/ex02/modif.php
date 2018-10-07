<?php
	$pwdir = "../private";
	$pwfile = $pwdir."/passwd";
	if($_POST["login"]==="" || $_POST["oldpw"] === "" || !file_exists($pwfile)|| $_POST["submit"]!=="OK")
	{
		echo "ERROR\n";
		return ;
	}
	if(file_exists($pwfile))
	{
		$array = unserialize(file_get_contents($pwfile));
		//$old = $_POST["oldpw"];
		$old = hash("sha1",$_POST["oldpw"]);
		//$new = $_POST["newpw"];
		$new = hash("sha1",$_POST["newpw"]);
		foreach($array as &$elem)
		{
			if($elem["login"] === $_POST["login"] && $elem["passwd"] === $old)
			{
				$elem["passwd"] = $new;
				file_put_contents($pwfile, serialize($array));
				echo "OK\n";
				return ;
			}
		}
		echo "ERROR\n";
		return ;
	}
?>
