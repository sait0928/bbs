<?php

use Routing\Routing;
use Http\Session;

include __DIR__ . '/../autoload.php';
include __DIR__ . '/../config.php';
include __DIR__ . '/../vendor/autoload.php';

spl_autoload_register('Autoloader::load');

$container = new DI\Container();

$container->get(Session::class)->start();

$container->get(Routing::class)->routing($_SERVER['REQUEST_URI'], $container);
