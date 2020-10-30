<?php

/**
 * データベースに接続
 *
 * @param string $dsn
 * @param string $user
 * @param string $pass
 * @return PDO
 */
function connect(string $dsn, string $user, string $pass): PDO
{
	return $dbh = new PDO($dsn, $user, $pass);
}

/**
 * フォームに入力された内容をテーブルに挿入
 *
 * @param PDO $dbh
 * @param string $text
 * @param int $user_id
 */
function insert(PDO $dbh, string $text, int $user_id): void
{
	$stmt = $dbh->prepare('INSERT INTO posts (post, user_id) VALUES (:post, :user_id)');
	$stmt->bindParam(':post', $text, PDO::PARAM_STR);
	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$stmt->execute();
}

/**
 * レコードを削除
 *
 * @param PDO $dbh
 * @param int $id
 */
function delete(PDO $dbh, int $id): void
{
	$stmt = $dbh->prepare('DELETE FROM posts WHERE id=:id');
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
}

/**
 * テーブルの内容を出力
 *
 * @param PDO $dbh
 * @param int|null $page
 * @return array
 */
function select(PDO $dbh, ?int $page): array
{
	if($page === null) {
		$stmt = $dbh->query('SELECT * FROM posts ORDER BY id DESC LIMIT 3');
		return $posts = $stmt->fetchAll();
	} else {
		$start = ($page - 1) * 3;
		$stmt = $dbh->prepare('SELECT * FROM posts ORDER BY id DESC LIMIT :start, 3');
		$stmt->bindParam(':start', $start, PDO::PARAM_INT);
		$stmt->execute();
		return $posts = $stmt->fetchAll();
	}
}

/**
 * ページ総数のカウント
 *
 * @param PDO $dbh
 * @return int
 */
function countPages(PDO $dbh): int
{
	$stmt = $dbh->query('SELECT COUNT(*) FROM posts');
	$count = $stmt->fetchColumn();
	return $pages = ceil($count / 3);
}

/**
 * リダイレクト
 *
 * @param string $url
 */
function redirect(string $url): void
{
	header('Location: '.$url);
	exit;
}

/**
 * 新規登録
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

/**
 * ログアウト
 */
function logout(): void
{
	$_SESSION = array();
	session_destroy();
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
 * @param string $id
 * @return array
 */
function selectUserById(PDO $dbh, string $id): array
{
	$stmt = $dbh->prepare('SELECT * FROM users WHERE id=:id');
	$stmt->bindParam(':id', $id, PDO::PARAM_STR);
	$stmt->execute();
	return $user = $stmt->fetch();
}
