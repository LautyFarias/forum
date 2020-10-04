<?php

class Register extends Controller
{
    use ValidationMixin;

    private $validation;

    private $email;
    private $username;
    private $password;
    private $repassword;
    private $description;
    private $token;

    public function __construct()
    {
        $request = self::resolve_request(['GET', 'POST']);

        if ($request['method'] == 'post') {
            $this->email       =       $request['params']['email'];
            $this->username    =    $request['params']['username'];
            $this->password    =    $request['params']['password'];
            $this->repassword  =  $request['params']['repassword'];
            $this->description = $request['params']['description'];
        } elseif ($request['method'] == 'get') {
            $this->token = $request['params']['get'];
        }
    }

    public function validate_register()
    {
        $this->validate_email($this->email);
        $this->validate_repassword($this->password, $this->repassword);

        if ($this->data_is_valid()) {
            $this->token = $this->get_token();
            $this->send_mail();
            $user = new User(
                $this->email,
                $this->username,
                $this->password,
                $this->description,
                $this->token
            );
            $user->create();
            self::json_response(true, 200);
        } else {
            self::json_response($this->validation, 400);
        }
    }

    private function get_token()
    {
        return substr(md5(openssl_random_pseudo_bytes(20)), -20);
    }

    private function send_mail()
    {
        $message = '
                Acceda a este <a href="' . $_SERVER['HTTP_HOST'] . '/register/validate?token=' . $this->token . '" style="color: #1a237e;">link</a> para activar su cuenta.
                Si no puede visualizar el link. Copie y pegue la siguiente dirección de enlace en su barra de direcciones: ' . $_SERVER['HTTP_HOST'] . '/register/validate?token=' . $this->token;
        $subject = "Complete Register!";
        $mail = new Mail($message, $subject, $this->email, $this->username);
        $mail->send();
    }

    public function validate_account()
    {
        $user = new User();
        $user->get(['token' => $this->token]);

        if (!$user->is_active()) {
            $user->activate();
            header('location: /login');
        }
    }
}
