<?php

namespace App\Models;

class EStudentDAO {
    
    private $student = null;
    private $conn = null;
    public $table_name = "students";
    
    public function __construct($conn, $student){
        
     $this->conn = $conn;
     $this->student = $student;
    }
    
    public function __destruct(){
        
      $this->conn = null;  
    }
    
    public function add_student(){
        
        $query = "INSERT INTO " . $this->table_name . " SET student_email=:student_email,
                                                            lastname=:lastname,
                                                            firstname=:firstname,
                                                            fathername=:fathername,
                                                            mothername=:mothername,
                                                            phone=:phone,
                                                            tmima=:tmima,
                                                            created=:created";
                                                
        $this->student->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":student_email", $this->student->student_email);
        $stmt->bindParam(":lastname", $this->student->lastname);
        $stmt->bindParam(":firstname", $this->student->firstname);
        $stmt->bindParam(":fathername", $this->student->fathername);
        $stmt->bindParam(":mothername", $this->student->mothername);
        $stmt->bindParam(":phone", $this->student->phone);
        $stmt->bindParam(":tmima", $this->student->tmima);
        $stmt->bindParam(":created", $this->student->timestamp);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
    }
    
    public function update_student(){
        
        $query = "UPDATE " . $this->table_name . " SET lastname=:lastname,
                                                            firstname=:firstname,
                                                            fathername=:fathername,
                                                            mothername=:mothername,
                                                            phone=:phone,
                                                            tmima=:tmima,
                                                            created=:created
                                                            WHERE student_email=:student_email";
                                                
        $this->student->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":lastname", $this->student->lastname);
        $stmt->bindParam(":firstname", $this->student->firstname);
        $stmt->bindParam(":fathername", $this->student->fathername);
        $stmt->bindParam(":mothername", $this->student->mothername);
        $stmt->bindParam(":phone", $this->student->phone);
        $stmt->bindParam(":tmima", $this->student->tmima);
        $stmt->bindParam(":created", $this->student->timestamp);
        $stmt->bindParam(":student_email", $this->student->student_email);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }

    }
    
    public function view_students(){
        
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
    
    
    public function view_student(){
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE student_email=:student_email";
      
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":student_email", $this->student->student_email);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
        return $stmt;
    }
    
    public function view_tmima_students(){
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE tmima=:tmima ORDER BY lastname";
      
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tmima", $this->student->tmima);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
        
        return $stmt;
    }
    
    public function promote_tmima($old_tmima, $next_tmima){
        
        $query = "UPDATE " . $this->table_name . " SET tmima=?
                                                   WHERE tmima=?";
                                                
        $this->student->timestamp = date('d-m-Y');
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $next_tmima);
        $stmt->bindParam(2, $old_tmima);
        $stmt->execute();
        $this->conn->commit();
        
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
    }
    
    
    public function delete_student(){
        
        $query = "DELETE FROM " . $this->table_name . " WHERE student_email=:student_email";
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":student_email", $this->student->student_email);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
    }
}


?>