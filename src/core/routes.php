<?php

use Steampixel\Route;

Route::add('/login', function () {
    Login::render('login.html');
});

Route::add('/register', function () {
    Register::render('register.html');
});
Route::add('/register', function () {
    Register::validate_register();
}, 'POST');

Route::add('/', function () {
    header('location: /login');
});

Route::pathNotFound(function () {
    echo "Not found";
});
