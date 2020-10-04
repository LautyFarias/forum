<?php

class Login extends Controller
{
    use ValidationMixin;

    private $validation;

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
                self::json_response(true, 200);
            }
        }
    }
}
