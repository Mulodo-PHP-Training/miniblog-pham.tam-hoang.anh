<?php
class MyController extends Controller_Rest {
    protected $format = 'json';

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
}