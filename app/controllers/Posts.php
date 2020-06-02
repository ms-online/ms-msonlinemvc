<?php
class Posts extends Controller
{
    public function __construct()
    {
        if (!isLoggdeIn()) {
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }
    public function index()
    {
        // 获取posts
        $posts = $this->postModel->getPosts();
        // 初始化
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/index', $data);
    }
    public function add()
    {
        // 判断是post提交还是加载页面
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // 提交表单
            // 预处理
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // 初始化data
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            // 验证是否为空
            if (empty($data['title'])) {
                $data['title_err'] = '请输入标题';
            }
            if (empty($data['body'])) {
                $data['body_err'] = '请输入博客内容';
            }

            //验证err是否为空
            if (empty($data['title_err']) && empty($data['body_err'])) {
                // err都为空，提交成功
                // 提交成功
                if ($this->postModel->addPost($data)) {
                    flash('post_message', '博客文章添加成功！');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                // 有err重新加载add页面
                $this->view('posts/add', $data);
            }
        } else {
            //加载页面
            // 初始化
            $data = [
                'title' => '',
                'body' => ''
            ];
            $this->view('posts/add', $data);
        }
    }


    public function show($id)
    {
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);
        $data = [
            'post' => $post,
            'user' => $user
        ];
        $this->view('posts/show', $data);
    }

    // 编辑博客
    public function edit($id)
    {
        // 判断是post提交还是加载页面
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // 提交表单
            // 预处理
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // 初始化data
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            // 验证是否为空
            if (empty($data['title'])) {
                $data['title_err'] = '请输入标题';
            }
            if (empty($data['body'])) {
                $data['body_err'] = '请输入博客内容';
            }

            //验证err是否为空
            if (empty($data['title_err']) && empty($data['body_err'])) {
                // err都为空，提交成功
                // 提交成功
                if ($this->postModel->updatePost($data)) {
                    flash('post_message', '博客文章更新成功！');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                // 有err重新加载edit页面
                $this->view('posts/edit', $data);
            }
        } else {
            // 从post模型文件中获取博客
            $post = $this->postModel->getPostById($id);

            // 验证发布者(拥有者)
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }
            //加载页面
            // 初始化
            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body
            ];
            $this->view('posts/edit', $data);
        }
    }
}
