<?php
namespace Controller\Post;

use Http\CsrfToken;
use Http\Http;
use Http\Session;
use Http\Validator;
use Model\Post\PostWriter;
use PHPUnit\Framework\TestCase;

class DeleteControllerTest extends TestCase
{
	/**
	 * 記事削除のテスト
	 */
	public function testDeleteAction()
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
				[$this->identicalTo(1), $this->identicalTo('/user_page?user_id=1')]
			)
		;

		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/user_page?user_id=1')
		;

		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->once())
			->method('get')
		;

		$post_writer = $this->getMockBuilder(PostWriter::class)
			->disableOriginalConstructor()
			->getMock();
		$post_writer->expects($this->once())
			->method('delete')
			->with(1, 1)
		;

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST['id'] = 1;
		$_POST['csrf_token'] = '';
		$delete_controller = new DeleteController(
			$session,
			$validator,
			$http,
			$csrf_token,
			$post_writer
		);
		$delete_controller->deleteAction();
	}

	/**
	 * Post通信ではなかった場合
	 */
	public function testDeleteAction_NotPostRequest()
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
		;

		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/user_page?user_id=1')
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

		$post_writer = $this->getMockBuilder(PostWriter::class)
			->disableOriginalConstructor()
			->getMock();
		$post_writer->expects($this->never())
			->method('delete')
		;

		$_SERVER['REQUEST_METHOD'] = 'GET';
		$delete_controller = new DeleteController(
			$session,
			$validator,
			$http,
			$csrf_token,
			$post_writer
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$delete_controller->deleteAction();
	}

	/**
	 * トークン認証に失敗した場合
	 */
	public function testDeleteAction_TokenMismatch()
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

		$post_writer = $this->getMockBuilder(PostWriter::class)
			->disableOriginalConstructor()
			->getMock();
		$post_writer->expects($this->never())
			->method('delete')
		;

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST['csrf_token'] = 'token';
		$delete_controller = new DeleteController(
			$session,
			$validator,
			$http,
			$csrf_token,
			$post_writer
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$delete_controller->deleteAction();
	}

	/**
	 * 期待する値が取得できなかった場合
	 */
	public function testDeleteAction_ValidationFailure()
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

		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->never())
			->method('redirect')
		;

		$csrf_token = $this->getMockBuilder(CsrfToken::class)
			->disableOriginalConstructor()
			->getMock();
		$csrf_token->expects($this->never())
			->method('get')
		;

		$post_writer = $this->getMockBuilder(PostWriter::class)
			->disableOriginalConstructor()
			->getMock();
		$post_writer->expects($this->never())
			->method('delete')
		;

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$delete_controller = new DeleteController(
			$session,
			$validator,
			$http,
			$csrf_token,
			$post_writer
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$delete_controller->deleteAction();
	}
}
