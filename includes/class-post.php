<?php
class Post
{
    /**
     * Retrieve all posts from database
     */
    public static function getAllPosts()
    {
        return DB::connect()->select(
            'SELECT * FROM posts ORDER BY id DESC',
            [],
            true
        );
    }
    /**
     * Retrieve post data by id
     */
    public static function getPostByID ( $post_id )
    {
        return DB::connect()->select(
            'SELECT * FROM posts WHERE id = :id',
            [
                'id' => $post_id
            ]
            );
    }
    /**
     * Add new post
     */
    public static function add( $title, $content, $user_id)
    {
        return DB::connect()->insert(
            'INSERT INTO posts(title, content, user_id)
            VALUES (:title, :content, :user_id)',
            [
                'title' => $title,
                'content' => $content,
                'user_id' => $user_id
            ]
        );
    }
    /**
     * Update post details
     */
    public static function update( $id, $title, $content, $status = null )
    {
        //setup params
        $params = [
            'id' => $id,
            'title' => $title,
            'status' => $status,
            'content' => $content
        ];
        // update post data into the database
        return DB::connect()->update(
            'UPDATE posts SET title = :title, content = :content, status = :status WHERE id = :id',
            $params
        );
    }
    /**
     * Delete post
     */
    public static function delete( $post_id )
    {
        return DB::connect()->delete(
            'DELETE FROM posts where id = :id',
            [
                'id' => $post_id
            ]
            );
    }
}