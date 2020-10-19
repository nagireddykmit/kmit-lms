<?php
session_start();
$_SESSION['selectdate']=$_GET['month'];
header("Location: principal_daywiseleavehistory.php?fromdate=".$_GET['month']);
?>