<?php

namespace App\Models;

class ETmimaDAO {
    
    private $tmima = null;
    private $conn = null;
    public $table_name = "tmimata";
    
    public function __construct($conn, $tmima){
        
     $this->conn = $conn;
     $this->tmima = $tmima;
    }
    
    public function __destruct(){
        
      $this->conn = null;  
    }
    
    public function add_tmima(){
        
        $query = "INSERT INTO " . $this->table_name . " SET tmima=:tmima,
                                                            created=:created";
                                                
        $this->tmima->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":student_id", $this->tmima->student_id);
        $stmt->bindParam(":tmima", $this->tmima->tmima);
        $stmt->bindParam(":created", $this->tmima->timestamp);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
    }
    
    public function update_tmima(){
        
        $query = "UPDATE " . $this->table_name . " SET tmima=:tmima,
                                                            created=:created
                                                            WHERE id=:id";
                                                
        $this->tmima->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tmima", $this->tmima->tmima);
        $stmt->bindParam(":created", $this->tmima->timestamp);
        $stmt->bindParam(":id", $this->tmima->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }

    }
    
    public function view_tmimata(){
        
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY tmima";
      
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
    
    
    public function view_tmima(){
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE id=:id";
      
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->tmima->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
        return $stmt;
    }
    
    
    public function delete_tmima(){
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->tmima->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
    }
}


?>