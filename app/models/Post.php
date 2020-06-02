<?php
class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // 获取博客帖子
    public function getPosts()
    {
        $this->db->query('SELECT *,
                        posts.id as postId,
                        users.id as userId,
                        posts.created_at as postCreated,
                        users.created_at as userCreated
                         FROM posts
                        INNER JOIN users
                        ON posts.user_id = users.id
                        ORDER BY posts.created_at DESC
                        ');

        $results = $this->db->resultSet();

        return $results;
    }
    // 添加博客
    public function addPost($data)
    {
        $this->db->query('INSERT INTO posts(title, user_id, body) VALUES(:title, :user_id, :body)');
        // 将值绑定到参数
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':body', $data['body']);

        // 执行预处理语句
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // 通过id获取
    public function getPostById($id)
    {
        $this->db->query('SELECT * FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    // 更新博客
    public function updatePost($data)
    {
        $this->db->query('UPDATE posts SET title= :title,body=:body WHERE id =:id');
        // 将值绑定到参数
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        // 执行预处理语句
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
