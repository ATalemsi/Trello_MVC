<?php 
class Tasks extends Controller{
    private $taskModel;
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
}