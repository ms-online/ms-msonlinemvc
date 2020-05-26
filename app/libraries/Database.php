<?php

/* 创建PDO数据库类
 * 链接数据库
 * 创建预处理查询语句
 * 将值绑定给参数
 * 返回结果
 */

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;


    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        // 设置DSN
        $dsn = 'mysql: host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // 链接数据库,创建pdo实例化对象
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
}