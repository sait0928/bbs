<?php
namespace Controller;

use Http\Http;
use Http\Session;
use Model\Post\PostWriter;
use PHPUnit\Framework\TestCase;

class InsertControllerTest extends TestCase
{
	public function testInsertAction()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('start')
		;

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
		$_POST['user_id'] = 1;
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$insert_controller = new InsertController(
			$session,
			$http,
			$post_writer
		);
		$insert_controller->insertAction();
	}
}
