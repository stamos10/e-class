<?php

namespace App\Models;

class ETeacher {
    
    private $teacher_id;
    private $email;
    public $lastname;
    public $firstname;
    public $eidikotita;
    public $tmima_upethinos;
    public $timestamp;
    
    
    public function __construct(){
        
    }
    
    public function __destruct(){
        
    }
    
    public function setTeacherId($teacher_id){
        $this->teacher_id = $teacher_id;
    }
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function getTeacherId(){
        return $this->teacher_id;
    }
    
    public function getEmail(){
        return $this->email;
    }
}


?>