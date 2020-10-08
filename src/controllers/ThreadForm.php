<?php

class ThreadForm extends Controller
{
    protected static $view = 'thread_form.html';

    public function __construct()
    {
        $request = self::resolve_request(['POST']);
        
        $title      = $request['params']['title'];
        $discussion = $request['params']['discussion'];

        $thread = new Thread($title, $discussion);
        $thread->create();
    }
}