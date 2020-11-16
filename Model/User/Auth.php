<?php
namespace Model\User;

include '../../functions/db.php';

class Auth
{
	private $dbh;

	public function __construct()
	{
		$this->dbh = connect();
	}

	public function login(User $user)
	{
		$email = $user->getEmail();
		$pass = $user->getPassword();
		$stmt = $this->dbh->prepare('SELECT pass FROM users WHERE email=:email');
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();

		$verify_pass = $stmt->fetch();

		if(password_verify($pass, $verify_pass['pass'])) {
			return (bool)true;
		} else {
			return (bool)false;
		}
	}

	public function logout()
	{
		$_SESSION = array();
		session_destroy();
	}
}

