<?php
namespace Http;

class Validator
{
	private Http $http;

	public function __construct(
		Http $http
	) {
		$this->http = $http;
	}

	/**
	 * stringかどうか検証して違う場合はredirect
	 *
	 * @param mixed $param
	 * @param string $url
	 * @psalm-assert string $param
	 */
	public function validateString($param, string $url): void
	{
		if(!is_string($param)) {
			$this->http->redirect($url);
		}
	}

	/**
	 * intかどうか検証して違う場合はredirect
	 *
	 * @param $param
	 * @param string $url
	 * @psalm-assert int $param
	 */
	public function validateInt($param, string $url): void
	{
		if(!is_int($param)) {
			$this->http->redirect($url);
		}
	}
}