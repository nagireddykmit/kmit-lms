<?php
	error_reporting(1);
	$connect = mysqli_connect('localhost:3306', 'admin', 'kmit@3306','finalelms');
	$type=$_POST["leavetype"];
	$leaves=$_POST['leavecount'];
	$epid=$_POST['lempid'];
	$mnth=$_POST['month'];
	$Date=$_POST['date'];
	$employee=$_POST['employees'];
	
	$sql1 = "INSERT INTO adminaddleavecount (eid,employees,leavetype,monthname,date,count )VALUES ('$epid', '$employee','$type', '$mnth','$Date','$leaves')";

if (mysqli_query($connect, $sql1))
	{
  echo "New record created successfully";
	}
	
	$sql='select * from '.$_POST["month"].' where empid='.$_POST["lempid"];
	$result = mysqli_query($connect, $sql);
	
	$row=mysqli_fetch_assoc($result);
	$sql2 = "none";
	
	if($type=='cl'){
		$sql="update ".$_POST['month']." set cl=cl+".$leaves." where empid=".$_POST["lempid"];
		$sql2 = "update tblavailable set cl=cl+".$leaves." where empid=".$_POST["lempid"];
	}
	else{
		if($row['cl'] < 0){
			$sql="update ".$_POST['month']." set cl=0, ccl=ccl-cl+".$leaves." where empid=".$_POST["lempid"];
			$sql2 = "update tblavailable set cl=0, ccl=ccl-cl+".$leaves." where empid=".$_POST["lempid"];
		}
		else{
			$sql="update ".$_POST['month']." set ccl=ccl+".$leaves." where empid=".$_POST["lempid"];
			$sql2 = "update tblavailable set ccl=ccl+".$leaves." where empid=".$_POST["lempid"];
		}
	}
	mysqli_query($connect,$sql);
	
	mysqli_query($connect,$sql2);
	
	echo '<script type="text/javascript">'; 
	echo 'alert("Leaves added successfully");'; 
	echo 'window.location.href = "changepassword.php";';
	echo '</script>';
?>