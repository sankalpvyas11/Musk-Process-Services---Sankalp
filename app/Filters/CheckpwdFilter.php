<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class CheckpwdFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = new \App\Libraries\Authentication;
        $id = $auth->getCurrentUser()->user_id;
        $role_id = $auth->getCurrentUser()->role_id;
        $token = $auth->getCurrentUser()->token_pwd;

        //if you're not an admin
        if ($role_id != 0){

            //Check if the password has been changed for the first log
            if ($token == 0){
                return redirect()->to('/user/editpwd/'.$id)
                                ->with('warning', 'Forbidden Access');
            }

        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}