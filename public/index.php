<?php

$url = parse_url($_SERVER['REQUEST_URI']);
$path = $url['path'];

const CONTROLLER_BASE = '../controllers';
const ROUTES = [
	'/' => '/index.php',
	'/user_page' => '/user_page.php',
	'/insert' => '/insert.php',
	'/login_form' => '/login_form.php',
	'/login' => '/login.php',
	'/register_form' => '/register_form.php',
	'/register' => '/register.php',
	'/logout' => '/logout.php',
];
$route = ROUTES[$path] ?? '/404.php';
include CONTROLLER_BASE . $route;
