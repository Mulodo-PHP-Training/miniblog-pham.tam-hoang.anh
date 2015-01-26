<?php
class MyController extends Controller_Rest {
    protected $format = 'json';

    /**
     *
     * get message error
     *  @param $error_code
     *  @return string $message
     */
    private function get_message($code) {
        $message = '';

        switch ($code) {
            // Validate message
            case ERROR_VALIDATE:
                $message = 'Validate data error';
                break;

            // MESSAGE OF USER
            case ERROR_USERNAME_EXIST:
                $message = 'Username already exist';
                break;
            case ERROR_EMAIL_EXIST:
                $message = 'Email already exist';
                break;
            case ERROR_INSERT_USER:
                $message = 'Insert user error';
                break;
            case ERROR_TOKEN_EXPIRED:
                $message = 'Token has expired';
                break;
            case ERROR_USERNAME_PWD_NULL:
                $message = 'Username or Password null';
                break;
            case ERROR_LOGIN_FAILED:
                $message = 'Username or Password incorrect';
                break;

            //Message of Post
            case ERROR_GET_ALL_POST_FAILED:
                $message = 'Get all post error';
                break;
            case ERROR_CREATE_POST_FAILED:
                $message = 'Create new post error';
                break;
            case ERROR_UPDATE_POST_FAILED:
                $message = 'Update post error';
                break;
            case ERROR_DELETE_POST_FAILED:
                $message = 'Delete post error';
                break;
            case ERROR_GET_A_POST_FAILED:
                $message = 'get a post error';
                break;
            case ERROR_SEARCH_POST_FAILED:
                $message = 'Search post error';
                break;

            // Message of Comment
                case ERROR_GET_ALL_COMMENT_FAILED:
                $message = 'Get all comment error';
            break;
                case ERROR_CREATE_COMMENT_FAILED:
                $message = 'Create new comment error';
                break;
            case ERROR_UPDATE_COMMENT_FAILED:
                $message = 'Update comment error';
                break;
            case ERROR_DELETE_COMMENT_FAILED:
                $message = 'Delete comment error';
                break;
        }

        return $message;
    }

    /**
     *
     *
     * @param string $code
     * @param array $data
     * @param string or array $message
     *
     * @return json format
     */
    public function get_response($code, $data = '', $message = '') {
        if ($message == '')
            $message = $this->get_message($code);
        $response = $this->response(array(
            'meta' => array(
                'code'      => $code,
                'message'   => $message
                ),
            'data' => $data
            )
        );

        return $response;
    }
}