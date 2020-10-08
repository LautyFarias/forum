<?php

class Thread extends Model
{
    private $pid;
    private $title;
    private $discussion;
    private $user;
    private $likes;
    private $dislikes;

    public function __construct(
        string $title      = null,
        string $discussion = null
    ) {
        $this->title      = $title;
        $this->discussion = $discussion;
    }

    public function create()
    {
        if (
            is_null($this->title)      ||
            is_null($this->discussion)
        ) {
            throw new Exception("Error Processing Request", 1);
            die();
        }
        $this->create_object([
            "pid"        => $this->get_pid(),
            "title"      => $this->title,
            "discussion" => $this->discussion,
            "user_id"    => $_SESSION['user']->id(),
        ]);
    }

    public function get(array $field)
    {
        $thread_data = $this->get_object($field);

        $user = new User();

        $this->pid        = $thread_data['pid'];
        $this->title      = $thread_data['title'];
        $this->discussion = $thread_data['discussion'];
        $this->user       = $user->get(["id" => $thread_data['user_id']]);
        $this->likes      = $thread_data['likes'];
        $this->dislikes   = $thread_data['dislikes'];
        $this->date       = $thread_data['date'];
    }

    public function pid()
    {
        return $this->pid;
    }

    public function title()
    {
        return $this->title;
    }

    public function discussion()
    {
        return $this->discussion;
    }

    public function likes()
    {
        return $this->likes;
    }

    public function dislikes()
    {
        return $this->dislikes;
    }
}
