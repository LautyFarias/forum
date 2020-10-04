<?php

use Steampixel\Route;

Route::add('/login', function () {
    Login::render('login.html');
});
Route::add('/login', function () {
    $login = new Login();
    $login->validate_login();
}, 'POST');

Route::add('/register', function () {
    Register::render('register.html');
});
Route::add('/register', function () {
    $register = new Register();
    $register->validate_register();
}, 'POST');
Route::add('/register/validate', function () {
    $register = new Register();
    $register->validate_account();
});

Route::add('/', function () {
    $main = new Main($_SESSION['User']);
});

Route::pathNotFound(function () {
    echo "Not found";
});
