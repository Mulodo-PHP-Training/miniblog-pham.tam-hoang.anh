<?php
class MyController extends Controller_Rest
{
	protected $format = 'json';
	/**
	 * 
	 * get message error
	 *  @param $error_code
	 *  @return $message
	 */
	private function getMessage($code)
	{
		$message = '';
		
		switch ($code)
		{
			case ERROR_VALIDATE:
				$message = 'Validate data error';
			break;
			case ERROR_USERNAME_EXIST:
				$message = 'Username already exist';
			break;
			case ERROR_EMAIL_EXIST:
				$message = 'Email already exist';
			break;
			case ERROR_INSERT_USER:
				$message = 'Insert user error';
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
	 * @return xml
	 */
	public function getResponse($code, $data = '', $message = '')
	{
		if($message == '')
			$message = $this->getMessage($code);
		$response = $this->response(array(
			'meta'	=> array(
				'code'		=> $code,
				'message'	=> $message
				),
			'data'	=> $data
			)
		);
		
		return $response;
	}
}