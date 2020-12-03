<?php
namespace Controller;

use Http\Http;
use Http\Session;
use Model\Post\PostWriter;
use PHPUnit\Framework\TestCase;

class DeleteControllerTest extends TestCase
{
	public function testDeleteAction()
	{
		$session = $this->getMockBuilder(Session::class)->getMock();
		$session->expects($this->once())
			->method('start')
		;

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
			->with(1)
		;

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_SESSION['user_id'] = 1;
		$_POST['id'] = 1;
		$delete_controller = new DeleteController(
			$session,
			$http,
			$post_writer
		);
		$delete_controller->deleteAction();
	}
}
