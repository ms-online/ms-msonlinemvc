<?php

/* 基础Controller
 * 加载models 和 views
 */

class Controller
{
    //加载models
    public function model($model)
    {
        // 引入model 文件
        require_once '../app/models/' . $model . '.php';
        //  实例化model
        return new $model();
    }

    // 加载views
    public function view($view, $data = [])
    {
        // 验证有无view 文件
        if (file_exists('../app/views/' . $view . '.php')) {
            // 引入view文件
            require_once '../app/views/' . $view . '.php';
        } else {
            // view文件不存在
            die('抱歉，不存在这个View');
        }
    }
}
