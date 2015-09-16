<?php
/**
 *
 * Posts controller
 * @author TamPham
 * @version 1
 *
 */
class Controller_V1_Posts extends Controller_Base {

    private $_filter = array('strip_tags', 'htmlentities');

    private $_order = array(
                        'newest' => 'created_at',
                        'name' => 'title',
                        'most_comment' => array('comment.created_at' => 'desc', 'created_at' => 'desc')
    );

    /**
     *
     * get list all posts for user
     * @param int $user_id
     * @return json format
     */
    public function get_list_posts_for_user($user_id) {
        //Init model
        $model  = new Model_V1_Posts();

         // if limit not exist and not nummeric: return default: LIMIT_USER
        $limit = (Input::get('limit') and is_numeric(Input::get('limit'))) ? Security::clean(Input::get('limit'), $this->_filter) : LIMIT_POST;

        // if offset not exist and not nummeric: return default: 0
        $offset = (Input::get('offset') and is_numeric(Input::get('offset'))) ? Security::clean(Input::get('offset'), $this->_filter) : 0;

        // if order not exist: return default: date
        $input_order = Security::clean(Input::get('order'), $this->_filter);
        $order = ($input_order and isset($this->_order[$input_order])) ? $this->_order[$input_order]: $this->_order['newest'];

        // get list posts
        $posts   = $model->get_list_posts_for_user($user_id, $limit, $offset, $order);
        if ($posts)
            return $this->get_response(STATUS_OK, $posts, 'OK');
        return $this->get_response(ERROR_GET_LIST_POST_USER_NULL, '', MSG_GET_LIST_POST_USER_NULL);
    }

    /**
     *
     * create post
     * param get from method POST
     * @return json response
     */
    public function post_create() {
        // Init
        $model = new Model_V1_Posts();

        // add validation
        $val = Validation::forge()->add_model('Model_V1_Posts');
        $user = new Model_V1_Users();
        $token = Security::clean(Input::post('token'));
        if (!$user->check_token($token) or $token == '') {
            return $this->get_response(ERROR_TOKEN_INVALID, '', MSG_TOKEN_INVALID);
        }

        if ($val->run()) {
            $user_id = Security::clean(Input::post('user_id'));
            $model->title           = Security::clean(Input::post('title'), $this->_filter);
            $model->description     = Security::clean(Input::post('description'), $this->_filter);
            $model->content         = Security::clean(Input::post('content'), $this->_filter);
            $model->image           = Security::clean(Input::post('image'), $this->_filter);
            $model->user_id         = $user_id;
            $model->status          = Security::clean(Input::post('status'), $this->_filter);
            $model->created_at      = date('Y-m-d H:i:s',time());
            $model->updated_at      = date('Y-m-d H:i:s',time());

            $res = $model->save();
            if ($res) {
                return $this->get_response(STATUS_OK, $model, 'Create post successful!');
            } else {
                return $this->get_response(ERROR_CREATE_POST_FAILED, '', MSG_CREATE_POST_FAILED);
            }
        } else {
            //get validation message
            $message = array();
            foreach ($val->error() as $field => $error) {
                array_push($message, array($field => $error->get_message()));
            }
            return $this->get_response(ERROR_VALIDATE, '', $message);
        }
    }

    /**
     *
     * Update post
     * @param int $id post id
     * @return json format
     */
    public function put_update($id) {
        // check token
        $user = new Model_V1_Users();
        $token = Security::clean(Input::put('token'));
        if (!$user->check_token($token) or $token == '') {
            return $this->get_response(ERROR_TOKEN_INVALID, '', MSG_TOKEN_INVALID);
        }

        // Init model
        $model = Model_V1_Posts::find($id);
        if (!$model) {
            return $this->get_response(ERROR_POST_NOT_EXIST, '', MSG_POST_NOT_EXIST);
        }

        //get user id
        $user_id = Security::clean(Input::put('user_id'));
        // check permission
        if ($model->user_id != $user_id) {
            return $this->get_response(ERROR_PERMISSION, '', MSG_PERMISSION);
        }

         // add validation
        $val = Validation::forge()->add_model('Model_V1_Posts');

        // validate attribute
        $input = array(
            'title'         => Security::clean(Input::put('title'), $this->_filter),
            'description'   => Security::clean(Input::put('description'), $this->_filter),
            'content'       => Security::clean(Input::put('content'), $this->_filter),
            'image'         => Security::clean(Input::put('image'), $this->_filter),
            'status'        => Security::clean(Input::put('status'), $this->_filter)
        );

        if ($val->run($input, true)) {
            $model->title           = Security::clean(Input::put('title'), $this->_filter);
            $model->description     = Security::clean(Input::put('description'), $this->_filter);
            $model->content         = Security::clean(Input::put('content'), $this->_filter);
            $model->image           = Security::clean(Input::put('image'), $this->_filter);
            $model->status          = Security::clean(Input::put('status'), $this->_filter);
            $model->updated_at      = date('Y-m-d H:i:s',time());

            $res = $model->save();
            if ($res) {
                return $this->get_response(STATUS_OK, $model, 'Update post successful!');
            } else {
                return $this->get_response(ERROR_UPDATE_POST_FAILED, '', MSG_UPDATE_POST_FAILED);
            }
        } else {
            //get validation message
            $message = array();
            foreach ($val->error() as $field => $error) {
                array_push($message, array($field => $error->get_message()));
            }
            return $this->get_response(ERROR_VALIDATE, '', $message);
        }
    }

    /**
     *
     * Delete a post
     * @param int $id post_id
     * @return json format
     */
    public function delete_delete($id) {
        // check token
        $user = new Model_V1_Users();
        $token = Security::clean(Input::delete('token'));
        if (!$user->check_token($token) or $token == '') {
            return $this->get_response(ERROR_TOKEN_INVALID, '', MSG_TOKEN_INVALID);
        }

        // Init model
        $model = Model_V1_Posts::find($id);
        if (!$model) {
            return $this->get_response(ERROR_POST_NOT_EXIST, '', MSG_POST_NOT_EXIST);
        }

        //get user id
        $user_id = Security::clean(Input::delete('user_id'));
        // check permission
        if ($model->user_id != $user_id) {
            return $this->get_response(ERROR_PERMISSION, '', MSG_PERMISSION);
        }

        if ($model->delete()) {
            return $this->get_response(STATUS_OK, '', 'Delete post successful!');
        } else {
            return $this->get_response(ERROR_DELETE_POST_FAILED, '', MSG_DELETE_POST_FAILED);
        }
    }

    /**
     *
     * Get all posts
     *
     * @return json format
     */
    public function get_list_all_posts() {
        //Init model
        $model  = new Model_V1_Posts();

         // if limit not exist and not nummeric: return default: LIMIT_USER
        $limit = (Input::get('limit') and is_numeric(Input::get('limit'))) ? Security::clean(Input::get('limit'), $this->_filter) : LIMIT_POST;

        // if offset not exist and not nummeric: return default: 0
        $offset = (Input::get('offset') and is_numeric(Input::get('offset'))) ? Security::clean(Input::get('offset'), $this->_filter) : 0;

        // if offset not exist and not nummeric: return default: 0
        $offset = (Input::get('offset') and is_numeric(Input::get('offset'))) ? Security::clean(Input::get('offset'), $this->_filter) : 0;

        // if order not exist: return default: date
        $input_order = Security::clean(Input::get('order'), $this->_filter);
        $order = ($input_order and isset($this->_order[$input_order])) ? $this->_order[$input_order]: $this->_order['newest'];

        // get list posts
        $posts   = $model->get_list_all_posts($limit, $offset, $order);

        if ($posts) {
            return $this->get_response(STATUS_OK, $posts, 'OK');
        }
        return $this->get_response(ERROR_GET_ALL_POST_FAILED, '', MSG_GET_ALL_POST_FAILED);
    }

    /**
     * Get a post
     *
     * @return json format
     */

    public function get_view($id) {
    	$model = new Model_V1_Comments();
        $comments = $model->get_list_comments_for_post($id);
        if (!empty($comments['post'])) {
        	return $this->get_response(STATUS_OK, $comments, 'OK');
        }
        return $this->get_response(ERROR_POST_NOT_EXIST, '', MSG_POST_NOT_EXIST);
    }
}