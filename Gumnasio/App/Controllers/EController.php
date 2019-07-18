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

class EController {
    
    
    
    public function __construct(){
      
      
    }
    
    public function __destruct(){
      
      
    }
    
    
    /*
     *
     * ADMIN FUNCTIONS
     */
    
    public function adminCreateAnartisi(){
        
      $conn = new Connection();
      $con = $conn->getConnection();
      $anartisi = new EAnartisi();
      $anartisi_dao = new EAnartisiDAO($con, $anartisi);
      $handler = new FormHandler();
      $dispatcher = new EDispatcher();
      
      $approved = 1;
      
      $title = $_POST['title'];
      $tmima = $_POST['tmima'];
      $type = "Anakoinwsi";
      $content_init = $_POST['content_init'];
      $content = $_POST['content'];
      $sender_email = $_POST['sender_email'];
      $url = null;
      $mathima_id = null;
      $receiver_email = null;
      
      $title = $handler->prepare_input($title);
      $title = $handler->process_input($title);
      
      $tmima = $handler->prepare_input($tmima);
      $tmima = $handler->process_input($tmima);
      
      $content_init = $handler->prepare_input($content_init);
      $content_init = $handler->process_input($content_init);
      
      $content = $handler->prepare_input($content);
      $content = $handler->process_input($content);
      
      $sender_email = $handler->prepare_input($sender_email);
      
      if($title != "error"){
      $anartisi->title = $title;
      }else{   
      $approved = 0;
      }
      
      if($tmima != "error"){
      $anartisi->tmima = $tmima;
      }else{   
      $approved = 0;
      }
      
      if($content_init != "error"){
      $anartisi->content_init = $content_init;
      }else{   
      $approved = 0;
      }
      
      if($content != "error"){
      $anartisi->content = $content;
      }else{   
      $approved = 0;
      }
      
      $anartisi->url = $url;
      $anartisi->type = $type;
      $anartisi->sender_email = $sender_email;
      $anartisi->mathima_id = $mathima_id;
      $anartisi->receiver_email = $receiver_email;
      
      if($approved == 1){
      $anartisi_dao->add_anartisi();
      $message = $dispatcher->releaseConfirmation();
      header("location: http://localhost/gumnasio/eclass/admin/dashboard.php?message=" . $message);
      }else{
      $error = $dispatcher->releaseRejection();
      header("location: http://localhost/gumnasio/eclass/admin/create-anartisi.php?error=" . $error);
      }
      
    }
    
    public function adminUpdateAnartisi(){
       
      $conn = new Connection();
      $con = $conn->getConnection();
      $anartisi = new EAnartisi();
      $anartisi_dao = new EAnartisiDAO($con, $anartisi);
      $handler = new FormHandler();
      $dispatcher = new EDispatcher();
      
      $approved = 1;
      
      $json = file_get_contents('php://input');
      $request = json_decode($json);
      
      $id = $request->id;
      $title = $request->title;
      $tmima = $request->tmima;
      $type = "Anakoinwsi";
      $content_init = $request->content_init;
      $content = $request->content;
      $sender_email = $request->sender_email;
      $url = null;
      $mathima_id = null;
      $receiver_email = null;
     
      $title = $handler->prepare_input($title);
      $title = $handler->process_input($title);
      
      $tmima = $handler->prepare_input($tmima);
      $tmima = $handler->process_input($tmima);
      
      $content_init = $handler->prepare_input($content_init);
      $content_init = $handler->process_input($content_init);
      
      $content = $handler->prepare_input($content);
      $content = $handler->process_input($content);
      
      $sender_email = $handler->prepare_input($sender_email);
      
      if($title != "error"){
      $anartisi->title = $title;
      }else{   
      $approved = 0;
      }
      
      if($tmima != "error"){
      $anartisi->tmima = $tmima;
      }else{   
      $approved = 0;
      }
      
      if($content_init != "error"){
      $anartisi->content_init = $content_init;
      }else{   
      $approved = 0;
      }
      
      if($content != "error"){
      $anartisi->content = $content;
      }else{   
      $approved = 0;
      }
      
      $anartisi->id = $id;
      $anartisi->url = $url;
      $anartisi->type = $type;
      $anartisi->sender_email = $sender_email;
      $anartisi->mathima_id = $mathima_id;
      $anartisi->receiver_email = $receiver_email;
      
      if($approved == 1){
        
      $anartisi_dao->update_anartisi();
      $message = $dispatcher->releaseJsonConfirmation();
      echo $message;
      }else{
      $error = $dispatcher->releaseJsonRejection();
      echo $error;
      }
       
        
    }
    
    public function adminDeleteAnartisi(){
      
      $conn = new Connection();
      $con = $conn->getConnection();
      $anartisi = new EAnartisi();
      $anartisi_dao = new EAnartisiDAO($con, $anartisi);
      $handler = new FormHandler();
      $dispatcher = new EDispatcher();
      
      $approved = 1;
      
      $json = file_get_contents('php://input');
      $request = json_decode($json);
      
      $id = $request->id;
      $anartisi->id = $id;
      
       if($approved == 1){
        
      $anartisi_dao->delete_anartisi();
      $message = $dispatcher->releaseJsonConfirmation();
      echo $message;
      }else{
      $error = $dispatcher->releaseJsonRejection();
      echo $error;
      }
    }
    
    
    public function adminDeleteMathima(){
        
        
    }
    
    
    public function adminUpdateMathitis(){
        
      $conn = new Connection();
      $con = $conn->getConnection();
      $student = new EStudent();
      $student_dao = new EStudentDAO($con, $student);
      $handler = new FormHandler();
      $dispatcher = new EDispatcher();
      
      $approved = 1;
      
      $json = file_get_contents('php://input');
      $request = json_decode($json);
      
      $id = $request->id;
      $student_email = $request->student_email;
      $lastname = $request->lastname;
      $firstname = $request->firstname;
      $fathername = $request->fathername;
      $mothername = $request->mothername;
      $phone = $request->phone;
      $tmima = $request->tmima;
      
      $student_email = $handler->prepare_input($student_email);
      $student_email = $handler->process_input($student_email);
      
      $lastname = $handler->prepare_input($lastname);
      $lastname = $handler->process_input($lastname);
      
      $firstname = $handler->prepare_input($firstname);
      $firstname = $handler->process_input($firstname);
      
      $fathername = $handler->prepare_input($fathername);
      $fathername = $handler->process_input($fathername);
      
      $mothername = $handler->prepare_input($mothername);
      $mothername = $handler->process_input($mothername);
      
      $phone = $handler->prepare_input($phone);
      $tmima = $handler->prepare_input($tmima);
      
      if($student_email != "error"){
      $student->student_email = $student_email;
      }else{   
      $approved = 0;
      }
      
      if($lastname != "error"){
      $student->lastname = $lastname;
      }else{   
      $approved = 0;
      }
      
      if($firstname != "error"){
      $student->firstname = $firstname;
      }else{   
      $approved = 0;
      }
      
      if($fathername != "error"){
      $student->fathername = $fathername;
      }else{   
      $approved = 0;
      }
      
      if($mothername != "error"){
      $student->mothername = $mothername;
      }else{   
      $approved = 0;
      }
      
      $student->phone = $phone;
      $student->tmima = $tmima;
      
      if($approved == 1){
        
      $student_dao->update_student();
      $message = $dispatcher->releaseJsonConfirmation();
      echo $message;
      }else{
      $error = $dispatcher->releaseJsonRejection();
      echo $error;
      }
        
    }
    
    public function adminDeleteMathitis(){
     
      $conn = new Connection();
      $con = $conn->getConnection();
      $student = new EStudent();
      $student_dao = new EStudentDAO($con, $student);
      $handler = new FormHandler();
      $dispatcher = new EDispatcher();
      
      $approved = 1;
      
      $json = file_get_contents('php://input');
      $request = json_decode($json);
      
      $student_email = $request->student_email;
      $student->student_email = $student_email;
      
       if($approved == 1){
        
      $student_dao->delete_student();
      $message = $dispatcher->releaseJsonConfirmation();
      echo $message;
      }else{
      $error = $dispatcher->releaseJsonRejection();
      echo $error;
      }   
        
    }
    
    public function adminPromoteMathites(){
        
      $conn = new Connection();
      $con = $conn->getConnection();
      $student = new EStudent();
      $student_dao = new EStudentDAO($con, $student);
      $handler = new FormHandler();
      $dispatcher = new EDispatcher();
      
      $approved = 1;
      
      $json = file_get_contents('php://input');
      $request = json_decode($json);
      
      $tmima = $request->tmima;
      $student->tmima = $tmima;
      $old_tmima = $student->tmima;
      $next_tmima = $this->calculateTmima($old_tmima);
      
       if($approved == 1){
        
      $student_dao->promote_tmima($old_tmima, $next_tmima);
      $message = $dispatcher->releaseJsonConfirmation();
      echo $message;
      }else{
      $error = $dispatcher->releaseJsonRejection();
      echo $error;
      }   
    }
    
    private function calculateTmima($tmima){
        
        switch($tmima){
            case 'A1':
            $tmima = 'B1';
            break;
            case 'A2':
            $tmima = 'B2';
            break;
            case 'A3':
            $tmima = 'B3';
            break;
            case 'A4':
            $tmima = 'B4';
            break;
            case 'B1':
            $tmima = 'C1';
            break;
            case 'B2':
            $tmima = 'C2';
            break;
            case 'B3':
            $tmima = 'C3';
            break;
            case 'B4':
            $tmima = 'C4';
            break;
            case 'C1':
            $tmima = 'D1';
            break;
            case 'C2':
            $tmima = 'D2';
            break;
            case 'C3':
            $tmima = 'D3';
            break;
            case 'C4':
            $tmima = 'D4';
            break;
            default:
            break;

        }
        return $tmima;
    }
    
    
    /*
     *
     * TEACHER FUNCTIONS
     */
}


?>