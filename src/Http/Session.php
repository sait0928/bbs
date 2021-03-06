<?php
namespace Http;

/**
 * sessionに関わる関数を扱うクラス
 *
 * @package Http
 */
class Session
{
	/**
	 * session 開始
	 */
	private function start(): void
	{
		session_start();
	}

	/**
	 * session 終了
	 */
	public function destroy(): void
	{
		if(session_status() === PHP_SESSION_NONE) {
			$this->start();
		}
		session_destroy();
	}

	/**
	 * @param string $key
	 * @param mixed $value
	 */
	public function set(string $key, $value): void
	{
		if(session_status() === PHP_SESSION_NONE) {
			$this->start();
		}
		/** @psalm-suppress MixedAssignment */
		$_SESSION[$key] = $value;
	}

	/**
	 * @param string $key
	 * @return mixed
	 */
	public function get(string $key)
	{
		if(session_status() === PHP_SESSION_NONE) {
			$this->start();
		}
		return $_SESSION[$key] ?? null;
	}

	/**
	 * session 変数の初期化
	 */
	public function unset(): void
	{
		if(session_status() === PHP_SESSION_NONE) {
			$this->start();
		}
		$_SESSION = array();
	}
}