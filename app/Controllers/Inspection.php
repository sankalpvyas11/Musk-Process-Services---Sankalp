<?php

namespace App\Controllers;

use App\Entities\InspectionEntity;
use CodeIgniter\Files\File;

class Inspection extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new \App\Models\InspectionModel;
    }


    public function index()
    {
        $auth = new \App\Libraries\Authentication;
        $user_id = $auth->getCurrentUser()->user_id;

        $inspections = $this->model->where(['user_id' => $user_id])->findAll();

        $interventionmodel = new \App\Models\InterventionModel;
        $nb_interventions = 0;
        foreach ($inspections as $inspection){
            $interventions = $interventionmodel->where(['inspection_id' => $inspection->inspection_id])->findAll();
            foreach ($interventions as $intervention){
                $nb_interventions += $intervention->intervention_nb;
            }
                
        }

        return view('/inspection/index', ['nb_interventions' => $nb_interventions]);  
    }
     

    public function show($id)
    {
        $inspection = $this->getInspectionOr404($id);
        return view('inspection/show', ['inspection' => $inspection]);
    }


    public function edit($id)
    {
        $inspection = $this->getInspectionOr404($id);

        $sitemodel = new \App\Models\SiteModel;
        $siteCurr = $sitemodel->where(['site_id' => $inspection->site_id])->first();
        $sites = $sitemodel->find();

        $typemodel = new \App\Models\TypeModel;
        $typeCurr = $typemodel->where(['type_id' => $inspection->type_id])->first();
        $types = $typemodel->find();

        $inspectiontypemodel = new \App\Models\InspectionTypeModel;
        $inspectiontypes = $inspectiontypemodel->find();

        $categorymodel = new \App\Models\CategoryModel;
        $categories = $categorymodel->find();

        return view('inspection/edit', [
            'inspection' => $inspection,
            'siteCurr' => $siteCurr,
            'sites' => $sites,
            'typeCurr' => $typeCurr,
            'types' => $types,
            'inspection_types' => $inspectiontypes,
            'categories' => $categories,
        ]);
    }



    public function update($id)
    {

        $result = $this->model->update($id, [
            'site_id' => $this->request->getPost('site_id'),
            'work_area' => $this->request->getPost('work_area'),
            'job_description' => $this->request->getPost('job_description'),
            'inspection_supervisor' => $this->request->getPost('inspection_supervisor'),
            'inspection_inspector' => $this->request->getPost('inspection_inspector'),
            'date' => $this->request->getPost('date'),
            'type_id' => $this->request->getPost('type_id'),
        ]);

        if ($result){
            return redirect()->to("/inspection/show/$id")
                             ->with('info', 'Task updated successfully');
        }else{
            return redirect()->back()
                             ->with('errors', $model->errors())
                             ->with('warning', 'Invalid data');
        }
    }



    public function delete($id)
    {
        $inspection = $this->getInspectionOr404($id);

        //Are you sure?
        if ($this->request->getMethod() === 'post'){

            //First : Delete interventions related to the inspection
            $interventionmodel = new \App\Models\InterventionModel;
            $interventions = $interventionmodel->where(['inspection_id' => $inspection->inspection_id])->findAll();

            foreach ($interventions as $intervention){
                $interventionmodel->delete($intervention->intervention_id);
            }

            //Then we can delete the inspection
            $this->model->delete($id);

            return redirect()->to('/inspection')
                             ->with('info', 'Task delected');
        }

        return view('inspection/delete', [
            'inspection' => $inspection
        ]);
    }





    public function newInspection()
    {
        $sitemodel = new \App\Models\SiteModel;
        $sites = $sitemodel->find();

        $typemodel = new \App\Models\TypeModel;
        $types = $typemodel->find();

        $inspectiontypemodel = new \App\Models\InspectionTypeModel;
        $inspectiontypes = $inspectiontypemodel->find();

        $categorymodel = new \App\Models\CategoryModel;
        $categories = $categorymodel->find();

        //save user_id
        $auth = new \App\Libraries\Authentication;
        $user_id = $auth->getCurrentUser()->user_id;

        return view('/inspection/newinspection', [
            'sites' => $sites,
            'types' => $types,
            'inspection_types' => $inspectiontypes,
            'categories' => $categories,
            'user_id' => $user_id,
        ]);
    }



    public function create()
    {
        $inspection = new InspectionEntity($this->request->getPost());
        
        $interventionmodel = new \App\Models\InterventionModel;

        $totalinterv = 0;

        //check user_id
        $auth = new \App\Libraries\Authentication;
        $user_id = $auth->getCurrentUser()->user_id;


        //check supervisor name
        $supervisor = $this->request->getPost('inspection_supervisor');

        $usermodel = new \App\Models\UserModel;
        //check if the given name exists in the database among all the managers
        $checkSuperv = $usermodel->where(['role_id'=> 2, 'name'=>$supervisor])->first();

        //check if the user who complete an inspection is the logged-in user (for the "completed by" field)
        if ($user_id == $inspection->user_id){

            //if the given supervisor exists
            if ($checkSuperv != null){

                $inspection->manager_id = $checkSuperv->user_id;

                if ($this->model->insert($inspection)){

                    //for each of the interventions
                    for ($i=0; $i<=24; $i++){
                        
                        $intervention_nb = $this->request->getPost('intervention_nb'.$i);

                        if ($intervention_nb > 0){

                            $totalinterv += 1;

                            //check for each of interventions if they are completed or not
                            $iscompleted = $this->request->getPost('is_completed'.$i);
                            if ($iscompleted == null){
                                $iscompleted = 0;
                            }



                            //UPLOAD FILES

                    
                            $img = $this->request->getFile('attachment'.$i);

                            if ($img->getSize() != 0){

                                //check size (>2MB)
                                $size = $img->getSizeByUnit('mb');
                                if ($size > 2){
                                    return redirect()->back()
                                                     ->with('warning', 'File too large (max 2MB)');
                                }

                                //check type (PNG/JPEG)
                                $type = $img->getMimeType();
                                if (!array($type, ['image/png', 'image/jpeg'])){
                                    return redirect()->back()
                                                     ->with('warning', 'Invalid file format (PNG or JPEG only)');
                                }


                                //change file name with a random string
                                $fileName = random_string('alnum', 16);
                                $ext = $img->getClientExtension();

                                //move the uploaded file to the public folder
                                $img->move(ROOTPATH.'public/assets/uploads/', $fileName.'.'.$ext);





                                //insertion of interventions in the database
                                $interventionmodel->insert([
                                    'intervention_nb' => $this->request->getPost('intervention_nb'.$i),
                                    'comment' => $this->request->getPost('comment'.$i),
                                    'is_completed' => $iscompleted,
                                    'action_taken' => $this->request->getPost('action_taken'.$i),
                                    'attachment' => $fileName.'.'.$ext,
                                    'inspection_id' => $this->model->insertID,
                                    'inspection_type_id' => $this->request->getPost('inspection_type_id'.$i)
                                ]);

                            }else{

                                //insertion of interventions in the database
                                $interventionmodel->insert([
                                    'intervention_nb' => $this->request->getPost('intervention_nb'.$i),
                                    'comment' => $this->request->getPost('comment'.$i),
                                    'is_completed' => $iscompleted,
                                    'action_taken' => $this->request->getPost('action_taken'.$i),
                                    'inspection_id' => $this->model->insertID,
                                    'inspection_type_id' => $this->request->getPost('inspection_type_id'.$i)
                                ]);
                            }



                        }

                        //if an inspection contain 0 intervention -> invalid !
                        if ($totalinterv == 0){
                            return redirect()->back()
                                        ->with('warning', '0 intervention !');
                        }

                    }

                    return redirect()->to("/inspection/show/{$this->model->insertID}")
                                ->with('info', 'Inscription created successfully');
                } else{

                    return redirect()->back()
                                        ->with('errors', $this->model->errors())
                                        ->with('warning', 'Invalid data')
                                        ->withInput();
                } 

            }else{
                return redirect()->back()
                                        ->with('warning', 'This supervisor doesn\'t exist')
                                        ->withInput();
            }  

                
        }else{
            return redirect()->back()
                                    ->with('warning', 'Invalid user')
                                    ->withInput();
        }  

    }



    public function inspectionList()
    {
        $sitemodel = new \App\Models\SiteModel;
        $interventionmodel = new \App\Models\InterventionModel;
        $usermodel = new \App\Models\UserModel;

        $auth = new \App\Libraries\Authentication;
        $role_id = $auth->getCurrentUser()->role_id;

        if ($role_id == 1){
            $user_id = $auth->getCurrentUser()->user_id;
        }

        //FILTER
        //if the filter has been used
        if ($this->request->getMethod() == 'post'){

            $site_id = $this->request->getPost('site_id');

            //an engineer can only see HIS owns inspections
            if ($role_id == 1){
                $user_id = $auth->getCurrentUser()->user_id;
            }else{
                $user_id = $this->request->getPost('user_id');
            }

            $month = $this->request->getPost('month');
            $year = $this->request->getPost('year');

            //if manager
            if ($role_id == 2){

                $manager_id = $auth->getCurrentUser()->user_id;

                if ($site_id != 'All' && $month != 'All' && $year != 'All' && $user_id != 'All'){
                    $array = ['site_id' => $site_id, 'MONTH(date)' => $month, 'YEAR(date)' => $year, 'user_id' => $user_id, 'manager_id' => $manager_id];
    
                }else if ($site_id != 'All' && $month != 'All' && $year != 'All' && $user_id == 'All'){
                    $array = ['site_id' => $site_id, 'MONTH(date)' => $month, 'YEAR(date)' => $year, 'manager_id' => $manager_id];
    
                }else if ($site_id != 'All' && $month != 'All' && $year == 'All' && $user_id != 'All'){
                    $array = ['site_id' => $site_id, 'MONTH(date)' => $month, 'user_id' => $user_id, 'manager_id' => $manager_id];
    
                }else if ($site_id != 'All' && $month == 'All' && $year != 'All' && $user_id != 'All'){
                    $array = ['site_id' => $site_id, 'YEAR(date)' => $year, 'user_id' => $user_id, 'manager_id' => $manager_id];
    
                }else if ($site_id == 'All' && $month != 'All' && $year != 'All' && $user_id != 'All'){
                    $array = ['MONTH(date)' => $month, 'YEAR(date)' => $year, 'user_id' => $user_id, 'manager_id' => $manager_id];
    
                }else if ($site_id != 'All' && $month != 'All' && $year == 'All' && $user_id == 'All'){
                    $array = ['site_id' => $site_id, 'MONTH(date)' => $month, 'manager_id' => $manager_id];
    
                }else if ($site_id != 'All' && $month == 'All' && $year != 'All' && $user_id == 'All'){
                    $array = ['site_id' => $site_id, 'YEAR(date)' => $year, 'manager_id' => $manager_id];
    
                }else if ($site_id != 'All' && $month == 'All' && $year == 'All' && $user_id != 'All'){
                    $array = ['site_id' => $site_id, 'user_id' => $user_id, 'manager_id' => $manager_id];
    
                }else if ($site_id == 'All' && $month != 'All' && $year != 'All' && $user_id == 'All'){
                    $array = ['MONTH(date)' => $month, 'YEAR(date)' => $year, 'manager_id' => $manager_id];
    
                }else if ($site_id == 'All' && $month != 'All' && $year == 'All' && $user_id != 'All'){
                    $array = ['MONTH(date)' => $month, 'user_id' => $user_id, 'manager_id' => $manager_id];
    
                }else if ($site_id == 'All' && $month == 'All' && $year != 'All' && $user_id != 'All'){
                    $array = ['YEAR(date)' => $year, 'user_id' => $user_id, 'manager_id' => $manager_id];
    
                }else if ($site_id == 'All' && $month == 'All' && $year == 'All' && $user_id != 'All'){
                    $array = ['user_id' => $user_id, 'manager_id' => $manager_id];
    
                }else if ($site_id == 'All' && $month == 'All' && $year != 'All' && $user_id == 'All'){
                    $array = ['YEAR(date)' => $year, 'manager_id' => $manager_id];
    
                }else if ($site_id == 'All' && $month != 'All' && $year == 'All' && $user_id == 'All'){
                    $array = ['MONTH(date)' => $month, 'manager_id' => $manager_id];
    
                }else if ($site_id != 'All' && $month == 'All' && $year == 'All' && $user_id == 'All'){
                    $array = ['site_id' => $site_id, 'manager_id' => $manager_id];
    
                }

            }else{

                if ($site_id != 'All' && $month != 'All' && $year != 'All' && $user_id != 'All'){
                    $array = ['site_id' => $site_id, 'MONTH(date)' => $month, 'YEAR(date)' => $year, 'user_id' => $user_id];
    
                }else if ($site_id != 'All' && $month != 'All' && $year != 'All' && $user_id == 'All'){
                    $array = ['site_id' => $site_id, 'MONTH(date)' => $month, 'YEAR(date)' => $year];
    
                }else if ($site_id != 'All' && $month != 'All' && $year == 'All' && $user_id != 'All'){
                    $array = ['site_id' => $site_id, 'MONTH(date)' => $month, 'user_id' => $user_id];
    
                }else if ($site_id != 'All' && $month == 'All' && $year != 'All' && $user_id != 'All'){
                    $array = ['site_id' => $site_id, 'YEAR(date)' => $year, 'user_id' => $user_id];
    
                }else if ($site_id == 'All' && $month != 'All' && $year != 'All' && $user_id != 'All'){
                    $array = ['MONTH(date)' => $month, 'YEAR(date)' => $year, 'user_id' => $user_id];
    
                }else if ($site_id != 'All' && $month != 'All' && $year == 'All' && $user_id == 'All'){
                    $array = ['site_id' => $site_id, 'MONTH(date)' => $month];
    
                }else if ($site_id != 'All' && $month == 'All' && $year != 'All' && $user_id == 'All'){
                    $array = ['site_id' => $site_id, 'YEAR(date)' => $year];
    
                }else if ($site_id != 'All' && $month == 'All' && $year == 'All' && $user_id != 'All'){
                    $array = ['site_id' => $site_id, 'user_id' => $user_id];
    
                }else if ($site_id == 'All' && $month != 'All' && $year != 'All' && $user_id == 'All'){
                    $array = ['MONTH(date)' => $month, 'YEAR(date)' => $year];
    
                }else if ($site_id == 'All' && $month != 'All' && $year == 'All' && $user_id != 'All'){
                    $array = ['MONTH(date)' => $month, 'user_id' => $user_id];
    
                }else if ($site_id == 'All' && $month == 'All' && $year != 'All' && $user_id != 'All'){
                    $array = ['YEAR(date)' => $year, 'user_id' => $user_id];
    
                }else if ($site_id == 'All' && $month == 'All' && $year == 'All' && $user_id != 'All'){
                    $array = ['user_id' => $user_id];
    
                }else if ($site_id == 'All' && $month == 'All' && $year != 'All' && $user_id == 'All'){
                    $array = ['YEAR(date)' => $year];
    
                }else if ($site_id == 'All' && $month != 'All' && $year == 'All' && $user_id == 'All'){
                    $array = ['MONTH(date)' => $month];
    
                }else if ($site_id != 'All' && $month == 'All' && $year == 'All' && $user_id == 'All'){
                    $array = ['site_id' => $site_id];
    
                }


            }



            if ($role_id == 1 && $site_id == 'All' && $month == 'All' && $year == 'All'){
                $inspections = $this->model->where(['user_id' => $user_id])->findAll();
            }

            //if all the fields = 'All' then we display all of the inspections
            if ($site_id == 'All' && $month == 'All' && $year == 'All' && $user_id == 'All'){
                if ($role_id == 2){
                    $inspections = $this->model->where(['manager_id' => $manager_id])->findAll();
                }else{
                    $inspections = $this->model->find();
                }
            }else{
                //else filter
                $inspections = $this->model->where($array)->find();
            }


        }else{
            //an engineer can only see HIS owns inspections
            if ($role_id == 1){
                $inspections = $this->model->where(['user_id' => $user_id])->findAll();
            }else if ($role_id == 2){
                $manager_id = $auth->getCurrentUser()->user_id;
                $inspections = $this->model->where(['manager_id' => $manager_id])->findAll();
            }else if ($role_id == 0){
                $inspections = $this->model->findAll();
            }
        }

        $sites = $sitemodel->find();
        $users = $usermodel->find();
        $interventions = $interventionmodel->find();

        return view('/inspection/inspectionlist', [
            'inspections' => $inspections,
            'interventions' => $interventions,
            'sites' => $sites,
            'users' => $users,
            'role_id' => $role_id
        ]);
    }




    //PDF (Library Dompdf)

    public function report($id){

        //inspection
        $inspection = $this->model->where(['inspection_id' => $id])->first();

        //Inspection site
        $sitemodel = new \App\Models\SiteModel;
        $site = $sitemodel->where(['site_id' => $inspection->site_id])->first();
        //Inspection supervisor
        $usermodel = new \App\Models\UserModel;
        $user = $usermodel->where(['user_id' => $inspection->user_id])->first();
        //Inspection Type
        $typemodel = new \App\Models\TypeModel;
        $type = $typemodel->where(['type_id' => $inspection->type_id])->first();

        //All of the interventions of an inspection
        $interventionmodel = new \App\Models\InterventionModel;
        $interventions = $interventionmodel->where(['inspection_id' => $id])->find();

        //Types(A.Working Standards, B.Quality, ...)
        $inspectiontypemodel = new \App\Models\InspectionTypeModel;
        $inspectiontypes = $inspectiontypemodel->find();
        //Categories(1.Work At Height, B. Lifting Operations, ...)
        $categorymodel = new \App\Models\CategoryModel;
        $categories = $categorymodel->find();


        //GENERATE PDF
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml(view('/inspection/report', [
            'inspection' => $inspection,
            'interventions' => $interventions,
            'site' => $site,
            'user' => $user,
            'type' => $type,
            'inspectiontypes' => $inspectiontypes,
            'categories' => $categories,
        ]));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("", array("Attachment" => false));
    }


    

    private function getInspectionOr404($id)
    {
        $inspection = $this->model->find($id);

        if ($inspection===null){
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Inspection with id $id not found");
        }
        return $inspection;
    }
    
}