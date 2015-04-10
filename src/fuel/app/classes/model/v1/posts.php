<?php
/**
 *
 * Model Posts
 * @author TamPham
 * @version 1
 *
 */
class Model_V1_Posts extends Orm\Model {
    protected static $_properties = array(
        'id',
        'title'         => array(
            'data_type'         => 'varchar',
            'label'             => 'Title',
            'validation'        => array('required', 'min_length' => array(4), 'max_length' => array(100))
        ),
        'description'   => array(
            'data_type'         => 'text',
            'label'             => 'Description',
            'validation'        => array('required', 'min_length' => array(4), 'max_length' => array(400))
        ),
        'content'       => array(
            'data_type'         => 'text',
            'label'             => 'Content',
            'validation'        => array('required')
        ),
        'image'         => array(
            'data_type'         => 'varchar',
            'label'             => 'Image'
        ),
        'user_id'         => array(
            'data_type'         => 'int',
            'label'             => 'User Id'
        ),
        'status'        => array(
            'data_type'         => 'int',
            'label'             => 'Status'
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
    protected static $_table_name = 'post';

    protected static $_created_at = 'created_at';

    protected static $_updated_at = 'updated_at';

    protected static $_belongs_to = array(
        'user' => array(
            'model_to'  => 'Model_V1_Users',
            'key_from'  => 'user_id',
            'key_to'    => 'id'
        )
    );

    protected static $_has_many = array(
        'comment' => array(
            'model_to'  => 'Model_V1_Comments',
            'key_form'  => 'id',
            'key_to'    => 'post_id'
        )
    );

    /**
     *
     * Get list all posts of user
     * @param int $user_id
     * @param int $limit
     * @param int $offset
     * @param string $order_by
     */
    public function get_list_posts_for_user($user_id, $limit = LIMIT_POST, $offset = 0, $order_by = 'created_at') {
        $query = Model_V1_Posts::query()
                ->related('comment')
                ->where('user_id', '=', $user_id)
                ->where('status', '=', 1)
                ->order_by($order_by, 'desc');

        if ($query) {
            $total = $query->count();
            $model = $query->limit($limit)->offset($offset)->get();
            $posts = array();
            foreach ($model as $value) {
                $posts[] = $value;
            }
            $user  = Model_V1_Users::find($user_id);

            $res = array(
                'user'  => $user,
                'posts' => $posts,
                'limit'     => $limit,
                'offset'    => $offset,
                'total'     => $total
            );
            return $res;
        }
        return false;
    }

    /**
     *
     * Get list all posts
     * @param int $limit
     * @param int $offset
     * @param string $order_by
     *
     * @return array
     */
    public function get_list_all_posts($limit = LIMIT_POST, $offset = 0, $order_by = 'created_at') {
        $query = Model_V1_Posts::query()
                ->related('user')
                ->related('comment')
                ->where('status', '=', 1)
                ->order_by($order_by, 'desc');

        if ($query) {
            //get total post
            $total = $query->count();
            // get post with limit
            $model = $query->rows_limit($limit)->offset($offset)->get();
            $posts = array();
            foreach ($model as $value) {
                $posts[] = $value;
            }

            $res = array(
                'posts' => $posts,
                'limit'     => $limit,
                'offset'    => $offset,
                'total'     => $total,
                'order'     => $order_by
            );
            return $res;
        }

        return false;
    }
}