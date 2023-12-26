<?php 
class Projects extends Controller{
    private $projectModel;
    public function __construct()
    {
      if (!isLoggedIn()){
        redirect('users/login');
      }
      $this->projectModel = $this->model('project');  
    }

    public function index(){
        // get Projects
        
        $projects = $this->projectModel->getProjects();
        $data =[
            'projects' => $projects
        ];
        $this->view('projects/index',$data);
    }
}