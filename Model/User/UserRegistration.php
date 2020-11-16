<?php
namespace Model\User;

include '../../functions/db.php';

class UserRegistration
{
	private $dbh;

	public function __construct()
	{
		$this->dbh = connect();
	}

	public function register(User $user): void
	{
		$name = $user->getUserName();
		$email = $user->getEmail();
		$pass = password_hash($user->getPassword(), PASSWORD_DEFAULT);
		$stmt = $this->dbh->prepare('INSERT INTO users (name, email, pass) VALUES (:name, :email, :pass)');
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
		$stmt->execute();
	}
}
