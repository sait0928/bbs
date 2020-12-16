<?php
namespace Controller;

use Http\Http;
use Model\Post\PostWriter;
use PHPUnit\Framework\TestCase;

class DeleteControllerTest extends TestCase
{
	public function testDeleteAction()
	{
		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/user_page?user_id=1')
		;

		$post_writer = $this->getMockBuilder(PostWriter::class)
			->disableOriginalConstructor()
			->getMock();
		$post_writer->expects($this->once())
			->method('delete')
			->with(1, 1)
		;

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_SESSION['user_id'] = 1;
		$_POST['id'] = 1;
		$delete_controller = new DeleteController(
			$http,
			$post_writer
		);
		$delete_controller->deleteAction();
	}

	public function testDeleteAction_NotPostRequest()
	{
		$http = $this->getMockBuilder(Http::class)->getMock();
		$http->expects($this->once())
			->method('redirect')
			->with('/user_page?user_id=1')
			->willReturnCallback(function () {
				throw new \Exception('exit with redirect');
			})
		;

		$post_writer = $this->getMockBuilder(PostWriter::class)
			->disableOriginalConstructor()
			->getMock();
		$post_writer->expects($this->never())
			->method('delete')
		;

		$_SERVER['REQUEST_METHOD'] = 'GET';
		$_SESSION['user_id'] = 1;
		$delete_controller = new DeleteController(
			$http,
			$post_writer
		);
		$this->expectException(\Exception::class);
		$this->expectErrorMessage('exit with redirect');
		$delete_controller->deleteAction();
	}
}
