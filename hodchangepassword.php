<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen(isset($_SESSION['alogin'])==0))
{   
header('location:index.php');
}
	
// Code for change password 
else
{
	if(isset($_POST['change']))
	{
		$password=md5($_POST['password']);
		$newpassword=md5($_POST['newpassword']);
		$username=$_SESSION['alogin'];
		$sql ="SELECT UserName, Password FROM hod WHERE UserName=:username and Password=:password";
		$query= $dbh -> prepare($sql);
		$query-> bindParam(':username', $username, PDO::PARAM_STR);
		$query-> bindParam(':password', $password, PDO::PARAM_STR);
		$query-> execute();
		$results = $query -> fetchAll(PDO::FETCH_OBJ);
	if($query -> rowCount() > 0)
	{
		$con="update hod set Password=:newpassword where UserName=:username";
		$chngpwd1 = $dbh->prepare($con);
		$chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
		$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
		$chngpwd1->execute();
		
		echo '<script type="text/javascript">'; 
		echo 'alert("Your Password succesfully changed");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
		//$_SESSION['msg']="Your Password succesfully changed";
		//header('location:index.php');
	}
	else {
		echo '<script type="text/javascript">'; 
		echo 'alert("Your current password is wrong");'; 
		echo 'window.location.href = "index.php";';
		echo '</script>';
		//$_SESSION['error']="Your current password is wrong";    
	}
}

}?>