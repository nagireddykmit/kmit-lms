<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
{   
header('location:index.php');
}
// code for action taken on leave
$lid=$_GET['leaveid'];
$eid=$_GET['empid'];
$status=$_GET['status'];   
date_default_timezone_set('Asia/Kolkata');
$sql="update classadjustments set actionstatus=:status where leaveid=:lid and empid=:eid";
$query = $dbh->prepare($sql);
$query->bindParam(':lid',$lid,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$msg="Adjustment updated Successfully";
echo "<script type='text/javascript'> document.location = 'pendingclasses.php'; </script>";
 ?>