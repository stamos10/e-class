<?php

namespace App\Controllers;

use App\Controllers\EDispatcher;
use App\Models\Connection;
use App\Models\EAnartisi;
use App\Models\EAnartisiDAO;
use App\Models\EMathima;
use App\Models\EMathimaDAO;
use App\Models\EParent;
use App\Models\EParentDAO;
use App\Models\EStudent;
use App\Models\EStudentDAO;
use App\Models\ETeacher;
use App\Models\ETeacherDAO;
use App\Models\ETmima;
use App\Models\ETmimaDAO;
use App\Models\FormHandler;

class EDataController {
    
    
    
    public function __construct(){
        
   
    }
    
    public function __destruct(){
        
    }
    
    
    /*
     *
     * ADMIN FUNCTIONS
     */
    
    public function adminFetchAnartiseis(){
        
      $conn = new Connection();
      $con = $conn->getConnection();
      $anartisi = new EAnartisi();
      $anartisi_dao = new EAnartisiDAO($con, $anartisi);
      $dispatcher = new EDispatcher();
      
      $data_returned = array();
      $results = $anartisi_dao->view_anartiseis();

      while($row = $results->fetch(\PDO::FETCH_ASSOC)){
        extract($row);
        $result_item = array('id' => $id,
                             'title' => $title,
                             'tmima' => $tmima,
                             'type' => $type,
                             'content_init' => $content_init,
                             'content' => $content,
                             'url' => $url,
                             'sender_email' => $sender_email,
                             'mathima_id' => $mathima_id,
                             'receiver_email' => $receiver_email,
                             'created' => $created
                             );
         
        array_push($data_returned, $result_item);
      }
      
      $dispatcher->releaseData($data_returned);
    }
    
    public function adminFetchMathimata(){
        
      $conn = new Connection();
      $con = $conn->getConnection();
      $mathima = new EMathima();
      $mathima_dao = new EMathimaDAO($con, $mathima);
      $handler = new FormHandler();
      $dispatcher = new EDispatcher();
      $approved = 1;
      
      $data_returned = array();
      $data_fixed = array();
      $results = $mathima_dao->view_mathimata_extended();

      while($row = $results->fetch(\PDO::FETCH_ASSOC)){
        extract($row);
        $result_item = array('id' => $id,
                             'title' => $title,
                             'tmima' => $tmima,
                             'teacher_email' => $teacher_email,
                             'teacher_firstname' => $teacher_firstname,
                             'teacher_lastname' => $teacher_lastname,
                             'student_email' => $student_email,
                             'firstname' =>$firstname,
                             'lastname' => $lastname,
                             'fathername' => $fathername,
                             'created' => $created);
        
        array_push($data_returned, $result_item);
      }
      
        $unique = 0;
        if(is_array($data_returned)){
        if(!empty($data_returned)){
        if($title != null){ 
        foreach($data_returned as $key => $val){
        $unique = array_count_values(array_column($data_returned, 'title'))[$val['title']];
        if($unique > 1){
         unset($data_returned[$key]);
        }
        }
        }
        }
        }
      
      $dispatcher->releaseData(array_merge($data_returned, $data_fixed));  
    }
    
    public function adminFetchMathites(){
        
      $conn = new Connection();
      $con = $conn->getConnection();
      $student = new EStudent();
      $student_dao = new EStudentDAO($con, $student);
      $handler = new FormHandler();
      $dispatcher = new EDispatcher();
      $tmima = "";
      $approved = 1;
      
      if(isset($_GET['tmima'])){
        $tmima = $_GET['tmima'];
      }
      
      $tmima = $handler->prepare_input($tmima);
      $tmima = $handler->process_input($tmima);
      
      if($tmima != "error"){
      $student->tmima = $tmima;
      }else{   
      $approved = 0;
      }
      
      $data_returned = array();
      $results = $student_dao->view_tmima_students();

      while($row = $results->fetch(\PDO::FETCH_ASSOC)){
        extract($row);
        $result_item = array('id' => $id,
                             'student_email' => $student_email,
                             'lastname' => $lastname,
                             'firstname' => $firstname,
                             'fathername' => $fathername,
                             'mothername' => $mothername,
                             'phone' => $phone,
                             'tmima' => $tmima,
                             'created' => $created
                             );
         
        array_push($data_returned, $result_item);
      }
      
      $dispatcher->releaseData($data_returned);  
    }
    
    
    
    /*
     *
     * TEACHER FUNCTIONS
     */
    

}


?>