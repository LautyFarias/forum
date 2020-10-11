<?php

class Thread extends Model
{
    private $id;
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
        $user->get(["id" => $thread_data[0]['user_id']]);

        $this->id         = $thread_data[0]['id'];
        $this->pid        = $thread_data[0]['pid'];
        $this->title      = $thread_data[0]['title'];
        $this->discussion = $thread_data[0]['discussion'];
        $this->user       = $user;
        $this->likes      = $thread_data[0]['likes'];
        $this->dislikes   = $thread_data[0]['dislikes'];
        $this->date       = $thread_data[0]['date'];
    }

    public function filter(array $field): array
    {
        $thread_data = $this->get_object($field);
        return $thread_data;
    }

    public function id()
    {
        return $this->id;
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

    public function user()
    {
        return $this->user;
    }

    public function date()
    {
        return $this->date;
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
