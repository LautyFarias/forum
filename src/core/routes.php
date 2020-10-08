<?php

use Steampixel\Route;

Route::add('/login', function () {
    Login::render();
});
Route::add('/login', function () {
    $login = new Login();
    $login->validate_login();
}, 'POST');

Route::add('/register', function () {
    Register::render();
});
Route::add('/register', function () {
    $register = new Register();
    $register->validate_register();
}, 'POST');
Route::add('/register/validate', function () {
    $register = new Register();
    $register->validate_account();
});

Route::add('/thread/create', function () {
    ThreadForm::render();
});
Route::add('/thread/create', function () {
    $thread_form = new ThreadForm();
}, 'POST');

Route::add('/profile/me', function () {
    $profile = new Profile();
    Profile::render($profile->get_context());
});

Route::add('/', function () {
    $main = new Main();
});

Route::pathNotFound(function () {
    Controller::render();
});
