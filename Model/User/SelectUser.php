<?php
namespace Model\User;

use Database\Database;

class SelectUser
{
	private $dbh;

	public function __construct()
	{
		$database = new Database();
		$this->dbh = $database->connect();
	}

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
