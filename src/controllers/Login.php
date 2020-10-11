<?php

class Login extends Controller
{
    use Validation;

    private $validation;

    protected static $view = 'login.php';

    private $email;
    private $password;

    public function __construct()
    {
        $request = self::resolve_request(['POST']);

        $this->email    = $request['params']['email'];
        $this->password = $request['params']['password'];
    }

    public function validate_login()
    {
        $this->validate_email($this->email);
        $this->validate_password($this->password);
        if ($this->data_is_valid()) {
            $user = new User();
            $user->get(
                ["email" => $this->email, "password" => $this->password]
            );
            if ($user->is_active()) {
                $_SESSION['user'] = $user;
                $this->json_response(true, 200);
            }
        } else {
            $this->json_response(false, 400);
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('location: /login');
    }
}
