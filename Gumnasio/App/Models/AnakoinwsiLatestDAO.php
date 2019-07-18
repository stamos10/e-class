<?php

namespace App\Models;

class AnakoinwsiLatestDAO {
    
    private $conn = null;
    private $table_name = "anakoinwsi_latest";
    private $anakoinwsi_latest = null;
    
    public function __construct($conn, $anakoinwsi_latest){
        
        $this->conn = $conn;
        $this->anakoinwsi_latest = $anakoinwsi_latest;
    }
    
    public function __destruct(){
        
        $this->conn = null;
    }
    
    public function add_anakoinwsi(){
        
        $query = "INSERT INTO " . $this->table_name . " SET title=:title,
                                                            promo=:promo,
                                                            content=:content,
                                                            image_url_a=:image_url_a,
                                                            created=:created";
                                                
        $this->anakoinwsi_latest->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $this->anakoinwsi_latest->title);
        $stmt->bindParam(":promo", $this->anakoinwsi_latest->promo);
        $stmt->bindParam(":content", $this->anakoinwsi_latest->content);
        $stmt->bindParam(":image_url_a", $this->anakoinwsi_latest->image_url_a);
        $stmt->bindParam(":created", $this->anakoinwsi_latest->timestamp);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
    }
    
    public function update_anakoinwsi(){
        
        $query = "UPDATE " . $this->table_name . " SET title=:title,
                                                       promo=:promo,
                                                       content=:content,
                                                       image_url_a=:image_url_a,
                                                       created=:created
                                                       WHERE id=:id";
                                                
        $this->anakoinwsi_latest->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $this->anakoinwsi_latest->title);
        $stmt->bindParam(":promo", $this->anakoinwsi_latest->promo);
        $stmt->bindParam(":content", $this->anakoinwsi_latest->content);
        $stmt->bindParam(":image_url_a", $this->anakoinwsi_latest->image_url_a);
        $stmt->bindParam(":created", $this->anakoinwsi_latest->timestamp);
        $stmt->bindParam(":id", $this->anakoinwsi_latest->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }

    }
    
    public function view_anakoinwsi_latest(){
        
        $query = "SELECT * FROM " . $this->table_name ." LIMIT 1";
      
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
        $stmt->bindParam(":id", $this->anakoinwsi_latest->id);
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
        $stmt->bindParam(":id", $this->anakoinwsi_latest->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
    }
    
}

?>