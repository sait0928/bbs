<?php
ini_set('display_errors', "On");
error_reporting(E_ALL);

include '../functions/routes.php';

routing($_SERVER['REQUEST_URI']);
