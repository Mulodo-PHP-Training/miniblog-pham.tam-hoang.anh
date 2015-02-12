<?php
/**
 * testing Model_V1_Posts
 * @author Tam Pham
 * @group Post
 */

class Test_Model_V1_Posts extends TestCase {
    private $_model;

    // call before test
    public function setUp() {
        $this->_model = new Model_V1_Posts();
    }

    // call after test
    public function tearDown() {
        unset($this->_model);
    }

    /**
     *
     * test list all posts of user true
     */
    public function test_get_list_posts_for_user_ok() {
        $user_id = 18;
        $posts = $this->_model->get_list_posts_for_user($user_id);

        $this->assertNotEmpty($posts);
    }

    /**
     *
     * test list all posts of user fail
     */
    public function test_get_list_posts_for_user_fail() {
        $user_id = 17;
        $posts = $this->_model->get_list_posts_for_user($user_id);

        $this->assertFalse($posts);
    }
}