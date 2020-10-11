<?php

trait Validation
{
    protected function validate_email(string $email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->validation['email'] = TRUE;
        }
        return $this->validation['email'] = FALSE;
    }

    protected function verify_repeat_email(string $email)
    {
        $user = new User();
        $rows = $user->select("email");

        foreach ($rows as $row => $field) {
            if ($email == $field['email']) {
                return $this->validation['email'] = FALSE;
            }
        }
        return $this->validation['email'] = TRUE;
    }

    protected function validate_password(string $password)
    {
        if (
            filter_var(
                $password,
                FILTER_VALIDATE_REGEXP,
                ["options" => ["regexp" => "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{8,}.*$/"]]
            )
        ) {
            return $this->validation['password'] = TRUE;
        }
        return $this->validation['password'] = FALSE;
    }

    protected function validate_repassword(string $password, string $repassword)
    {
        if (
            $this->validate_password($password) &&
            $this->validate_password($repassword)
        ) {
            if ($repassword === $password) {
                return $this->validation['password'] = TRUE;
            }
            return $this->validation['password'] = FALSE;
        }
        return $this->validation['password'] = FALSE;
    }

    protected function validate_username($username)
    {
        if (
            filter_var(
                $username,
                FILTER_VALIDATE_REGEXP,
                ["options" => ["regexp" => "/^(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/"]]
            )
        ) {
            return $this->validation['username'] = TRUE;
        }
        return $this->validation['username'] = FALSE;
    }

    protected function validate_description($description)
    {
        if (
            filter_var(
                $description,
                FILTER_VALIDATE_REGEXP,
                ["options" => ["regexp" => "/^(.|\s)*[a-zA-Z]+(.|\s)*$/"]]
            )
        ) {
            return $this->validation['description'] = TRUE;
        }
        return $this->validation['description'] = FALSE;
    }

    protected function validate_discussion($discussion)
    {
        if (
            filter_var(
                $discussion,
                FILTER_VALIDATE_REGEXP,
                ["options" => ["regexp" => "/^(.|\s)*[a-zA-Z]+(.|\s)*$/"]]
            )
        ) {
            return $this->validation['title or discussion'] = TRUE;
        }
        return $this->validation['title or discussion'] = FALSE;
    }

    protected function data_is_valid(): bool
    {
        if (in_array(FALSE, $this->validation, TRUE)) {
            return FALSE;
        }
        return TRUE;
    }

    protected function validate_data()
    {
        if (property_exists(self::class, $this->email)) {
            $this->validate_email($this->email);
        }
        if (property_exists(self::class, $this->repassword)) {
            $this->validate_repassword($this->password, $this->repassword);
        } else {
            if (property_exists(self::class, $this->password)) {
                $this->validate_password($this->password);
            }
        }
    }
}
