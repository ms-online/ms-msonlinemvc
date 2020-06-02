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

    // 用户登录
    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email =:email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;
        // 判断密码是否匹配
        if (password_verify($password, $hashed_password)) {
            return $row;
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

    // 通过ID查询用户
    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();
        return $row;
    }
}
