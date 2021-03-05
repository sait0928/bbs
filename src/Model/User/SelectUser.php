<?php
namespace Model\User;

use Database\Database;

/**
 * ユーザーを検索するモデル
 *
 * @package Model\User
 */
class SelectUser
{
	private Database $db;

	public function __construct(
		Database $db
	) {
		$this->db = $db;
	}

	/**
	 * id からユーザーを検索する
	 *
	 * @param int $id
	 * @return User
	 */
	public function selectUserById(int $id): User
	{
		$stmt = $this->db->getConnection()->prepare('SELECT * FROM users WHERE id=:id');
		$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
		$stmt->execute();
		/**
		 * @var array{
		 *   id: int,
		 *   name: string,
		 *   email: string,
		 *   pass: string
		 * } $result
		 */
		$result = $stmt->fetch();

		$user = new User(
			$result['id'],
			$result['name'],
			$result['email'],
			$result['pass']
		);

		return $user;
	}

	/**
	 * email からユーザーを検索する
	 *
	 * @param string $email
	 * @return User
	 */
	public function selectUserByEmail(string $email): User
	{
		$stmt = $this->db->getConnection()->prepare('SELECT * FROM users WHERE email=:email');
		$stmt->bindParam(':email', $email, \PDO::PARAM_STR);
		$stmt->execute();
		/**
		 * @var array{
		 *   id: int,
		 *   name: string,
		 *   email: string,
		 *   pass: string
		 * } $result
		 */
		$result = $stmt->fetch();

		$user = new User(
			$result['id'],
			$result['name'],
			$result['email'],
			$result['pass']
		);

		return $user;
	}
}
