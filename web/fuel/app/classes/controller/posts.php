<?php
/**
 * Post controller
 */
class Controller_Posts extends Controller_Base {
	private $_filter = array('strip_tags', 'htmlentities');

	public function action_list_all_posts() {
		$this->template->title = 'List all posts';
		$breadcrumbs = array(
			'Home' => Uri::base(),
			'Blog' => ''
		);
		$this->template->breadcrumbs = $breadcrumbs;
		$data = array();
		$limit = Security::clean(Input::param('limit'), $this->_filter);
		$order = Security::clean(Input::param('order'), $this->_filter);
		$order = $order ? $order : 'newest';

		$link_api = $this->link_api.'posts';
		$method = 'GET';
		$params = array(
			'order' => $order,
			'limit' => $limit,
			'offset' => 2
		);

		$res = $this->curl($link_api, $method, $params);
		if ($res->meta->code == '200') {
			//config pagination
			$config = array(
				'pagination_url'	=> Uri::base().'list-all-posts?limit='.$res->data->limit.'&order='.$order,
				'total_items'		=> $res->data->total,
				'per_page'			=> $res->data->limit,
				'uri_segment'		=> 2,
				'previous-marker'	=> 'Prev',
				'next-marker'		=> 'Next',
			);
			$pagination = Pagination::forge('list_all_posts', $config);
			$data['pagination'] = $pagination;

			$params = array(
				'order' => $order,
				'limit' => $res->data->limit,
				'offset' => $pagination->offset,
			);

			$res = $this->curl($link_api, $method, $params);
			$data['data']		= $res->data;
			$data['message']	= $res->meta->message;
		} else {
			$data['message']	= $res->meta->message;
		}
		$this->template->content = View::forge('posts/list_all_posts', $data);
	}

	/**
	 *
	 * list all user post
	 * @param int $id
	 */
	public function action_list_all_user_posts($id) {
		$this->template->title = 'List all posts';
		$breadcrumbs = array(
			'Home' => Uri::base(),
			"List all user's post" => ''
		);
		$this->template->breadcrumbs = $breadcrumbs;
		$data = array();
		$limit = Security::clean(Input::param('limit'), $this->_filter);
		$order = Security::clean(Input::param('order'), $this->_filter);
		$order = $order ? $order : 'newest';

		$link_api = $this->link_api.'users/'.$id.'/posts';
		$method = 'GET';
		$params = array(
			'order' => $order,
			'limit' => $limit,
			'offset' => 0
		);

		$res = $this->curl($link_api, $method, $params);
		if ($res->meta->code == '200') {
			//config pagination
			$config = array(
				'pagination_url'	=> Uri::base().'list-user-posts?limit='.$res->data->limit.'&order='.$order,
				'total_items'		=> $res->data->total,
				'per_page'			=> $res->data->limit,
				'uri_segment'		=> 3,
				'previous-marker'	=> 'Prev',
				'next-marker'		=> 'Next',
			);
			$pagination = Pagination::forge('list_user_posts', $config);
			$data['pagination'] = $pagination;

			$params = array(
				'order' => $order,
				'limit' => $res->data->limit,
				'offset' => $pagination->offset,
			);

			$res = $this->curl($link_api, $method, $params);
			$data['data']		= $res->data;
			$data['message']	= $res->meta->message;
		} else {
			$data['message']	= $res->meta->message;
		}
		$this->template->content = View::forge('posts/list_user_posts', $data);
	}

	/**
	 *
	 * Detail log
	 * @param int $id
	 */
	public function action_view($id) {
		$this->template->title = 'List all posts';
		$breadcrumbs = array(
			'Home' => Uri::base(),
			"Blog" => Uri::base().'/list-all-posts.html',
			"Detail" => ''
		);
		$this->template->breadcrumbs = $breadcrumbs;
		$data = array();
		$link_api = $this->link_api.'posts/'.$id;
		$method = 'GET';

		$res = $this->curl($link_api, $method);
		if ($res->meta->code == '200') {
			$data ['data']	= $res->data;
		} else {
			$data['message'] = $res->meta->message;
		}
		$this->template->content = View::forge('posts/view', $data);
	}
}