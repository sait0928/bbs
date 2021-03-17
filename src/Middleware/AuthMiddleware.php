<?php
namespace Middleware;

use Database\Database;
use Http\Http;
use Http\Session;
use Model\User\Auth;
use Model\User\AuthStorage;
use Model\User\PasswordVerifier;
use Model\User\UserReader;

class AuthMiddleware
{
	private Auth $auth;
	private Http $http;

	public function __construct(
		Auth $auth,
		Http $http
	) {
		$this->auth = $auth;
		$this->http = $http;
	}

	public static function createDefault(): self
	{
		$database = new Database();
		return new self(
			new Auth(
				new UserReader($database),
				new PasswordVerifier(),
				new AuthStorage(new Session())
			),
			new Http()
		);
	}

	public function isLoggedIn(): void
	{
		if(!$this->auth->isLoggedIn()) {
			$this->http->redirect('/login_form');
		}
	}

	public function isNotLoggedIn(): void
	{
		if($this->auth->isLoggedIn()) {
			$this->http->redirect('/');
		}
	}
}