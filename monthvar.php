<?php
session_start();
$_SESSION['month']=$_GET['month'];
header("Location: monthlyreport.php?month=".$_GET['month']);
?>