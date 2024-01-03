<?php
class Project{
    private $db;

    public function __construct()
    {
        $this->db=new Database;
    }

    public function getProjects() {
        $this->db->query('SELECT projects.*,
                            users.*,
                            COUNT(tasks.task_id) as total_tasks,
                            SUM(tasks.status = "Done") as completed_tasks,
                            SUM(tasks.status = "To do") as todo_tasks,
                            SUM(tasks.status = "Doing") as doing_tasks,
                            IFNULL((SUM(tasks.status = "Done") / COUNT(tasks.task_id) * 100), 0) as percentage_completion
                            FROM projects
                            INNER JOIN users ON projects.created_by = users.user_id
                            LEFT JOIN tasks ON projects.project_id = tasks.project_id
                            GROUP BY projects.project_id, users.user_id
                            ORDER BY projects.created_at DESC
                        ');
    
        return $this->db->resultSet();
    }


    public function addProject($data){
        $this->db->query('INSERT INTO projects (project_name,created_by) VALUES(:project_name ,:created_by )');
        //Bind value
        $this->db->bind(':project_name',$data['project_name']);
        $this->db->bind(':created_by',$data['user_id']);
       
   
        //Execute
        return $this->db->execute();
    }

    public function getProjectId($id){
         $this->db->query('SELECT * FROM projects WHERE project_id = :project_id');
         $this->db->bind(':project_id',$id);

         return $this->db->single();
    }

    public function updateProject($data){
        $this->db->query('UPDATE  projects SET project_name = :project_name  WHERE project_id = :project_id');
        //Bind value
        $this->db->bind(':project_id',$data['project_id']);
        $this->db->bind(':project_name',$data['project_name']);
        
    
        //Execute
        return $this->db->execute();
    }
    
    public function deleteProject($id){
        $this->db->query('DELETE FROM projects WHERE project_id = :project_id');
        $this->db->bind(':project_id',$id);
        
        //Execute
        return $this->db->execute();
    }

}
