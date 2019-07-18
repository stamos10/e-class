<?php

namespace App\Models;

class DrasiDAO {
    
    private $conn = null;
    private $table_name = "draseis";
    private $drasi = null;
    
    public function __construct($conn, $drasi){
        
        $this->conn = $conn;
        $this->drasi = $drasi;
    }
    
    public function __destruct(){
        
        $this->conn = null;
    }
    
    public function add_drasi(){
        
        $query = "INSERT INTO " . $this->table_name . " SET title=:title,
                                                            content=:content,
                                                            image_url_a=:image_url_a,
                                                            image_url_b=:image_url_b,
                                                            image_url_c=:image_url_c,
                                                            image_url_d=:image_url_d,
                                                            template_choice=:template_choice,
                                                            created=:created";
                                                
        $this->drasi->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $this->drasi->title);
        $stmt->bindParam(":content", $this->drasi->content);
        $stmt->bindParam(":image_url_a", $this->drasi->image_url_a);
        $stmt->bindParam(":image_url_b", $this->drasi->image_url_b);
        $stmt->bindParam(":image_url_c", $this->drasi->image_url_c);
        $stmt->bindParam(":image_url_d", $this->drasi->image_url_d);
        $stmt->bindParam(":template_choice", $this->drasi->template_choice);
        $stmt->bindParam(":created", $this->drasi->timestamp);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
    }
    
    public function update_drasi(){
        
        $query = "UPDATE " . $this->table_name . " SET title=:title,
                                                            content=:content,
                                                            image_url_a=:image_url_a,
                                                            image_url_b=:image_url_b,
                                                            image_url_c=:image_url_c,
                                                            image_url_d=:image_url_d,
                                                            template_choice=:template_choice,
                                                            created=:created
                                                            WHERE id=:id";
                                                
        $this->drasi->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $this->drasi->title);
        $stmt->bindParam(":content", $this->drasi->content);
        $stmt->bindParam(":image_url_a", $this->drasi->image_url_a);
        $stmt->bindParam(":image_url_b", $this->drasi->image_url_b);
        $stmt->bindParam(":image_url_c", $this->drasi->image_url_c);
        $stmt->bindParam(":image_url_d", $this->drasi->image_url_d);
        $stmt->bindParam(":template_choice", $this->drasi->template_choice);
        $stmt->bindParam(":created", $this->drasi->timestamp);
        $stmt->bindParam(":id", $this->drasi->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }

    }
    
    public function view_draseis(){
        
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
    
    
    public function view_drasi(){
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE id=:id";
      
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->drasi->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
        return $stmt;
    }
    
    
    public function delete_drasi(){
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->drasi->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
    }
    
}

?>