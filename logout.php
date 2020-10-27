<?php

session_start();

include 'functions.php';

logout();

redirect('/login_form.php');
