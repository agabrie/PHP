<?php
	session_start();
	if($_GET["submit"] == "OK")
	{
		$_SESSION["login"] = $_GET["login"];
		$_SESSION["passwd"] = $_GET["passwd"];
	}
	else
		echo "Error\n";
?>
<html><body>
<form method="get" action="index.php">
	Username:<input type="text" name="login" value="<?php if ($_SESSION["login"]){ echo $_SESSION["login"];}?>" />
	<br />
	Password:<input type="password" name="passwd" value="<?php if ($_SESSION["passwd"]){ echo $_SESSION["passwd"];}?>" />
	<input type="submit" name="submit" value="OK">
</form>
</body></html>