<?php
namespace Middleware;

use Database\Database;
use Http\Http;
use Model\User\Auth;
use Model\User\SelectUser;

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

	public static function createDefault()
	{
		$database = new Database();
		return new self(
			new Auth(new SelectUser($database)),
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