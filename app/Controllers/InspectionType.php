<?php

namespace App\Controllers;

use App\Entities\InspectionTypeEntity;


class InspectionType extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new \App\Models\InspectionTypeModel;
    }


    public function index()
    {
        return view('/inspectiontype/index');
    }
     

    public function show($id)
    {
        $inspectiontype = $this->getInspectionTypeOr404($id);

        return view('inspectiontype/show', ['inspection_type' => $inspectiontype]);
    }



    public function new()
    {
        $categorymodel = new \App\Models\CategoryModel;
        $categories = $categorymodel->find();

        return view('/inspectiontype/new',[
            'categories' => $categories
        ]);
    }


    public function edit($id)
    {
        $inspectiontype = $this->getInspectionTypeOr404($id);
        $categorymodel = new \App\Models\CategoryModel;
        $categories = $categorymodel->find();

        return view('inspectiontype/edit', [
            'inspectiontype' => $inspectiontype,
            'categories' => $categories
        ]);
    }


    public function update($id)
    {

        $result = $this->model->update($id, [
            'inspection_type_name' => $this->request->getPost('inspection_type_name'),
        ]);

        if ($result){
            return redirect()->to("/inspectiontype/show/$id")
                             ->with('info', 'Inspection Type updated successfully');
        }else{
            return redirect()->back()
                             ->with('errors', $model->errors())
                             ->with('warning', 'Invalid data');
        }
    }



    public function delete($id)
    {
        $inspectiontype = $this->getUserOr404($id);

        if ($this->request->getMethod() === 'post'){
            $this->model->delete($id);

            return redirect()->to('/inspection')
                             ->with('info', 'Inspection Type delected');
        }

        return view('inspectiontype/delete', [
            'inspectiontype' => $inspectiontype
        ]);
    }


    public function create()
    {
        $inspectiontype = new InspectionTypeEntity($this->request->getPost());

        if ($this->model->insert($inspectiontype)){
            
            return redirect()->to("/inspectiontype/show/{$this->model->insertID}")
                             ->with('info', 'Inspection Type created successfully');

        } else{

            return redirect()->back()
                                ->with('errors', $this->model->errors())
                                ->with('warning', 'Invalid data')
                                ->withInput();
        }   

    }

    public function inspectiontypeList()
    {
        $inspectiontypes = $this->model->find();

        return view('/inspectiontype/inspectiontypelist',
                    ['inspectiontypes' => $inspectiontypes]);
    }
    

    private function getInspectionTypeOr404($id)
    {
        $inspectiontype = $this->model->find($id);

        if ($inspectiontype===null){
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Inspection Type with id $id not found");
        }
        return $inspectiontype;
    }
    
}
