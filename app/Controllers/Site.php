<?php

namespace App\Controllers;

use App\Entities\SiteEntity;


class Site extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new \App\Models\SiteModel;
    }

    public function index()
    {
        return view('/site/index');
    }
     

    public function show($id)
    {
        $site = $this->getSiteOr404($id);

        return view('site/show', ['site' => $site]);
    }



    public function new()
    {
        return view('/site/new');
    }



    public function edit($id)
    {
        $site = $this->getSiteOr404($id);

        return view('site/edit', [
            'site' => $site,
        ]);
    }


    public function update($id)
    {

        $result = $this->model->update($id, [
            'site_name' => $this->request->getPost('site_name'),
        ]);

        if ($result){
            return redirect()->to("/site/show/$id")
                             ->with('info', 'Site updated successfully');
        }else{
            return redirect()->back()
                             ->with('errors', $model->errors())
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


    public function create()
    {
        $site = new SiteEntity($this->request->getPost());

        if ($this->model->insert($site)){
            
            return redirect()->to("/site/show/{$this->model->insertID}")
                             ->with('info', 'Site created successfully');

        } else{

            return redirect()->back()
                                ->with('errors', $this->model->errors())
                                ->with('warning', 'Invalid data')
                                ->withInput();
        }   

    }

    public function siteList()
    {
        $sites = $this->model->find();

        return view('/site/sitelist',
            ['sites' => $sites]);
    }

    

    private function getSiteOr404($id)
    {
        $site = $this->model->find($id);

        if ($site===null){
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Site with id $id not found");
        }
        return $site;
    }
    
}
