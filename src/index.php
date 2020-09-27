<?php

use Steampixel\Route;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/core/config.php';
require_once __DIR__ . '/core/routes.php';

spl_autoload_register(function ($class_name) {
    if (file_exists(CONTROLLERS_ROOT . '/' . $class_name . '.php')) {
        require_once CONTROLLERS_ROOT . '/' . $class_name . '.php';
    } elseif (file_exists(CORE_ROOT . '/' . $class_name . '.php')) {
        require_once CORE_ROOT . '/' . $class_name . '.php';
    }
});

Route::run('/');
