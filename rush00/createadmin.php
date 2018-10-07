<?php
	$pwdir = "../private";
	$pwfile = $pwdir."/adminpasswd";
	if($_POST["login"]==="" || $_POST["passwd"] === "" || $_POST["submit"]!=="OK")
	{
		echo "ERROR!\n";
		return ;
	}
	if(!file_exists($pwdir) || !file_exists($pwfile))
		mkdir($pwdir);
	if(file_exists($pwfile))
	{
		$array = unserialize(file_get_contents($pwfile));
		foreach($array as $elem)
		{
			if($elem["login"] === $_POST["login"])
			{
				echo "Error!\n";
				return;
			}
		}
	}
	$info["login"] = $_POST["login"];
	$info["passwd"] = hash("sha1",$_POST["passwd"]);
	//$info["passwd"] = $_POST["passwd"];
	$array[] = $info;
	file_put_contents($pwfile, serialize($array));
	echo "OK\n";
?>
