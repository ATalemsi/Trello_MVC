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
}