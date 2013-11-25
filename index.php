<?php

$params = array('title' => 'this is a title', 'thing' => 'this is a thing');

foreach($params as $p => $value)
{
	$$p = $value;
	
}
	echo $title;

?>