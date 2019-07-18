<?php
$message = null;

if(!empty($_GET['message'])){
$message = $_GET['message'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Server Error</title>
<meta name="description" content="">    
<?php require $_SERVER['DOCUMENT_ROOT']."/gumnasio/eclass/inc/meta1.php";?>
<?php require $_SERVER['DOCUMENT_ROOT']."/gumnasio/eclass/inc/meta2.php";?>
<style>
    
.fa-frown{
    
    font-size: 24px;
    color: #FFFFFF;
    font-weight: 600;
    margin: 0 20px;
}
.alert-danger{
 
 margin: 80px 0;
 padding: 40px 30px;
 text-align: center;
 background-color: #da6a8a;
 color: #FFFFFF;
}
</style>
</head>
<body>

<div class="container">
<div class="alert alert-danger">
<?php
if ($message != null){
echo '<i class="far fa-frown"></i>&nbsp;&nbsp;' . $message;
}
?>   
</div>
</div>
<?php require $_SERVER['DOCUMENT_ROOT']."/gumnasio/eclass/inc/js-footer.php";?>
</body>
</html>