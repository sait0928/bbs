<?php
ini_set('display_errors', "On");
error_reporting(E_ALL);

use Routing\Routing;

const BASE_DIR = __DIR__ . '/..';
const SOURCE_DIR = BASE_DIR . '/src';
const TEMPLATE_DIR = BASE_DIR . '/templates';

spl_autoload_register(function (string $class_name) {
	$file_path = SOURCE_DIR . '/' . str_replace('\\', '/', $class_name) . '.php';
	include_once($file_path);
});

$routing = new Routing();
$routing->routing($_SERVER['REQUEST_URI']);
