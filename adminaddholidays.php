<?php
	error_reporting(1);
	$connect = mysqli_connect("localhost:3306", "root", "root", "finalelms");

	$holiday=$_POST['holiday'];
	$hdate=$_POST['date'];
	
	$sql = "INSERT INTO holidaystable (occasion, hdate)VALUES ('$holiday','$hdate')";

if (mysqli_query($connect, $sql))
	{
  echo "New record created successfully";
	}
	echo '<script type="text/javascript">'; 
	echo 'alert("Holiday added successfully");'; 
	echo 'window.location.href = "changepassword.php";';
	echo '</script>';
?>