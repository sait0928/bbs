<?php
namespace Model\User;

/**
 * ユーザーのモデル
 *
 * @package Model\User
 */
class User
{
	private int $user_id;
	private string $user_name;
	private string $email;
	private string $password;

	/**
	 * ユーザーの id を set
	 *
	 * @param int $user_id
	 */
	public function setUserId(int $user_id): void
	{
		$this->user_id = $user_id;
	}

	/**
	 * ユーザーの名前を set
	 *
	 * @param string $user_name
	 */
	public function setUserName(string $user_name): void
	{
		$this->user_name = $user_name;
	}

	/**
	 * ユーザーの email を set
	 *
	 * @param string $email
	 */
	public function setEmail(string $email): void
	{
		$this->email = $email;
	}

	/**
	 * ユーザーのパスワードを set
	 *
	 * @param string $password
	 */
	public function setPassword(string $password): void
	{
		$this->password = $password;
	}

	/**
	 * プロパティの user_id を取得
	 *
	 * @return int
	 */
	public function getUserId(): int
	{
		return $this->user_id;
	}

	/**
	 * プロパティの user_name を取得
	 *
	 * @return string
	 */
	public function getUserName(): string
	{
		return $this->user_name;
	}

	/**
	 * プロパティの email を取得
	 *
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * プロパティの password を取得
	 *
	 * @return string
	 */
	public function getPassword(): string
	{
		return $this->password;
	}
}
