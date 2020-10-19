<?php
session_start();
error_reporting(0);
include('includes/config.php');
// Code for change password 
if(isset($_POST['change']))
    {
$newpassword=md5($_POST['newpassword']);
$empid=$_SESSION['empid'];

$con="update tblemployees set Password=:newpassword where id=:empid";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':empid', $empid, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
//$msg="Your Password succesfully changed";
echo '<script type="text/javascript">'; 
echo 'alert("Your Password succesfully changed");'; 
echo 'window.location.href = "index.php";';
echo '</script>';
}

?><!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>ELMS | Password Recovery</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
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
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
        
    </head>
    <body > 
			<header>
		<?php
		require_once('header.php');
		?>
	</header>
	<style>	

	.card-container.card {
    max-width: 650px;
    padding: 5px 5px;
	background: linear-gradient(180deg, rgba(222,228,235,1) 0%, rgba(69,174,207,1) 100%);
	}

	</style>
	<div class="container">
	<div class="card card-container">     
	<h3 style="color:black;text-align:center">EMPLOYEE PASSWORD RECOVERY</h3>
					 <?php if($msg){?><div class="succWrap"><strong>Success </strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
					   <form class="form-signin" name="signin" method="post">
							   <br><input id="empid" style="margin:auto;width:500px;" placeholder="Enter Employee ID" class="form-control" type="text" name="empid" class="validate" autocomplete="off" required >
							   <br><input id="password" style="margin:auto;width:500px;" placeholder="Enter Email ID" class="form-control"  type="text" class="validate" name="emailid" autocomplete="off" required>
							   <br><button type="submit" class="waves-effect waves-light btn indigo m-b-xs" style="margin:auto;width:150px;" name="submit"><b>RESET</b></button>
								<br>
					   </form>
				  </div>
<?php if(isset($_POST['submit']))
{
$empid=$_POST['empid'];
$email=$_POST['emailid'];
$sql ="SELECT id FROM tblemployees WHERE EmailId=:email and EmpId=:empid";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':empid', $empid, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach ($results as $result) {
    $_SESSION['empid']=$result->id;
	header("Location: forgot-password.php#setpassword");
  } 
    ?>

 <div class="card card-container">
          <h3 align="center">CHANGE YOUR PASSWORD </h3>                                     
    <form class="form-signin" name="udatepwd" method="post">
		<input id="password" placeholder="Enter New Passowrd" style="margin:auto;width:500px;" class="form-control" style="width:450px" type="password" name="newpassword" class="validate" autocomplete="off" required>
		<br><input id="password" placeholder="Enter Confirm Passowrd" style="margin:auto;width:500px;" class="form-control" style="width:450px" type="password" name="confirmpassword" class="validate" autocomplete="off" required>
		<br><button type="submit" name="change" style="margin:auto;width:150px;" class="waves-effect waves-light btn indigo m-b-xs" onclick="return valid();"><b>CHANGE</b></button>
		<br>
	</form>
</div>
</div>

<?php } else{ ?>
<div class="errorWrap" style="margin-left: 2%; font-size:22px;">
 <strong>ERROR</strong> : <?php echo htmlentities("Invalid details");
}?></div>
<?php } ?>
<br><br><br><br>
<!-- Footer -->
		<?php
		require_once('footer.php');
		?>     
    </body>
</html>