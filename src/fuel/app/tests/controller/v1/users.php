<?php
/**
 * 
 * Testing Controller_V1_Users
 * @author Tam Pham
 * @group User
 */
class Test_Controller_V1_Users extends TestCase
{
	/**
	 * 
	 * test create user
	 * Method: Post
	 * 
	 */
	public function test_create_user_ok()
	{
		$link	= 'http://miniblog.tam/v1/users';
		$method	= 'POST';
		$params = array(
			'username'		=> 'tam04',
			'password'		=> '123456',
			'email'			=> 'tam04@gmail.com',
			'firstname'		=> 'tam',
			'lastname'		=> 'pham',
			'group'			=> 1,
			'gender'		=> 1,
			'avatar'		=> 'avatar.jpg',
			'birthday'		=> '1988-12-13',
			'address'		=> '111D Ly Chinh Thang',
			'city'			=> 'HCMC',
			'mobile'		=> '0909999999',
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
	public function test_username_exist()
	{
		$link	= 'http://miniblog.tam/v1/users';
		$method	= 'POST';
		$params = array(
			'username'		=> 'phamtam',
			'password'		=> '123456',
			'email'			=> 'tam04@gmail.com',
			'firstname'		=> 'tam',
			'lastname'		=> 'pham',
			'group'			=> 1,
			'gender'		=> 1,
			'avatar'		=> 'avatar.jpg',
			'birthday'		=> '1988-12-13',
			'address'		=> '111D Ly Chinh Thang',
			'city'			=> 'HCMC',
			'mobile'		=> '0909999999',
		);
		$res = $this->curl($link, $method, $params);

		$this->assertEquals(ERROR_USERNAME_EXIST, $res->meta->code);
	}
	
	/**
	 * 
	 * email is already exist
	 */
	public function test_email_exist()
	{
		$link	= 'http://miniblog.tam/v1/users';
		$method	= 'POST';
		$params = array(
			'username'		=> 'tam04',
			'password'		=> '123456',
			'email'			=> 'tam@gmail.com',
			'firstname'		=> 'tam',
			'lastname'		=> 'pham',
			'group'			=> 1,
			'gender'		=> 1,
			'avatar'		=> 'avatar.jpg',
			'birthday'		=> '1988-12-13',
			'address'		=> '111D Ly Chinh Thang',
			'city'			=> 'HCMC',
			'mobile'		=> '0909999999',
		);
		$res = $this->curl($link, $method, $params);
		
		$this->assertEquals(ERROR_EMAIL_EXIST, $res->meta->code);
	}
	
	/**
	 * 
	 * validation error
	 * @dataProvider create_user_provider
	 */
	public function test_create_user_error_validate($data)
	{
		$link	= 'http://miniblog.tam/v1/users';
		$method	= 'POST';
		$params = $data;
		$res = $this->curl($link, $method, $params);
		
		$this->assertEquals(ERROR_VALIDATE, $res->meta->code);
	}
	/**
	 * 
	 * dataProvider
	 */
	public function create_user_provider()
	{
		return array(
		
			// username is empty
			array(
				array(
					'username'		=> '',
					'password'		=> '123456',
					'email'			=> 'tam@gmail',
					'firstname'		=> 'tam',
					'lastname'		=> 'pham',
					'group'			=> 1,
					'gender'		=> 1,
					'avatar'		=> 'avatar.jpg',
					'birthday'		=> '1988-12-13',
					'address'		=> '111D Ly Chinh Thang',
					'city'			=> 'HCMC',
					'mobile'		=> '0909999999',
				)
			),
			
			// username less than 4 character
			array(
				array(
					'username'		=> 'tam',
					'password'		=> '123456',
					'email'			=> 'tam@gmail.com',
					'firstname'		=> 'tam',
					'lastname'		=> 'pham',
					'group'			=> 1,
					'gender'		=> 1,
					'avatar'		=> 'avatar.jpg',
					'birthday'		=> '1988-12-13',
					'address'		=> '111D Ly Chinh Thang',
					'city'			=> 'HCMC',
					'mobile'		=> '0909999999',
				)
			),
			
			// username large than 64 character
			array(
				array(
					'username'		=> 'tam_aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa_',
					'password'		=> '123456',
					'email'			=> 'tam_a@gmail.com',
					'firstname'		=> 'tam',
					'lastname'		=> 'pham',
					'group'			=> 1,
					'gender'		=> 1,
					'avatar'		=> 'avatar.jpg',
					'birthday'		=> '1988-12-13',
					'address'		=> '111D Ly Chinh Thang',
					'city'			=> 'HCMC',
					'mobile'		=> '0909999999',
				)
			),
			
			// password is empty
			array(
				array(
					'username'		=> 'tam04',
					'password'		=> '',
					'email'			=> 'tam@gmail',
					'firstname'		=> 'tam',
					'lastname'		=> 'pham',
					'group'			=> 1,
					'gender'		=> 1,
					'avatar'		=> 'avatar.jpg',
					'birthday'		=> '1988-12-13',
					'address'		=> '111D Ly Chinh Thang',
					'city'			=> 'HCMC',
					'mobile'		=> '0909999999',
				)
			),
			
			// password less than 4 character
			array(
				array(
					'username'		=> 'tam04',
					'password'		=> '123',
					'email'			=> 'tam@gmail.com',
					'firstname'		=> 'tam',
					'lastname'		=> 'pham',
					'group'			=> 1,
					'gender'		=> 1,
					'avatar'		=> 'avatar.jpg',
					'birthday'		=> '1988-12-13',
					'address'		=> '111D Ly Chinh Thang',
					'city'			=> 'HCMC',
					'mobile'		=> '0909999999',
				)
			),
			
			// password large than 64 character
			array(
				array(
					'username'		=> 'tam04',
					'password'		=> 'tam_aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa_',
					'email'			=> 'tam@gmail.com',
					'firstname'		=> 'tam',
					'lastname'		=> 'pham',
					'group'			=> 1,
					'gender'		=> 1,
					'avatar'		=> 'avatar.jpg',
					'birthday'		=> '1988-12-13',
					'address'		=> '111D Ly Chinh Thang',
					'city'			=> 'HCMC',
					'mobile'		=> '0909999999',
				)
			),
			
			// email invalid
			array(
				array(
					'username'		=> 'tam04',
					'password'		=> '123456',
					'email'			=> 'tam@gmail',
					'firstname'		=> 'tam',
					'lastname'		=> 'pham',
					'group'			=> 1,
					'gender'		=> 1,
					'avatar'		=> 'avatar.jpg',
					'birthday'		=> '1988-12-13',
					'address'		=> '111D Ly Chinh Thang',
					'city'			=> 'HCMC',
					'mobile'		=> '0909999999',
				)
			),
			
			// email is empty
			array(
				array(
					'username'		=> 'tam04',
					'password'		=> '123456',
					'email'			=> '',
					'firstname'		=> 'tam',
					'lastname'		=> 'pham',
					'group'			=> 1,
					'gender'		=> 1,
					'avatar'		=> 'avatar.jpg',
					'birthday'		=> '1988-12-13',
					'address'		=> '111D Ly Chinh Thang',
					'city'			=> 'HCMC',
					'mobile'		=> '0909999999',
				)
			),
			
			// firstname is empty
			array(
				array(
					'username'		=> 'tam04',
					'password'		=> '123456',
					'email'			=> 'tam@gmail',
					'firstname'		=> '',
					'lastname'		=> 'pham',
					'group'			=> 1,
					'gender'		=> 1,
					'avatar'		=> 'avatar.jpg',
					'birthday'		=> '1988-12-13',
					'address'		=> '111D Ly Chinh Thang',
					'city'			=> 'HCMC',
					'mobile'		=> '0909999999',
				)
			),
			
			// lastname is empty
			array(
				array(
					'username'		=> 'tam04',
					'password'		=> '123456',
					'email'			=> 'tam@gmail',
					'firstname'		=> 'tam',
					'lastname'		=> '',
					'group'			=> 1,
					'gender'		=> 1,
					'avatar'		=> 'avatar.jpg',
					'birthday'		=> '1988-12-13',
					'address'		=> '111D Ly Chinh Thang',
					'city'			=> 'HCMC',
					'mobile'		=> '0909999999',
				)
			),
			
			// mobile less than 10 character
			array(
				array(
					'username'		=> 'tam04',
					'password'		=> '123456',
					'email'			=> 'tam@gmail',
					'firstname'		=> 'tam',
					'lastname'		=> '',
					'group'			=> 1,
					'gender'		=> 1,
					'avatar'		=> 'avatar.jpg',
					'birthday'		=> '1988-12-13',
					'address'		=> '111D Ly Chinh Thang',
					'city'			=> 'HCMC',
					'mobile'		=> '090999999',
				)
			),
			
			// mobile large than 20 character
			array(
				array(
					'username'		=> 'tam04',
					'password'		=> '123456',
					'email'			=> 'tam@gmail',
					'firstname'		=> 'tam',
					'lastname'		=> '',
					'group'			=> 1,
					'gender'		=> 1,
					'avatar'		=> 'avatar.jpg',
					'birthday'		=> '1988-12-13',
					'address'		=> '111D Ly Chinh Thang',
					'city'			=> 'HCMC',
					'mobile'		=> '090999999909099999990',
				)
			),
			
		);
	}
	
	private function curl($link, $method = 'GET', $params = '')
	{
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