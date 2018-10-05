<?php
if($name = $_GET["name"])
{
switch($_GET["action"])
{
	case "set":
		if($name)
			setcookie($name, $_GET["value"], time() + 300);
		break;
	case "get":
		if($_COOKIE[$name])
			echo $_COOKIE[$name]."\n";
		break;
	case "del":
		if($name)
			setcookie($name,NULL, time() - 300);
		break;
	default:
		break;
}
}
?>