<?php
return array(
    '_root_'  => 'welcome/index',  // The default route
    '_404_'   => 'welcome/404',    // The main 404 route

    'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
    'v1/users' => array(array('POST', new Route('v1/users/create')), array('PUT', new Route('v1/users/update'))),
    'v1/posts' => array(array('GET', new Route('v1/posts/index')), array('POST', new Route('v1/posts/create'))),
    'v1/posts/(:num)' => array(array('PUT', new Route('v1/posts/update/$1')), array('DELETE', new Route('v1/posts/delete/$1'))),
);