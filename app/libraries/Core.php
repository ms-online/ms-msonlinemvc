<?php

/* 创建应用 CORE Class
 * 创建URL & 加载核心Controller
 * URL 格式 - /controller/method/param1/param2
 */

 class Core {
    //  设置默认属性
    protected $currentController = 'Pages';//默认controller
    protected $currentMethod = 'index'; //默认 method
    protected $params = []; //设置初始化parmas空数组
    
    public function __construct(){
        // print_r($this->getUrl());
        $url = $this->getUrl();
        // 在controllers这个文件夹中查看是否有数组第一项值存在
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
            // 如果存在，那就重置currentController
            $this->currentController = ucwords($url[0]);
            // unset 0 index
            unset($url[0]);
        }

        // 引入controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        // 实力化controller 类
        $this->currentController = new $this->currentController;
        
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
 }