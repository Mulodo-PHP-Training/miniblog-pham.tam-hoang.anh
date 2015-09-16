<?php
class Controller_Base extends Controller_Template {
    protected $format = 'json';
    public $link_api = 'http://miniblog.tam/v1/';
    /**
     *
     * get response code
     * @param string $code
     * @param array $data
     * @param string or array $message
     *
     * @return json format
     */
    public function get_response($code, $data = '', $message = '') {
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

    /**
     *
     * get response body from $link
     * @param string $link
     * @param string $method
     * @param array $params
     *
     * @return object
     */
    public function curl($link, $method = 'GET', $params = '', $header = '') {
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