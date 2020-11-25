<?php
namespace Model\User;

class AuthStorage
{
	public function setStorage(User $user): void
	{
		$_SESSION['user_id'] = $user->getUserId();
	}

	public function clearStorage(): void
	{
		$_SESSION = array();
		session_destroy();
	}
}