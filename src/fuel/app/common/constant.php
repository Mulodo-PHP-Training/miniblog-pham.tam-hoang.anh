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

// USERNAME OR PASSWORD NULL
define('ERROR_USERNAME_PWD_NULL', '1004');
define('MSG_USERNAME_PWD_NULL', 'Username or Password null');

// LOGIN FAIL
define('ERROR_LOGIN_FAILED', '1005');
define('MSG_LOGIN_FAILED', 'Username or Password incorrect');

// USERNAME ALREADY EXIST
define('ERROR_USERNAME_EXIST', '2001');
define('MSG_USERNAME_EXIST', 'Username already exist');

// EMAIL ALREADY EXIST
define('ERROR_EMAIL_EXIST', '2002');
define('MSG_EMAIL_EXIST', 'Email already exist');

// CREATE USER ERROR
define('ERROR_INSERT_USER', '2003');
define('MSG_INSERT_USER', 'Create new user failed');

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
