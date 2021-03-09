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
	 * @return no-return
	 */
	public function redirect(string $url): void
	{
		header('Location: '.$url);
		exit;
	}
}
