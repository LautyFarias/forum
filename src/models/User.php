<?php

class User extends Model
{
    protected const TABLE = self::class;

    private $pid;
    private $email;
    private $username;
    private $password;
    private $description;
    private $token;

    public function __construct(
        string $email,
        string $username,
        string $password,
        $description = null,
        string $token
    ) {
        $this->pid         = self::get_pid();
        $this->email       = $email;
        $this->username    = $username;
        $this->password    = $password;
        $this->description = $description;
        $this->token       = $token;
        self::create_object([
            "pid"         => $this->pid,
            "email"       => $this->email,
            "username"    => $this->username,
            "password"    => $this->password,
            "description" => $this->description,
            "token"       => $this->token
        ]);
    }
}
