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
    public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          //sanitize POST array
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
          $data = [
            'project_name' => trim($_POST['project_name']),
            'user_id' => $_SESSION['user_id'],
            'project_name_error' => ''

          ];
          //Validate project_name
          if (empty($data['project_name'])){
            $data['project_name_error']= 'Please entre Project name';
          }

          //Make sure no errors
          if (empty($data['project_name_error']) ){
            //Validated
            if ($this->projectModel->addProject($data)){
               flash('project_message','Project Added');
               redirect('projects');
              # code...
            }else {
              die('Something went wrong ');
            }

            
          }else{
            //Load view with errors
            $this->view('projects/add',$data);
          }
          
      }else{
        $data =[
          'project_name' => '',
          
      ];
      $this->view('projects/add',$data);
  

      }
      
    }

  public function edit($id){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $data = [
          'project_id' => $id,
          'project_name' => trim($_POST['project_name']),
          'user_id' => $_SESSION['user_id'],
          'project_name_error' => ''

        ];
        //Validate project_name
        if (empty($data['project_name'])){
          $data['project_name_error']= 'Please entre Project name';
        }

        //Make sure no errors
        if (empty($data['project_name_error']) ){
          //Validated
          if ($this->projectModel->updateProject($data)){
             flash('project_message','Project Modifier');
             redirect('projects');
            
          }else {
            die('Something  went wrong ');
          }

          
        }else{
          //Load view with errors
          $this->view('projects/edit',$data);
        }
        
    }else{
      //Get existing project from model
      $project = $this->projectModel->getProjectId($id);
      //Check for owner
      if ($project->created_by != $_SESSION['user_id']){
        redirect('projects');
        
      }
      $data =[
        'project_id'=> $id,
        'project_name' => $project->project_name
        
    ];
    $this->view('projects/edit',$data);


    }
    
  }
  public function delete($id){
      if ($this->projectModel->deleteProject($id)){
        flash('project_message','Project Deleted');
        redirect('projects');
      }else{
        die('Something went wrong');
      }
  }
  public function statistics($projectId) {
    $project = $this->projectModel->getProjectById($projectId);
    $statistics = $this->projectModel->getProjectStatistics($projectId);

    $data = [
        'project' => $project,
        'statistics' => $statistics,
    ];

    // Load the statistics view (create a new view file for statistics)
    $this->view('projects/statistics', $data);
}
}
