<?php
	function($item, $amount)
	{
		$itemdir = "itemsdir";
		$itemfile = $itemdir."/items";
		$cartdir = "cartdir";
		$cartfile = $cartdir."/cart";
		if(file_exists($itemfile) && file_exists($cartfile))
		{
			$array = unserialize(file_get_contents($itemfile));
			$basket = unserialize(file_get_contents($cartfile));
			foreach($array as &$elem)
			{
				if($item === $elem["id"] && intval($elem["amount"]) - $amount > 0)
				{
					$cart["id"] = $elem["id"];
					$cart["amount"] = $elem["amount"];
					$elem["amount"] = (intval($elem["amount"])-$amount)."";
				}
			}
			$basket[] = $cart;
			file_put_contents($cartfile, serialize($basket));
		}
	}
?>