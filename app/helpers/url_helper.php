<?php

// 页面重定向
function redirect($page)
{
    header('location:' . URLROOT . '/' . $page);
}