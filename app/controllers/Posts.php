<?php
class Posts extends Controller
{
    public function index()
    {
        // 初始化
        $data = [];
        $this->view('posts/index', $data);
    }
}