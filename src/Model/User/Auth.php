<?php
namespace Model\User;

use Model\User\AuthStorage;

include 'AuthStorage.php';

/**
 * ユーザー認証に関わるモデル
 *
 * @package Model\User
 */
class Auth
{
	private SelectUser $select_user;

	public function __construct(SelectUser $select_user)
	{
		$this->select_user = $select_user;
	}

	/**
	 * パスワードを認証
	 *
	 * @param string $password_input
	 * @param User $user
	 * @return bool
	 */
	private function verifyPassword(string $password_input, User $user): bool
	{
		return password_verify($password_input, $user->getPassword());
	}

	/**
	 * ログイン
	 *
	 * @param string $email
	 * @param string $password
	 */
	public function login(string $email, string $password): void
	{
		$user = $this->select_user->selectUserByEmail($email);
		if ($this->verifyPassword($password, $user)) {
			$authStorage = new AuthStorage();
			$authStorage->setStorage($user);
		}
	}

	/**
	 * ログインしているかどうかを確認
	 *
	 * @return bool
	 */
	public function isLoggedIn(): bool
	{
		return isset($_SESSION['user_id']);
	}

	/**
	 * ログアウト
	 */
	public function logout(): void
	{
		$authStorage = new AuthStorage();
		$authStorage->clearStorage();
	}
}

