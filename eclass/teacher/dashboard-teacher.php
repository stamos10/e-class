<?php
//session_start();
$page = "test.php";
require "../../Gumnasio/loader.php";
use App\Controllers\ERouteGenerator;
?>
<!DOCTYPE html>

<html lang="el">
<head>
  <?php require("../inc/meta1.php"); ?>
  <title>Ανακοινώσεις</title>
  <meta name="description" content="Ανακοινώσεις του Γυμνασίου">
  <?php require("../inc/meta2.php"); ?>
  <link rel="canonical" href="https://sgschool.gr/gumnasio/anakoinwseis">
</head>
<body>
<?php require("../partial/header-teacher.php"); ?>
<div class="container">
<h1><i class="far fa-hand-point-right"></i>&nbsp;This is the page title</h1>
<div class="article">
 <div class="tools">
   <a href="" class="a-tools"><i class="fas fa-trash-alt"></i></a>
   <a href="" class="a-tools"><i class="fas fa-edit"></i></a>
 </div>
 <p class="clear"></p>
 <h2><i class="fab fa-spotify"></i>&nbsp;This is a smaller title</h2>
 <h3 class="dte">Date of Post: 07/07/2019<h3>
 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever</p>
 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever</p>
 <a href="">This is a link</a>
</div>
</div>
<?php require("../partial/footer.php"); ?>
<?php require("../inc/js-footer.php"); ?>
</body>
</html>