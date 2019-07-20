<?php

namespace App\Models;

class EMathimaDAO {
    
    private $mathima = null;
    private $conn = null;
    public $table_name = "mathimata";
    
    public function __construct($conn, $mathima){
        
     $this->conn = $conn;
     $this->mathima = $mathima;
    }
    
    public function __destruct(){
        
      $this->conn = null;  
    }
    
    public function add_mathima(){
        
        $query = "INSERT INTO " . $this->table_name . " SET title=:title,
                                                            tmima=:tmima,
                                                            teacher_email=:teacher_email,
                                                            teacher_firstname=:teacher_firstname,
                                                            teacher_lastname=:teacher_lastname,
                                                            student_email=:student_email,
                                                            ergasia_id=:ergasia_id,
                                                            online_ergasia_id=:online_ergasia_id,
                                                            anakoinwsi_id=:anakoinwsi_id,
                                                            daily_report_id=:daily_report_id,
                                                            created=:created";
                                                
        $this->mathima->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $this->mathima->title);
        $stmt->bindParam(":tmima", $this->mathima->tmima);
        $stmt->bindParam(":teacher_email", $this->mathima->teacher_email);
        $stmt->bindParam(":teacher_firstname", $this->mathima->teacher_firstname);
        $stmt->bindParam(":teacher_lastname", $this->mathima->teacher_lastname);
        $stmt->bindParam(":student_email", $this->mathima->student_email);
        $stmt->bindParam(":ergasia_id", $this->mathima->ergasia_id);
        $stmt->bindParam(":online_ergasia_id", $this->mathima->online_ergasia_id);
        $stmt->bindParam(":anakoinwsi_id", $this->mathima->anakoinwsi_id);
        $stmt->bindParam(":daily_report_id", $this->mathima->daily_report_id);
        $stmt->bindParam(":created", $this->mathima->timestamp);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
    }
    
    public function update_mathima(){
        
        $query = "UPDATE " . $this->table_name . " SET title=:title,
                                                            tmima=:tmima,
                                                            teacher_email=:teacher_email,
                                                            teacher_firstname=:teacher_firstname,
                                                            teacher_lastname=:teacher_lastname,
                                                            student_email=:student_email,
                                                            ergasia_id=:ergasia_id,
                                                            online_ergasia_id=:online_ergasia_id,
                                                            anakoinwsi_id=:anakoinwsi_id,
                                                            daily_report_id=:daily_report_id,
                                                            created=:created
                                                            WHERE id=:id";
                                                
        $this->mathima->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $this->mathima->title);
        $stmt->bindParam(":tmima", $this->mathima->tmima);
        $stmt->bindParam(":teacher_email", $this->mathima->teacher_email);
        $stmt->bindParam(":teacher_firstname", $this->mathima->teacher_firstname);
        $stmt->bindParam(":teacher_lastname", $this->mathima->teacher_lastname);
        $stmt->bindParam(":student_email", $this->mathima->student_email);
        $stmt->bindParam(":ergasia_id", $this->mathima->ergasia_id);
        $stmt->bindParam(":online_ergasia_id", $this->mathima->online_ergasia_id);
        $stmt->bindParam(":anakoinwsi_id", $this->mathima->anakoinwsi_id);
        $stmt->bindParam(":daily_report_id", $this->mathima->daily_report_id);
        $stmt->bindParam(":created", $this->mathima->timestamp);
        $stmt->bindParam(":id", $this->mathima->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }

    }
    
    public function update_mathima_simple(){
        
        $query = "UPDATE " . $this->table_name . " SET title=:title,
                                                            tmima=:tmima,
                                                            
                                                            teacher_firstname=:teacher_firstname,
                                                            teacher_lastname=:teacher_lastname,
                                                            created=:created
                                                            WHERE id=:id";
                                                
        $this->mathima->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $this->mathima->title);
        $stmt->bindParam(":tmima", $this->mathima->tmima);
        //$stmt->bindParam(":teacher_email", $this->mathima->teacher_email);
        $stmt->bindParam(":teacher_firstname", $this->mathima->teacher_firstname);
        $stmt->bindParam(":teacher_lastname", $this->mathima->teacher_lastname);
        $stmt->bindParam(":created", $this->mathima->timestamp);
        $stmt->bindParam(":id", $this->mathima->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }

    }
    
    public function view_mathimata(){
        
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
    
    public function view_mathimata_extended(){
        
        $query = "SELECT DISTINCT
                  m.id,
                  m.title,
                  m.tmima,
                  m.teacher_firstname,
                  m.teacher_lastname,
                  m.teacher_email,
                  m.created,
                  s.student_email,
                  s.lastname,
                  s.firstname,
                  s.fathername,
                  s.tmima
                  FROM mathimata m
                  LEFT JOIN
                  students s on m.tmima = s.tmima";
                  
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
    
    
    public function view_mathima(){
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE id=:id";
      
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->mathima->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
        return $stmt;
    }
    
    
    public function delete_mathima(){
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->mathima->id);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
    }
}


?>