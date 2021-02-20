<?php
namespace Model\User;

use Database\Database;

class UserUpdate
{
	private Database $db;

	public function __construct(
		Database $db
	) {
		$this->db = $db;
	}

	private function createSql(array $sql_array): string
	{
		$sql = 'UPDATE users SET ' . implode(', ', $sql_array) . ' WHERE id = :id';
		return $sql;
	}

	public function updateUser(array $sql_array, array $value_array, int $user_id): void
	{
		$sql = $this->createSql($sql_array);
		$stmt = $this->db->getConnection()->prepare($sql);
		foreach($sql_array as $key => $value) {
			$place_holder = ':' . $key;
			$stmt->bindParam($place_holder, $value_array[$key], \PDO::PARAM_STR);
		}
		$stmt->bindParam(':id', $user_id, \PDO::PARAM_INT);
		$stmt->execute();
	}
}