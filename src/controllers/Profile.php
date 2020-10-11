<?php

class Profile extends Controller
{
    use SessionVerification;

    protected static $view = 'profile.php';

    private $context;
    private $user_pid;

    public function __construct()
    {
        $this->verificate_session();

        $url = parse_url($_SERVER['PHP_SELF'], PHP_URL_PATH);
        $url_components = explode('/', $url);
        foreach ($url_components as $url_component) {
            preg_match(
                "/\b[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}\b/",
                $url_component, $matches
            );
        }
        $this->user_pid = $matches[0];
    }

    public function get_context()
    {
        $user = $_SESSION['user'];

        if ($this->user_pid) {
            $user = new User();
            $user->get(['pid' => $this->user_pid]);
        }

        $thread = new Thread();
        $threads = $thread->filter(["user_id" => $user->id()]);

        $this->context = [
            "user" => [
                "pid"         => $user->pid(),
                "username"    => $user->username(),
                "description" => $user->description(),
                "email"       => $user->email(),
            ],
            "threads" => $threads
        ];

        return $this->context;
    }
}
