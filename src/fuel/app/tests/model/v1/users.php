<?php
/**
 * testing Model_V1_Users
 * @author Tam Pham
 * @group User
 */

class Test_Model_V1_Users extends TestCase {
    private $_model;

    // call before test
    public function setUp() {
        $this->_model = new Model_V1_Users();
    }

    // call after test
    public function tearDown() {
        unset($this->_model);
    }

    /**
     *
     * Search user ok
     */
    public function test_search_user_ok() {
        $keyword    = 'tam';
        $user       = $this->_model->search_user($keyword);

        $this->assertNotEmpty($user);
    }

    /**
     *
     * Search user not found result
     */
    public function test_search_user_null() {
        $keyword    = 'abca afbc';
        $user       = $this->_model->search_user($keyword);

        $this->assertEquals($user['total'], 0);
    }
}