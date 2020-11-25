<?php
namespace Model\User;

use Model\User\AuthStorage;

include 'AuthStorage.php';

class Auth
{
	private SelectUser $select_user;

	public function __construct(SelectUser $select_user)
	{
		$this->select_user = $select_user;
	}

	private function verifyPassword(string $password_input, User $user): bool
	{
		return password_verify($password_input, $user->getPassword());
	}

	public function login(string $email, string $password): void
	{
		$user = $this->select_user->selectUserByEmail($email);
		if ($this->verifyPassword($password, $user)) {
			$authStorage = new AuthStorage();
			$authStorage->setStorage($user);
		}
	}

	public function isLoggedIn(): bool
	{
		return isset($_SESSION['user_id']);
	}

	public function logout(): void
	{
		$authStorage = new AuthStorage();
		$authStorage->clearStorage();
	}
}

