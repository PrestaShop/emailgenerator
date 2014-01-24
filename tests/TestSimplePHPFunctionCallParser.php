<?php

return array(
	array(
		'constructor_arguments' => array('l'),
		'string' => "l('hello')",
		'expect' => array(array("'hello'"))
	),
	array(
		'constructor_arguments' => array('l'),
		'string' => "l('he\'llo')",
		'expect' => array(array("'he\'llo'"))
	),
	array(
		'constructor_arguments' => array('l'),
		'string' => 'l("hello")',
		'expect' => array(array('"hello"'))
	),
	array(
		'constructor_arguments' => array('l'),
		'string' => 'l("he\"llo")',
		'expect' => array(array('"he\"llo"'))
	),
	array(
		'constructor_arguments' => array('l'),
		'string' => "l(('hello'))",
		'expect' => array(array("('hello')"))
	),
	array(
		'constructor_arguments' => array('l'),
		'string' => "l('hello', 'world')",
		'expect' => array(array("'hello'", "'world'"))
	),
	array(
		'constructor_arguments' => array('l'),
		'string' => "l(('hello', 'world'))",
		'expect' => array(array("('hello', 'world')"))
	),
	array(
		'constructor_arguments' => array('l'),
		'string' => "l(a > 0 ? 42 : 24   , 1261)",
		'expect' => array(array("a > 0 ? 42 : 24", "1261"))
	),
	array(
		'constructor_arguments' => array('l'),
		'string' => "l(function(){return 42;}, 1261)",
		'expect' => array(array("function(){return 42;}", "1261"))
	),
	array(
		'constructor_arguments' => array('l'),
		'string' => "l(function() use (\$bob) {return 42+\$bob;}, 1261)",
		'expect' => array(array("function() use (\$bob) {return 42+\$bob;}", "1261"))
	),
	array(
		'constructor_arguments' => array('l'),
		'string' => "l((function() use (\$bob) {return 42+\$bob;})(23), 1261)",
		'expect' => array(array("(function() use (\$bob) {return 42+\$bob;})(23)", "1261"))
	),
	array(
		'constructor_arguments' => array('l'),
		'string' => "l((function(x, y) use (\$bob) {return 42+\$bob;})(23, 24), 1261)",
		'expect' => array(array("(function(x, y) use (\$bob) {return 42+\$bob;})(23, 24)", "1261"))
	)
);