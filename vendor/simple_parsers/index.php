<?php

@ini_set('display_errors', 'on');

$tests_dir = dirname(__FILE__).'/tests';

$ran = 0;

foreach (scandir($tests_dir) as $entry)
{
	$path = $tests_dir.'/'.$entry;
	$m = array();
	if (is_file($path) && preg_match('/^Test(\w+)\.php$/', $entry, $m))
	{
		$className = $m[1];

		require_once dirname(__FILE__).'/classes/'.$className.'.php';

		$tests = include($path);

		foreach ($tests as $n => $test)
		{
			$instanciator = new ReflectionClass($className);
			$instance = $instanciator->newInstanceArgs($test['constructor_arguments']);

			$result = $instance->parse($test['string']);

			if ($result !== $test['expect'])
			{
				echo "<p>Test $n of $className failed!</p>";
				echo "<p>We expected:</p>";
				echo "<pre>";
				print_r($test['expect']);
				echo "</pre>";
				echo "<p>For input:</p>";
				echo "<pre>";
				echo $test['string'];
				echo "</pre>";
				echo "<p>But instead we got:</p>";
				echo "<pre>";
				print_r($result);
				echo "</pre>";
				echo "<p>You must have broken something, sorry!</p>";
				die();
			}

			$ran++;
		}
	}
}

die("<p>Successfully ran all $ran tests!</p>");