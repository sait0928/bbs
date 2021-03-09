<?php
namespace Controller\Post;

use Http\CsrfToken;
use Http\Http;
use Http\Session;
use Http\Validator;
use Model\Post\PostWriter;
use PHPUnit\Framework\TestCase;

class InsertControllerTest extends TestCase
{
	/**
	 * 記事投稿テスト
	 */
	public function testInsertAction()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('get')
			->with('user_id')
			->willReturn(1)
		;

		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/')
		;

		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->once())
			->method('get')
		;

		$validator = $this->getMockBuilder(Validator::class)
			->disableOriginalConstructor()
			->getMock();
		$validator->expects($this->once())
			->method('validateInt')
			->with(1, '/logout');
		$validator->expects($this->once())
			->method('validateString')
			->with('test', '/')
		;

		$post_writer = $this->getMockBuilder(PostWriter::class)
			->disableOriginalConstructor()
			->getMock();
		$post_writer->expects($this->once())
			->method('insert')
			->with('test', 1)
		;

		$_POST['text'] = 'test';
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST['csrf_token'] = '';
		$insert_controller = new InsertController(
			$session,
			$http,
			$csrf_token,
			$validator,
			$post_writer
		);
		$insert_controller->insertAction();
	}

	/**
	 * Post通信ではない場合
	 */
	public function testInsertAction_NotPostRequest()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->never())
			->method('get')
		;

		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/')
			->willReturnCallback(function () {
				throw new \Exception('exit with redirect');
			})
		;

		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->never())
			->method('get')
		;

		$validator = $this->getMockBuilder(Validator::class)
			->disableOriginalConstructor()
			->getMock();
		$validator->expects($this->never())
			->method('validateInt')
		;

		$post_writer = $this->getMockBuilder(PostWriter::class)
			->disableOriginalConstructor()
			->getMock();
		$post_writer->expects($this->never())
			->method('insert')
		;

		$_SERVER['REQUEST_METHOD'] = 'GET';
		$insert_controller = new InsertController(
			$session,
			$http,
			$csrf_token,
			$validator,
			$post_writer
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$insert_controller->insertAction();
	}

	/**
	 * トークン認証に失敗した場合
	 */
	public function testInsertAction_TokenMismatch()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->never())
			->method('get')
		;

		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/login_form')
			->willReturnCallback(function () {
				throw new \Exception('exit with redirect');
			})
		;

		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->once())
			->method('get')
		;

		$validator = $this->getMockBuilder(Validator::class)
			->disableOriginalConstructor()
			->getMock();
		$validator->expects($this->never())
			->method('validateInt')
		;

		$post_writer = $this->getMockBuilder(PostWriter::class)
			->disableOriginalConstructor()
			->getMock();
		$post_writer->expects($this->never())
			->method('insert')
		;

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST['csrf_token'] = 'token';
		$insert_controller = new InsertController(
			$session,
			$http,
			$csrf_token,
			$validator,
			$post_writer
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$insert_controller->insertAction();
	}

	/**
	 * 期待する値が得られなかった場合
	 */
	public function testInsertAction_ValidationFailure()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('get')
			->willReturn(1)
		;

		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->never())
			->method('redirect')
		;

		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->once())
			->method('get')
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

		$post_writer = $this->getMockBuilder(PostWriter::class)
			->disableOriginalConstructor()
			->getMock();
		$post_writer->expects($this->never())
			->method('insert')
		;

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST['csrf_token'] = '';
		$insert_controller = new InsertController(
			$session,
			$http,
			$csrf_token,
			$validator,
			$post_writer
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$insert_controller->insertAction();
	}
}
