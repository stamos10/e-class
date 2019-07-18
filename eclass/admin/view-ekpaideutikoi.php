<?php
//session_start();
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

<div class="row" style="margin: 30px 0;">
<div class="col-md-3 col-md-offset-9">
<a role="button" class="btn btn-primary btn-block">Εισαγωγή</a>
</div>
</div>

<div class="menu-option">
 <div class="math-tools">
   <a href="" class="a-tools"><i class="fas fa-edit"></i></a>
   <a href="" class="a-tools"><i class="fas fa-trash-alt"></i></a>
 </div>
 <p class="clear"></p>
 <h2>This is the Ekpaideutikos Full Name</h2>
 
 <div class="form-group">
 <label>Επώνυμο:</label>
 <input type="text" class="form-control" name="lastname" id="lastname" value="Strongylis" readonly/>
 </div>
 
 <div class="form-group">
 <label>Όνομα:</label>
 <input type="text" class="form-control" name="firstname" id="firstname" value="Stamatis"/ readonly>
 </div>
 
 <div class="form-group">
 <label>Email:</label>
 <input type="email" class="form-control" name="email" id="email" value="stamos10@otenet.gr" readonly/>
 </div>
 
 <div class="form-group">
 <label>Ειδικότητα:</label>
 <select class="form-control" name="eidikotita" id="eidikotita">
 <option value="filologos">Φιλόλογος</option>
 <option value="mathimatikos">Μαθηματικός</option>
 <option value="mousikos">Μουσικός</option>
 </select> 
 </div>
 
 <div class="form-group">
 <label>Υπεύθυνος Τμήματος:</label>
 <select class="form-control" name="tmima_upethinos" id="tmima_upethinos">
 <option value="not_ready">Κανένα</option>
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
 </div>
 

</div>

</div>
<?php require("../partial/footer.php"); ?>
<?php require("../inc/js-footer.php"); ?>
<script src="js/ekpaideutikoi.js"></script>
</body>
</html>