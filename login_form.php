<?php

session_start();

include 'functions/http.php';

if(isset($_SESSION['user_id'])) {
	redirect('/');
}

include 'templates/login_form.php';
