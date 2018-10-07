<?php 
	include("auth.php");
	session_start();
	if($_GET["submit"] === "OK")
	{
		$cartdir = "cartdir";
		$cartfile = $itemdir."/cart";
		if(!file_exists($cartdir))
			mkdir($cartdir);
		//echo $_GET["login"]."   ".$_GET["passwd"]."<br>";
		file_put_contents($cartfile, "");
		if(auth($_GET["login"],$_GET["passwd"]))
		{
			$_SESSION["loggued_on_user"] = $_GET["login"];
			file_put_contents();
			echo "OK\n";
			return ;
		}
		$_SESSION["loggued_on_user"] = "";
		echo "ERROR\n";
		return ;
	}
	
?>
<html>
<head>
		<style>
			body
			{
				background: radial-gradient( rgba(107, 50, 67, 0.89),rgb(66, 27, 40));
			}
			.writing 
			{
				color: white;
			}
			#welcome
			{
				text-align: center;
				font-family: cursive;
				font-size: 1000%;
				color: rgb(138, 73, 100);
			}
		</style>
</head>
	



<body>
	<h1 id="welcome"><p>Login</p></h1>
	<form action="login.php" method="get">
		<div class="writing"> Username:<br></div><input type="text" name="login" key="<?php if ($_SESSION["loggued_on_user"]){ echo $_SESSION["logged_on_user"];}?>">
		<br />
		<div class="writing">Password:<br></div><input type="password" name="passwd">
		<br />
		<input type="submit" name="submit" value="OK">
	</form>
</body></html>

