<?php

namespace App\Services;

use App\Routes\ERoutes;

class ERoleAuthenticatorService {
    
    public $file;
    
    public function __construct($file){
        
        $this->file = $file;
    }
    
    public function __destruct(){
        
    }
    
    public static function evaluateRole(){
        
        $username = $_SESSION['username'];
        $user_role = $_SESSION['user_role'];
        
        if(!isset($username) || empty($username)){
           
        return false;
        }
        
        if(!isset($user_role) || empty($user_role)){
           
        return false;
        }
        
        if(trim($user_role) == "parent"){
            if(!in_array($this->file, ERoutes::getValidParent())){
              return false;
            }
        }else if(trim($user_role) == "teacher"){
            if(!in_array($this->file, ERoutes::getValidTeacher())){
              return false;
            }
        }else if(trim($user_role) == "admin"){
            if(!in_array($this->file, ERoutes::getValidAdmin())){
              return false;
            }
        }
        
        return true;
    }
    
}


?>