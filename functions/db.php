<?php

/**
 * データベースに接続
 *
 * @return PDO
 */
function connect(): PDO
{
	return new PDO(
		'mysql:dbname=bbs;host=localhost',
		'root',
		''
	);
}
