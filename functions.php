<?php

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
 * ログアウト
 */
function logout(): void
{
	$_SESSION = array();
	session_destroy();
}
