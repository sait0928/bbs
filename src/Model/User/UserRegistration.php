<?php
namespace Model\User;

use Database\Database;

/**
 * ユーザーを新規登録するモデル
 *
 * @package Model\User
 */
class UserRegistration
{
	private Database $db;

	public function __construct(
		Database $db
	) {
		$this->db = $db;
	}

	/**
	 * 新規登録
	 *
	 * @param string $name
	 * @param string $email
	 * @param string $pass
	 */
	public function register(string $name, string $email, string $pass): void
	{
		$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
		$stmt = $this->db->getConnection()->prepare('INSERT INTO users (name, email, pass) VALUES (:name, :email, :pass)');
		$stmt->bindParam(':name', $name, \PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, \PDO::PARAM_STR);
		$stmt->bindParam(':pass', $hashed_pass, \PDO::PARAM_STR);
		$stmt->execute();
	}
}
