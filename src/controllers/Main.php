<?php

class Main extends Controller{
    use SessionVerification;

    protected static $view = 'main.html';

    public function __construct()
    {
        $this->verificate_session();
        self::render($this->view);
    }

}