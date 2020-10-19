<?php
session_start();
$_SESSION['selectdate']=$_GET['month'];
header("Location: daywiseleavehistory.php?fromdate=".$_GET['month']);
?>