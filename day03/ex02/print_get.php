<?php
	//echo (implode($_GET,": "));
	if($_GET)
		foreach($_GET as $key => $value)
			echo ($key.": ".$value."\n");
?>