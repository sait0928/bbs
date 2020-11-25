<?php

use Routing\Routing;

include __DIR__ . '/../autoload.php';
include __DIR__ . '/../config.php';

spl_autoload_register('Autoloader::load');

$routing = new Routing();
$routing->routing($_SERVER['REQUEST_URI']);
