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

        // get list posts
        $posts   = $model->get_list_posts_for_user($user_id, $limit, $offset);
        if($posts)
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

    }
}