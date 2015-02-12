<?php

class Model_V1_Users extends Orm\Model {
    protected static $_properties = array(
        'id',
        'username' => array(
            'data_type'        => 'varchar',
            'label'            => 'Username',
            'validation'       => array('required', 'min_length' => array(4), 'max_length' => array(64))
        ),
        'password' => array(
            'data_type'        => 'varchar',
            'label'            => 'Password',
            'validation'       => array('required', 'min_length' => array(4), 'max_length' => array(64))
        ),
        'email' => array(
            'data_type'        => 'varchar',
            'label'            => 'Email',
            'validation'       => array('required', 'valid_email', 'min_length' => array(4))
        ),
        'firstname' => array(
            'data_type'        => 'varchar',
            'label'            => 'Firstname',
            'validation'       => array('required', 'max_length' => array(50))
        ),
        'lastname' => array(
            'data_type'        => 'varchar',
            'label'            => 'Lastname',
            'validation'       => array('required', 'max_length' => array(50))
        ),
        'avatar' => array(
            'data_type'        => 'varchar',
            'label'            => 'Avatar',
            'validation'       => array('max_length' => array(100))
        ),
        'birthday' => array(
            'data_type'        => 'varchar',
            'label'            => 'Birthday',
            'validation'       => array('max_length' => array(10))
        ),
        'gender' => array(
            'data_type'        => 'int',
            'label'            => 'Gender',
        ),
        'address' => array(
            'data_type'        => 'varchar',
            'label'            => 'Address',
        ),
        'city' => array(
            'data_type'        => 'varchar',
            'label'            => 'City',
        ),
        'mobile' => array(
            'data_type'        => 'varchar',
            'label'            => 'Mobile',
            'validation'       => array('min_length' => array(10), 'max_length' => array(20))
        ),
        'group' => array(
            'data_type'        => 'int',
            'label'            => 'Group',
        ),
        'login_hash' => array(
            'data_type'        => 'varchar',
            'label'            => 'Login Hash',
        ),
        'created_at' => array(
            'data_type'        => 'varchar',
            'label'            => 'Created',
        ),
        'updated_at' => array(
            'data_type'        => 'varchar',
            'label'            => 'Updated',
        ),
    );

    protected static $_table_name = 'user';

    protected static $_created_at = 'created_at';
    protected static $_updated_at = 'updated_at';
    protected static $_has_many = array(
        'post' => array(
            'model_to'  => 'Model_V1_Posts',
            'key_form'  => 'id',
            'key_to'    => 'user_id'
        )
    );

    /**
     *
     * check token
     * @param $token
     * @return bool
     */
    public function check_token($token) {
        $model = new Model_V1_Users();
        $res = $model->query()->where('login_hash', $token)->count();
        if($res > 0)
            return true;
        return false;

    }

    /**
     *
     * Search user by username, firstname, lastname
     * @param string $keyword
     * @param int $limit
     * @param int $offset
     */
    public function search_user($keyword, $limit = LIMIT_USER, $offset = 0) {
        // SQL
        $sql = sprintf("SELECT * FROM user WHERE MATCH(username, firstname, lastname) AGAINST('%s') order by created_at desc limit %d offset %d", $keyword, $limit, $offset);
        $user = DB::query($sql)->as_object()->execute();
        //check isset user
        if($user) {
            // list user
            $item = array();
            foreach ($user as $value) {
                $item[] = $value;
            }
            //response
            $data = array(
                'item'      => $item,
                'limit'     => $limit,
                'offset'    => $offset,
                'total'     => count($user)
            );
            return $data;
        }

        return false;
    }

    /**
     *
     * Get user information
     * @param int $id user_id
     */
    public function get_user_info($id) {
        $user = Model_V1_Users::find($id);
        if($user)
            return $user;
        return false;
    }
}
