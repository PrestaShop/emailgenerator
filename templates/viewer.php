<style>
	img[src="{shop_logo}"]
	{
		content: url('logo.jpg');
	}
</style>

<?php

@ini_set('display_errors', 'on');

$template = isset($_GET['template']) ? $_GET['template'] : null;

function t($str)
{
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