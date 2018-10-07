<?php
	if($_GET["submit"] === "OK")
	{
		
	}
?>

<html><body>
	<form action="additem.php" method="post">
		Name:<br><input type="text" name="item"><br>
		Image:<br><input type="text" name="img"><br>
		Description:<br><input type="text" name="desc"><br>
		Type:<br><input type="text" name="type"><br>
		Category:<br><input type="text" name="cat"><br>
		Price:<br><input type="text" name="price"><br>
		Amount:<br><input type="text" name="amount"><br>
		<input type="submit" name="submit" value="OK">
	</form>
</body></html>