<?php

session_start();
$_SESSION['error']="";
include('includes/config.php');
if(isset($_POST['signin']))
{
	
	$uname=$_POST['username'];
	$_SESSION['username']=$_POST['username'];
	$password=md5($_POST['password']);

	if(filter_var($uname, FILTER_VALIDATE_EMAIL))
	{
		$sql ="SELECT FirstName, LastName, EmailId,Password,Status,id,EmpId FROM tblemployees WHERE EmailId=:uname and Password=:password";
		$query= $dbh -> prepare($sql);
		$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
		$query-> bindParam(':password', $password, PDO::PARAM_STR);
		$query-> execute();
		$results=$query->fetchAll(PDO::FETCH_OBJ);
		if($query->rowCount() > 0)
		{
			 foreach ($results as $result)
			 {
				$status=$result->Status;
				$_SESSION['empid']=$result->EmpId;
				$_SESSION['eid']=$result->id;
				$_SESSION['emname']= $result->FirstName." ".$result->LastName;
				if($status==0)
				{
					$_SESSION['error']='Your account is Inacitve Please Contact Admin';
					//echo $error;
					echo '<script type="text/javascript">
					window.location.href = "index.php";'; 
				
					echo '</script>';
				}
				else
				{
					$_SESSION['emplogin']=$_POST['username'];
					
					echo "<script type='text/javascript'> document.location = 'emp-changepassword.php'; </script>";
				} 
			}
		}
		else {
			$_SESSION['error']='Invalid Credentials';
			
			echo '<script type="text/javascript">
			window.location.href = "index.php";'; 
			
			echo '</script>';
		}
    //echo 'This is a valid email address.';
    //echo filter_var($uname, FILTER_VALIDATE_EMAIL);
    //exit("E-mail is not valid");
	}
	else
	{
		if($uname=='admin')
		{
			$sql ="SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
			$query= $dbh -> prepare($sql);
			$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
			$query-> bindParam(':password', $password, PDO::PARAM_STR);
			$query-> execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);
			if($query->rowCount() > 0)
			{
			$_SESSION['alogin']=$_POST['username'];
			echo "<script type='text/javascript'> document.location = 'changepassword.php'; </script>";
			} 
			else
			{ 
			$_SESSION['error']='Invalid Credentials';
			echo '<script type="text/javascript">
			window.location.href = "index.php";';
			echo '</script>';

			}
		}
		
		else if($uname=='principal')
		{
			$sql ="SELECT username,password FROM principal WHERE username=:uname and password=:password";
			$query= $dbh -> prepare($sql);
			$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
			$query-> bindParam(':password', $password, PDO::PARAM_STR);
			$query-> execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);
			if($query->rowCount() > 0)
			{
			$_SESSION['alogin']=$_POST['username'];
			echo "<script type='text/javascript'> document.location = 'principal.php'; </script>";
			} 
			else
			{ 
			$_SESSION['error']='Invalid Credentials';
			echo '<script type="text/javascript">
			window.location.href = "index.php";';
			echo '</script>';

			}
		}
		else
		{
			$sql ="SELECT UserName, department FROM hod WHERE UserName=:uname and Password=:password";
			$query= $dbh -> prepare($sql);
			$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
			$query-> bindParam(':password', $password, PDO::PARAM_STR);

			$query-> execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);
			if($query->rowCount() > 0)
			{
				foreach ($results as $result)
			 {
				$_SESSION['alogin']=$result->UserName;
				$_SESSION['dept']= $result->department;
			  } 

				echo "<script type='text/javascript'> document.location = 'hod.php'; </script>";
			} 
			else
			{
			  $_SESSION['error']='Invalid Credentials';
			echo '<script type="text/javascript">
			window.location.href = "index.php";';
			echo '</script>';

			}

		}
		//echo 'Invalid email address.';
	}

}

?>