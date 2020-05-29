<?php
// 重启新会话
session_start();

// 创建flash message
// 流程：1）在users这个controller中，当进行登录页跳转时候，调用flash('register-success', '恭喜你注册成功，可以直接登录！')；
//     2）在login页面中显示闪现信息，echo flash（'register-success'）;
function flash($name = '', $message = "", $class = "alert alert-success")
{
    // 判断$names是否为空
    if (!empty($name)) {
        //No message, create it
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        }
        //Message exists, display it
        elseif (!empty($_SESSION[$name]) && empty($message)) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}