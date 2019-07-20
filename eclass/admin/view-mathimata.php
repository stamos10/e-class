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

$page = "view-mathimata.php";
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
<h1><i class="far fa-hand-point-right"></i>&nbsp;Προβολή Μαθημάτων</h1>

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

<div id="template-single-holder" class="table-responsive">
<div class="clos" id="close-a">X</div>
<p class="clear"></p>
<h2 id="mathima-title">This is the mathima title</h2>
<p class="math-label-b" id="mathima-taksi">Taksi</p>
<p class="math-label-b" id="mathima-tmima">Tmima</p>
<p class="math-label-b" id="teacher-fullname">Teacher fullname</p>
<h4>Κατάσταση Μαθητών</h4>
<table class="mathites table" id="mathites">
<tr class="warning">
<td>Επώνυμο</td>
<td>Όνομα</td>
<td>Πατρώνυμο</td>
</tr>
</table>
<div class="clos" id="close-b"><button class="btn btn-warning">Κλείσιμο</button></div>
<p class="clear"></p>
</div>

<div id="template-edit-holder" class="table-responsive">
<div class="clos" id="close-c">X</div>
<p class="clear"></p>
<h2>Επεξεργασία Μαθήματος</h2>

<div class="form-group">
<label>Τίτλος Μαθήματος:</label>
<input type="text" class="form-control" name="title" id="title"/>
<p class="form-error">This a form input error</p>
</div>

<div class="form-group">
<label>Τμήμα:</label>
<select class="form-control" name="tmima" id="tmima">
<option value="not_ready">Παρακαλώ Επιλέξτε</option>
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
<label>Όνομα Καθηγητή:</label>
<input type="text" class="form-control" name="teacher_firstname" id="teacher-firstname"/>
<p class="form-error">This a form input error</p>
</div>

<div class="form-group">
<label>Επώνυμο Καθηγητή:</label>
<input type="text" class="form-control" name="teacher_lastname" id="teacher-lastname"/>
<p class="form-error">This a form input error</p>
</div>

<input type="hidden" name="mathima_id" id="mathima-id"/>

<div class="form-group">
<button class="btn btn-primary pull-right" id="update" style="margin:3px;">Ανανέωση</button>
<button class="btn btn-warning pull-right" id="close-d" style="margin:3px;">Κλείσιμο</button>
</div>
<p class="clear"></p>
</div>

<div id="loading"></div>
</div>
<input type="hidden" name="action" id="action"/>
<input type="hidden" name="page" id="page" value="<?php echo $page;?>"/>
<?php require("../partial/footer.php"); ?>
<?php require("../inc/js-footer.php"); ?>
<script src="modules/mathimata.js"></script>
<script src="js/menu-active.js"></script>
</body>
</html>