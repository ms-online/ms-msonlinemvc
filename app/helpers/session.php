<?php

// 重启新对话
session_start();

// 创建flash message
// 流程：1）在users这个controller中，当登录进行跳转时，调用flash（'register-success', '恭喜你注册成功，可以直接登录！'） 2）在login页面显示闪存信息， echo flash（'register-success'）;
function flash($name = '', $message = '', $class = 'alert alert-success')
{
    // name不为空
    if (!empty($name)) {
        // $message不为空且$session[$name]为空，则赋值
        if (!empty($message) && empty($_SESSION[$name])) {
            // 重置
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }

            // 重新赋值
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } elseif
        // $message为空且session[$name]不为空，则显示
        (!empty($_SESSION[$name]) && empty($message)) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class ="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}
function isLoggdeIn()
{
    if (isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}