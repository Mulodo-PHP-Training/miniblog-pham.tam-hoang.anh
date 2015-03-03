<?php
/**
 *
 * Model Comments
 * @author TamPham
 * @version 1
 *
 */
class Model_V1_Comments extends Orm\Model {
    protected static $_properties = array(
        'id',
        'content'         => array(
            'data_type'         => 'varchar',
            'label'             => 'Content',
            'validation'        => array('required', 'min_length' => array(4), 'max_length' => array(250))
        ),

        'user_id'         => array(
            'data_type'         => 'int',
            'label'             => 'User Id'
        ),
        'post_id'         => array(
            'data_type'         => 'int',
            'label'             => 'Post Id'
        ),
        'created_at'    => array(
            'data_type'         => 'varchar',
            'label'             => 'Created',
        ),
        'updated_at'    => array(
            'data_type'         => 'varchar',
            'label'             => 'Updated',
        ),
    );
    protected static $_table_name = 'comment';

    protected static $_created_at = 'created_at';

    protected static $_updated_at = 'updated_at';

    protected static $_belongs_to = array(
        'post' => array(
            'model_to'  => 'Model_V1_Posts',
            'key_from'  => 'post_id',
            'key_to'    => 'id'
        )
    );
}