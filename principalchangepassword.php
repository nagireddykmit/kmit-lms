<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen(isset($_SESSION['alogin'])==0))
{   
header('location:index.php');
}
// Code for change password 
if(isset($_POST['change']))
{
		$password=md5($_POST['password']);
		$newpassword=md5($_POST['newpassword']);
		$username=$_SESSION['alogin'];
		$sql ="SELECT username, password FROM principal WHERE username=:username and password=:password";
		$query= $dbh -> prepare($sql);
		$query-> bindParam(':username', $username, PDO::PARAM_STR);
		$query-> bindParam(':password', $password, PDO::PARAM_STR);
		$query-> execute();
		$results = $query -> fetchAll(PDO::FETCH_OBJ);
	if($query -> rowCount() > 0)
	{
		$con="update principal set password=:newpassword where username=:username";
		$chngpwd1 = $dbh->prepare($con);
		$chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
		$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
		$chngpwd1->execute();
		//$_SESSION['msg']="Your Password succesfully changed";
		//header('location:index.php');
		echo '<script type="text/javascript">'; 
		echo 'alert("Your Password succesfully changed");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
	}
	else {
		//$_SESSION['error']="Your current password is wrong";   
		echo '<script type="text/javascript">'; 
		echo 'alert("Your current password is wrong");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';		
	}
}
?>