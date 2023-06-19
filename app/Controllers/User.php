<?php

namespace App\Controllers;

use App\Entities\UserEntity;


class User extends BaseController
{
    private $model;



    public function __construct()
    {
        $this->model = new \App\Models\UserModel;
    }


    public function index()
    {
        $usermodel = new \App\Models\UserModel;

        $users = $usermodel->find();

        return view('/user/index', [
            'users' => $users
        ]);
    }


    public function show($id)
    {
        $user = $this->getUseror404($id);
        return view('/User/show', [
            'user' => $user
        ]);
    }

    
    //Edit name, email address, role (for admin only).
    public function edit($id)
    {
        $user = $this->getUserOr404($id);

        $auth = new \App\Libraries\Authentication;
        $role_id = $auth->getCurrentUser()->role_id;

        return view('user/edit', [
            'user' => $user,
            'role_id' => $role_id
        ]);
    }


    //send changes to the database
    public function update($id)
    {

        $result = $this->model->update($id, [
            'name' => $this->request->getPost('name'),
            'role_id' => $this->request->getPost('role_id'),
            'email' => $this->request->getPost('email'),
        ]);

        if ($result){
            return redirect()->to("/user/show/$id")
                             ->with('info', 'User updated successfully');
        }else{
            return redirect()->back()
                             ->with('errors', $this->model->errors())
                             ->with('warning', 'Invalid data');
        }
    }


    //Change password
    public function editpwd($id)
    {
        $user = $this->getUserOr404($id);

        //change token to 1 if the pwd is changed for the 1st time
        if ($user->token == 0){
            $this->model->update($id, ['token_pwd' => 1]);
        }


        return view('user/editpwd', [
            'user' => $user        
        ]);
    }


    public function updatepwd($id)
    {

        $result = $this->model->update($id, [
            'password' => $this->request->getPost('password'),
            'password_confirmation' => $this->request->getPost('password_confirmation'),
        ]);
        

        if ($result){
            return redirect()->to("/user/show/$id")
                             ->with('info', 'Password updated successfully');
        }else{
            return redirect()->back()
                             ->with('errors', $this->model->errors())
                             ->with('warning', 'Invalid data');
        }
    }



    public function delete($id)
    {
        $user = $this->getUserOr404($id);

        if ($this->request->getMethod() === 'post'){
            $this->model->delete($id);

            return redirect()->to('/inspection')
                             ->with('info', 'User delected');
        }

        return view('user/delete', [
            'user' => $user
        ]);
    }
    


    private function getUserOr404($id)
    {
        $user = $this->model->find($id);

        if ($user===null){
            throw new \CodeIgniter\Exceptions\PageNotFoundException("User with id $id not found");
        }
        return $user;
    }

    
}
