<?php

class Model_V1_Users extends Orm\Model
{
	protected static $_properties = array(
		'id',
		'username' => array(
			'data_type'		=> 'varchar',
			'label'			=> 'Username',
			'validation'	=> array('required', 'min_length' => array(4), 'max_length' => array(64))		
		),
		'password' => array(
			'data_type'		=> 'varchar',
			'label'			=> 'Password',
			'validation'	=> array('required', 'min_length' => array(4), 'max_length' => array(64))
		),
		'email' => array(
			'data_type'		=> 'varchar',
			'label'			=> 'Email',
			'validation'	=> array('required', 'valid_email', 'min_length' => array(4))
		),
		'firstname' => array(
			'data_type'		=> 'varchar',
			'label'			=> 'Firstname',
			'validation'	=> array('required', 'max_length' => array(50))
		),
		'lastname' => array(
			'data_type'		=> 'varchar',
			'label'			=> 'Lastname',
			'validation'	=> array('required', 'max_length' => array(50))
		),
		'avatar' => array(
			'data_type'		=> 'varchar',
			'label'			=> 'Avatar',
			'validation'	=> array('max_length' => array(100))
		),
		'birthday' => array(
			'data_type'		=> 'varchar',
			'label'			=> 'Birthday',
			'validation'	=> array('max_length' => array(10))
		),
		'gender' => array(
			'data_type'		=> 'int',
			'label'			=> 'Gender',
		),
		'address' => array(
			'data_type'		=> 'varchar',
			'label'			=> 'Address',
		),
		'city' => array(
			'data_type'		=> 'varchar',
			'label'			=> 'City',
		),
		'mobile' => array(
			'data_type'		=> 'varchar',
			'label'			=> 'Mobile',
			'validation'	=> array('min_length' => array(10), 'max_length' => array(20))
		),
		'group' => array(
			'data_type'		=> 'int',
			'label'			=> 'Group',
		),
		'login_hash' => array(
			'data_type'		=> 'varchar',
			'label'			=> 'Login Hash',
		),
		'created_at' => array(
			'data_type'		=> 'varchar',
			'label'			=> 'Created',
		),
		'updated_at' => array(
			'data_type'		=> 'varchar',
			'label'			=> 'Updated',
		),
	);
	
	protected static $_table_name = 'user';
}
