<?php

/**
 * ログイン
 *
 * @param PDO $dbh
 * @param string $email
 * @param string $pass
 * @return bool
 */
function login(PDO $dbh, string $email, string $pass): bool
{
	$stmt = $dbh->prepare('SELECT pass FROM users WHERE email=:email');
	$stmt->bindParam(':email', $email, PDO::PARAM_STR);
	$stmt->execute();

	$verify_pass = $stmt->fetch();

	if(password_verify($pass, $verify_pass['pass'])) {
		return (bool)true;
	} else {
		return (bool)false;
	}
}
