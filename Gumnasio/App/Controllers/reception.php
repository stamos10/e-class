<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$page = "";
$request = "";
if(isset($_GET['page'])){
$page = ($_GET['page']);
}

if(isset($_POST['page'])){
$page = ($_POST['page']);
}

$json = file_get_contents('php://input');
$request = json_decode($json);
if($request){
if($request->action != null){
$request = $request->action;
$page = $request->page;
}
}
require "../../loader-views.php";

?>