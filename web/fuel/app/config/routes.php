<?php
return array(
	'_root_'  => 'home/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route

	// front end
	'login' => 'users/login',
	'logout' => 'users/logout',
	'UpdateUserInfo' => 'users/update',
	'searchUser' => 'users/search',
	'searchUser/(:num)' => 'users/search/$1',
	'change-password'	=> 'users/password',
	'list-all-posts' => 'posts/list_all_posts',
	'list-all-posts/(:num)' => 'posts/list_all_posts/$1',
	'list-user-posts/(:num)' => 'posts/list_all_user_posts/$1',
	'detail/(:num)'	=> 'posts/view/$1',
	'create-comment' => 'comments/create'
);