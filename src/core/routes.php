<?php

use Steampixel\Route;

Route::add('/login', function () {
    Login::render();
});
Route::add('/login', function () {
    $login = new Login();
    $login->validate_login();
}, 'POST');
Route::add('/logout', function () {
    Login::logout();
});

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

Route::add(
    '/thread/\b[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}\b',
    function () {
        $thread_retrieve = new ThreadRetrieve();
        $thread_retrieve->render($thread_retrieve->get_context());
    }
);
Route::add(
    '/thread/\b[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}\b',
    function () {
        $thread_retrieve = new ThreadRetrieve();
        $thread_retrieve->set_response();
    },
    'POST'
);

Route::add('/thread/create', function () {
    new ThreadForm();
}, 'POST');

Route::add('/profile/me', function () {
    $profile = new Profile();
    Profile::render($profile->get_context());
});
Route::add(
    '/profile/\b[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}\b',
    function () {
        $profile = new Profile();
        $profile->render($profile->get_context());
    }
);

Route::add('/', function () {
    $main = new Main();
    $main->render($main->get_context());
});

Route::pathNotFound(function () {
    Controller::render();
});
