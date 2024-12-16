<?php
require 'point.php';

$first = new Point;
$first->x = 3;
$first->y = 3;

$second = clone $first;

// $second->x = 5;
$second->y = 5;

echo "x: {$second->x}, y: {$first->y}"; // x: 3, y: 3


class PrintText {
	function __construct()
	{
		
	}
	public function print($args){
		var_dump($args);
	}
}

$var1 = new PrintText();
echo $var1->print('te');
?>