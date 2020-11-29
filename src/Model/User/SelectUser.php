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
	private $dbh;

	public function __construct()
	{
		$database = new Database();
		$this->dbh = $database->connect();
	}

	/**
	 * id からユーザーを検索する
	 *
	 * @param int $id
	 * @return User
	 */
	public function selectUserById(int $id): User
	{
		$stmt = $this->dbh->prepare('SELECT * FROM users WHERE id=:id');
		$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch();

		$user = new User();
		$user->setUserId($result['id']);
		$user->setUserName($result['name']);
		$user->setEmail($result['email']);
		$user->setPassword($result['pass']);

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
		$stmt = $this->dbh->prepare('SELECT * FROM users WHERE email=:email');
		$stmt->bindParam(':email', $email, \PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch();

		$user = new User();
		$user->setUserId($result['id']);
		$user->setUserName($result['name']);
		$user->setEmail($result['email']);
		$user->setPassword($result['pass']);

		return $user;
	}
}
