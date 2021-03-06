<?php
namespace Model\User;

/**
 * ユーザー認証に関わるモデル
 *
 * @package Model\User
 */
class Auth
{
	private UserReader $user_reader;
	private PasswordVerifier $password_verifier;
	private AuthStorage $auth_storage;

	public function __construct(
		UserReader $user_reader,
		PasswordVerifier $password_verifier,
		AuthStorage $auth_storage
	) {
		$this->user_reader = $user_reader;
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
		$user = $this->user_reader->selectUserByEmail($email);
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
		return $this->auth_storage->issetStorage();
	}

	/**
	 * ログアウト
	 */
	public function logout(): void
	{
		$this->auth_storage->clearStorage();
	}
}

