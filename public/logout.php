<?php

session_start();

include '../functions/http.php';
include '../functions/auth.php';

logout();

redirect('/login_form.php');
