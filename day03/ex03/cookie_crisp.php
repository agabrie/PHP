<?php
if($_GET)
{
		switch($_GET["action"])
		{
			case "set":
				setcookie($_GET["name"], $_GET["value"], time() + 3600);
				break;
			case "get":
				if($_COOKIE[$_GET["name"]] == $_GET["name"])
					echo $_COOKIE[$_GET["name"]]. "\n";
				break;
			case "del":
				if($_COOKIE[$_GET["name"]] == $_GET["name"])
					setcookie($_GET["name"],NULL, -1);
			default:
				break;
		}
}
?>