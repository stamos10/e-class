<?php

namespace App\Services;

class EMessageService {
    
    private $message;
    
    public function __construct(){
        
    }
    
    public function __destruct(){
        
    }
    
    public function confirmationMessage(){
        
        $this->message = "Η Ενέργεια Ολοκληρώθηκε με επιτυχία";
        return urlencode($this->message);
    }
    
    public function rejectionMessage(){
        
        $this->message = "Λυπούμαστε. Κάτι δεν πήγε καλά";
        return urlencode($this->message);
    }
    
    public function confirmationJsonMessage(){
        
        $response = array();
        $response['status'] = array();
        $response['message'] = array();
        
        $this->message = "Η Ενέργεια Ολοκληρώθηκε με επιτυχία";
        array_push($response['status'], '0');
        array_push($response['message'], urlencode((string) $this->message));
        return json_encode($response);
    }
    
    public function rejectionJsonMessage(){
        
        $response = array();
        $response['status'] = array();
        $response['message'] = array();
        $this->message = "Λυπούμαστε. Κάτι δεν πήγε καλά";
        array_push($response['status'], '1');
        array_push($response['message'], urlencode((string) $this->message));
        return json_encode($response);
    }
    
    public function loginMessage(){
        
        $this->message = "Παρακαλούμε συνδεθείτε για να δείτε αυτή τη Σελίδα";
        return urlencode($this->message);
    }
    
    public function unauthorisedMessage(){
        
        $this->message = "Φαίνεται ότι δεν έχετε δικαίωμα να δείτε αυτή τη σελίδα";
        return urlencode($this->message);
    }
}


?>