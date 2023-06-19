<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class EngineerFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = new \App\Libraries\Authentication;
        $role_id = $auth->getCurrentUser()->role_id;
        
        if ($role_id != 1){

            return redirect()->to('/inspection')
                             ->with('warning', 'Forbidden Access');
        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}