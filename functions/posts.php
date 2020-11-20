<?php

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
