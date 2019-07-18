<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
}
}
require "../../loader-views.php";
/*
require "EDispatcher.php";
require "../Models/Connection.php";
require "../Models/EAnartisi.php";
require "../Models/EAnartisiDAO.php";
require "../Models/FormHandler.php";


require "../Services/EAuthenticatorService.php";
require "../Services/ERoleAuthenticatorService.php";
require "../Services/EMessageService.php";
require "../Routes/EActions.php";
require "../Routes/ERoutes.php";
require "EController.php";
require "EDataController.php";
require "ERequestHandler.php";

$page = "";

if(isset($_GET['page'])){
$page = ($_GET['page']);
}

if(isset($_POST['page'])){
$page = ($_POST['page']);
}
$auth = new App\Services\EAuthenticatorService();
$auth_role = new App\Services\ERoleAuthenticatorService($page);
$msg = new App\Services\EMessageService();
$controller = new App\Controllers\EController();
$data_controller = new App\Controllers\EDataController();
$router = new App\Controllers\ERequestHandler($auth, $auth_role, $msg, $controller, $data_controller);
*/
?>