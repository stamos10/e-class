<?php
require "../../Gumnasio/bootstrap.php";

use App\Controllers\ERequestHandler;
use App\Services\EAuthenticatorService;
use App\Services\ERoleAuthenticatorService;
use App\Services\EMessageService;
use App\Controllers\EController;
use App\Controllers\EDataController;


$auth = new EAuthenticatorService();
$auth_role = new ERoleAuthenticatorService($page);
$msg = new EMessageService();
$controller = new EController();
$data_controller = new EDataController();
$router = new ERequestHandler($auth, $auth_role, $msg, $controller, $data_controller, null);
?>