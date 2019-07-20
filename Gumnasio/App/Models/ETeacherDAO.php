<?php

namespace App\Models;

class ETeacherDAO {
    
    private $conn = null;
    private $teacher = null;
    public $table_name = "teachers";    
    
    public function __construct($conn, $teacher){
      
      $this->conn = $conn;
      $this->teacher = $teacher;
    }
    
    public function __destruct(){
        
      $this->conn = null;
    }
    
    public function add_teacher(){
        
        $query = "INSERT INTO " . $this->table_name . " SET email=:email,
                                                            lastname=:lastname,
                                                            firstname=:firstname,
                                                            eidikotita=:eidikotita,
                                                            created=:created";
                                                
        $this->teacher->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $this->teacher->email);
        $stmt->bindParam(":lastname", $this->teacher->lastname);
        $stmt->bindParam(":firstname", $this->teacher->firstname);
        $stmt->bindParam(":eidikotita", $this->teacher->eidikotita);
        $stmt->bindParam(":created", $this->teacher->timestamp);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
    }
    
    public function update_teacher(){
        
        $query = "UPDATE " . $this->table_name . " SET email=:email,
                                                            lastname=:lastname,
                                                            firstname=:firstname,
                                                            eidikotita=:eidikotita,
                                                            created=:created
                                                            WHERE email=:email";
                                                
        $this->teacher->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $this->teacher->email);
        $stmt->bindParam(":lastname", $this->teacher->lastname);
        $stmt->bindParam(":firstname", $this->teacher->firstname);
        $stmt->bindParam(":eidikotita", $this->teacher->eidikotita);
        $stmt->bindParam(":created", $this->teacher->timestamp);
        $stmt->bindParam(":email", $this->teacher->email);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }

    }
    
    public function view_teachers(){
        
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY lastname";
      
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
        return $stmt;
    }
    
    
    public function view_teacher(){
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE email=:email";
      
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $this->teacher->email);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
        return $stmt;
    }
    
    
    public function delete_teacher(){
        
        $query = "DELETE FROM " . $this->table_name . " WHERE email=:email";
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $this->teacher->email);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
    }
    
}


?>