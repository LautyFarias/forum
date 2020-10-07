<?php

class Profile extends Controller
{
    use SessionVerification;

    protected static $view = 'profile.php';

    private $context;

    public function __construct()
    {
        $this->verificate_session();
    }

    public function get_context()
    {
        $user = $_SESSION['user'];
        $this->context = [
            "user" => [
                "pid"         => $user->pid(),
                "username"    => $user->username(),
                "description" => $user->description()
            ]
        ];

        return $this->context;
    }
}
