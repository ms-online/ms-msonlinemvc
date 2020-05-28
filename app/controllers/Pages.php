<?php
class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {

        $data = ['title' => '共享贴吧', 'description' => '基于PHP面向对象MVC框架创建的一个简单的社交网络平台'];
        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = ['title' => '关于我们', 'description' => '这是一款可以增进交流，分享见解的应用程序——共享贴吧（共享博客）'];
        $this->view('pages/about', $data);
    }
}
