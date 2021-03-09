<?php

namespace Controller;

use Http\CsrfToken;
use Http\Session;
use Http\Validator;
use Model\Post\PostCounter;
use Model\Post\PostReader;
use Model\User\SelectUser;
use Pagination\Pagination;
use PHPUnit\Framework\TestCase;
use View\ReactView;

class IndexControllerTest extends TestCase
{
	/**
	 * indexActionのテスト
	 */
	public function testIndexAction()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('get')
			->with('user_id')
			->willReturn(1)
		;

		$validator = $this->getMockBuilder(Validator::class)
			->disableOriginalConstructor()
			->getMock();
		$validator->expects($this->exactly(2))
			->method('validateInt')
			->withConsecutive(
				[$this->identicalTo(1), $this->identicalTo('/logout')],
				[$this->identicalTo(1), $this->identicalTo('/')]
			)
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
			->with('/index.php')
		;

		$_SESSION['user_id'] = 1;
		$_GET['page'] = 1;
		$index_controller = new IndexController(
			$session,
			$validator,
			$select_user,
			$post_reader,
			$post_counter,
			$pagination,
			$csrf_token,
			$react_view
		);
		$index_controller->indexAction();
	}

	/**
	 * 期待した値を取得できなかった場合
	 */
	public function testIndexAction_ValidationFailure()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('get')
			->with('user_id')
			->willReturn(1)
		;

		$validator = $this->getMockBuilder(Validator::class)
			->disableOriginalConstructor()
			->getMock();
		$validator->expects($this->once())
			->method('validateInt')
			->with(1, '/logout')
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

		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->never())
			->method('get')
		;

		$react_view = $this->getMockBuilder(ReactView::class)->getMock();
		$react_view->expects($this->never())
			->method('render')
		;

		$_SESSION['user_id'] = 1;
		$_GET['page'] = 1;
		$index_controller = new IndexController(
			$session,
			$validator,
			$select_user,
			$post_reader,
			$post_counter,
			$pagination,
			$csrf_token,
			$react_view
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$index_controller->indexAction();
	}
}
