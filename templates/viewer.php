<?php

@ini_set('display_errors', 'on');

$template = isset($_GET['template']) ? $_GET['template'] : null;

if (isset($_GET['preview']))
{
	echo '<style>img[src="{shop_logo}"]{content: url(\'logo.jpg\');}</style>';
}

function t($str)
{
	static $dictionary;

	if (!is_array($dictionary))
	{
		$language = isset($_GET['language']) ? $_GET['language'] : 'en';
		$dictionary_path = dirname(__FILE__).'/../templates_translations/'.$language.'/lang_content.php';
		if (file_exists($dictionary_path))
			$dictionary = include($dictionary_path);
		else
			$dictionary = array();
	}

	if (isset($dictionary[$str]) && trim($dictionary[$str]) !== '')
		return $dictionary[$str];
	else
		return $str;
}

$m = array();
if($template && (preg_match('#^templates/(core/[^/]+|modules/[^\./]+/[^/]+)$#', $template, $m)))
{
	if (dirname($template) !== 'templates/core')
	{
		set_include_path(dirname(__FILE__).'/core:'.get_include_path());
	}

	include $m[1];
}
else
{
	die("Missing template argument!");
}