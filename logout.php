<?php

session_start();

$_SESSION = array();
session_destroy();

redirect('/login_form.php');
