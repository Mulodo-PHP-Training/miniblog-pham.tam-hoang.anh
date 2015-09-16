<?php
/**
 * User Controller
 */
class Controller_Users extends Controller_Base {
	private $_filter = array('strip_tags', 'htmlentities');

	/**
	 *
	 * Login function
	 *
	 * @return string message
	 */
	public function action_login() {
		$this->template->title = 'Login';
		$breadcrumbs = array(
			'Home' => Uri::base(),
			'Login' => ''
		);
		$this->template->breadcrumbs = $breadcrumbs;
		$data = '';
		// check logged
		if (!Session::get('user_id')) {
			// check method post
			if (Input::post()) {
				$username = Security::clean(Input::param('username'), $this->_filter);
				$password = Security::clean(Input::param('password'), $this->_filter);
				$link_api = $this->link_api.'users/signin';
				$method   = 'POST';
				$params   = array(
				'username' => $username,
				'password' => $password
				);
				$res = $this->curl($link_api, $method, $params);
				if($res->meta->code == '200') {
					Session::set('token', $res->data->login_hash);
					Session::set('user_id', $res->data->id);
					Session::set('username', $res->data->username);
					$data['message'] = '<div class="alert alert-success" role="alert">'.$res->meta->message.'</div>';
					return Response::redirect('/');
				} else {
					$messages = '';
					$messages.= '<div class="alert alert-danger" role="alert" style="margin-top: 5px;">
													<button type="button" class="close" data-dismiss="alert">
														<span aria-hidden="true">&times;</span> <span class="sr-only">Close</span>
													</button>';
					if (is_array($res->meta->message)) {
						foreach ($res->meta->message as $k => $v) {
							foreach ($v as $v1){
								$messages.= $v1.'<br>';
							}
						}
					} else {
						$messages.= $res->meta->message;
					}
					$messages.= '</div>';
					$data['message'] = $messages;
				}
			}
		} else {
			$data['message'] = '<div class="alert alert-warning" role="alert">
								<strong>Sorry!</strong> You had logged.
							</div>';
		}

		$this->template->content = View::forge('users/login', $data);
	}

	/**
	 * Logout function
	 */
	public function action_logout() {
		Session::destroy();
		return Response::redirect('/');
	}

	/**
	 * Update user info
	 */
	public function action_update() {
		$this->template->title = 'Update user info';
		$breadcrumbs = array(
			'Home' => Uri::base(),
			'My Account' => '#',
			"Update User's Information" => ''
		);
		$this->template->breadcrumbs = $breadcrumbs;
		$data = '';
		if (Session::get('user_id')) {
			// get user info
			$link_api = $this->link_api.'users';
			$method = 'GET';
			$token = Session::get('token');
			$user_id = Session::get('user_id');
			$params = array('token' => $token, 'user_id' => $user_id);
			$res = $this->curl($link_api, $method, $params);
			if ($res->meta->code == '200') {
				$data['user'] = $res->data;
			} else {
				$messages = '';
				$messages.= '<div class="alert alert-danger" role="alert" style="margin-top: 5px;">
									<button type="button" class="close" data-dismiss="alert">
										<span aria-hidden="true">&times;</span> <span class="sr-only">Close</span>
									</button>';
				if (is_array($res->meta->message)) {
					foreach ($res->meta->message as $k => $v) {
						foreach ($v as $v1){
							$messages.= $v1.'<br>';
						}
					}
				} else {
					$messages.= $res->meta->message;
				}
				$messages.= '</div>';
				$data['message'] = $messages;
			}

			// Update info
			if (Input::post()) {
				$method = 'PUT';
				$params = array(
					'email'     => Security::clean(Input::param('email'), $this->_filter),
					'firstname' => Security::clean(Input::param('firstname'), $this->_filter),
					'lastname'  => Security::clean(Input::param('lastname'), $this->_filter),
					'avatar'    => Security::clean(Input::param('avatar'), $this->_filter),
					'birthday'  => Security::clean(Input::param('year').'-'.Input::param('month').'-'.Input::param('day'), $this->_filter),
					'gender'    => Security::clean(Input::param('gender'), $this->_filter),
					'address'   => Security::clean(Input::param('address'), $this->_filter),
					'city'      => Security::clean(Input::param('city'), $this->_filter),
					'mobile'    => Security::clean(Input::param('mobile'), $this->_filter),
					'token'		=> $token,
					'user_id'	=> $user_id
				);
				$res = $this->curl($link_api, $method, $params);
				if ($res->meta->code == '200') {
					$data['message'] = '<div class="alert alert-success" role="alert" style="margin-top:5px;">
											<button type="button" class="close" data-dismiss="alert">
												<span aria-hidden="true">&times;</span>
												<span class="sr-only">Close</span>
											</button>
											'.$res->meta->message.'
										</div>';
					$data['user'] = $res->data;
				} else{
					$messages = '';
					$messages.= '<div class="alert alert-danger" role="alert" style="margin-top: 5px;">
										<button type="button" class="close" data-dismiss="alert">
											<span aria-hidden="true">&times;</span> <span class="sr-only">Close</span>
										</button>';
					if (is_array($res->meta->message)) {
						foreach ($res->meta->message as $k => $v) {
							foreach ($v as $v1){
								$messages.= $v1.'<br>';
							}
						}
					} else {
						$messages.= $res->meta->message;
					}
					$messages.= '</div>';
					$data['message'] = $messages;
				}
			}
		}

		$this->template->content = View::forge('users/update', $data);
	}

	/**
	 * search user
	 */
	public function action_search() {
		$this->template->title = 'Search User';
		$breadcrumbs = array(
			'Home' => Uri::base(),
			'Search User' => ''
		);
		$data = array();
		$keyword = Security::clean(Input::param('keyword'), $this->_filter);
		$limit = Security::clean(Input::param('limit'), $this->_filter);

		$link_api = $this->link_api.'users/search';
		$method = 'GET';
		$params = array(
			'keyword' => $keyword,
			'limit' => $limit,
		);

		$res = $this->curl($link_api, $method, $params);
		if ($res->meta->code == '200') {
			//config pagination
			$config = array(
				'pagination_url'	=> Uri::base().'searchUser?keyword='.$keyword.'&limit='.$res->data->limit,
				'total_items'		=> $res->data->total,
				'per_page'			=> $res->data->limit,
				'uri_segment'		=> 2,
				'previous-marker'	=> 'Prev',
				'next-marker'		=> 'Next',
			);
			$pagination = Pagination::forge('searchUser', $config);
			$data['pagination'] = $pagination;

			$params = array(
			'keyword' => $keyword,
			'limit' => $limit,
			'offset' => $pagination->offset,
		);

			$res = $this->curl($link_api, $method, $params);
			$data['data']		= $res->data;
			$data['message']	= $res->meta->message;
		} else {
			$data['message']	= 'Result not found';
		}

		$this->template->breadcrumbs = $breadcrumbs;
		$this->template->content = View::forge('users/search', $data);
	}

	/**
	 * change password
	 */
	public function action_password() {
		$this->template->title = 'Change Password';
		$breadcrumbs = array(
			'Home' => Uri::base(),
			'Change Password' => ''
		);
		$this->template->breadcrumbs = $breadcrumbs;
		$data = array();
		if (Input::post()) {
			$link_api = $this->link_api.'users/password';
			$method = 'PUT';
			$params = array(
				'token' => Session::get('token'),
				'user_id' => Session::get('user_id'),
				'old_password' => Security::clean(Input::param('old_password'), $this->_filter),
				'new_password' => Security::clean(Input::param('new_password'), $this->_filter),
				'retype_password' => Security::clean(Input::param('retype_password'), $this->_filter)
			);
			$res = $this->curl($link_api, $method, $params);
			if ($res->meta->code == '200') {
				$data['message'] = '<div class="alert alert-success" role="alert">
								<button type="button" class="close" data-dismiss="alert">
									<span aria-hidden="true">&times;</span>
									<span class="sr-only">Close</span>
								</button>
								'.$res->meta->message.'
							</div>';
			} else {
				$messages = '';
					$messages.= '<div class="alert alert-danger" role="alert" style="margin-top: 5px;">
										<button type="button" class="close" data-dismiss="alert">
											<span aria-hidden="true">&times;</span> <span class="sr-only">Close</span>
										</button>';
					if (is_array($res->meta->message)) {
						foreach ($res->meta->message as $k => $v) {
							foreach ($v as $v1){
								$messages.= '- '.$v1.'<br>';
							}
						}
					} else {
						$messages.= $res->meta->message;
					}
					$messages.= '</div>';
					$data['message'] = $messages;
			}
		}
		$this->template->content = View::forge('users/password', $data);

	}
}