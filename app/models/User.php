<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // 注册用户
    public function register($data)
    {
        $this->db->query('INSERT INTO users(name, email, password) VALUES(:name, :email, :password)');
        // 将值绑定到参数
        $this->db->bind(':name', $data['name']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('password', $data['password']);

        // 执行预处理语句
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // 通过邮箱查询是否有这个用户
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // 验证行数是否大于0
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
