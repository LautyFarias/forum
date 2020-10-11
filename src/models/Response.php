<?php

class Response extends Model
{
    private $pid;
    private $content;
    private $user;
    private $thread;

    public function __construct(
        string $content = null
    ) {
        $this->content = $content;
    }

    public function create()
    {
        if (
            is_null($this->content)
        ) {
            throw new Exception("Error Processing Request", 1);
            die();
        }
        $this->create_object([
            "pid"       => $this->get_pid(),
            "content"   => $this->content,
            "user_id"   => $_SESSION['user']->id(),
            "thread_id" => $_SESSION['thread']->id(),
        ]);
    }

    public function get(array $field)
    {
        $response_data = $this->get_object($field);

        $user = new User();
        $user->get(["id" => $response_data[0]['user_id']]);

        $thread = new Thread();
        $thread->get(["id" => $response_data[0]['thread_id']]);

        $this->pid     = $response_data[0]['pid'];
        $this->content = $response_data[0]['content'];
        $this->user    = $user;
        $this->thread  = $thread;
        $this->date    = $response_data[0]['date'];
    }

    public function filter(array $field): array
    {
        $response_data = $this->get_object($field);
        return $response_data;
    }

    public function pid()
    {
        return $this->pid;
    }

    public function content()
    {
        return $this->content;
    }

    public function user()
    {
        return $this->user;
    }

    public function thread()
    {
        return $this->thread;
    }

    public function date()
    {
        return $this->date;
    }
}
