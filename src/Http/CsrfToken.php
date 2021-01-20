<?php
namespace Http;

/**
 * Class CsrfToken
 * @package CsrfToken
 */
class CsrfToken
{
	private Session $session;

	public function __construct
	(
		Session $session
	) {
		$this->session = $session;
	}

	/**
	 * CSRFトークンをセット
	 */
	public function set(): void
	{
		$toke_byte = openssl_random_pseudo_bytes(16);
		$csrf_token = bin2hex($toke_byte);
		$this->session->set('csrf_token', $csrf_token);
	}

	/**
	 * CSRFトークンを取得
	 *
	 * @return string
	 */
	public function get(): string
	{
		return $this->session->get('csrf_token');
	}
}