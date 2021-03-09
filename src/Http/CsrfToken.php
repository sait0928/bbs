<?php
namespace Http;

/**
 * Class CsrfToken
 * @package CsrfToken
 */
class CsrfToken
{
	private Session $session;
	private Validator $validator;

	public function __construct
	(
		Session $session,
		Validator $validator
	) {
		$this->session = $session;
		$this->validator = $validator;
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
		$token = $this->session->get('csrf_token');
		$this->validator->validateString($token, '/logout');
		return $token;
	}
}