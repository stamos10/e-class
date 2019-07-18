<?php

namespace App\Controllers;

use App\Services\EAuthenticatorService;
use App\Services\ERoleAuthenticatorService;
use App\Services\EMessageService;
use App\Routes\EActions;
use App\Routes\ERoutes;
use App\Controllers\EController;
use App\Controllers\EDataController;


class ERequestHandler {
    
    private $auth = null;
    private $msg = null;
    private $auth_role = null;
    private $controller = null;
    private $data_controller = null;
    private $action = null;
    private $data_action = null;
    private $url = null;
    private $actions = null;
    private $request = null;
   
   
    public function __construct(EAuthenticatorService $auth,
                                ERoleAuthenticatorService $auth_role,
                                EMessageService $msg,
                                EController $controller,
                                EDataController $data_controller,
                                $request){
         
        $this->auth = $auth;
        $this->auth_role = $auth_role;
        $this->msg = $msg;
        $this->controller = $controller;
        $this->data_controller = $data_controller;
        $this->request = $request;
        /*
        if($auth->evaluateUser() == false){
            
            $message = $msg->loginMessage();
            header("location: http://localhost/gumnasio/eclass/error/error.php?message=" . $message);
            exit;
        }else if($auth_role->evaluateRole() == false){
           
            $message = $msg->unauthorisedMessage();
            header("location: http://localhost/gumnasio/eclass/error/error.php?message=" . $message);
            exit;
        }else{
           
           if(isset($_GET['action'])){
            $this->action = $_GET['action'];
           }
            
           if(isset($_POST['action'])){
            $this->action = $_POST['action'];
           } 
           
           if($this->action != null){ 
            $this->proceedRequest();
           }else{
            $data_controller = new EDataController();
           }
        }
        */
         
           if(isset($_GET['action'])){
            $this->action = $_GET['action'];
           }
           
           if(isset($_POST['action'])){
            $this->action = $_POST['action'];
           }
           
           
           
           if($this->request != null){
            $this->action = $this->request;
           } 
           
           if($this->action != null){
            $this->proceedRequest();
           }else{
            
               if(isset($_GET['data-action'])){
                 $this->data_action = $_GET['data-action'];
               }
            
               if(isset($_POST['data-action'])){
                 $this->data_action = $_POST['data-action'];
               } 
            
               if($this->data_action != null){
                  $this->proceedDataRequest();
               }
           }
    }
    
    public function __destruct(){
        
    }
    
    
    private function proceedRequest(){
        
       
       $actions = new EActions();
       $method= null;
        
        foreach($actions->getValidActions() as $key=>$val){
            if($this->action == $key){
                $method = $key;
            }
        }
        
        if($method != null){
            
        switch($method){
         case 'ac0':
          $this->controller->adminCreateAnartisi();  
         break;
         case 'au0':
          $this->controller->adminUpdateAnartisi(); 
         break;
         case 'ad0':
          $this->controller->adminDeleteAnartisi(); 
         break;
         case 'ad1':
          $this->controller->adminDeleteMathima(); 
         break;
         case 'au2':
          $this->controller->adminUpdateMathitis(); 
         break;
         case 'ad2':
          $this->controller->adminDeleteMathitis(); 
         break;
         case 'apr2':
          $this->controller->adminPromoteMathites(); 
         break;
         default:
          $this->controller->controller_method_redirect_home();  
         break;
            
        }
        
        }else{
         
         $message = $this->msg->rejectionMessage();
         header("location: http://localhost/gumnasio/eclass/error/error.php?message=" . $message);
         exit;
        }
        
    }
    
    private function proceedDataRequest(){
        
        
        if($this->data_action != null){
            
        switch($this->data_action){
         case 'admin-data-dashboard':
          $this->data_controller->adminFetchAnartiseis();  
         break;
         case 'admin-data-mathimata':
          $this->data_controller->adminFetchMathimata(); 
         break;
         case 'admin-data-mathites':
          $this->data_controller->adminFetchMathites(); 
         break;
         default:
          $this->data_controller->controller_method_redirect_home();  
         break;
            
        }
        
        }else{
         
         $message = $this->msg->rejectionMessage();
         header("location: http://localhost/gumnasio/eclass/error/error.php?message=" . $message);
         exit;
        }
    }
    
}

?>