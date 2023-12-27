<?php
class Project{
    private $db;

    public function __construct()
    {
        $this->db=new Database;
    }

    public function getProjects(){
        $this->db->query('SELECT *,
                        projects.project_id as projectID,
                        users.user_id as userID
                    
                        FROM projects
                        INNER JOIN users
                        ON projects.created_by = users.user_id
                        ORDER BY projects.created_at DESC
                        ');

        $results=$this->db->resultSet();

        return $results;
    }

    public function addProject($data){
        $this->db->query('INSERT INTO projects (project_name,created_by) VALUES(:project_name ,:created_by )');
        //Bind value
        $this->db->bind(':project_name',$data['project_name']);
        $this->db->bind(':created_by',$data['user_id']);
       
   
        //Execute
        if($this->db->execute()){
           return true;
        }else{
           return false;
        }   
    }
    public function getProjectId($id){
         $this->db->query('SELECT * FROM projects WHERE project_id = :project_id');
         $this->db->bind(':project_id',$id);

         $row = $this->db->single();

         return $row;
    }
    public function updateProject($data){
        $this->db->query('UPDATE  projects SET project_name = :project_name  WHERE project_id = :project_id');
        //Bind value
        $this->db->bind(':project_id',$data['project_id']);
        $this->db->bind(':project_name',$data['project_name']);
        
    
        //Execute
        if($this->db->execute()){
           return true;
        }else{
           return false;
        }   
    }
    public function deleteProject($id){
        $this->db->query('DELETE FROM projects WHERE project_id = :project_id');
        $this->db->bind(':project_id',$id);
        
    
        //Execute
        if($this->db->execute()){
           return true;
        }else{
           return false;
        }   
    }

}