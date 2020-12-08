<?php

use Routing\Routing;
use Http\Session;

include __DIR__ . '/../autoload.php';
include __DIR__ . '/../config.php';

spl_autoload_register('Autoloader::load');

$session = new Session();
$session->start();

$routing = new Routing();
$routing->routing($_SERVER['REQUEST_URI']);
