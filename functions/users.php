<?php

/**
 * ユーザー新規登録
 *
 * @param string $pass
 * @param string $again
 * @param PDO $dbh
 * @param string $name
 * @param string $email
 */
function register(string $pass, string $again, PDO $dbh, string $name, string $email): void
{
	if($pass === $again) {
		$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
		$stmt = $dbh->prepare('INSERT INTO users (name, email, pass) VALUES (:name, :email, :pass)');
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
		$stmt->execute();
	}
}

/**
 * メールアドレスからユーザーのレコードを取得
 *
 * @param PDO $dbh
 * @param string $email
 * @return array
 */
function selectUserByEmail(PDO $dbh, string $email): array
{
	$stmt = $dbh->prepare('SELECT * FROM users WHERE email=:email');
	$stmt->bindParam(':email', $email, PDO::PARAM_STR);
	$stmt->execute();
	return $user = $stmt->fetch();
}

/**
 * IDからユーザーのレコードを取得
 *
 * @param PDO $dbh
 * @param int $id
 * @return array
 */
function selectUserById(PDO $dbh, int $id): array
{
	$stmt = $dbh->prepare('SELECT * FROM users WHERE id=:id');
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	return $user = $stmt->fetch();
}
