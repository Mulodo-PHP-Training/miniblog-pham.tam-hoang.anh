<?php
/**
 *
 * @version 1
 *
 */

class Controller_V1_Comments extends Controller_Base {
    private $_filter = array('strip_tags', 'htmlentities');
    private $_order = array(
                        'newest' => 'created_at',
                        'name' => 'title',
                        'most_comment' => array('comment.created_at' => 'desc', 'created_at' => 'desc')
    );

    /**
     *
     * get list all comments for post
     * @param int $post_id
     * @return json format
     */
    public function get_list_comments_for_post($post_id) {
        //Init model
        $model  = new Model_V1_Comments();

         // if limit not exist and not nummeric: return default: LIMIT_USER
        $limit = (Input::get('limit') and is_numeric(Input::get('limit'))) ? Security::clean(Input::get('limit'), $this->_filter) : LIMIT_POST;

        // if offset not exist and not nummeric: return default: 0
        $offset = (Input::get('offset') and is_numeric(Input::get('offset'))) ? Security::clean(Input::get('offset'), $this->_filter) : 0;

        // if order not exist: return default: date
        $input_order = Security::clean(Input::get('order'), $this->_filter);
        $order = ($input_order and isset($this->_order[$input_order])) ? $this->_order[$input_order]: $this->_order['newest'];

        // get list posts
        $comments   = $model->get_list_comments_for_post($post_id, $limit, $offset, $order);
        if ($comments)
            return $this->get_response(STATUS_OK, $comments, 'OK');
        return $this->get_response(ERROR_GET_ALL_COMMENT_FAILED, '', MSG_GET_ALL_COMMENT_FAILED);
    }

    /**
     * @api
     *
     * create comment
     *
     * @param $post_id
     *
     * @return json format
     */
    public function post_create($post_id) {
        // check isset post
        $post = Model_V1_Posts::find($post_id);
        if (!$post) {
            return $this->get_response(ERROR_POST_NOT_EXIST, '', MSG_POST_NOT_EXIST);
        }

        // Init model
        $model = new Model_V1_Comments();

        // add validation
        $val = Validation::forge()->add_model('Model_V1_Comments');
        $user = new Model_V1_Users();
        $token = Security::clean(Input::post('token'));
        if (!$user->check_token($token) or $token == '') {
            return $this->get_response(ERROR_TOKEN_INVALID, '', MSG_TOKEN_INVALID);
        }

        if ($val->run()) {
            $user_id = Security::clean(Input::post('user_id'));
            $model->content           = Security::clean(Input::post('content'), $this->_filter);
            $model->user_id         = $user_id;
            $model->post_id         = $post_id;
            $model->created_at      = date('Y-m-d H:i:s',time());
            $model->updated_at      = date('Y-m-d H:i:s',time());

            $res = $model->save();
            if ($res) {
                return $this->get_response(STATUS_OK, $model, 'Create comment successful!');
            } else {
                return $this->get_response(ERROR_CREATE_COMMENT_FAILED, '', MSG_CREATE_COMMENT_FAILED);
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
     * Update comment
     * @param int $id
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
        $model = Model_V1_Comments::find($id);
        if (!$model) {
            return $this->get_response(ERROR_COMMENT_NOT_EXIST, '', MSG_COMMENT_NOT_EXIST);
        }

        //get user id
        $user_id = Security::clean(Input::put('user_id'));
        // check permission
        if ($model->user_id != $user_id) {
            return $this->get_response(ERROR_PERMISSION, '', MSG_PERMISSION);
        }

         // add validation
        $val = Validation::forge()->add_model('Model_V1_Comments');

        //validate attribute
        $input = array(
            'content'       => Security::clean(Input::put('content'), $this->_filter),
        );

        if ($val->run($input, true)) {
            $model->content         = Security::clean(Input::put('content'), $this->_filter);
            $model->updated_at      = date('Y-m-d H:i:s',time());

            $res = $model->save();
            if ($res) {
                return $this->get_response(STATUS_OK, $model, 'Update comment successful!');
            } else {
                return $this->get_response(ERROR_UPDATE_COMMENT_FAILED, '', MSG_UPDATE_COMMENT_FAILED);
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
     * Delete a comment
     * @param int $id comment id
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
        $model = Model_V1_Comments::find($id);
        if (!$model) {
            return $this->get_response(ERROR_COMMENT_NOT_EXIST, '', MSG_COMMENT_NOT_EXIST);
        }

        //get user id
        $user_id = Security::clean(Input::delete('user_id'));
        // check permission
        if ($model->user_id != $user_id) {
            return $this->get_response(ERROR_PERMISSION, '', MSG_PERMISSION);
        }

        if ($model->delete()) {
            return $this->get_response(STATUS_OK, '', 'Delete comment successful!');
        } else {
            return $this->get_response(ERROR_DELETE_COMMENT_FAILED, '', MSG_DELETE_COMMENT_FAILED);
        }
    }
}