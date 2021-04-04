<?php
namespace Controller;

use Http\CsrfToken;
use Http\Session;
use Http\Validator;
use Model\User\UserReader;
use Model\Post\PostReader;
use Model\Post\PostCounter;
use Pagination\Pagination;
use View\ReactView;

/**
 * '/' にアクセスされた時に
 * 使用するコントローラー
 *
 * @package Controller
 */
class IndexController
{
	private Session $session;
	private Validator $validator;
	private UserReader $user_reader;
	private PostReader $post_reader;
	private PostCounter $post_counter;
	private Pagination $pagination;
	private CsrfToken $csrf_token;
	private ReactView $react_view;

	public function __construct(
		Session $session,
		Validator $validator,
		UserReader $user_reader,
		PostReader $post_reader,
		PostCounter $post_counter,
		Pagination $pagination,
		CsrfToken $csrf_token,
		ReactView $react_view
	) {
		$this->session = $session;
		$this->validator = $validator;
		$this->user_reader = $user_reader;
		$this->post_reader = $post_reader;
		$this->post_counter = $post_counter;
		$this->pagination = $pagination;
		$this->csrf_token = $csrf_token;
		$this->react_view = $react_view;
	}

	/**
	 * 現在ログインしているユーザーと
	 * 記事一覧を表示
	 */
	public function indexAction(): void
	{
		$user_id = $this->session->get('user_id');

		$current_page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ?? 1;

		$this->validator->validateInt($user_id, '/logout');
		$this->validator->validateInt($current_page, '/');

		$user = $this->user_reader->selectUserById($user_id);
		$name = $user->getUserName();

		$posts = $this->post_reader->select($current_page);

		$total_posts = $this->post_counter->countPosts();
		$total_pages = $this->pagination->countPages($total_posts);
		$page_links = $this->pagination->createPageLinksArray($current_page, $total_pages);

		$csrf_token = $this->csrf_token->get();

		$params = [
			'name'       => $name,
			'posts'      => $posts,
			'page_links' => $page_links,
			'csrf_token' => $csrf_token,
		];
		$this->react_view->render($params);
	}
}
