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
 */
function insert(PDO $dbh, string $text): void
{
	$stmt = $dbh->prepare('INSERT INTO posts (post) VALUES (:post)');
	$stmt->bindParam(':post', $text, PDO::PARAM_STR);
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
 */
function register(string $pass, string $again, PDO $dbh, string $name): void
{
	if($pass === $again) {
		$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
		$stmt = $dbh->prepare('INSERT INTO users (user, pass) VALUES (:user, :pass)');
		$stmt->bindParam(':user', $name, PDO::PARAM_STR);
		$stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
		$stmt->execute();
	}
}
