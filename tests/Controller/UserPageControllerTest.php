<?php

namespace Controller;

use Model\Post\PostCounter;
use Model\Post\PostReader;
use Model\User\SelectUser;
use Pagination\Pagination;
use PHPUnit\Framework\TestCase;
use View\View;

class UserPageControllerTest extends TestCase
{
	public function testUserPageAction()
	{
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

		$view = $this->getMockBuilder(View::class)->getMock();
		$view->expects($this->once())
			->method('render')
			->with('/user_page.php')
		;

		$_GET['user_id'] = 1;
		$_GET['page'] = 1;
		$user_page_controller = new UserPageController(
			$select_user,
			$post_reader,
			$post_counter,
			$pagination,
			$view
		);
		$user_page_controller->userPageAction();
	}
}
