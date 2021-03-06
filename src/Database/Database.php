<?php
namespace Database;

/**
 * データベースに関するクラス
 *
 * @package Database
 */
class Database
{
	private ?\PDO $connection = null;

	/**
	 * データベースに接続する
	 *
	 * @return \PDO
	 */
	private function connect(): \PDO
	{
		$password = getenv('MYSQL_ROOT_PASSWORD');
		if($password === false) {
			$password = '';
		}
		$host = getenv('MYSQL_HOST');
		if($host === false) {
			$host = 'localhost';
		}
		return new \PDO(
			'mysql:dbname=bbs;host=' . $host,
			'root',
			$password,
			[
				// 取得した値の型変換を無効にする
				\PDO::ATTR_EMULATE_PREPARES => false
			]
		);
	}

	/**
	 * 接続していない場合は接続する
	 *
	 * @return \PDO
	 */
	public function getConnection(): \PDO
	{
		if(is_null($this->connection)) {
			$this->connection = $this->connect();
		}
		return $this->connection;
	}
}
