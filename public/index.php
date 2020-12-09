<?php

use Routing\Router;
use Http\Session;

include __DIR__ . '/../autoload.php';
include __DIR__ . '/../config.php';
include __DIR__ . '/../vendor/autoload.php';

spl_autoload_register('Autoloader::load');

$container = new DI\Container();

$container->get(Session::class)->start();

$route = $container->get(Router::class)->routing($_SERVER['REQUEST_URI']);

$middleware_name = $route->middlewares['middleware_name'];
$method = $route->middlewares['method'];
$container->get($middleware_name)->$method();

$controller_class = $route->controller_class;
$action = $route->action;
$container->get($controller_class)->$action();
