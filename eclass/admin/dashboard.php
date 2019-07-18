<?php
if(session_id() == ''){
session_start();
}
$message = null;
$error = null;

if(!empty($_GET['message'])){
$message = $_GET['message'];
}

if(!empty($_GET['error'])){
$error = $_GET['error'];
}
$page = "dashboard.php";
require "../../Gumnasio/loader.php";
use App\Controllers\ERouteGenerator;
?>
<!DOCTYPE html>

<html lang="el">
<head>
  <?php require("../inc/meta1.php"); ?>
  <title>Διαχείριση</title>
  <meta name="description" content="">
  <?php require("../inc/meta2.php"); ?>
  <link rel="canonical" href="https://sgschool.gr/">
</head>
<body>
<?php require("../partial/header-admin.php"); ?>
<div class="container-left">
<?php require("../partial/admin-assist-menu.php"); ?>
</div>
<div class="container">
<h1><i class="far fa-hand-point-right"></i>&nbsp;Προβολή Αναρτήσεων</h1>

<div class="row" id="messages-area">
<div class="col-md-12">
<?php
if($message != null){
echo '<div class="alert alert-success">' . $message . '</div>';
}
if($error != null){
echo '<div class="alert alert-danger">' . $error . '</div>';
}
?>
</div>
</div>

<div id="template-holder">

</div>

<div id="template-single-holder">
<div class="article-single" id="article-single">
 <div class="clos" id="close-a">X</div>
 <p class="clear"></p>
 <h2 id="article-title"></h2>
 <h3 class="cat" id="article-type"></h3>
 <h3 class="per" id="article-sender"></h3>
 <h3 class="dte" id="article-date"></h3>
 <div class="anart-content" id="article-content"></div>
 <div class="clos" id="close-b"><button class="btn btn-warning">Κλείσιμο</button></div>
 <p class="clear"></p>
</div>  
</div>

<div id="template-edit-holder">
<div class="clos" id="close-c">X</div>
<h2>Επεξεργασία Ανάρτησης</h2>

<div class="form-group">
<label>Είδος Ανακοίνωσης:</label>
<input type="text" class="form-control" name="type" id="type" value="Ανακοίνωση" readonly/>
<p class="form-error">This a form input error</p>
</div>

<div class="form-group">
<label>Τίτλος:</label>
<input type="text" class="form-control" name="title" id="title"/>
<p class="form-error">This a form input error</p>
</div>

<div class="form-group">
<label>Τμήμα:</label>
<select class="form-control" name="tmima" id="tmima">
<option value="not_ready">Παρακαλώ Επιλέξτε</option>
<option value="all">Όλα</option>
<option value="A1">Α1</option>
<option value="A2">Α2</option>
<option value="A3">Α3</option>
<option value="A4">Α4</option>
<option value="B1">Β1</option>
<option value="B2">Β2</option>
<option value="B3">Β3</option>
<option value="B4">Β4</option>
<option value="C1">Γ1</option>
<option value="C2">Γ2</option>
<option value="C3">Γ3</option>
<option value="C4">Γ4</option>
</select>
<p class="form-error">This a form input error</p>
</div>

<div class="form-group">
<label>Αρχικό Περιεχόμενο:</label>
<textarea class="form-control" rows="5" name="content_init" id="content-init"></textarea>   
<p class="form-error">This a form input error</p>
</div>

<div class="form-group">
<label>Περιεχόμενο:</label>
<textarea rows="10" class="form-control" name="content" id="content"></textarea>   
<p class="form-error">This a form input error</p>
</div>
<div class="proigoumeno">
<label>Προηγούμενο Περιεχόμενο</label>
<div id="cont-pro">
 
</div>
</div>
<input type="hidden" name="sender_email" id="sender-email"/>
<input type="hidden" name="action" id="action"/>
<input type="hidden" name="page" id="page"/>

<div class="form-group">
<button class="btn btn-primary pull-right" id="update" style="margin:3px;">Ανανέωση</button>
<button class="btn btn-warning pull-right" id="close-d" style="margin:3px;">Κλείσιμο</button>
</div>
<p class="clear"></p>

</div>

<div id="loading"></div>
</div>
<input type="hidden" name="page" id="page" value="<?php echo $page;?>"/>
<?php require("../partial/footer.php"); ?>
<?php require("../inc/js-footer.php"); ?>
<script src="js/validator.js"></script>
<script src="modules/dashboard.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=a9sa963z6122hbduw2qes131su92d66o0g1iw186aynxrixj"></script>
<script src="js/tiny.js"></script>
<script src="js/menu-active.js"></script>
</body>
</html>