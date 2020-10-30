<?php

session_start();

include 'functions.php';
include 'functions/http.php';

logout();

redirect('/login_form.php');
