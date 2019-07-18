<?php

namespace App\Controllers;

use App\Services\EMessageService;

class EDispatcher {
    
    private $data = null;
    private $message_returned;
    
    public function __construct(){
        
    }
    
    public function __destruct(){
        
    }
    
    public function releaseData($data){
        
        $this->data = $data;
        echo json_encode($data);
    }
    
    public function releaseConfirmation(){
        
        $this->message_returned = new EMessageService();
        return $this->message_returned->confirmationMessage();
    }
    
    public function releaseRejection(){
        
        $this->message_returned = new EMessageService();
        return $this->message_returned->rejectionMessage();
    }
    
    public function releaseJsonConfirmation(){
        
        $this->message_returned = new EMessageService();
        return $this->message_returned->confirmationJsonMessage();
    }
    
    public function releaseJsonRejection(){
        
        $this->message_returned = new EMessageService();
        return $this->message_returned->rejectionJsonMessage();
    }
}


?>