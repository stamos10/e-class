<?php
use App\Controllers\ERouteGenerator;
?>
<ul class="assist-menu">
<li><a href="<?php echo ERouteGenerator::set_url("dashboard.php");?>" class="link">Αναρτήσεις </a></li>
<li><a href="<?php echo ERouteGenerator::set_url("create-anartisi.php");?>" class="link">Νέα Αναρτηση</a></li>
<li><a href="<?php echo ERouteGenerator::set_url("view-mathimata.php");?>" class="link">Μαθήματα</a></li>
<li><a href="<?php echo ERouteGenerator::set_url("view-mathites.php");?>" class="link">Μαθητές</a></li>
<li><a href="<?php echo ERouteGenerator::set_url("view-ekpaideutikoi.php");?>" class="link">Εκπαιδευτικοί</a></li>
<li><a href="" class="link">Χρήστες</a></li>
</ul> 