<?php
/**
 *
 * @version 1
 */

class Controller_V1_Users extends Controller_Base {

    private $_filter = array('strip_tags', 'htmlentities');

    /**
     * @api
     *
     * Create user account
     *
     * @return json format
     */
    public function post_create() {
        // Init
        $model = new Model_V1_Users();

        // add validation
        $val = Validation::forge()->add_model('Model_V1_Users');
        if ($val->run()) {
            // create user
            $rest = Auth::create_user(
                Security::clean(Input::param('username'), $this->_filter),
                Security::clean(Input::param('password'), $this->_filter),
                Security::clean(Input::param('email'), $this->_filter),
                1,
                array(
                    'firstname' => Security::clean(Input::param('firstname'), $this->_filter),
                    'lastname'  => Security::clean(Input::param('lastname'), $this->_filter),
                    'avatar'    => Security::clean(Input::param('avatar'), $this->_filter),
                    'birthday'  => Security::clean(Input::param('birthday'), $this->_filter),
                    'gender'    => Security::clean(Input::param('gender'), $this->_filter),
                    'address'   => Security::clean(Input::param('address'), $this->_filter),
                    'city'      => Security::clean(Input::param('city'), $this->_filter),
                    'mobile'    => Security::clean(Input::param('mobile'), $this->_filter)
                )
            );

            if ($rest['code'] !== STATUS_OK) {
                $response = $this->get_response($rest['code'], '', $rest['message']);
            } else {
                $data = Input::param();
                $message = 'User account was created successfully';
                $response = $this->get_response(STATUS_OK, $data, $message);
            }
        } else {
            //get validation message
            $message = array();
            foreach ($val->error() as $field => $error) {
                array_push($message, array($field => $error->get_message()));
            }
            $response = $this->get_response(ERROR_VALIDATE, '', $message);
        }

        return $response;
    }

    /**
     *
     * User Login
     * param HTTP_METHOD POST
     * @return json format
     */
    public function post_signin() {
        // check user login?
        if (Auth::check()) { // yes
            $response = $this->get_response(ERROR_LOGGED_USER, '', MSG_LOGGED_USER);
            return $response;
        }
        // get params
        $username = Security::clean(Input::param('username'), $this->_filter);
        $password = Security::clean(Input::param('password'), $this->_filter);

        // perform a login
        $res = Auth::login($username, $password);
        // false
        if (isset($res['code'])) {
            $response = $this->get_response($res['code'], '', $res['message']);
        } else { // true
            $data = $res;
            $message = 'Login successful!';
            $response = $this->get_response(STATUS_OK, $data, $message);
        }

        return $response;
    }

    /**
     *
     * User logout
     * param HTTP_METHOD PUT
     * @return json format
     */
    public function put_logout() {
        // Check login
        if(!Auth::check())
            return $this->get_response(ERROR_USER_NOT_LOGIN, '', MSG_USER_NOT_LOGIN);

        $model = new Model_V1_Users();
        $token = Security::clean(Input::put('token'));
        if ($model->check_token($token) and $token != '') {
            //Delete session login_hash and update token = ''
            Auth::logout();
            return $this->get_response(STATUS_OK, '', 'Logout successful!');
        } else
            return $this->get_response(ERROR_TOKEN_INVALID, '', MSG_TOKEN_INVALID);
    }

    /**
     *
     * Update user info
     *
     * params get from HTTP METHOD PUT
     * @return json format
     */
    public function put_update() {
        // check login
        if(!Auth::check())
            return $this->get_response(ERROR_USER_NOT_LOGIN, '', MSG_USER_NOT_LOGIN);

        // Init
        $model = new Model_V1_Users();
        $token = Security::clean(Input::put('token'));
        if ($model->check_token($token) and $token != '') {
        	// Init validation
            $val = Validation::forge()->add_model('Model_V1_Users');
            $input = array(
                'email'     => Input::put('email'),
                'firstname' => Input::put('firstname'),
                'lastname'  => Input::put('lastname'),
                'avatar'    => Input::put('avatar'),
                'birthday'  => Input::put('birthday'),
                'gender'    => Input::put('gender'),
                'address'   => Input::put('address'),
                'city'      => Input::put('city'),
                'mobile'    => Input::put('mobile')
            );
            if ($val->run($input, true)) {
                $data = array(
                    'email' => Security::clean(Input::param('email'), $this->_filter),
                    'profile_fields' => array(
                        'firstname' => Security::clean(Input::param('firstname'), $this->_filter),
                        'lastname'  => Security::clean(Input::param('lastname'), $this->_filter),
                        'avatar'    => Security::clean(Input::param('avatar'), $this->_filter),
                        'birthday'  => Security::clean(Input::param('birthday'), $this->_filter),
                        'gender'    => Security::clean(Input::param('gender'), $this->_filter),
                        'address'   => Security::clean(Input::param('address'), $this->_filter),
                        'city'      => Security::clean(Input::param('city'), $this->_filter),
                        'mobile'    => Security::clean(Input::param('mobile'), $this->_filter)
                    )
                );
                $user_id = Auth::get_user_id();
                // Update user
                $res = Auth::update_user($data, $user_id[1]);
                if ($res['code'] != STATUS_OK) {
                    return $this->get_response($res['code'], '', $res['message']);
                } else
                    return $this->get_response(STATUS_OK, $res['data'], 'Update user successful!');
            } else {
                //get validation message
                $message = array();
                foreach ($val->error() as $field => $error) {
                    array_push($message, array($field => $error->get_message()));
                }
                return $this->get_response(ERROR_VALIDATE, '', $message);
            }
        } else
            return $this->get_response(ERROR_TOKEN_INVALID, '', MSG_TOKEN_INVALID);
    }

    /**
     *
     * Change password
     *
     * params get from method PUT
     * return json format
     */
    public function put_password() {
        // check login
        if(!Auth::check())
            return $this->get_response(ERROR_USER_NOT_LOGIN, '', MSG_USER_NOT_LOGIN);

        // Init model
        $model = new Model_V1_Users();

        $token = Security::clean(Input::put('token'));
         //check token
        if ($model->check_token($token) and $token != '') {
            // Init validation
            $val = Validation::forge()->add_model('Model_V1_Users');
            $data = array('password' => Input::put('new_password'));
            if ($val->run($data, true)) {

                $old_password   = Security::clean(Input::param('old_password'), $this->_filter);
                $new_password   = Security::clean(Input::param('new_password'), $this->_filter);
                $re_password    = Security::clean(Input::param('retype_password'), $this->_filter);
                // check retype_password match with new_password
                if ($new_password !== $re_password) {
                    return $this->get_response(ERROR_PWD_NOT_MATCH, '', MSG_PWD_NOT_MATCH);
                }

                $user_id = Auth::get_user_id();
                // Change password
                $res = Auth::change_password($old_password, $new_password, $user_id[1]);
                if ($res['code'] != STATUS_OK) {
                    return $this->get_response($res['code'], '', $res['message']);
                } else
                    return $this->get_response(STATUS_OK, $res['data'], 'Change password successful!');

            } else {
                //get validation message
                $message = array();
                foreach ($val->error() as $field => $error) {
                    array_push($message, array($field => $error->get_message()));
                }
                return $this->get_response(ERROR_VALIDATE, '', $message);
            }
        } else
                return $this->get_response(ERROR_TOKEN_INVALID, '', MSG_TOKEN_INVALID);
    }

}