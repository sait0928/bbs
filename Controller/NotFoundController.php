<?php
namespace Controller;

class NotFoundController
{
	public function notFoundAction(): void
	{
		session_start();

		echo 'ページが見つかりません';
	}
}
