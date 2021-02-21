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

	/**
	 * ユーザ情報を更新する
	 *
	 * @param string $name
	 * @param string $email
	 * @param string $pass
	 * @param int $user_id
	 */
	public function updateUser(string $name, string $email, string $pass, int $id): void
	{
		if($name !== '') {
			$sql_array['name'] = 'name = :name';
			$value_array['name'] = $name;
		}

		if($email !== '') {
			$sql_array['email'] = 'email = :email';
			$value_array['email'] = $email;
		}

		if($pass !== '') {
			$sql_array['pass'] = 'pass = :pass';
			$value_array['pass'] = password_hash($pass, PASSWORD_DEFAULT);
		}

		$sql = 'UPDATE users SET ' . implode(', ', $sql_array) . ' WHERE id = :id';

		$stmt = $this->db->getConnection()->prepare($sql);
		foreach($value_array as $key => $value) {
			$place_holder = ':' . $key;
			$stmt->bindParam($place_holder, $value, \PDO::PARAM_STR);
		}
		$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
		$stmt->execute();
	}
}