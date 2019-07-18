<?php

namespace App\Routes;

class ERoutes {
    
    
     /*
     *
     * User Admin FILES
     * activates EDataController
     */
    
    private $valid_admin_urls = array("dashboard.php",
                                      "create-anartisi.php",
                                      "view-mathimata.php",
                                      "view-mathites.php");
    
     /*
     * ------------------------------------------------------------------------
     * ------------------------------------------------------------------------
     */
    
    
    /*
     *
     * User Parent FILES
     * activates EDataController
     */
    
    private $valid_parent_urls = array("test.php",
                                       "test-2.php");
    
     /*
     * ------------------------------------------------------------------------
     * ------------------------------------------------------------------------
     */
    
    
    /*
     *
     * User Teacher FILES
     * activates EDataController
     */
    
    
    private $valid_teacher_urls = array("test.php",
                                        "test-2.php");
    
     /*
     * ------------------------------------------------------------------------
     * ------------------------------------------------------------------------
     */
    
    public function __construct(){
        
        
    }
    
    public function __destruct(){
        
        
    }
    
    public static function getValidAdmin(){
        
        return $self::valid_admin_urls;
    }
    
    public static function getValidParent(){
        
        return $self::valid_parent_urls;
    }
    
    public static function getValidTeacher(){
        
        return $self::valid_teacher_urls;
    }
}

?>
