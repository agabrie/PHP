<?php
class Fighter
{
	private $div;

	public function __construct($type)
	{
		$this->div = $type;
	}
	public function getDiv()
	{
		return($this->div);
	}
}
?>