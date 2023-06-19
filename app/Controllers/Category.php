<?php

namespace App\Controllers;

use App\Entities\CategoryEntity;


class Category extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new \App\Models\CategoryModel;
    }

    public function index()
    {
        return view('/category/index');
    }
     

    public function show($id)
    {
        $category = $this->getCategoryOr404($id);

        return view('category/show', ['category' => $category]);
    }



    public function new()
    {
        return view('/category/new');
    }


    public function edit($id)
    {
        $category = $this->getCategoryOr404($id);

        return view('category/edit', [
            'category' => $category,
        ]);
    }


    public function update($id)
    {

        $result = $this->model->update($id, [
            'category_name' => $this->request->getPost('category_name'),
        ]);

        if ($result){
            return redirect()->to("/category/show/$id")
                             ->with('info', 'Category updated successfully');
        }else{
            return redirect()->back()
                             ->with('errors', $model->errors())
                             ->with('warning', 'Invalid data');
        }
    }



    public function delete($id)
    {
        $category = $this->getTypeOr404($id);

        if ($this->request->getMethod() === 'post'){
            $this->model->delete($id);

            return redirect()->to('/inspection')
                             ->with('info', 'Category delected');
        }

        return view('category/delete', [
            'category' => $category
        ]);
    }


    public function create()
    {
        $type = new CategoryInspectionEntity($this->request->getPost());

        if ($this->model->insert($type)){
            
            return redirect()->to("/category/show/{$this->model->insertID}")
                             ->with('info', 'Category created successfully');

        } else{

            return redirect()->back()
                                ->with('errors', $this->model->errors())
                                ->with('warning', 'Invalid data')
                                ->withInput();
        }   

    }

    public function categoryList()
    {
        $categories = $this->model->find();

        return view('/category/categorylist',
                    ['categories' => $categories]);
    }
    

    private function getCategoryOr404($id)
    {
        $category = $this->model->find($id);

        if ($category===null){
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Category with id $id not found");
        }
        return $category;
    }
    
}
