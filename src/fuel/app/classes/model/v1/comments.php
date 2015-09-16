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
        ),
        'user' => array(
            'model_to'  => 'Model_V1_Users',
            'key_from'  => 'user_id',
            'key_to'    => 'id'
        )
    );

    /**
     *
     * Get list all comments of post
     * @param int $user_id
     * @param int $limit
     * @param int $offset
     * @param string $order_by
     */
    public function get_list_comments_for_post($post_id, $limit = LIMIT_POST, $offset = 0, $order_by = 'created_at') {
        $query = Model_V1_Comments::query()
                ->related('user')
                ->where('post_id', '=', $post_id)
                ->order_by($order_by, 'desc');

        if ($query) {
            $total = $query->count();
            $model = $query->limit($limit)->offset($offset)->get();
            $comments = array();
            foreach ($model as $value) {
                $comments[] = $value;
            }
            $post  = Model_V1_Posts::find($post_id);
            $user = Model_V1_Users::find($post->user_id);
            if (!$post && !$user) {
                return false;
            }
            $res = array(
                'post'  => $post,
                'user'  => $user,
                'comments' => $comments,
                'limit'     => $limit,
                'offset'    => $offset,
                'total'     => $total
            );
            return $res;
        }
        return false;
    }
}