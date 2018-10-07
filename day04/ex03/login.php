<?php
	include("auth.php");
	session_start();
	if($_GET["submit"] === "OK")
	{
		//echo $_GET["login"]."   ".$_GET["passwd"]."<br>";
		if(auth($_GET["login"],$_GET["passwd"]))
		{
			$_SESSION["loggued_on_user"] = $_GET["login"];
			echo "OK\n";
			return ;
		}
		$_SESSION["loggued_on_user"] = "";
		echo "ERROR\n";
		return ;
	}
	
?>
<html><body>
	<form action="login.php" method="get">
		Username:<br><input type="text" name="login" key="<?php if ($_SESSION["loggued_on_user"]){ echo $_SESSION["logged_on_user"];}?>">
		<br />
		Password:<br><input type="password" name="passwd">
		<br />
		<input type="submit" name="submit" value="OK">
	</form>
</body></html>