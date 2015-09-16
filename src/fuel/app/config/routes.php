<?php
return array(
    '_root_'  => 'welcome/index',  // The default route
    '_404_'   => 'welcome/404',    // The main 404 route

    'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
    'v1/users' => array(array('POST', new Route('v1/users/create')), array('PUT', new Route('v1/users/update')), array('GET', new Route('v1/users/user_info'))),
    'v1/users/(:num)/posts' => array(array('GET', new Route('v1/posts/list_posts_for_user/$1'))),
    'v1/posts' => array(array('GET', new Route('v1/posts/list_all_posts')), array('POST', new Route('v1/posts/create'))),
    'v1/posts/(:num)' => array(array('GET', new Route('v1/posts/view/$1')), array('PUT', new Route('v1/posts/update/$1')), array('DELETE', new Route('v1/posts/delete/$1'))),
    'v1/comments/(:num)' => array(
                                array('POST', new Route('v1/comments/create/$1')),
                                array('PUT', new Route('v1/comments/update/$1')),
                                array('DELETE', new Route('v1/comments/delete/$1')),
                                array('GET', new Route('v1/comments/list_comments_for_post/$1'))
                            )
);