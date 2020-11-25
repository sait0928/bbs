<?php
ini_set('display_errors', "On");
error_reporting(E_ALL);

use Routing\Routing;

include __DIR__ . '/../autoload.php';

const BASE_DIR = __DIR__ . '/..';
const SOURCE_DIR = BASE_DIR . '/src';
const TEMPLATE_DIR = BASE_DIR . '/templates';

spl_autoload_register('Autoloader::load');

$routing = new Routing();
$routing->routing($_SERVER['REQUEST_URI']);
