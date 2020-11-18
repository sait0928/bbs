<?php
namespace Model\User;

class UserRegistration
{
	private $dbh;

	public function __construct()
	{
		$this->dbh = connect();
	}

	public function register(string $name, string $email, string $pass): void
	{
		$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
		$stmt = $this->dbh->prepare('INSERT INTO users (name, email, pass) VALUES (:name, :email, :pass)');
		$stmt->bindParam(':name', $name, \PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, \PDO::PARAM_STR);
		$stmt->bindParam(':pass', $hashed_pass, \PDO::PARAM_STR);
		$stmt->execute();
	}
}
