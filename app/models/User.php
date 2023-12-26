<?php
class User{
  private $db;

  public function __construct()
  {
    $this->db=new Database;
  }
  //Register User

  public function register($data){
     $this->db->query('INSERT INTO users (Nom,Prenom,email,password_hash,Phone,user_role) VALUES(:Nom, :Prenom, :email, :password_hash, :Phone, :user_role)');
     //Bind value
     $this->db->bind(':Nom',$data['nom']);
     $this->db->bind(':Prenom',$data['prenom']);
     $this->db->bind(':email',$data['email']);
     $this->db->bind(':password_hash',$data['password']);
     $this->db->bind(':Phone',$data['phone']);
     $this->db->bind(':user_role',$data['role']);

     //Execute
     if($this->db->execute()){
        return true;
     }else{
        return false;
     }
  

  }

  //Lofin User
  public function login($email, $password){
   $this->db->query('SELECT * FROM users WHERE email = :email');
   $this->db->bind(':email', $email);

   $row = $this->db->single();
   $hashed_password = $row->password_hash;

   if(password_verify($password, $hashed_password)){
     return $row;
   } else {
     return false;
   }
 }
  //Find user by email
  public function findUserByEmail($email){
     $this->db->query('SELECT * FROM users WHERE email = :email');
     //Bind value
    $this->db->bind(':email',$email);
    
    $row = $this->db->single();


    //Check row
    if($this->db->rowCount() > 0){
        return true;
    }else{
        return false ;
    }
    }
}