<?php

namespace App\Controllers;

class Signup extends BaseController
{
    
    public function new()
    {
        return view("Signup/new");
    }


    public function create()
    {
        $user = new \App\Entities\UserEntity($this->request->getPost());
                
        $model = new \App\Models\UserModel;

        if ($model->insert($user)){

            //log in after register
            //$auth = new \App\Libraries\Authentication;
            //$auth->login($user->email, $user->password);
            
            return redirect()->to("/signup/success");
        }else{
            return redirect()->back()
                             ->with('errors', $model->errors())
                             ->with('warning', 'Invalid data')
                             ->withInput();
        }  
    }
    
    public function success()
    {
        return view("Signup/success");
    }

}
