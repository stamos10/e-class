<?php

namespace App\Models;

class User {
    
    private $username;
    private $password;
    private $role;
    private $token;
    
    private $conn = null;
    public $table_name = "users_storage";
    
    function __construct($conn){
        
        $this->conn = $conn;
    }
    
    function __destruct(){
        
        $this->conn = null;
    }
    
    public function setUsername($username){
        
        $this->username = trim($username);
    }
    
    public function getUsername(){
        
        return $this->username;
    }

    public function setPass($password){
        
        $password = trim($password);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $password;
       
        
    }
    
    public function getPass(){
        
        return $this->password;
    }
    
    private function check_password($pass){
        
        $message = null;
        $password = $pass;
        if (strlen($password) < 7){
            $message = "Password Too Small";
        }else{
             $message = "Password is Ok";
        }
        
        return $message;
    }
    
    public function setRole($role){
        
        $this->role = trim($role);
    }
    
    public function getRole(){
        
        return $this->role;
    }
    
    public function setToken($token){
        
        $this->token = trim($token);
    }
    
    public function getToken(){
        
        return $this->token;
    }
    
    public function add_user(){
        
      if($this->check_password($this->getPass()) != null){
        
       $query = "INSERT INTO " . $this->table_name . " SET username=:username,
                                                           secret_t=:secret_t,
                                                           role=:role,
                                                           token=:token";
 
          $stmt = $this->conn->prepare($query);
 
          $stmt->bindParam(":username", $this->username);
          $stmt->bindParam(":secret_t", $this->password);
          $stmt->bindParam(":role", $this->role);
          $stmt->bindParam(":token", $this->token);
 
          $stmt->execute();
      }
    }
    
    public function update_role(){
        
       $query = "UPDATE " . $this->table_name . " SET role=:role
                                                      WHERE username=:username";
 
          $stmt = $this->conn->prepare($query);
 
          $stmt->bindParam(":role", $this->role);
          $stmt->bindParam(":username", $this->username);
          
          $stmt->execute(); 
    }
    
    public function update_it(){
        
       $query = "UPDATE " . $this->table_name . " SET secret_t=?
                                                      WHERE username=?";
 
          $stmt = $this->conn->prepare($query);
 
          $stmt->bindParam(":secret_t", $this->password);
          $stmt->bindParam(":username", $this->username);
          
          $stmt->execute(); 
    }
    
    public function fetch_user(){
        
        $query = "SELECT username FROM " . $this->table_name . " WHERE username=:username";
 
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();
       
        return $stmt;
    }
    
     public function fetch_user_b($username){
        
        $query = "SELECT username FROM " . $this->table_name . " WHERE username=?";
 
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $stmt->closeCursor();
       
        return json_encode($results);
    }
    
    public function fetch_it(){
        
        $query = "SELECT secret_t FROM " . $this->table_name . " WHERE username=:username";
 
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();
       
        return $stmt;
    }
    
    public function delete_user(){
        
        $query = "DELETE FROM " . $this->table_name . " WHERE username=:username";
        
        try{
        $this->conn->beginTransaction();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();
        $this->conn->commit();
        }catch(\PDOEXCEPTION $e){
            echo $e->getMessage();
        }
    }
    
    public function update_token(){
        
        $query = "UPDATE " . $this->table_name . " SET token=:token
                                                       WHERE username=:username";
 
          $stmt = $this->conn->prepare($query);
 
          $stmt->bindParam(":token", $this->token);
          $stmt->bindParam(":username", $this->username);
          
          $stmt->execute(); 
    }
    
    public function fetch_token(){
        
       $query = "SELECT username, token FROM " . $this->table_name . " WHERE username=:username";
 
          $stmt = $this->conn->prepare($query);
          $stmt->bindParam(":username", $this->username);
          
          $stmt->execute();
          
          return $stmt;
    }
    
    public function create_token($token){
        
        $random = rand(5, 15);
        $token .= "-" . $random;
        
        return $token;
    }
    
}


?>