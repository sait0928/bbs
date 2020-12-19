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
	private PasswordVerifier $password_verifier;
	private AuthStorage $auth_storage;

	public function __construct(
		SelectUser $select_user,
		PasswordVerifier $password_verifier,
		AuthStorage $auth_storage
	) {
		$this->select_user = $select_user;
		$this->password_verifier = $password_verifier;
		$this->auth_storage = $auth_storage;
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
		if ($this->password_verifier->verifyPassword($password, $user)) {
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

