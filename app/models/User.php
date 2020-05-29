<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
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