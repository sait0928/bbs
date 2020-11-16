<?php
ini_set('display_errors', "On");
include '../functions/routes.php';

routing($_SERVER['REQUEST_URI']);
