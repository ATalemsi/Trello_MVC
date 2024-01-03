<?php
class Task{
    private $db;

    public function __construct()
    {
        $this->db=new Database;
    }
    public function getTasksProject($id){
        $this->db->query('SELECT * FROM tasks WHERE project_id= :project_id;
                        ');
        $this->db->bind(':project_id',$id);                

        $results=$this->db->resultSet();

        return $results;
    }
    public function addTask($data){
        $this->db->query('INSERT INTO tasks (task_name,debut_date,fin_date,created_by,project_id,status,Archive) VALUES(:task_name,:debut_date,:fin_date,:created_by,:project_id,:status,1)');
        //Bind value
        $this->db->bind(':task_name',$data['task_name']);
        $this->db->bind(':debut_date',$data['debut_date']);
        $this->db->bind(':fin_date',$data['fin_date']);
        $this->db->bind(':created_by',$data['created_by']);
        $this->db->bind(':project_id',$data['project_id']);
        $this->db->bind(':status',$data['status']);
       
   
        //Execute
        if($this->db->execute()){
           return true;
        }else{
           return false;
        }   
    }
    public function getTasksId($id){
        $this->db->query('SELECT * FROM tasks WHERE task_id = :task_id');
        $this->db->bind(':task_id',$id);

        $row = $this->db->single();

        return $row;
   }
   public function updateTask($data){
    $this->db->query('UPDATE  tasks SET task_name = :task_name ,debut_date=:debut_date,fin_date=:fin_date WHERE task_id = :task_id');
    //Bind value
    $this->db->bind(':task_id',$data['task_id']);
    $this->db->bind(':task_name',$data['task_name']);
    $this->db->bind(':debut_date',$data['debut_date']);
    $this->db->bind(':fin_date',$data['fin_date']);
    

    //Execute
    if($this->db->execute()){
       return true;
    }else{
       return false;
    }   
   }
   public function deleteTask($id){
    $this->db->query('UPDATE tasks SET Archive=0 WHERE task_id = :task_id');
    $this->db->bind(':task_id',$id);
    //Execute
    if($this->db->execute()){
       return true;
    }else{
       return false;
    }   
}
    public function searchTasks($searchQuery,$projectId) {
        // Use a SQL query to search for tasks based on task_name
        $this->db->query('SELECT * FROM tasks WHERE project_id = :project_id AND task_name LIKE :search_query');
        $this->db->bind(':search_query', '%' . $searchQuery . '%');
        $this->db->bind(':project_id',$projectId);
        $results = $this->db->resultSet();

        return $results;
    }
    public function getProjectStatistics($projectId) {
        $this->db->query('SELECT COUNT(*) as total_tasks, 
                                SUM(CASE WHEN status = "Done" THEN 1 ELSE 0 END) as completed_tasks,
                                SUM(CASE WHEN status = "To do" THEN 1 ELSE 0 END) as todo_tasks,
                                SUM(CASE WHEN status = "Doing" THEN 1 ELSE 0 END) as doing_tasks,
                                (SUM(CASE WHEN status = "Done" THEN 1 ELSE 0 END) / COUNT(*)) * 100 as percentage_completion
                          FROM tasks WHERE project_id = :project_id');
        
        $this->db->bind(':project_id', $projectId);

        $row = $this->db->single();

        return $row;
    }
}