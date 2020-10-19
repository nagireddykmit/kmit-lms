<?php
session_start();
$_SESSION['selectdate']=$_GET['month'];
header("Location: hoddaywiseleavehistory.php?fromdate=".$_GET['month']);
?>