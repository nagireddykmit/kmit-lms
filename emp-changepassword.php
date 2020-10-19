<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{
// Code for change password 
if(isset($_POST['change']))
    {
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$username=$_SESSION['emplogin'];
    $sql ="SELECT Password FROM tblemployees WHERE EmailId=:username and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tblemployees set Password=:newpassword where EmailId=:username";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo '<script type="text/javascript">'; 
echo 'alert("Your Password succesfully changed");'; 
echo 'window.location.href = "emp-changepassword.php";';
echo '</script>';
//$msg="Your Password succesfully changed";
}
else
	{
		
echo '<script type="text/javascript">'; 
echo 'alert("Your current password is wrong");'; 
echo 'window.location.href = "emp-changepassword.php";';
echo '</script>';
//$error="Your current password is wrong";    
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>KMIT ELMS</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
 <style>
  
  .errorWrap
		{
		color:red;
		padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		}
		
		.successWrap
		{
			padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		color:green;
		}
		.look
{
	font-size:168%;
	color: white;
}

		</style>
</head>
<body>
  
  <!--==========================
  Header
  ============================-->
    <header>
<!-- #nav-menu-container -->
		<?php
		require_once('empheader.php');
		?>
     </header><!-- #header -->
		  
     
  <!--==========================
    Hero Section
  ============================-->
 <div class="container">
	<br><br><br><br><br><br><br><br>
	<?php 
$eid=$_SESSION['empid'];
$sql = "SELECT FirstName,LastName,EmpId from  tblemployees where empid=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                   <h2> <p class="look"  align="center" style="font-family:Georgia;color:#2F4F4F;"><b>Welcome to <b><?php echo htmlentities($result->FirstName." ".$result->LastName);?></p></h2>
                        <p class="look"  align="center" style="font-family:Georgia;color:#2F4F4F;"><b> You are Employee ID is <?php echo htmlentities($result->EmpId)?></p>
                         <?php $_SESSION['empid']=$result->EmpId; }} ?>
      
  <!-- #hero -->

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> 	 	
      <!--==========================
      Services Section
    ============================-->
    <section id="about">
        <div class="card card-container">
           
	  <h3 style="font-family:Georgia;color:#2F4F4F;" align="center">Change Password</h3>
       <br>  
           <form class="form-signin" name="chngpwd"  method="post">
			   <?php if(isset($error1)){?> <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
				
				else if(isset($_SESSION['msg1'])){?><div class="successWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
				<input id="password" type="password"  class="form-control" autocomplete="off" name="password" placeholder="Current Password" required>
				<br><input id="password" type="password" name="newpassword" class="form-control" autocomplete="off" placeholder="New Password" required>
				<br><input id="password" type="password" name="confirmpassword" class="form-control" autocomplete="off" placeholder="Confirm Password" required>
				<br><button type="submit" name="change" class="waves-effect waves-light btn indigo m-b-xs" style="margin:auto;width:120px;"onclick="return valid();" >CHANGE</button>
            </form><!-- /form -->
       </div>
	   </div>
  <br><br><br><br>
                           


<!-- Footer -->
		<?php
		require_once('footer.php');
		?>
</body>
</html>
<?php } ?> 