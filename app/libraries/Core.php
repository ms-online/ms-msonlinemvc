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
        $this->getUrl();
    }

    public function getUrl(){
        echo $_GET['url'];
    }
 }