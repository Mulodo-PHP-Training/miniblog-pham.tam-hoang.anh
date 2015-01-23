<?php
/**
 * The development database settings. These get merged with the global settings.
 */

//return array(
//	'default' => array(
//		'connection'  => array(
//			'dsn'        => 'mysql:host=localhost;dbname=mini_blog',
//			'username'   => 'root',
//			'password'   => 'root',
//		),
//	),
//);

return array(
    'default' => array(
        'type'           => 'mysql',
	    'connection'     => array(
	        'hostname'       => 'localhost',
	        'database'       => 'mini_blog',
	        'username'       => 'root',
	        'password'       => 'root',
	        'persistent'     => false,
	        'compress'       => false,
	    ),
	    'identifier'     => '`',
	    'table_prefix'   => '',
	    'charset'        => 'utf8',
	    'enable_cache'   => true,
	    'profiling'      => false,
	    'readonly'       => false,
    ),
);
