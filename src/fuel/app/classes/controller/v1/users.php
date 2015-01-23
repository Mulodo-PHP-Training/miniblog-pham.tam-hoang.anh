<?php
/**
 * 
 * @version 1
 */

class Controller_V1_Users extends MyController
{

	private $_filter = array('strip_tags', 'htmlentities');
	
	/**
	 * @api
	 * 
	 * Create user account
	 * 
	 * @return xml 
	 */
	public function Post_create()
	{
		// Init
		$model = new Model_V1_Users();
	
		// add validation
		$val = Validation::forge()->add_model('Model_V1_Users');
		if($val->run())
		{
			// create user
			$rest = Auth::create_user(
				Security::clean(Input::param('username'), $this->_filter),
				Security::clean(Input::param('password'), $this->_filter),
				Security::clean(Input::param('email'), $this->_filter),
				1,
				array(
					'firstname' => Security::clean(Input::param('firstname'), $this->_filter),
					'lastname'	=> Security::clean(Input::param('lastname'), $this->_filter),
					'avatar'	=> Security::clean(Input::param('avatar'), $this->_filter),
					'birthday'	=> Security::clean(Input::param('birthday'), $this->_filter),
					'gender'	=> Security::clean(Input::param('gender'), $this->_filter),
					'address'	=> Security::clean(Input::param('address'), $this->_filter),
					'city'		=> Security::clean(Input::param('city'), $this->_filter),
					'mobile'	=> Security::clean(Input::param('mobile'), $this->_filter)
				)
			);
			
			if($rest != STATUS_OK)
			{
				$response = $this->getResponse($rest);
			}
			else
			{
				$data = Input::param();
				$message = 'User account was created successfully';
				$response = $this->getResponse(STATUS_OK, $data, $message);	
			}
		}
		else {
			//get validation message
			$message = array();
			foreach ($val->error() as $field => $error)
			{
				array_push($message, array($field => $val->error($field)->get_message()));
			}
			$response = $this->getResponse(ERROR_VALIDATE, '', $message);
		}	
		
		return $response;
	}
	
}