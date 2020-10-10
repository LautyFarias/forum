<?php

class ThreadRetrieve extends Controller
{
    protected static $view = 'thread-retrieve.php';
    
    private $context;
    private $thread_pid;

    public function __construct()
    {
        $url = parse_url($_SERVER['PHP_SELF'], PHP_URL_PATH);
        $url_components = explode('/', $url);
        foreach ($url_components as $url_component) {
            preg_match(
                "/\b[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}\b/",
                $url_component, $matches
            );
        }
        $this->thread_pid = $matches[0];
    }

    public function get_context(){
        $thread = new Thread();
        $thread->get(['pid'=>$this->thread_pid]);

        $_SESSION['thread'] = $thread;

        $this->context = [
            "thread" => [
                "title"      => $thread->title(),
                "discussion" => $thread->discussion(),
                "user"       => $thread->user()->username(),
                "likes"      => $thread->likes(),
                "dislikes"   => $thread->dislikes()
            ]
        ];
        
        return $this->context;
    }
}
