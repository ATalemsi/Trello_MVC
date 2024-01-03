<?php
  class Pages extends Controller {
    
    public function index(){
      if (isLoggedIn()) {
        redirect('projects');
      }
      
      $data= [
        'title'=>'Welcome',
      ];

     
        
     $this->view('projects/index',$data);
    }

    public function about(){
      $data= [
        'title'=>'About'
      ];
     $this->view('pages/about',$data);
        
    }
  }
  