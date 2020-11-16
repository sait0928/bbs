<?php
namespace Model\User;

class User
{
	private $user_id;
	private $user_name;
	private $email;
	private $password;

	public function setUserId(int $user_id): void
	{
		$this->user_id = $user_id;
	}

	public function setUserName(string $user_name): void
	{
		$this->user_name = $user_name;
	}

	public function setEmail(string $email): void
	{
		$this->email = $email;
	}

	public function setPassword(string $password): void
	{
		$this->password = $password;
	}

	public function getUserId(): int
	{
		return $this->user_id;
	}

	public function getUserName(): string
	{
		return $this->user_name;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

	public function getPassword(): string
	{
		return $this->password;
	}
}
