<?php

namespace Controller;

use Http\Http;
use Http\Session;
use Model\Post\PostCounter;
use Model\Post\PostReader;
use Model\User\Auth;
use Model\User\SelectUser;
use Pagination\Pagination;
use PHPUnit\Framework\TestCase;
use View\View;

class IndexControllerTest extends TestCase
{
	public function testIndexAction()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('start')
		;

		$auth = $this->getMockBuilder(Auth::class)
			->disableOriginalConstructor()
			->getMock();
		$auth->expects($this->once())
			->method('isLoggedIn')
			->willReturn(true)
		;

		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->never())
			->method('redirect')
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
			->method('select')
			->with(1)
		;

		$post_counter = $this->getMockBuilder(PostCounter::class)
			->disableOriginalConstructor()
			->getMock();
		$post_counter->expects($this->once())
			->method('countPosts')
		;

		$pagination = $this->getMockBuilder(Pagination::class)->getMock();
		$pagination->expects($this->once())
			->method('countPages')
			->with(0)
		;

		$view = $this->getMockBuilder(View::class)->getMock();
		$view->expects($this->once())
			->method('render')
			->with('/index.php')
		;

		$_SESSION['user_id'] = 1;
		$_GET['page'] = 1;
		$index_controller = new IndexController(
			$session,
			$auth,
			$http,
			$select_user,
			$post_reader,
			$post_counter,
			$pagination,
			$view
		);
		$index_controller->indexAction();
	}

	public function testIndexAction_IsNotLoggedIn()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('start')
		;

		$auth = $this->getMockBuilder(Auth::class)
			->disableOriginalConstructor()
			->getMock();
		$auth->expects($this->once())
			->method('isLoggedIn')
			->willReturn(false)
		;

		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/login_form')
			->willReturnCallback(function () {
				throw new \Exception('exit with redirect');
			})
		;

		$select_user = $this->getMockBuilder(SelectUser::class)
			->disableOriginalConstructor()
			->getMock();
		$select_user->expects($this->never())
			->method('selectUserById')
		;

		$post_reader = $this->getMockBuilder(PostReader::class)
			->disableOriginalConstructor()
			->getMock();
		$post_reader->expects($this->never())
			->method('select')
		;

		$post_counter = $this->getMockBuilder(PostCounter::class)
			->disableOriginalConstructor()
			->getMock();
		$post_counter->expects($this->never())
			->method('countPosts')
		;

		$pagination = $this->getMockBuilder(Pagination::class)->getMock();
		$pagination->expects($this->never())
			->method('countPages')
		;

		$view = $this->getMockBuilder(View::class)->getMock();
		$view->expects($this->never())
			->method('render')
		;

		$index_controller = new IndexController(
			$session,
			$auth,
			$http,
			$select_user,
			$post_reader,
			$post_counter,
			$pagination,
			$view
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$index_controller->indexAction();
	}
}
