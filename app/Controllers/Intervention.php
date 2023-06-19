<?php

namespace App\Controllers;

use App\Entities\InterventionEntity;


class Intervention extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new \App\Models\InterventionModel;
    }

    public function index()
    {
        return view('/intervention/index');
    }
     

    public function show($id)
    {
        $intervention = $this->getInterventionOr404($id);

        return view('intervention/show', ['intervention' => $intervention]);
    }


    public function edit($id)
    {
        $intervention = $this->getInterventionOr404($id);

        return view('intervention/edit', ['intervention' => $intervention]);
    }


    public function update($id)
    {
        $iscompleted = $this->request->getPost('is_completed');
        if ($iscompleted == null){
            $iscompleted = 0;
        }

        $result = $this->model->update($id, [
            'comment' => $this->request->getPost('comment'),
            'is_completed' => $iscompleted,
            'action_taken' => $this->request->getPost('action_taken'),
            'attachment' => $this->request->getPost('attachment'),
        ]);

        if ($result){
            return redirect()->to("/intervention/show/$id")
                             ->with('info', 'Task updated successfully');
        }else{
            return redirect()->back()
                             ->with('errors', $model->errors())
                             ->with('warning', 'Invalid data');
        }
        

    }


    public function delete($id)
    {
        $intervention = $this->getInterventionOr404($id);

        if ($this->request->getMethod() === 'post'){
            $this->model->delete($id);

            return redirect()->to('/inspection')
                             ->with('info', 'Task delected');
        }

        return view('intervention/delete', [
            'intervention' => $intervention
        ]);
    }
    

    public function interventionList($user_id = null)
    {

        $auth = new \App\Libraries\Authentication;
        $userid = $auth->getCurrentUser()->user_id;
        $role_id = $auth->getCurrentUser()->role_id;

        $inspectionmodel = new \App\Models\InspectionModel;

        $interventionTab=null;

        if ($user_id != null){
            if ($user_id == $userid || $role_id == 0 || $role_id == 2){

                $inspections = $inspectionmodel->where(['user_id' => $user_id])->find();

                $interventionTab=[];

                $i=0;
                foreach ($inspections as $inspection){
                    $interventionTab[$i] = $this->model->where(['inspection_id' => $inspection->inspection_id])->find();
                    $i++;
                }

            }else{
                return view('/intervention/index');
            }
            
        }

        $interventions = $this->model->find();

        return view('/intervention/interventionlist', [
            'interventionTab' => $interventionTab,
            'interventions' => $interventions,
            'role_id' => $role_id
        ]);
    }
    

    private function getInterventionOr404($id)
    {
        $intervention = $this->model->find($id);

        if ($intervention===null){
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Intervention with id $id not found");
        }
        return $intervention;
    }
    
}
