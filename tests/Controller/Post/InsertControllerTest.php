<?php
namespace Controller\Post;

use Http\Http;
use Model\Post\PostWriter;
use PHPUnit\Framework\TestCase;

class InsertControllerTest extends TestCase
{
	public function testInsertAction()
	{
		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/')
		;

		$post_writer = $this->getMockBuilder(PostWriter::class)
			->disableOriginalConstructor()
			->getMock();
		$post_writer->expects($this->once())
			->method('insert')
			->with('test', 1)
		;

		$_POST['text'] = 'test';
		$_SESSION['user_id'] = 1;
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$insert_controller = new InsertController(
			$http,
			$post_writer
		);
		$insert_controller->insertAction();
	}

	public function testInsertAction_NotPostRequest()
	{
		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/')
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

		$_SERVER['REQUEST_METHOD'] = 'GET';
		$insert_controller = new InsertController(
			$http,
			$post_writer
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$insert_controller->insertAction();
	}
}
