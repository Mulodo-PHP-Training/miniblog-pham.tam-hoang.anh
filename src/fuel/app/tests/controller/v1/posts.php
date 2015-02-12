<?php
/**
 *
 * Testing Controller_V1_Posts
 * @author Tam Pham
 * @group Post
 */
class Test_Controller_V1_Posts extends TestCase {
    private $_link = 'http://miniblog.tam/v1/';

    /**
     *
     * get all list post of user true
     */
    public function test_get_list_post_user_ok() {
        $link   = $this->_link.'users/18/posts';
        $method = 'GET';

        $res    = $this->curl($link, $method);
        $this->assertEquals(STATUS_OK, $res->meta->code);
    }

    /**
     *
     * get all list post of user false
     */
    public function test_get_list_post_user_false() {
        $link   = $this->_link.'users/17/posts';
        $method = 'GET';

        $res    = $this->curl($link, $method);
        $this->assertEquals(ERROR_GET_LIST_POST_USER_NULL, $res->meta->code);
    }

    /**
     *
     * get response body from $link
     * @param string $link
     * @param string $method
     * @param array $params
     *
     * @return object
     */
    private function curl($link, $method = 'GET', $params = '', $header = '') {
        // init
        $curl = Request::forge($link, 'curl');

        // set header
        if ($header) {
            foreach ($header as $key => $val) {
                $curl->set_header($key, $val);
            }
        }

        // set method
        $curl->set_method($method);

        // set params
        if ($params)
            $curl->set_params($params);

        // execute the request
        $curl->execute();

        // get response
        $response = $curl->response();

        // get body
        $body = json_decode($response->body());

        return $body;
    }
}