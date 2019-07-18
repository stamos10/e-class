<?php

namespace App\Controllers;

class ERouteGenerator {
    
    
    public function __construct(){
    
        
    }
    
    public function __destruct(){
        
        
    }
    
    public static function set_url($file){
   
    $url = "http://" .$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']) . "/" . $file;
    
    return htmlspecialchars($url);
    
    }
    
    
    public static function set_request($file){
        
    $url = "http://" .$_SERVER['HTTP_HOST']. "/gumnasio/Gumnasio/App/Controllers/" . $file;
    
    return htmlspecialchars($url); 
    }
}


?>