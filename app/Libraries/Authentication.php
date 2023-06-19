<?php

namespace App\Libraries;

class Authentication
{
    public function login($email, $password)
    {
        $model = new \App\Models\UserModel;

        $user = $model->where('email', $email)->first();

        if ($user === null) {
            return false;
        }

        if (!password_verify($password, $user->password)) {
            return false;
        }

        $session = session();
        $session->regenerate();
        $session->set('user_id', $user->user_id);

        return true;
    }


    public function logout()
    {
        session()->destroy();
    }


    public function getCurrentUser()
    {
        if (!$this->isLoggedIn()) {
            return null;
        }

        $model = new \App\Models\UserModel;

        return $model->find(session()->get('user_id'));
    }


    public function isLoggedIn()
    {
        return session()->has('user_id');
    }
}
