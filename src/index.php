<?php

session_start();

use Steampixel\Route;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/core/config.php';
require_once __DIR__ . '/core/routes.php';
require_once __DIR__ . '/core/Autoload.php';

new Autoload();

Route::run('/');
