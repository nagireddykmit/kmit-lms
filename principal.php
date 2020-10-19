<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
if(isset($_POST['add']))
{
$deptname=$_POST['departmentname'];
$deptshortname=$_POST['departmentshortname'];
$deptcode=$_POST['deptcode'];   
$sql="INSERT INTO tbldepartments(DepartmentName,DepartmentCode,DepartmentShortName) VALUES(:deptname,:deptcode,:deptshortname)";
$query = $dbh->prepare($sql);
$query->bindParam(':deptname',$deptname,PDO::PARAM_STR);
$query->bindParam(':deptcode',$deptcode,PDO::PARAM_STR);
$query->bindParam(':deptshortname',$deptshortname,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
//$msg="Department Created Successfully";
echo '<script type="text/javascript">'; 
echo 'alert("Department Created Successfully");'; 
echo 'window.location.href = "principal.php";';
echo '</script>';

}
else 
{
echo '<script type="text/javascript">'; 
echo 'alert("Something went wrong. Please try again");'; 
echo 'window.location.href = "principal.php";';
echo '</script>';
//$error="Something went wrong. Please try again";

}

}
}
    ?>
	<?php
	if(isset($_POST['addleavetype']))
{
$leavetype=$_POST['leavetype'];
$description=$_POST['description'];
$sql="INSERT INTO tblleavetype(LeaveType,Description) VALUES(:leavetype,:description)";
$query = $dbh->prepare($sql);
$query->bindParam(':leavetype',$leavetype,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo '<script type="text/javascript">'; 
echo 'alert("Leave type added Successfully");'; 
echo 'window.location.href = "changepassword.php";';
echo '</script>';

//$msg="Leave type added Successfully";
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
  <meta charset="utf-8">
  <meta charset="utf-8">
   <title>PRINCIPAL HOME PAGE</title>
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

  <!--==========================
  Header
  ============================-->
 <header>
<!-- #nav-menu-container -->
		<?php
		require_once('principalheader.php');
		?>
     </header>
  
  
 
<!-- #header -->

  <!--==========================
    Hero Section
  ============================-->
  <div class="container">
	 <br><br><br><br><br><br><br><br>
      <h1 align="center" style="font-family:Bookman Old Style;">WELCOME TO PRINCIPAL PORTAL</h1>
	  <h3 style="font-family:Constantia;color:#2F4F4F;" align="center">Employee Leave Management System </h3>
	 <br><br><br><br><br><br><br><br>

	<br><br><br><br><br><br>
     <!--==========================
      About change password
    ============================-->
     <section id="about">
	 <div class="container">
	 <br><br><br>
        <div class="card card-container">
           
	  <h3 style="font-family:Georgia;color:#2F4F4F;" align="center">CHANGE PASSWORD</h3>
       <br>  
           <form class="form-signin" name="chngpwd" action="principalchangepassword.php" method="post">
			   <?php if(isset($error1)){?> <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
				
				else if(isset($_SESSION['msg1'])){?><div class="successWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
				<input id="password" type="password"  class="form-control" autocomplete="off" name="password" placeholder="Current Password" required>
				<br><input id="password1" type="password" name="newpassword" class="form-control" autocomplete="off" placeholder="New Password" required>
				<br><input id="password2" type="password" name="confirmpassword" class="form-control" autocomplete="off" placeholder="Confirm Password" required>
				<br><button type="submit" name="change" value="Change" onclick="return valid();" class="waves-effect waves-light btn indigo m-b-xs" style="margin:auto;width:120px;">CHANGE</button>
            </form><!-- /form -->
       </div>
	   </div>
                           
    
	 </section>
	 
<br><br><br><br><br><br>
<br><br><br><br><br><br>
	 

	  <!--==========================
      About add ccl's
    ============================-->
	  <section id="viewdepartments">
		   <div class="container">
					<h2 style="font-family:Georgia;color:#000000;" align="center">Department Information</h2>
	   <table class="table table-striped table-responsive table-bordered" id="example" cellspacing="0" style="table-layout: auto;width: 100%;" >
			<thead>
                                        <tr>
										<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">SNO</th>
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">DepartmentName</th>
											<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">DepartmentShortName</th>
											<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">DepartmentCode</th>                                            
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php 
$sql="select *from tbldepartments";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                                        <tr>
                                            <td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"> <?php echo htmlentities($cnt);?></td>
                                            <td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"> <?php echo htmlentities($result->DepartmentName);?></td>
											<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"> <?php echo htmlentities(strtoupper($result->DepartmentShortName)); ?></td>
											<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"> <?php echo htmlentities($result->DepartmentCode);?></td>
                                        </tr>
                                         <?php $cnt=$cnt+1;} }?>
                                    </tbody>
                                </table>
</div>
	 
	
	  </section>
</div><!-- #hero -->	 

        <style>
	th {
	  font-size: 20px;
	  cursor: pointer;
	  background-color: coral;
	}
.icon-update {
    color: #0000FF;
}
.icon-valid {
    color: #008000;
}
.icon-invalid {
    color: #FF0000;
}
</style>
  
<!-- Footer -->
		<?php
		require_once('footer.php');
		?>

</body>
</html>
