<?php
namespace Model\User;

include '../../functions/db.php';

class SelectUser
{
	private $dbh;

	public function __construct()
	{
		$this->dbh = connect();
	}

	public function selectUserById(User $user)
	{
		$id = $user->getUserId();
		$stmt = $this->dbh->prepare('SELECT * FROM users WHERE id=:id');
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function selectUserByEmail(User $user)
	{
		$email = $user->getEmail();
		$stmt = $this->dbh->prepare('SELECT * FROM users WHERE email=:email');
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
	}
}
