<?php

namespace App\Controllers;

use App\Entities\TypeEntity;


class Type extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new \App\Models\TypeModel;
    }

    public function index()
    {
        return view('/type/index');
    }
     

    public function show($id)
    {
        $type = $this->getTypeOr404($id);

        return view('type/show', ['type' => $type]);
    }



    public function new()
    {
        return view('/type/new');
    }


    public function edit($id)
    {
        $type = $this->getTypeOr404($id);

        return view('type/edit', [
            'type' => $type,
        ]);
    }


    public function update($id)
    {

        $result = $this->model->update($id, [
            'type_name' => $this->request->getPost('type_name'),
        ]);

        if ($result){
            return redirect()->to("/type/show/$id")
                             ->with('info', 'Type updated successfully');
        }else{
            return redirect()->back()
                             ->with('errors', $model->errors())
                             ->with('warning', 'Invalid data');
        }
    }



    public function delete($id)
    {
        $type = $this->getTypeOr404($id);

        if ($this->request->getMethod() === 'post'){
            $this->model->delete($id);

            return redirect()->to('/inspection')
                             ->with('info', 'Type delected');
        }

        return view('type/delete', [
            'type' => $type
        ]);
    }


    public function create()
    {
        $type = new TypeEntity($this->request->getPost());

        if ($this->model->insert($type)){
            
            return redirect()->to("/type/show/{$this->model->insertID}")
                             ->with('info', 'Type created successfully');

        } else{

            return redirect()->back()
                                ->with('errors', $this->model->errors())
                                ->with('warning', 'Invalid data')
                                ->withInput();
        }   

    }

    public function typeList()
    {
        $types = $this->model->find();

        return view('/type/typelist',
        ['types' => $types]);
    }
    

    private function getTypeOr404($id)
    {
        $type = $this->model->find($id);

        if ($type===null){
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Type with id $id not found");
        }
        return $type;
    }
    
}
