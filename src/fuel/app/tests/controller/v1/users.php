<?php
/**
 *
 * Testing Controller_V1_Users
 * @author Tam Pham
 * @group User
 */
class Test_Controller_V1_Users extends TestCase {
    private $_link = 'http://miniblog.tam/v1/';
    /**
     *
     * test create user
     * Method: Post
     *
     */
    public function test_create_user_ok() {
        $link    = $this->_link.'users';
        $method    = 'POST';
        $params = array(
            'username'      => 'tam04',
            'password'      => '123456',
            'email'         => 'tam04@gmail.com',
            'firstname'     => 'tam',
            'lastname'      => 'pham',
            'group'         => 1,
            'gender'        => 1,
            'avatar'        => 'avatar.jpg',
            'birthday'      => '1988-12-13',
            'address'       => '111D Ly Chinh Thang',
            'city'          => 'HCMC',
            'mobile'        => '0909999999',
        );
        $res = $this->curl($link, $method, $params);

        //delete user tam04
        DB::delete('user')->where('username', '=', $params['username'])->execute();
        $this->assertEquals(STATUS_OK, $res->meta->code);
    }

    /**
     *
     * username is already exist
     */
    public function test_username_exist() {
        $link    = $this->_link.'users';
        $method    = 'POST';
        $params = array(
            'username'      => 'phamtam',
            'password'      => '123456',
            'email'         => 'tam04@gmail.com',
            'firstname'     => 'tam',
            'lastname'      => 'pham',
            'group'         => 1,
            'gender'        => 1,
            'avatar'        => 'avatar.jpg',
            'birthday'      => '1988-12-13',
            'address'       => '111D Ly Chinh Thang',
            'city'          => 'HCMC',
            'mobile'        => '0909999999',
        );
        $res = $this->curl($link, $method, $params);

        $this->assertEquals(ERROR_USERNAME_EXIST, $res->meta->code);
    }

    /**
     *
     * email is already exist
     */
    public function test_email_exist() {
        $link    = $this->_link.'users';
        $method    = 'POST';
        $params = array(
            'username'      => 'tam04',
            'password'      => '123456',
            'email'         => 'tam@gmail.com',
            'firstname'     => 'tam',
            'lastname'      => 'pham',
            'group'         => 1,
            'gender'        => 1,
            'avatar'        => 'avatar.jpg',
            'birthday'      => '1988-12-13',
            'address'       => '111D Ly Chinh Thang',
            'city'          => 'HCMC',
            'mobile'        => '0909999999',
        );
        $res = $this->curl($link, $method, $params);

        $this->assertEquals(ERROR_EMAIL_EXIST, $res->meta->code);
    }

    /**
     *
     * validation error
     * @dataProvider create_user_provider
     */
    public function test_create_user_error_validate($data) {
        $link   = 'http://miniblog.tam/v1/users';
        $method = 'POST';
        $params = $data;
        $res = $this->curl($link, $method, $params);

        $this->assertEquals(ERROR_VALIDATE, $res->meta->code);
    }
    /**
     *
     * dataProvider
     */
    public function create_user_provider() {
        return array(

            // username is empty
            array(
                array(
                    'username'  => '',
                    'password'  => '123456',
                    'email'     => 'tam@gmail',
                    'firstname' => 'tam',
                    'lastname'  => 'pham',
                    'group'     => 1,
                    'gender'    => 1,
                    'avatar'    => 'avatar.jpg',
                    'birthday'  => '1988-12-13',
                    'address'   => '111D Ly Chinh Thang',
                    'city'      => 'HCMC',
                    'mobile'    => '0909999999',
                )
            ),

            // username less than 4 character
            array(
                array(
                    'username'  => 'tam',
                    'password'  => '123456',
                    'email'     => 'tam@gmail.com',
                    'firstname' => 'tam',
                    'lastname'  => 'pham',
                    'group'     => 1,
                    'gender'    => 1,
                    'avatar'    => 'avatar.jpg',
                    'birthday'  => '1988-12-13',
                    'address'   => '111D Ly Chinh Thang',
                    'city'      => 'HCMC',
                    'mobile'    => '0909999999',
                )
            ),

            // username large than 64 character
            array(
                array(
                    'username'  => 'tam_aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa_',
                    'password'  => '123456',
                    'email'     => 'tam_a@gmail.com',
                    'firstname' => 'tam',
                    'lastname'  => 'pham',
                    'group'     => 1,
                    'gender'    => 1,
                    'avatar'    => 'avatar.jpg',
                    'birthday'  => '1988-12-13',
                    'address'   => '111D Ly Chinh Thang',
                    'city'      => 'HCMC',
                    'mobile'    => '0909999999',
                )
            ),

            // password is empty
            array(
                array(
                    'username'  => 'tam04',
                    'password'  => '',
                    'email'     => 'tam@gmail',
                    'firstname' => 'tam',
                    'lastname'  => 'pham',
                    'group'     => 1,
                    'gender'    => 1,
                    'avatar'    => 'avatar.jpg',
                    'birthday'  => '1988-12-13',
                    'address'   => '111D Ly Chinh Thang',
                    'city'      => 'HCMC',
                    'mobile'    => '0909999999',
                )
            ),

            // password less than 4 character
            array(
                array(
                    'username'  => 'tam04',
                    'password'  => '123',
                    'email'     => 'tam@gmail.com',
                    'firstname' => 'tam',
                    'lastname'  => 'pham',
                    'group'     => 1,
                    'gender'    => 1,
                    'avatar'    => 'avatar.jpg',
                    'birthday'  => '1988-12-13',
                    'address'   => '111D Ly Chinh Thang',
                    'city'      => 'HCMC',
                    'mobile'    => '0909999999',
                )
            ),

            // password large than 64 character
            array(
                array(
                    'username'  => 'tam04',
                    'password'  => 'tam_aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa_',
                    'email'     => 'tam@gmail.com',
                    'firstname' => 'tam',
                    'lastname'  => 'pham',
                    'group'     => 1,
                    'gender'    => 1,
                    'avatar'    => 'avatar.jpg',
                    'birthday'  => '1988-12-13',
                    'address'   => '111D Ly Chinh Thang',
                    'city'      => 'HCMC',
                    'mobile'    => '0909999999',
                )
            ),

            // email invalid
            array(
                array(
                    'username'  => 'tam04',
                    'password'  => '123456',
                    'email'     => 'tam@gmail',
                    'firstname' => 'tam',
                    'lastname'  => 'pham',
                    'group'     => 1,
                    'gender'    => 1,
                    'avatar'    => 'avatar.jpg',
                    'birthday'  => '1988-12-13',
                    'address'   => '111D Ly Chinh Thang',
                    'city'      => 'HCMC',
                    'mobile'    => '0909999999',
                )
            ),

            // email is empty
            array(
                array(
                    'username'  => 'tam04',
                    'password'  => '123456',
                    'email'     => '',
                    'firstname' => 'tam',
                    'lastname'  => 'pham',
                    'group'     => 1,
                    'gender'    => 1,
                    'avatar'    => 'avatar.jpg',
                    'birthday'  => '1988-12-13',
                    'address'   => '111D Ly Chinh Thang',
                    'city'      => 'HCMC',
                    'mobile'    => '0909999999',
                )
            ),

            // firstname is empty
            array(
                array(
                    'username'  => 'tam04',
                    'password'  => '123456',
                    'email'     => 'tam@gmail',
                    'firstname' => '',
                    'lastname'  => 'pham',
                    'group'     => 1,
                    'gender'    => 1,
                    'avatar'    => 'avatar.jpg',
                    'birthday'  => '1988-12-13',
                    'address'   => '111D Ly Chinh Thang',
                    'city'      => 'HCMC',
                    'mobile'    => '0909999999',
                )
            ),

            // lastname is empty
            array(
                array(
                    'username'  => 'tam04',
                    'password'  => '123456',
                    'email'     => 'tam@gmail',
                    'firstname' => 'tam',
                    'lastname'  => '',
                    'group'     => 1,
                    'gender'    => 1,
                    'avatar'    => 'avatar.jpg',
                    'birthday'  => '1988-12-13',
                    'address'   => '111D Ly Chinh Thang',
                    'city'      => 'HCMC',
                    'mobile'    => '0909999999',
                )
            ),

            // mobile less than 10 character
            array(
                array(
                    'username'  => 'tam04',
                    'password'  => '123456',
                    'email'     => 'tam@gmail',
                    'firstname' => 'tam',
                    'lastname'  => '',
                    'group'     => 1,
                    'gender'    => 1,
                    'avatar'    => 'avatar.jpg',
                    'birthday'  => '1988-12-13',
                    'address'   => '111D Ly Chinh Thang',
                    'city'      => 'HCMC',
                    'mobile'    => '090999999',
                )
            ),

            // mobile large than 20 character
            array(
                array(
                    'username'  => 'tam04',
                    'password'  => '123456',
                    'email'     => 'tam@gmail',
                    'firstname' => 'tam',
                    'lastname'  => '',
                    'group'     => 1,
                    'gender'    => 1,
                    'avatar'    => 'avatar.jpg',
                    'birthday'  => '1988-12-13',
                    'address'   => '111D Ly Chinh Thang',
                    'city'      => 'HCMC',
                    'mobile'    => '090999999909099999990',
                )
            ),

        );
    }

    /**
     *
     * test login ok
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
        $this->assertEquals(STATUS_OK, $res->meta->code);

        return $res->data;
    }

    /**
     *
     * test username or password null
     * @param array $params
     * @dataProvider login_validate_error_provider
     */
    public function test_login_validate_error($params) {
        $link   = $this->_link.'users/signin';
        $method = 'POST';

        $res    = $this->curl($link, $method, $params);
        $this->assertEquals(ERROR_USERNAME_PWD_NULL, $res->meta->code);
    }

    /**
     *
     * data provider for test_login_validate_error
     */
    public function login_validate_error_provider() {
        return array(
            //username and password null
            array(
                array(
                    'username'  => '',
                    'password'  => ''
                )
            ),
            // username null
            array(
                array(
                    'username'  => '',
                    'password'  => '123456'
                )
            ),
            // password null
            array(
                array(
                    'username'  => 'phamtam2',
                    'password'  => ''
                )
            ),
        );
    }

    /**
     *
     * username, password incorrect
     * @param array $params
     * @dataProvider login_incorrect_provider
     */
    public function test_login_incorrect($params) {
        $link   = $this->_link.'users/signin';
        $method = 'POST';

        $res = $this->curl($link, $method, $params);
        $this->assertEquals(ERROR_LOGIN_FAILED, $res->meta->code);
    }

    /**
     *
     * dataProvider for test_login_incorrect
     */
    public function login_incorrect_provider() {
        return array(
            //sql injection
            array(
                array(
                    'username'  => "' or '1'='1",
                    'password'  => '123456'
                )
            ),
            // sql injection
            array(
                array(
                    'username'  => "' or '1'='1--",
                    'password'  => '123456'
                )
            ),
            // username, password incorrect
            array(
                array(
                    'username'  => 'phamtam',
                    'password'  => '123456'
                )
            ),
        );
    }

    /**
     *
     * User logout
     * @param object $data get from test_login_ok
     * @depends test_login_ok
     */
    public function test_logout_ok($data) {
        $link   = $this->_link.'users/logout';
        $method = 'PUT';
        $params = array('token' => $data->login_hash);

        $res    = $this->curl($link, $method, $params);
        $this->assertNotEmpty($data);
        $this->assertEquals(STATUS_OK, $res->meta->code);
    }

    /**
     *
     * Test logout invalid
     * @param $params get from logout_invalid_provider
     * @dataProvider logout_invalid_provider
     */
    public function test_logout_invalid($params) {
        $link   = $this->_link.'users/logout';
        $method = 'PUT';

        $res    = $this->curl($link, $method, $params);
        $this->assertEquals(ERROR_TOKEN_INVALID, $res->meta->code);
    }

    /**
     *
     *  dataProvider using test_logout_invalid
     */
    public function logout_invalid_provider() {
        return array(
            // token is null
            array(
                array('token' => '')
            ),
            // token is invalid
            array(
                array('token' => 'asf0130181hkjasdjf87jhh1238712jh318asdflkj1283')
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
    private function curl($link, $method = 'GET', $params = '') {
        // init
        $curl = Request::forge($link, 'curl');

        // set method
        $curl->set_method($method);

        // set params
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