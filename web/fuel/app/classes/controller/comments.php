<?php
/**
 *
 * Comments controller
 * @author Tam Pham
 *
 */
class Controller_Comments extends Controller {
	public function action_create() {
		if (Session::get('user_id')) {
			// get user info
			$link_api = $this->link_api.'comments';
			$method = 'POST';
			$token = Session::get('token');
			$user_id = Session::get('user_id');
			$data = array();
			// Update info
			if (Input::post()) {
				$params = array(
					'content'     => Security::clean(Input::param('content'), $this->_filter),
					'post_id' => Security::clean(Input::param('post_id'), $this->_filter),
					'token'		=> $token,
					'user_id'	=> $user_id
				);
				$res = $this->curl($link_api, $method, $params);
				if ($res->meta->code == '200') {
					$data['message'] = '<span style="color:#85C994">
											'.$res->meta->message.'
										</span>';
					$data['user'] = $res->data;
				} else{
					$messages = '';
					$messages.= '<span style="color:#EF4A36">';
					if (is_array($res->meta->message)) {
						foreach ($res->meta->message as $k => $v) {
							foreach ($v as $v1){
								$messages.= $v1.'<br>';
							}
						}
					} else {
						$messages.= $res->meta->message;
					}
					$messages.= '</span>';
					$data['message'] = $messages;
				}
			}
		}
	}
}