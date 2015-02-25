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
     * login ok
     * method POST
     * @return string object test logout
     */
    public function test_login_ok() {
        $link   = $this->_link.'users/signin';
        $method = 'POST';
        $params = array(
            'username' => 'phamtam2',
            'password' => '123456'
        );

        $res    = $this->curl($link, $method, $params);
        return $res->data;
    }

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
     * test create post ok
     */
    public function test_create_post_ok() {
        $data = $this->test_login_ok();
        $link   = $this->_link.'posts';
        $method = 'POST';
        $params  = array(
            'title'         => 'post_4',
            'description'   => 'post 4',
            'content'       => 'post 4',
            'image'         => 'post_4.jpg',
            'status'        => '1',
            'token'         => $data->login_hash
        );

        $res = $this->curl($link, $method, $params);
        $this->assertEquals(STATUS_OK, $res->meta->code);
        return $res->data;
    }

    /**
     *
     * test token invalid
     */
    public function test_create_post_invalid_token() {
        $link   = $this->_link.'posts';
        $method = 'POST';
        $param  = array('token' => 'lkajsdf98as0f9sdfjslf9u0as9df');

        $res    = $this->curl($link, $method, $param);
        $this->assertEquals(ERROR_TOKEN_INVALID, $res->meta->code);
    }

    /**
     *
     * test validate error
     * @dataProvider provider_create_post_validate
     */
    public function test_create_post_validate_error($params) {
        $link   = $this->_link.'posts';
        $method = 'POST';

        $res    = $this->curl($link, $method, $params);
        $this->assertEquals(ERROR_VALIDATE, $res->meta->code);
    }

    /**
     *
     * dataProvider for test_create_post_validate_error
     */
    public function provider_create_post_validate() {
        $data = $this->test_login_ok();
        return array(
            // title null
            array(
                array(
                    'title'         => '',
                    'description'   => 'post 4',
                    'content'       => 'post 4',
                    'status'        => 1,
                    'token'         => $data->login_hash
                )
            ),
            // tile < 4 character
            array(
                array(
                    'title' => 'abc',
                    'description'   => 'post 4',
                    'content'       => 'post 4',
                    'status'        => 1,
                    'token' => $data->login_hash
                )
            ),
            // description null
            array(
                array(
                    'title' => 'post 4',
                    'description'   => '',
                    'content'       => 'post 4',
                    'status'        => 1,
                    'token' => $data->login_hash
                )
            ),
            // content null
            array(
                array(
                    'title' => 'post 4',
                    'description'   => 'post 4',
                    'content'       => '',
                    'status'        => 1,
                    'token' => $data->login_hash
                )
            ),
        );
    }

    /**
     *
     * Test update post ok
     * @depends test_create_post_ok
     */
    public function test_update_post_ok($post) {
        $data = $this->test_login_ok();
        $link   = $this->_link.'posts/'.$post->id;
        $method = 'PUT';
        $params = array(
            'title'         => 'post update',
            'description'   => 'description update',
            'content'       => 'content update',
            'status'        => 1,
            'token'         => $data->login_hash
        );

        $res = $this->curl($link, $method, $params);
        $this->assertEquals(STATUS_OK, $res->meta->code);
    }

    /**
     *
     * test update post token invalid
     * @depends test_create_post_ok
     */
    public function test_update_post_invalid_token($post) {
        $link   = $this->_link.'posts/'.$post->id;
        $method = 'PUT';
        $param  = array('token' => 'lkajsdf98as0f9sdfjslf9u0as9df');

        $res    = $this->curl($link, $method, $param);
        $this->assertEquals(ERROR_TOKEN_INVALID, $res->meta->code);
    }

    /**
     *
     * test validate error
     * @dataProvider provider_update_post_validate
     */
    public function test_update_post_validate_error($params) {
        $link   = $this->_link.'posts/1';
        $method = 'PUT';

        $res    = $this->curl($link, $method, $params);
        $this->assertEquals(ERROR_VALIDATE, $res->meta->code);
    }

    /**
     *
     * dataProvider for test_update_post_validate_error
     */
    public function provider_update_post_validate() {
        $data = $this->test_login_ok();
        return array(
            // title null
            array(
                array(
                    'title'         => '',
                    'description'   => 'post 4',
                    'content'       => 'post 4',
                    'status'        => 1,
                    'token'         => $data->login_hash
                )
            ),
            // tile < 4 character
            array(
                array(
                    'title' => 'abc',
                    'description'   => 'post 4',
                    'content'       => 'post 4',
                    'status'        => 1,
                    'token' => $data->login_hash
                )
            ),
            // description null
            array(
                array(
                    'title' => 'post 4',
                    'description'   => '',
                    'content'       => 'post 4',
                    'status'        => 1,
                    'token' => $data->login_hash
                )
            ),
            // content null
            array(
                array(
                    'title' => 'post 4',
                    'description'   => 'post 4',
                    'content'       => '',
                    'status'        => 1,
                    'token' => $data->login_hash
                )
            ),
        );
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