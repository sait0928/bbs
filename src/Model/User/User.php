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

	public function __construct(
		int $user_id,
		string $user_name,
		string $email,
		string $password
	) {
		$this->user_id = $user_id;
		$this->user_name = $user_name;
		$this->email = $email;
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
