<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        // 验证是post请求还是加载页面
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // 提交表单,进行表单验证
            // 预处理POST表单数据
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // 创建初始化data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            // 验证姓名是否为空
            if (empty($data['name'])) {
                $data['name_err'] = "姓名不能为空！";
            }

            // 验证邮箱是否为空
            if (empty($data['email'])) {
                $data['email_err'] = "邮箱不能为空！";
            } else {
                // 验证邮箱是否被注册
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = "邮箱已被注册！";
                }
            }

            // 验证密码是否为空/密码长度不小于6
            if (empty($data['password'])) {
                $data['password_err'] = "密码不能为空！";
            } else if (strlen($data['password']) < 6) {
                $data['password_err'] = "密码至少6位数！";
            }

            // 验证确认密码是否为空/是否和密码匹配
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = "确认密码不能为空！";
            } else if ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = "密码不匹配";
            }

            // 确保所有err都为空
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // 验证通过
                // die('注册验证成功');

                // 密码加密
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // 注册用户
                if ($this->userModel->register($data)) {
                    flash('register-success', '恭喜你注册成功，可以进行登录！');
                    redirect('users/login');
                } else {
                    die('抱歉，有错误');
                }
            } else {
                $this->view('users/register', $data);
            }
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

    public function login()
    {
        // 验证是post请求还是加载页面
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // 提交表单,进行验证
            // 预处理POST表单数据
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // 创建初始化data
            $data = [

                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',

            ];
            // 验证邮箱是否为空
            if (empty($data['email'])) {
                $data['email_err'] = "邮箱不能为空！";
            }
            // 验证密码是否为空/密码长度不小于6
            if (empty($data['password'])) {
                $data['password_err'] = "密码不能为空！";
            }
            // 验证是否存在这个用户（email）
            if ($this->userModel->findUserByEmail($data['email'])) {
                // 用户存在
            } else {
                // 用户不存在
                $data['email_err'] = '抱歉，该邮箱未注册！';
            }

            // 确保所有err都为空
            if (empty($data['email_err']) && empty($data['password_err'])) {
                // 验证通过
                // 验证用户登录
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    // 创建flash message
                    die('登录成功！');
                } else {
                    $data['password_err'] = '密码错误';

                    $this->view('users/login', $data);
                }
            } else {
                $this->view('users/login', $data);
            }
        } else {
            // 创建初始化data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            // 加载登录页面
            $this->view('users/login', $data);
        }
    }
}