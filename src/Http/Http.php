<?php
namespace Http;

/**
 * Http に関するクラス
 *
 * @package Http
 */
class Http
{
	/**
	 * リダイレクト
	 *
	 * @param string $url
	 */
	public function redirect(string $url): void
	{
		header('Location: '.$url);
		exit;
	}
}
