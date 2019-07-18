<?php

namespace App\Models;

class EkpaideutikosDAO {
    
    private $conn = null;
    private $table_name = "ekpaideutikoi";
    private $ekpaideutikos = null;
    
    public function __construct($conn, $ekpaideutikos){
        
        $this->conn = $conn;
        $this->ekpaideutikos = $ekpaideutikos;
    }
    
    public function __destruct(){
        
        $this->conn = null;
    }
    
    public function add_ekpaideutikos(){
        
        $query = "INSERT INTO " . $this->table_name . " SET lastname=:lastname,
                                                            firstname=:firstname,
                                                            eidikotita=:eidikotita,
                                                            tmima=:tmima,
                                                            wres=:wres,
                                                            created=:created";
                                                
        $this->ekpaideutikos->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":lastname", $this->ekpaideutikos->lastname);
        $stmt->bindParam(":firstname", $this->ekpaideutikos->firstname);
        $stmt->bindParam(":eidikotita", $this->ekpaideutikos->eidikotita);
        $stmt->bindParam(":tmima", $this->ekpaideutikos->tmima);
        $stmt->bindParam(":wres", $this->ekpaideutikos->wres);
        $stmt->bindParam(":created", $this->ekpaideutikos->timestamp);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
    }
    
    public function update_ekpaideutikos(){
        
        $query = "UPDATE " . $this->table_name . " SET lastname=:lastname,
                                                            firstname=:firstname,
                                                            eidikotita=:eidikotita,
                                                            tmima=:tmima,
                                                            wres=:wres,
                                                            created=:created
                                                            WHERE id=:id";
                                                
        $this->ekpaideutikos->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":lastname", $this->ekpaideutikos->lastname);
        $stmt->bindParam(":firstname", $this->ekpaideutikos->firstname);
        $stmt->bindParam(":eidikotita", $this->ekpaideutikos->eidikotita);
        $stmt->bindParam(":tmima", $this->ekpaideutikos->tmima);
        $stmt->bindParam(":wres", $this->ekpaideutikos->wres);
        $stmt->bindParam(":created", $this->ekpaideutikos->timestamp);
        $stmt->bindParam(":id", $this->ekpaideutikos->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }

    }
    
    public function view_ekpaideutikoi(){
        
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
    
    
    public function view_ekpaideutikos(){
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE id=:id";
      
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->ekpaideutikos->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
        return $stmt;
    }
    
    
    public function delete_ekpaideutikos(){
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->ekpaideutikos->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
    }
    
}

?>