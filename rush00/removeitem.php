<?php
	$itemdir = "itemsdir";
	$itemfile = $itemdir."/items";
	if($_POST["submit"] === "OK" && $_POST["id"] !== "")
	{
		if(!file_exists($itemdir))
			mkdir($itemdir);
		if(file_exists($itemfile))
		{
			$array =  unserialize(file_get_contents($itemfile));
			foreach($array as &$item)
			{
				if($item["id"] === $_POST["id"])
				{
					unset($item["id"]);
					unset($item["img"]);
					unset($item["desc"]);
					unset($item["type"]);
					unset($item["cat"]);
					unset($item["price"]);
					unset($item["amount"]);
					unset($item);
					file_put_contents($itemfile, serialize($array));
					echo "Item: ".$_POST["id"]." successfully removed!\n";
					return;
				}
			}
			echo "Item : ".$_POST["id"]." does not exist\n";
		}
	}
?>

<html><body>
	<form action="removeitem.php" method="post">
		Name:<br><input type="text" name="id"><br>
		<input type="submit" name="submit" value="OK">
	</form>
</body></html>