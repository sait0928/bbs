<?php
ini_set('display_errors', "On");
error_reporting(E_ALL);

use Routing\Routing;

spl_autoload_register(function (string $class_name) {
	$file_path = '../' . str_replace('\\', '/', $class_name) . '.php';
	include_once($file_path);
});

$routing = new Routing();
$routing->routing($_SERVER['REQUEST_URI']);
