<?php
namespace Database;

class Database
{
	public function connect(): \PDO
	{
		return new \PDO(
			'mysql:dbname=bbs;host=localhost',
			'root',
			''
		);
	}
}
