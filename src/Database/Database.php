<?php
namespace Database;

/**
 * データベースに関するクラス
 *
 * @package Database
 */
class Database
{
	/**
	 * データベースに接続する
	 *
	 * @return \PDO
	 */
	public function connect(): \PDO
	{
		return new \PDO(
			'mysql:dbname=bbs;host=localhost',
			'root',
			''
		);
	}
}
