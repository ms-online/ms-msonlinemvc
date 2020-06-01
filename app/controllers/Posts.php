<?php
class Posts extends Controller
{
    public function __construct()
    {
        if (!isLoggdeIn()) {
            redirect('users/login');
        }
    }
    public function index()
    {
        // 初始化
        $data = [];
        $this->view('posts/index', $data);
    }
}