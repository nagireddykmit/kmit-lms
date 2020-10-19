<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
// co
 if(isset($_GET['inid']))
{
$id=$_GET['inid'];
$status=0;
$sql = "update tblemployees set Status=:status  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> execute();
header('location:manageemployee.php');
}



//code for active employee
if(isset($_GET['id']))
{
$id=$_GET['id'];
$status=1;
$sql = "update tblemployees set Status=:status  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> execute();
header('location:manageemployee.php');
}
		 ?>
<!DOCTYPE html>
<html lang="en">
<head> <meta charset="utf-8">
  <meta charset="utf-8">
  <title>HOD HOME PAGE</title>
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
		require_once('hodheader.php');
		?>
     </header><!-- #header -->

  <!--==========================
    Hero Section
  ============================-->
  
  
	<div class="container">
	<br><br><br><br><br><br><br>
	<?php
	$dept=$_SESSION['dept'];
	$sql="select DepartmentShortName from tbldepartments  where DepartmentName=:dept";
	  $query = $dbh -> prepare($sql);
	$query->bindParam(':dept',$dept,PDO::PARAM_STR);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	if($query->rowCount() > 0)
	{
		foreach($results as $result){
			$department=$result->DepartmentShortName;
		}
	}
	?>
           
      <?php echo "<h1 align='center'style='font-family:Bookman Old Style;'>WELCOME TO ".$department." HOD PORTAL</h1>"; ?>

	  <h3  style="font-family:Constantia;color:#2F4F4F;" align="center">Employee Leave Management System </h3>
<br><br><br><br><br><br><br><br><br><br><br><br><br>
      <!--<center><a href="#about" class="btn-get-started">Get Started</a></center>-->
    </div>
	 
 <!-- #hero -->


    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
        <div class="card card-container">
		<h3 style="font-family:Verdna;color:#2F4F4F;" align="center"> CHANGE PASSWORD</h3> 
	   <form align="center" class="form-signin" name="chngpwd" method="post"  action="hodchangepassword.php">
					
     <?php if(isset($error1)){?> <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
					
    else if(isset($_SESSION['msg1'])){?><div class="successWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
		<br>							   
		<input id="password" class="form-control" placeholder="Enter Current Password" type="password"  class="validate" autocomplete="off" name="password"  required>
		<br>
		<input id="password" class="form-control" placeholder="Enter New Password" type="password" name="newpassword" class="validate" autocomplete="off" required>
		<br>
		<input id="password" class="form-control" placeholder="Enter Confirm Password" type="password" name="confirmpassword" class="validate" autocomplete="off" required>
		<br>
		<button type="submit" name="change"  class="waves-effect waves-light btn indigo m-b-xs"  style="margin:auto;width:120px;"onclick="return valid();">CHANGE</button>
	</form>

</div>
	<br><br><br><br><br><br>
</section><!-- #about -->
<!-- Footer -->
		<?php
		require_once('footer.php');
		?>
</body>
</html>
<?php }?>