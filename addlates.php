<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST['add']))
{
    $epid=$_POST['lempid'];
	$date=$_POST['dates'];
	//$mnth=$_POST['monthname'];;
	$employee=$_POST['employees'];
	$lates=1;
	$mname=date("F",strtotime($date));
$sql1="UPDATE  ".$mname." set lates=lates+1 where empid=:epid";
$query = $dbh->prepare($sql1);
$query->bindParam(':epid',$epid,PDO::PARAM_STR);
$exe=$query->execute();

	$sql = "INSERT INTO addlates (empid,empname,lates,monthname,dates)VALUES(:epid,:employee,:lates,:mnth,:date)";

$query = $dbh->prepare($sql);
$query->bindParam(':epid',$epid,PDO::PARAM_STR);
$query->bindParam(':employee',$employee,PDO::PARAM_STR);
$query->bindParam(':lates',$lates,PDO::PARAM_STR);

$query->bindParam(':mnth',$mname,PDO::PARAM_STR);
$query->bindParam(':date',$date,PDO::PARAM_STR);

$exe=$query->execute();


if($exe)
{
echo '<script type="text/javascript">'; 
echo 'alert("Lates added successfully");'; 
echo 'window.location.href = "addlates.php";';
echo '</script>';

//$msg="Leave applied successfully";
}
else 
{
echo '<script type="text/javascript">'; 
echo 'alert("Something went wrong. Please try again");'; 
echo 'window.location.href = "changepassword.php";';
echo '</script>';
//$error="Something went wrong. Please try again";
}

}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ADD Lates</title>
  <meta charset="utf-8">
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
<script>
$(document).ready(function(){
			$("#lempid").change(function(){
				var leid = $("#lempid").val();
				$.ajax({
					url: 'loademp.php',
					method: 'post',
					data: 'leid=' + leid
				}).done(function(employees){
					console.log(employees);
					employees = JSON.parse(employees);
					$('#employees').empty();
					employees.forEach(function(employee){
						$('#employees').append('<option>' + employee.FirstName +' '+ employee.LastName + '</option>')
					})
				})
			})
			})
</script>
<body>
    <header>
	<!-- #nav-menu-container -->
		<?php
		require_once('adminheader.php');
		?>
     </header><!-- #header -->
	 <div class="container">
        <div class="card card-container">
           <h3 style="font-family:Georgia;color:#2F4F4F;" align="center">ADD Late's</h3>
		   <form align="center" class="form-signin"  method="post"  name="addlates">

			 <?php if(isset($error1)){?> <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
							
			else if(isset($_SESSION['msg1'])){?><div class="successWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> 
			
			</div><?php }?>
			<br>
					<select name='lempid' class="form-control" id="lempid">
						<option selected="" disabled="">Select Employee ID</option>
						<?php 
						require 'loademp.php';
						$lempid = loademployees();
						foreach ($lempid as $empid) {
						echo "<option id='".$empid[EmpId]."' value='".$empid[EmpId]."'>".$empid[EmpId]."</option>";
					}
				 ?>
		   </select>
		   <br>
			<select class="form-control" id="employees" name="employees">
							<option selected="" disabled="">Faculty Name</option>           	
						 </select>
			<br>
			<input placeholder="Select Date" id="dates" class="form-control" name="dates" class="masked" type="date" data-inputmask="'alias': 'date'" required>
			<br>
			<input type="submit" name="add" class="waves-effect waves-light btn indigo m-b-xs" value="ADD">
			<input type="reset" name="reset" class="waves-effect waves-light btn indigo m-b-xs" value="RESET">
		</form>
		</div>
	</div>
		<?php
		require_once('footer.php');
		?>
</body>
</html>