<?php
// 加载config
require_once 'config/config.php';
// 加载helpers
require_once 'helpers/url_helper.php';

// 加载libraries
// require_once 'libraries/Controller.php';
// require_once 'libraries/Core.php';
// require_once 'libraries/Database.php';


// 自动加载libraries
spl_autoload_register(function ($className) {
    require_once 'libraries/' . $className . '.php';
});