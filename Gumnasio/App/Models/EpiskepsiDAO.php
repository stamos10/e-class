<?php

namespace App\Models;

class EpiskepsiDAO {
    
    private $conn = null;
    private $table_name = "episkepseis";
    private $episkepsi = null;
    
    public function __construct($conn, $episkepsi){
        
        $this->conn = $conn;
        $this->episkepsi = $episkepsi;
    }
    
    public function __destruct(){
        
        $this->conn = null;
    }
    
    public function add_episkepsi(){
        
        $query = "INSERT INTO " . $this->table_name . " SET title=:title,
                                                            content=:content,
                                                            image_url_a=:image_url_a,
                                                            image_url_b=:image_url_b,
                                                            image_url_c=:image_url_c,
                                                            image_url_d=:image_url_d,
                                                            template_choice=:template_choice,
                                                            created=:created";
                                                
        $this->episkepsi->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $this->episkepsi->title);
        $stmt->bindParam(":content", $this->episkepsi->content);
        $stmt->bindParam(":image_url_a", $this->episkepsi->image_url_a);
        $stmt->bindParam(":image_url_b", $this->episkepsi->image_url_b);
        $stmt->bindParam(":image_url_c", $this->episkepsi->image_url_c);
        $stmt->bindParam(":image_url_d", $this->episkepsi->image_url_d);
        $stmt->bindParam(":template_choice", $this->episkepsi->template_choice);
        $stmt->bindParam(":created", $this->episkepsi->timestamp);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
    }
    
    public function update_episkepsi(){
        
        $query = "UPDATE " . $this->table_name . " SET title=:title,
                                                            content=:content,
                                                            image_url_a=:image_url_a,
                                                            image_url_b=:image_url_b,
                                                            image_url_c=:image_url_c,
                                                            image_url_d=:image_url_d,
                                                            template_choice=:template_choice,
                                                            created=:created
                                                            WHERE id=:id";
                                                
        $this->episkepsi->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $this->episkepsi->title);
        $stmt->bindParam(":content", $this->episkepsi->content);
        $stmt->bindParam(":image_url_a", $this->episkepsi->image_url_a);
        $stmt->bindParam(":image_url_b", $this->episkepsi->image_url_b);
        $stmt->bindParam(":image_url_c", $this->episkepsi->image_url_c);
        $stmt->bindParam(":image_url_d", $this->episkepsi->image_url_d);
        $stmt->bindParam(":template_choice", $this->episkepsi->template_choice);
        $stmt->bindParam(":created", $this->episkepsi->timestamp);
        $stmt->bindParam(":id", $this->episkepsi->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }

    }
    
    public function view_episkepseis(){
        
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
    
    
    public function view_episkepsi(){
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE id=:id";
      
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->episkepsi->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
        return $stmt;
    }
    
    
    public function delete_episkepsi(){
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->episkepsi->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
    }
    
}

?>