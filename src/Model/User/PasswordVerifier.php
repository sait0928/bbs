<?php
namespace Model\User;

class PasswordVerifier
{
	/**
	 * パスワードを認証
	 *
	 * @param string $password_input
	 * @param User $user
	 * @return bool
	 */
	public function verifyPassword(string $password_input, User $user): bool
	{
		return password_verify($password_input, $user->getPassword());
	}
}