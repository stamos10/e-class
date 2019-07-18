<?php

namespace App\Models;

class EAnartisiDAO {
    
    private $anartisi = null;
    private $conn = null;
    public $table_name = "anartiseis";
    
    public function __construct($conn, $anartisi){
        
     $this->conn = $conn;
     $this->anartisi = $anartisi;
    }
    
    public function __destruct(){
        
      $this->conn = null;  
    }
    
    public function add_anartisi(){
        
        $query = "INSERT INTO " . $this->table_name . " SET title=:title,
                                                            tmima=:tmima,
                                                            type=:type,
                                                            content_init=:content_init,
                                                            content=:content,
                                                            url=:url,
                                                            sender_email=:sender_email,
                                                            mathima_id=:mathima_id,
                                                            receiver_email=:receiver_email,
                                                            created=:created";
                                                
        $this->anartisi->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $this->anartisi->title);
        $stmt->bindParam(":tmima", $this->anartisi->tmima);
        $stmt->bindParam(":type", $this->anartisi->type);
        $stmt->bindParam(":content_init", $this->anartisi->content_init);
        $stmt->bindParam(":content", $this->anartisi->content);
        $stmt->bindParam(":url", $this->anartisi->url);
        $stmt->bindParam(":sender_email", $this->anartisi->sender_email);
        $stmt->bindParam(":mathima_id", $this->anartisi->mathima_id);
        $stmt->bindParam(":receiver_email", $this->anartisi->receiver_email);
        $stmt->bindParam(":created", $this->anartisi->timestamp);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
    }
    
    public function update_anartisi(){
        
        $query = "UPDATE " . $this->table_name . " SET title=:title,
                                                            tmima=:tmima,
                                                            type=:type,
                                                            content_init=:content_init,
                                                            content=:content,
                                                            url=:url,
                                                            sender_email=:sender_email,
                                                            mathima_id=:mathima_id,
                                                            receiver_email=:receiver_email,
                                                            created=:created
                                                            WHERE id=:id";
                                                
        $this->anartisi->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $this->anartisi->title);
        $stmt->bindParam(":tmima", $this->anartisi->tmima);
        $stmt->bindParam(":type", $this->anartisi->type);
        $stmt->bindParam(":content_init", $this->anartisi->content_init);
        $stmt->bindParam(":content", $this->anartisi->content);
        $stmt->bindParam(":url", $this->anartisi->url);
        $stmt->bindParam(":sender_email", $this->anartisi->sender_email);
        $stmt->bindParam(":mathima_id", $this->anartisi->mathima_id);
        $stmt->bindParam(":receiver_email", $this->anartisi->receiver_email);
        $stmt->bindParam(":created", $this->anartisi->timestamp);
        $stmt->bindParam(":id", $this->anartisi->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }

    }
    
    public function view_anartiseis(){
        
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
      
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
    
    
    public function view_anartisi(){
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE id=:id";
      
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->anartisi->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
        return $stmt;
    }
    
    
    public function delete_anartisi(){
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->anartisi->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
    }
}


?>