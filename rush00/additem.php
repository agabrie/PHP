<?php
	$itemdir = "itemsdir";
	$itemfile = $itemdir."/items";
	if($_POST["submit"] === "OK" && $_POST["id"] !== "" && $_POST["img"] !== "" && $_POST["desc"] !== ""&& $_POST["type"] !== ""&& $_POST["cat"] !== ""&& $_POST["price"] !== ""&& $_POST["img"] !== "amount")
	{
		if(!file_exists($itemdir))
			mkdir($itemdir);
		if(file_exists($itemfile))
		{
			$array =  unserialize(file_get_contents($itemfile));
			foreach($array as $item)
			{
				if($item["id"] === $_POST["id"])
				{
					echo "Item already exists";
					return;
				}
			}
		}
		$info["id"] = $_POST["id"];
		$info["img"] = $_POST["img"];
		$info["desc"] = $_POST["desc"];
		$info["type"] = $_POST["type"];
		$info["color"] = $_POST["color"];
		$info["price"] = $_POST["price"];
		$info["amount"] = $_POST["amount"];
		$array[] = $info;
		file_put_contents($itemfile, serialize($array));
		echo "Item: ".$info["id"]." x ".$info["amount"]." added at R ".$info["price"]." each!\n";
	}
?>

<html><body>
	<form action="additem.php" method="post">
		Name:<br><input type="text" name="id"><br>
		Image:<br><input type="text" name="img"><br>
		Description:<br><input type="text" name="desc"><br>
		Type:<br><input type="text" name="type"><br>
		Color:<br><input type="text" name="color"><br>
		Price:<br><input type="text" name="price"><br>
		Amount:<br><input type="text" name="amount"><br>
		<input type="submit" name="submit" value="OK">
	</form>
</body></html>