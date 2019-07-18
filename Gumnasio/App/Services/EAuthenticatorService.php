<?php

namespace App\Services;

class EAuthenticatorService {
    
    public function __construct(){
       
    
    }
    
    public function __destruct(){
        
    }
    
    public static function evaluateUser(){
        
        $username = $_SESSION['username'];
        $token = $_SESSION['token'];
        $token = explode("-", $token);
        
        if(!isset($username) || empty($username)){
           
        return false;
        }
        
        if(is_array($token)){
        if(trim($token[0]) != trim($username)){
            
        return false;
        }
        }
        
        if(is_array($token)){
        if((int) $token[1] < 5 || (int) $token[1] > 15){
            
        return false;
        }
        }
        
        return true;
    }
}


?>