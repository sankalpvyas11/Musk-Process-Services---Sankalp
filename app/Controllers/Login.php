<?php

namespace App\Controllers;

class Login extends BaseController
{
    
    public function new()
    {
        return view("Login/new");
    }

    public function create()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $auth = new \App\Libraries\Authentication;

        if ($auth->login($email, $password)){


            $usermodel = new \App\Models\UserModel;
            $user = $usermodel->where(['email' => $email])->first();

            //change password for the 1st log
            if ($user->token_pwd == 0){
                return redirect()->to("/user/editpwd/".$user->user_id);
            }

            $redirect_url = session('redirect_url') ?? '/';

            unset($_SESSION['redirect_url']);
            
            return redirect()->to($redirect_url)
                             ->with('info', 'Login successful');

        }else{
            return redirect()->back()
                             ->withInput()
                             ->with('warning', 'Invalid login');
        }
    }    



    public function delete()
    {
        $auth = new \App\Libraries\Authentication;
        $auth->logout();
        return redirect()->to("/login/showLogoutMessage");
    }


    public function showLogoutMessage()
    {
        return redirect()->to("/")
                         ->with('info', 'Logout successful'); 
    }

}
?>