<?php

namespace App\Routes;

class EActions {
    
    /*
     *
     * VALID ACTIONS FOR GET OR POST REQUESTS
     * activates EController
     */
    
    
    private $valid_actions = array("ac0" => "adminCreateAnartisi",
                                   "au0" => "adminUpdateAnartisi",
                                   "ad0" => "adminDeleteAnartisi",
                                   "ad1" => "adminDeleteMathima",
                                   "au2" => "adminUpdateMathitis",
                                   "ad2" => "adminDeleteMathitis",
                                   "apr2" => "adminPromoteMathites");
    
     /*
     * ------------------------------------------------------------------------
     * ------------------------------------------------------------------------
     */
    
    public function __construct(){
        
        
    }
    
    public function __destruct(){
        
        
    }
    
    public function getValidActions(){
        
        return $this->valid_actions;
    }
    
}

?>
