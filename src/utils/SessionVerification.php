<?php

trait SessionVerification
{
    protected function verificate_session(){
        if (!$_SESSION['user']) {
            return header('location: /login');
        }
    }
}
