<?php

class User extends Model
{
    private $pid;
    private $email;
    private $username;
    private $password;
    private $description;
    private $token;
    private $is_active;

    public function __construct(
        string $email       = null,
        string $username    = null,
        string $password    = null,
        string $description = null,
        string $token       = null
    ) {
        $this->email       = $email;
        $this->username    = $username;
        $this->password    = $password;
        $this->description = $description;
        $this->token       = $token;
    }

    public function create()
    {
        if (
            is_null($this->email)       ||
            is_null($this->username)    ||
            is_null($this->password)    ||
            is_null($this->token)
        ) {
            throw new Exception("Error Processing Request", 1);
            die();
        }
        $this->create_object([
            "pid"         => $this->get_pid(),
            "email"       => $this->email,
            "username"    => $this->username,
            "password"    => $this->password,
            "description" => $this->description,
            "token"       => $this->token
        ]);
    }

    public function get(array $field)
    {
        $user_data = $this->get_object($field);

        $this->pid         = $user_data['pid'];
        $this->email       = $user_data['email'];
        $this->username    = $user_data['username'];
        $this->password    = $user_data['password'];
        $this->description = $user_data['description'];
        $this->token       = $user_data['token'];
        $this->is_active   = $user_data['is_active'];
        
        return $user_data;
    }

    public function is_active(){
        return $this->is_active;
    }

    public function activate(){
        return $this->update_object(
            ['is_active' => true, 'token' => '-'],
            ['pid' => $this->pid]
        );
    }
}
