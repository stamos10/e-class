<?php

namespace App\Models;

class KanonismosDAO {
    
    private $conn = null;
    private $table_name = "kanonismos";
    private $kanonismos = null;
    
    public function __construct($conn, $kanonismos){
        
        $this->conn = $conn;
        $this->kanonismos = $kanonismos;
    }
    
    public function __destruct(){
        
        $this->conn = null;
    }
    
    public function add_kanonismos(){
        
        $query = "INSERT INTO " . $this->table_name . " SET title=:title,
                                                            content=:content,
                                                            created=:created";
                                                
        $this->kanonismos->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $this->kanonismos->title);
        $stmt->bindParam(":content", $this->kanonismos->content);
        $stmt->bindParam(":created", $this->kanonismos->timestamp);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
    }
    
    public function update_kanonismos(){
        
        $query = "UPDATE " . $this->table_name . " SET title=:title,
                                                       content=:content,
                                                       created=:created
                                                       WHERE id=:id";
                                                
        $this->kanonismos->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $this->kanonismos->title);
        $stmt->bindParam(":content", $this->kanonismos->content);
        $stmt->bindParam(":created", $this->kanonismos->timestamp);
        $stmt->bindParam(":id", $this->kanonismos->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }

    }
    
    public function view_kanonismos_all(){
        
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id desc";
      
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
    
    
    public function view_kanonismos(){
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE id=:id";
      
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->kanonismos->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
        return $stmt;
    }
    
    
    public function delete_kanonismos(){
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->kanonismos->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
    }
    
}

?>