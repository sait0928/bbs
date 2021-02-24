<?php

namespace Controller;

use Http\CsrfToken;
use Http\Session;
use Model\Post\PostCounter;
use Model\Post\PostReader;
use Model\User\SelectUser;
use Pagination\Pagination;
use PHPUnit\Framework\TestCase;
use View\ReactView;

class UserPageControllerTest extends TestCase
{
	public function testUserPageAction()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('get')
			->with('user_id')
			->willReturn(1)
		;

		$select_user = $this->getMockBuilder(SelectUser::class)
			->disableOriginalConstructor()
			->getMock();
		$select_user->expects($this->once())
			->method('selectUserById')
			->with(1)
		;

		$post_reader = $this->getMockBuilder(PostReader::class)
			->disableOriginalConstructor()
			->getMock();
		$post_reader->expects($this->once())
			->method('selectUserPosts')
			->with(1)
		;

		$post_counter = $this->getMockBuilder(PostCounter::class)
			->disableOriginalConstructor()
			->getMock();
		$post_counter->expects($this->once())
			->method('countUserPosts')
		;

		$pagination = $this->getMockBuilder(Pagination::class)->getMock();
		$pagination->expects($this->once())
			->method('countPages')
			->with(0)
		;

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
			->with('/user_page.php')
		;

		$_GET['user_id'] = 1;
		$_GET['page'] = 1;
		$user_page_controller = new UserPageController(
			$session,
			$select_user,
			$post_reader,
			$post_counter,
			$pagination,
			$csrf_token,
			$react_view
		);
		$user_page_controller->userPageAction();
	}
}
