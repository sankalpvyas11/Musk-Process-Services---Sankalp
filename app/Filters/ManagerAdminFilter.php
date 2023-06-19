<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ManagerAdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = new \App\Libraries\Authentication;
        $role_id = $auth->getCurrentUser()->role_id;
        
        if ($role_id != 0 && $role_id != 2){

            return redirect()->to('/inspection')
                             ->with('warning', 'Forbidden Access');
        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}