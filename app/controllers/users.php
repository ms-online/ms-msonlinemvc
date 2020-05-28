<?php
class Users extends Controller
{
    public function __construct()
    {
    }

    public function register()
    {
        // 验证是post请求还是加载页面
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // 提交表单
        } else {
            // 创建初始化data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // 加载注册页面
            $this->view('users/register', $data);
        }
    }
}