<?php 
class Tasks extends Controller{
    private $taskModel;
    private $projectId ;
    public function __construct()
    {
      if (!isLoggedIn()){
        redirect('users/login');
      }
      $this->taskModel = $this->model('task');  
    }
    public function index($id){
        // get Tasks
        
        $tasks = $this->taskModel->getTasksProject($id);
        $data =[
            'tasks' => $tasks
        ];
        $this->view('tasks/index',$data);
    }
    public function getIdFromUrl() {
      $url = $_SERVER['REQUEST_URI'];
      $parts = explode('/', $url);
      $projectId = end($parts);
    
      return $projectId;
    }
    
  public function add(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          //sanitize POST array
          $projectId=$_POST['project_id'];
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
          
          $data = [
            'task_name' => trim($_POST['task_name']),
            'debut_date' => trim($_POST['debut_date']),
            'fin_date' => trim($_POST['fin_date']),
            'project_id' =>$projectId,
            'created_by' => $_SESSION['user_id'],
            'status' => trim($_POST['status']),
            'task_name_error' => '',
            'debut_date_error' => '',
            'fin_date_error' => '',
            'status_error' => '',

          ];
          //Validate project_name
          if (empty($data['task_name'])){
            $data['task_name_error']= 'Please entre Tasks name';
          }
          if (empty($data['debut_date'])){
            $data['debut_date_error']= 'Please entre Debut Date';
          }
          if (empty($data['fin_date'])){
            $data['fin_date_error']= 'Please entre Fin Date';
          }
          if (empty($data['status'])){
            $data['status_error']= 'Please entre Status';
          }

          //Make sure no errors
          if (empty($data['tasks_name_error']) && empty($data['debut_date_error']) && empty($data['fin_date_error']) && empty($data['status_error']) ){
            //Validated
            if ($this->taskModel->addTask($data)){
               flash('tasks_message','Task Added');
               redirect('tasks/index/'.$projectId);
              # code...
            }else {
              die('Something went wrong ');
            }

            
          }else{
            //Load view with errors
            $this->view('tasks/add',$data);
          }
          
      }else{
        $data =[
          'task_id'=>'',
          'task_name' => '',
          'debut_date' => '',
          'fin_date' =>'',
          'status' => '',
      ];
      $this->view('tasks/add',$data);
  

      }
      
    }
  public function edit($id){
    $projectId= $this->getIdFromUrl();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $data = [
            'task_id' =>$id,
            'task_name' => trim($_POST['task_name']),
            'debut_date' => trim($_POST['debut_date']),
            'fin_date' => trim($_POST['fin_date']),
            'project_id' => trim($_POST['project_id']),
            'task_name_error' => '',
            'debut_date_error' => '',
            'fin_date_error' => '',
        ];
         //Validate project_name
         if (empty($data['task_name'])){
          $data['task_name_error']= 'Please entre Tasks name';
        }
        if (empty($data['debut_date'])){
          $data['debut_date_error']= 'Please entre Debut Date';
        }
        if (empty($data['fin_date'])){
          $data['fin_date_error']= 'Please entre Fin Date';
        }


        //Make sure no errors
        if (empty($data['task_name_error']) && empty($data['debut_date_error']) && empty($data['fin_date_error']) ){
          //Validated
          if ($this->taskModel->updateTask($data)){
             flash('tasks_message','Tasks Modifier');
             
             redirect('tasks/index/'.$data['project_id']);
            
          }else {
            die('Something  went wrong ');
          }

          
        }else{
          //Load view with errors
          $this->view('tasks/edit',$data);
        }
        
    }else{
      //Get existing project from model
      $task = $this->taskModel->getTasksId($id);
      //Check for owner
      if ($task->created_by != $_SESSION['user_id']){
        redirect('tasks/index/'.$projectId);
        
      }
      $data =[
        'task_id'=>$task->task_id,
        'project_id'=> $task->project_id,
        'task_name' => $task->task_name ,
        'debut_date' => $task->debut_date,
        'fin_date' =>$task->fin_date,
        'status' =>$task->status,
        
    ];
    $this->view('tasks/edit',$data);


    }
    
  }
  public function delete($id){
    if ($this->taskModel->deleteTask($id)){
      flash('project_message','Task Deleted');
      redirect('projects');
    }else{
      die('Something went wrong');
    }
}

public function search($projectId) {
  $projectId = $this->getIdFromUrl(); 
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
      $searchQuery = trim($_POST['search_query']);
         
      $tasks = $this->taskModel->searchTasks($searchQuery, $projectId);   
      $data = [
          'tasks' => $tasks,       
      ];

      $this->view('tasks/index', $data);
  }
}
  }    