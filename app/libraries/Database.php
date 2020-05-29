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

    // 创建预处理查询语句函数
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // 创建值绑定到参数的函数
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value);
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value);
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value);
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // 执行预处理语句函数
    public function execute()
    {
        return $this->stmt->execute();
    }

    // 获取所有结果对象
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // 获取单个结果对象
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // 获取受影响的行数
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
