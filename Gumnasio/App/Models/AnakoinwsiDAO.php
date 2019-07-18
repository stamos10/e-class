<?php

namespace App\Models;

class AnakoinwsiDAO {
    
    private $conn = null;
    private $table_name = "anakoinwseis";
    private $anakoinwsi = null;
    
    public function __construct($conn, $anakoinwsi){
        
        $this->conn = $conn;
        $this->anakoinwsi = $anakoinwsi;
    }
    
    public function __destruct(){
        
        $this->conn = null;
    }
    
    public function add_anakoinwsi(){
        
        $query = "INSERT INTO " . $this->table_name . " SET title=:title,
                                                            content=:content,
                                                            image_url_a=:image_url_a,
                                                            created=:created";
                                                
        $this->anakoinwsi->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $this->anakoinwsi->title);
        $stmt->bindParam(":content", $this->anakoinwsi->content);
        $stmt->bindParam(":image_url_a", $this->anakoinwsi->image_url_a);
        $stmt->bindParam(":created", $this->anakoinwsi->timestamp);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
    }
    
    public function update_anakoinwsi(){
        
        $query = "UPDATE " . $this->table_name . " SET title=:title,
                                                       content=:content,
                                                       image_url_a=:image_url_a,
                                                       created=:created
                                                       WHERE id=:id";
                                                
        $this->anakoinwsi->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $this->anakoinwsi->title);
        $stmt->bindParam(":content", $this->anakoinwsi->content);
        $stmt->bindParam(":image_url_a", $this->anakoinwsi->image_url_a);
        $stmt->bindParam(":created", $this->anakoinwsi->timestamp);
        $stmt->bindParam(":id", $this->anakoinwsi->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }

    }
    
    public function view_anakoinwseis(){
        
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
    
    
    public function view_anakoinwsi(){
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE id=:id";
      
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->anakoinwsi->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
        return $stmt;
    }
    
    
    public function delete_anakoinwsi(){
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->anakoinwsi->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
    }
    
}

?>