<?php
	class Lannister
	{
		function	sleepWith($person)
		{
			switch(get_parent_class($person))
			{
				case "Lannister":
					print("Not even if I'm drunk !".PHP_EOL);
					break;
				default:
					print "Let's do this.".PHP_EOL;
					break;
			}
		}
	}
?>