<?php

/**
 * 記事の出力
 *
 * @param PDO $dbh
 * @param int|null $page
 * @return array
 */
function select(PDO $dbh, ?int $page): array
{
	if($page === null) {
		$stmt = $dbh->query('SELECT posts.id as post_id, post, user_id, name FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.id DESC LIMIT 3');
		return $stmt->fetchAll();
	} else {
		$start = ($page - 1) * 3;
		$stmt = $dbh->prepare('SELECT posts.id as post_id, post, user_id, name FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.id DESC LIMIT :start, 3');
		$stmt->bindParam(':start', $start, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}

/**
 * 記事総数のカウント
 *
 * @param PDO $dbh
 * @return int
 */
function countPosts(PDO $dbh): int
{
	$stmt = $dbh->query('SELECT COUNT(*) FROM posts');
	return $stmt->fetchColumn();
}

/**
 * ユーザー記事の出力
 *
 * @param PDO $dbh
 * @param int|null $page
 * @param int $user_id
 * @return array
 */
function selectUserPosts(PDO $dbh, ?int $page, int $user_id): array
{
	if($page === null) {
		$stmt = $dbh->prepare('SELECT posts.id as post_id, post, user_id, name FROM posts INNER JOIN users ON posts.user_id = users.id WHERE user_id = :user_id ORDER BY posts.id DESC LIMIT 3');
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	} else {
		$start = ($page - 1) * 3;
		$stmt = $dbh->prepare('SELECT posts.id as post_id, post, user_id, name FROM posts INNER JOIN users ON posts.user_id = users.id WHERE user_id = :user_id ORDER BY posts.id DESC LIMIT :start, 3');
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->bindParam(':start', $start, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}

/**
 * ユーザー記事総数のカウント
 *
 * @param PDO $dbh
 * @param int $user_id
 * @return int
 */
function countUserPosts(PDO $dbh, int $user_id): int
{
	$stmt = $dbh->prepare('SELECT COUNT(*) FROM posts WHERE user_id = :user_id');
	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchColumn();
}
