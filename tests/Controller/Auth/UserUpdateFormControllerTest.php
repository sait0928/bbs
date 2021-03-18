<?php

namespace Controller\Auth;

use Http\CsrfToken;
use PHPUnit\Framework\TestCase;
use View\ReactView;

class UserUpdateFormControllerTest extends TestCase
{
	public function testUserUpdateFormAction()
	{
		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->once())
			->method('get')
			->willReturn('token')
		;

		$react_view = $this->getMockBuilder(ReactView::class)->getMock();
		$react_view->expects($this->once())
			->method('render')
			->with('/js/user_update_form.js')
		;

		$user_update_form_controller = new UserUpdateFormController(
			$csrf_token,
			$react_view
		);
		$user_update_form_controller->userUpdateFormAction();
	}
}
