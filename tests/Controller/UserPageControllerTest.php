<?php

namespace Controller;

use Http\CsrfToken;
use Http\Session;
use Http\Validator;
use Model\Post\PostCounter;
use Model\Post\PostReader;
use Model\User\UserReader;
use Pagination\Pagination;
use PHPUnit\Framework\TestCase;
use View\ReactView;

class UserPageControllerTest extends TestCase
{
	/**
	 * userPageActionテスト
	 */
	public function testUserPageAction()
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
		$validator->expects($this->exactly(3))
			->method('validateInt')
			->withConsecutive(
				[$this->identicalTo(1), $this->identicalTo('/logout')],
				[$this->identicalTo(1), $this->identicalTo('/')],
				[$this->identicalTo(1), $this->identicalTo('/')]
			)
		;

		$user_reader = $this->getMockBuilder(UserReader::class)
			->disableOriginalConstructor()
			->getMock();
		$user_reader->expects($this->once())
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
		;

		$_GET['user_id'] = 1;
		$_GET['page'] = 1;
		$user_page_controller = new UserPageController(
			$session,
			$validator,
			$user_reader,
			$post_reader,
			$post_counter,
			$pagination,
			$csrf_token,
			$react_view
		);
		$user_page_controller->userPageAction();
	}

	/**
	 * 期待する値が得られなかった場合
	 */
	public function testUserPageAction_ValidationFailure()
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

		$user_reader = $this->getMockBuilder(UserReader::class)
			->disableOriginalConstructor()
			->getMock();
		$user_reader->expects($this->never())
			->method('selectUserById')
		;

		$post_reader = $this->getMockBuilder(PostReader::class)
			->disableOriginalConstructor()
			->getMock();
		$post_reader->expects($this->never())
			->method('selectUserPosts')
		;

		$post_counter = $this->getMockBuilder(PostCounter::class)
			->disableOriginalConstructor()
			->getMock();
		$post_counter->expects($this->never())
			->method('countUserPosts')
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

		$user_page_controller = new UserPageController(
			$session,
			$validator,
			$user_reader,
			$post_reader,
			$post_counter,
			$pagination,
			$csrf_token,
			$react_view
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$user_page_controller->userPageAction();
	}
}
