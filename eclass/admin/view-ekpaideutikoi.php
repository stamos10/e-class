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

$page = "view-ekpaideutikoi.php";
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
<h1><i class="far fa-hand-point-right"></i>&nbsp;Προβολή Εκπαιδευτικών</h1>

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

</div>


<div id="template-edit-holder">
<div class="clos" id="close-a">X</div>
<p class="clear"></p>
<h2>Επεξεργασία Εκπαιδευτικού</h2>

<div class="form-group">
<label>Επώνυμο:</label>
<input type="text" class="form-control" name="lastname" id="lastname"/>
<p class="form-error">This a form input error</p>
</div>

<div class="form-group">
<label>Όνομα:</label>
<input type="text" class="form-control" name="firstname" id="firstname"/>
<p class="form-error">This a form input error</p>
</div>

<div class="form-group">
<label>Email:</label>
<input type="text" class="form-control" name="email" id="email"/>
<p class="form-error">This a form input error</p>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label>Ειδικότητα:</label>
<select class="form-control" name="eidikotita" id="eidikotita">
<option value="not_ready">Παρακαλώ Επιλέξτε</option>
<option value="filologos">Φιλόλογος</option>
<option value="mathimatikos">Μαθηματικός</option>
</select>
</div>
</div>
</div>

<input type="hidden" name="ekpaideutikos_id" id="ekpaideutikos-id"/>
<div class="form-group">
<button class="btn btn-primary pull-right" id="update" style="margin:3px;">Ανανέωση</button>
<button class="btn btn-warning pull-right" id="close-b" style="margin:3px;">Κλείσιμο</button>
</div>
<p class="clear"></p>
</div>

<div id="loading"></div>
</div>
<input type="hidden" name="action" id="action"/>
<input type="hidden" name="page" id="page" value="<?php echo $page;?>"/>
<?php require("../partial/footer.php"); ?>
<?php require("../inc/js-footer.php"); ?>
<script src="modules/ekpaideutikoi.js"></script>
<script src="js/menu-active.js"></script>
</body>
</html>