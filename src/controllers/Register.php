<?php

class Register extends Controller
{
    public static function validate_register()
    {
        $request = self::resolveRequest(['POST']);
        $errors = [];

        $email      = $request['params']['email'];
        $username   = $request['params']['username'];
        $password   = $request['params']['password'];
        $repassword = $request['params']['repassword'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email_error'] = true;
        }
        if (
            !filter_var(
                $password,
                FILTER_VALIDATE_REGEXP,
                ["options" => ["regexp" => "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{8,}.*$/"]]
            )
        ) {
            $errors['password_error'] = true;
        }
        if ($password !== $repassword) {
            $err['repassword_error'] = true;
        }
        if (!empty($errors)) {
            self::json_response($errors, 400);
        } else {
            $message = '
                Acceda a este <a href="' . $_SERVER['HTTP_HOST'] . '" style="color: #1a237e;">link</a> para activar su cuenta';
            $subject = "Complete Register!";
            $mail = new Mail($message, $subject, $email, $username);
            $response = $mail->send();
            self::json_response(["result" => $response]);
        }
    }
}
