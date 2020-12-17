<?php
namespace Model\User;

/**
 * ユーザー認証に関わるモデル
 *
 * @package Model\User
 */
class Auth
{
	private SelectUser $select_user;
	private AuthStorage $auth_storage;

	public function __construct(
		SelectUser $select_user,
		AuthStorage $auth_storage
	) {
		$this->select_user = $select_user;
		$this->auth_storage = $auth_storage;
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
			$this->auth_storage->setStorage($user);
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
		$this->auth_storage->clearStorage();
	}
}

