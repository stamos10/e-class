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
      $student = new EStudent();
      $student_dao = new EStudentDAO($con, $student);
      $handler = new FormHandler();
      $dispatcher = new EDispatcher();
      $approved = 1;
      
      $data_returned = array();
      $data_returned['mathimata'] = array();
      $data_returned['students'] = array();
      
      $results = $mathima_dao->view_mathimata();
      $results_b = $student_dao->view_students();

      while($row = $results->fetch(\PDO::FETCH_ASSOC)){
        extract($row);
        $result_item = array('id' => $id,
                             'title' => $title,
                             'tmima' => $tmima,
                             'teacher_email' => $teacher_email,
                             'teacher_firstname' => $teacher_firstname,
                             'teacher_lastname' => $teacher_lastname,
                             'created' => $created);
        
        array_push($data_returned['mathimata'], $result_item);
      }
      
      while($row_b = $results_b->fetch(\PDO::FETCH_ASSOC)){
        extract($row_b);
        $result_item = array('id' => $id,
                             'student_email' => $student_email,
                             'lastname' => $lastname,
                             'firstname' => $firstname,
                             'fathername' => $fathername,
                             'mothername' => $mothername,
                             'phone' => $phone,
                             'tmima' =>$tmima,
                             'religion' => $religion,
                             'created' => $created);
        
        array_push($data_returned['students'], $result_item);
      }
          
            
      $dispatcher->releaseData($data_returned);  
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
    
    public function adminFetchEkpaideutikoi(){
        
      $conn = new Connection();
      $con = $conn->getConnection();
      $teacher = new ETeacher();
      $teacher_dao = new ETeacherDAO($con, $teacher);
      $handler = new FormHandler();
      $dispatcher = new EDispatcher();
      $approved = 1;
      
      $data_returned = array();
      $results = $teacher_dao->view_teachers();

      while($row = $results->fetch(\PDO::FETCH_ASSOC)){
        extract($row);
        $result_item = array('id' => $id,
                             'email' => $email,
                             'lastname' => $lastname,
                             'firstname' => $firstname,
                             'eidikotita' => $eidikotita,
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