<?php

namespace App\Models;

class EParentDAO {
    
    private $paret = null;
    private $conn = null;
    public $table_name = "parents";
    
    public function __construct($conn, $paret){
        
     $this->conn = $conn;
     $this->paret = $paret;
    }
    
    public function __destruct(){
        
      $this->conn = null;  
    }
    
    public function add_parent(){
        
        $query = "INSERT INTO " . $this->table_name . " SET parent_email=:parent_email,
                                                            lastname=:lastname,
                                                            firstname=:firstname,
                                                            phone=:phone,
                                                            tmima=:tmima,
                                                            created=:created";
                                                
        $this->paret->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":parent_email", $this->paret->parent_email);
        $stmt->bindParam(":lastname", $this->paret->lastname);
        $stmt->bindParam(":firstname", $this->paret->firstname);
        $stmt->bindParam(":phone", $this->paret->phone);
        $stmt->bindParam(":tmima", $this->paret->tmima);
        $stmt->bindParam(":created", $this->paret->timestamp);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
    }
    
    public function update_parent(){
        
        $query = "UPDATE " . $this->table_name . " SET parent_email=:parent_email,
                                                            lastname=:lastname,
                                                            firstname=:firstname,
                                                            phone=:phone,
                                                            tmima=:tmima,
                                                            created=:created
                                                            WHERE id=:id";
                                                
        $this->paret->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":parent_email", $this->paret->parent_email);
        $stmt->bindParam(":lastname", $this->paret->lastname);
        $stmt->bindParam(":firstname", $this->paret->firstname);
        $stmt->bindParam(":phone", $this->paret->phone);
        $stmt->bindParam(":tmima", $this->paret->tmima);
        $stmt->bindParam(":created", $this->paret->timestamp);
        $stmt->bindParam(":id", $this->paret->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }

    }
    
    public function view_parents(){
        
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
    
    
    public function view_parent(){
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE id=:id";
      
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->paret->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
        return $stmt;
    }
    
    public function view_tmima_parents(){
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE tmima=:tmima ORDER BY lastname";
      
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tmima", $this->paret->tmima);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
        return $stmt;
    }
    
    
    public function delete_parent(){
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->paret->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
    }
}


?>