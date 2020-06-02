<?php
class Posts extends Controller
{
    public function __construct()
    {
        if (!isLoggdeIn()) {
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
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
        // 初始化
        $data = [
            'title' => '',
            'body' => ''
        ];
        $this->view('posts/add', $data);
    }
}
