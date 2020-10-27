<?php

session_start();

include 'functions.php';

$_SESSION = array();
session_destroy();

redirect('/login_form.php');
