<?php
use Fuel\Core\Uri;

// STATUS OK
define('STATUS_OK', '200');

// VALIDATE ERROR
define('ERROR_VALIDATE', '1001');
define('MSG_VALIDATE', 'Validate data error');

// TOKEN EXPIRED
define('ERROR_TOKEN_EXPIRED', '1002');
define('MSG_TOKEN_EXPIRED', 'Token has expired');

// TOKEN INVALID
define('ERROR_TOKEN_INVALID', '1003');
define('MSG_TOKEN_INVALID', 'Token is invalid');

// USERNAME OR PASSWORD NULL
define('ERROR_USERNAME_PWD_NULL', '1004');
define('MSG_USERNAME_PWD_NULL', 'Username or Password null');

// LOGIN FAIL
define('ERROR_LOGIN_FAILED', '1005');
define('MSG_LOGIN_FAILED', 'Username or Password incorrect');

// LOGOUT FAIL
define('ERROR_LOGOUT_FAILED', '1006');
define('MSG_LOGOUT_FAILED', 'Logout unsuccessful!');

// USERNAME ALREADY EXIST
define('ERROR_USERNAME_EXIST', '2001');
define('MSG_USERNAME_EXIST', 'Username already exist');

// EMAIL ALREADY EXIST
define('ERROR_EMAIL_EXIST', '2002');
define('MSG_EMAIL_EXIST', 'Email already exist');

// CREATE USER ERROR
define('ERROR_INSERT_USER', '2003');
define('MSG_INSERT_USER', 'Create new user failed');

// USER HAS LOGGED
define('ERROR_LOGGED_USER', '2004');
define('MSG_LOGGED_USER', 'User has logged in!');

// UPDATE USER FAILED
define('ERROR_UPDATE_USER_FAILED', '2005');
define('MSG_UPDATE_USER_FAILED', 'Update user unsuccessful');

// PASSWORD NULL
define('ERROR_PASSWORD_NULL', '2006');
define('MSG_PASSWORD_NULL', 'Password can\'t be empty');

// USERNAME NOT FOUND
define('ERROR_USERNAME_NOT_FOUND', '2007');
define('MSG_USERNAME_NOT_FOUND', 'Username not found');

// USERNAME CANNOT BE CHANGE
define('ERROR_USERNAME_CHANGE', '2008');
define('MSG_USERNAME_CHANGE', 'Username can\'t be change');

// OLD PASSWORD IS INVALID
define('ERROR_OLD_PWD_INVALID', '2009');
define('MSG_OLD_PWD_INVALID', 'Old password is invalid');

// EMAIL IS INVALID
define('ERROR_EMAIL_INVALID', '2010');
define('MSG_EMAIL_INVALID', 'Email is invalid');

// USER NOT LOGIN
define('ERROR_USER_NOT_LOGIN', '2011');
define('MSG_USER_NOT_LOGIN', 'You are not login!');

// CHANGE PASSWORD FAILED
define('ERROR_CHANGE_PWD_FAILED', '2012');
define('MSG_CHANGE_PWD_FAILED', 'Change password failed!');

// RE_PASSWORD NOT MATCH
define('ERROR_PWD_NOT_MATCH', '2013');
define('MSG_PWD_NOT_MATCH', 'Retype password not match!');

// KEYWORD NOT NULL
define('ERROR_KEYWORD_NULL', '2014');
define('MSG_KEYWORD_NULL', 'Keyword can not null!');

// SEARCH USER FAILED
define('ERROR_SEARCH_USER_FAILED', '2015');
define('MSG_SEARCH_USER_FAILED', 'Search user failed!');

// SEARCH USER NOT FOUND RESULT
define('ERROR_SEARCH_USER_NOT_FOUND_RESULT', '2016');

// GET USER INFO FAILED
define('ERROR_GET_USER_INFO_FAILED', '2017');
define('MSG_GET_USER_INFO_FAILED', 'Get user information unsuccessful!');

// GET ALL POST ERROR
define('ERROR_GET_ALL_POST_FAILED', '2501');
define('MSG_GET_ALL_POST_FAILED', 'Get all post error');

// CREATE POST ERROR
define('ERROR_CREATE_POST_FAILED', '2502');
define('MSG_CREATE_POST_FAILED', 'Create new post error');

// UPDATE POST ERROR
define('ERROR_UPDATE_POST_FAILED', '2503');
define('MSG_UPDATE_POST_FAILED', 'Update post error');

// DELETE POST ERROR
define('ERROR_DELETE_POST_FAILED', '2504');
define('MSG_DELETE_POST_FAILED', 'Delete post error');

// GET A POST ERROR
define('ERROR_GET_A_POST_FAILED', '2505');
define('MSG_GET_A_POST_FAILED', 'get a post error');

// SEARCH POST ERROR
define('ERROR_SEARCH_POST_FAILED', '2506');
define('MSG_SEARCH_POST_FAILED', 'Search post error');

// GET LIST ALL POSTS OF USER_NULL
define('ERROR_GET_LIST_POST_USER_NULL', '2507');
define('MSG_GET_LIST_POST_USER_NULL', 'Can not found post with user');

// ERROR PERMISSION
define('ERROR_PERMISSION', '2508');
define('MSG_PERMISSION', "you don't have permission");

// ERROR POST NOT EXIST
define('ERROR_POST_NOT_EXIST', '2509');
define('MSG_POST_NOT_EXIST', 'The post can not found');

//GET ALL COMMENT ERROR
define('ERROR_GET_ALL_COMMENT_FAILED', '3001');
define('MSG_GET_ALL_COMMENT_FAILED', 'Get all comment error');

// CREATE COMMENT ERROR
define('ERROR_CREATE_COMMENT_FAILED', '3002');
define('MSG_CREATE_COMMENT_FAILED', 'Create new comment error');

// UPDATE COMMENT ERROR
define('ERROR_UPDATE_COMMENT_FAILED', '3003');
define('MSG_UPDATE_COMMENT_FAILED', 'Update comment error');

// DELETE COMMENT ERROR
define('ERROR_DELETE_COMMENT_FAILED', '3004');
define('MSG_DELETE_COMMENT_FAILED', 'Delete comment error');

// ERROR COMMENT NOT EXIST
define('ERROR_COMMENT_NOT_EXIST', '3005');
define('MSG_COMMENT_NOT_EXIST', 'The comment can not found');

// LIMIT_USER
define('LIMIT_USER', 15);

// LIMIT_POST
define('LIMIT_POST', 10);
