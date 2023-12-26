<?php
class Users extends Controller{
    private $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }
    public function register(){
        //check for post
        if($_SERVER['REQUEST_METHOD']== 'POST'){
            //Process from
            //Sanitize POST data
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $data =[
                'nom'=>trim($_POST['nom']),
                'prenom'=>trim($_POST['prenom']),
                'email'=>trim($_POST['email']),
                'password'=>trim($_POST['password']),
                'phone'=>trim($_POST['tel']),
                'role'=> 'user',
                'nom_error'=>'',
                'prenom_error'=>'',
                'email_error'=>'',
                'password_error'=>'',
                'phone_error'=>'',
              ];

              //validation Email
              if(empty($data['email'])){
                $data['email_error'] ='Please enter email';
              }else{
                //Check email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_error'] ='Email already Exist';
                    
                }
              }
              if(empty($data['nom'])){
                $data['nom_error'] ='Please enter nom';
              }
              if(empty($data['prenom'])){
                $data['prenom_error'] ='Please enter prenom';
              }
              if(empty($data['phone'])){
                $data['phone_error'] ='Please enter phone';
              }
              //Validation password
              if(empty($data['password'])){
                $data['password_error'] ='Please enter password';
              }elseif(strlen($data['password']) < 6){
                $data['password_error'] = 'Password must be at least 6 characters';

              }

              //make sure errors are empty
              if(empty($data['email_error']) && empty($data['nom_error']) && empty($data['prenom_error']) && empty($data['phone_error']) && empty($data['password_error'])){
                  //validatd
                  //hash Password
                  $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);

                  if($this->userModel->register($data)){
                    flash('register_success', 'You are registered and can log in');
                    redirect('users/login');
                  } else {
                    die('Something went wrong');
                  }
              }else {
                //Load view with errors
                  $this->view('users/register',$data);
              }


        }else{
          $data =[
            'nom'=>'',
            'prenom'=>'',
            'email'=>'',
            'password'=>'',
            'phone'=>'',
            'role'=> '',
            'nom_error'=>'',
            'prenom_error'=>'',
            'email_error'=>'',
            'password_error'=>'',
            'phone_error'=>'',
            'role_error'=> '',
          ];

          $this->view('users/register',$data);
        }
}
    public function login(){
        //check for post
        if($_SERVER['REQUEST_METHOD']== 'POST'){
            //process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $data =[  
                'email'=>trim($_POST['email']),
                'password'=>trim($_POST['password']),  
                'email_error'=>'',
                'password_error'=>'',
              ];
              if(empty($data['email'])){
                $data['email_error'] ='Please enter email';
              }
              if(empty($data['password'])){
                $data['password_error'] ='Please enter password';
              }
              //Check for user/email
              if($this->userModel->findUserByEmail($data['email'])){
                //user found
              }else{
                //user not found
                $data['email_error']= 'No user found';
              }
               //make sure errors are empty
               if(empty($data['email_error'])  && empty($data['password_error'])){
                //validatd
                //Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'],$data['password']);
                if ($loggedInUser) {
                  //Create Session
                  $this->createUserSession($loggedInUser);

                

                }else{
                  $data['password_error']='Passeword Incorrect';

                  $this->view('users/login',$data);
                }
            }else {
              //Load view with errors
                $this->view('users/login',$data);
            }
              

        }else{
          $data =[
            'email'=>'',
            'password'=>'',   
            'email_error'=>'',
            'password_error'=>'',
          ];

          $this->view('users/login',$data);
        }
        
    }
    public function createUserSession($user){
      $_SESSION['user_id']=$user->user_id;
      $_SESSION['user_email']=$user->email;
      $_SESSION['user_role']=$user->user_role;
      $_SESSION['user_Nom']=$user->Nom;
      redirect('projects');
    }
    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_Nom']);
      unset($_SESSION['role']);
      session_destroy();
      redirect('users/login');
    }
} 