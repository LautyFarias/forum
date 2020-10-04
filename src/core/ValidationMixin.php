<?php

trait ValidationMixin
{
    protected function validate_email(string $email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->validation['email'] = TRUE;
        }
        return $this->validation['email'] = FALSE;
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
