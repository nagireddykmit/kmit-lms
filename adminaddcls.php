<?php
	error_reporting(1);
	$connect = mysqli_connect("localhost:3306", "root", "root", "finalelms");
	$leaves=$_POST['leavecount'];
	$epid=$_POST['lempid'];
	$Date=$_POST['date'];
	$mnth=date("F", strtotime($Date));
	$employee=$_POST['employees'];
	
	$sql1 = "INSERT INTO adminaddclcount (eid,employees,leavetype,monthname,cldate,clcount )VALUES ('$epid', '$employee','cl', '$mnth','$Date','$leaves')";

if (mysqli_query($connect, $sql1))
	{
  echo "New record created successfully";
	}
	
	$sql='select * from '.$mnth.' where empid='.$epid;
	$result = mysqli_query($connect, $sql);
	
	$row=mysqli_fetch_assoc($result);
	$sql2 = "none";
	
		if($row['cl'] < 0){
			$sql="update ".$mnth." set cl=0, cl=cl+".$leaves." , icl=icl+".$leaves." where empid=".$epid;
			$sql2 = "update tblavailable set cl=0, cl=cl+".$leaves." where empid=".$epid;
		}
		else{
			$sql="update ".$mnth." set cl=cl+".$leaves.", icl=icl+".$leaves." where empid=".$epid;
			$sql2 = "update tblavailable set cl=cl+".$leaves." where empid=".$epid;
		}
	mysqli_query($connect,$sql);
	mysqli_query($connect,$sql2);
	
	echo '<script type="text/javascript">'; 
	echo 'alert("Leaves added successfully");'; 
	echo 'window.location.href = "changepassword.php";';
	echo '</script>';
?>