<?php
define('ROOT', dirname(__DIR__));
define('CORE_ROOT', ROOT . '/core');
define('VIEWS_ROOT', ROOT . '/views');
define('CONTROLLERS_ROOT', ROOT . '/controllers');
define('MODELS_ROOT', ROOT . '/models');

$dotenv = Dotenv\Dotenv::createImmutable(ROOT);
$dotenv->load();