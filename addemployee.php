<?php
session_start();
error_reporting(0);
include('includes/config.php');

/*if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{*/

if(isset($_POST['add']))
{
$empid=$_POST['empcode'];
$fname=$_POST['firstName'];
$lname=$_POST['lastName'];   
$email=$_POST['email']; 
$password=md5($_POST['password']); 
$gender=$_POST['gender']; 
$dob=$_POST['dob']; 
$department=$_POST['department']; 
$designation=$_POST['designation'];
$address=$_POST['address']; 
//$city=$_POST['city']; 
//$country=$_POST['country']; 
$mobileno=$_POST['mobileno']; 
$adharno=$_POST['adharno']; 
$pancardno=$_POST['pancardno']; 
$jntu_uid=$_POST['jntu_uid']; 
$aicteid=$_POST['aicteid']; 
$doj=date($_POST['doj']);
$status=0;

$sql="INSERT INTO tblemployees(EmpId,FirstName,LastName,EmailId,Password,Gender,Dob,Department,Designation,Address,Phonenumber,Status,doj,adharno,pancardno,jntu_uid,aicteid) VALUES(:empid,:fname,:lname,:email,:password,:gender,:dob,:department,:designation,:address,:mobileno,:status,:doj,:adharno,:pancardno,:jntu_uid,:aicteid)";
$query = $dbh->prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':department',$department,PDO::PARAM_STR);
$query->bindParam(':designation',$designation,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
//$query->bindParam(':city',$city,PDO::PARAM_STR);
//$query->bindParam(':country',$country,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':doj',$doj,PDO::PARAM_STR);
$query->bindParam(':adharno',$adharno,PDO::PARAM_STR);
$query->bindParam(':pancardno',$pancardno,PDO::PARAM_STR);
$query->bindParam(':jntu_uid',$jntu_uid,PDO::PARAM_STR);
$query->bindParam(':aicteid',$aicteid,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
//$msg="Employee record added Successfully";
echo '<script type="text/javascript">'; 
echo 'alert("Employee record added Successfully");'; 
echo 'window.location.href ="index.php";';
echo '</script>';

}
else 
{
/*echo '<script type="text/javascript">'; 
echo 'alert("Something went wrong. Please try again");'; 
echo 'window.location.href = "index.php";';
echo '</script>';*/

$error="Something went wrong. Please try again";

}

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title> Add Employee</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template"/>
        <meta name="keywords" content="admin,dashboard"/>
        <meta name="author" content="Steelcoders"/>
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
    <script type="text/javascript">
function valid()
{
if(document.addemp.password.value!= document.addemp.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.addemp.confirmpassword.focus();
return false;
}
return true;
}
</script>

<script>
function checkAvailabilityEmpid() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'empcode='+$("#empcode").val(),
type: "POST",
success:function(data){
$("#empid-availability").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

<script>
function checkAvailabilityEmailid() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#email").val(),
type: "POST",
success:function(data){
$("#emailid-availability").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
</head>
    <body>
		<header>
		<?php
		require_once('header.php');
		?>
	</header>
	<style>
	.card-container.card {
    max-width: 950px;
    padding: 15px 15px;
	background: linear-gradient(180deg, rgba(235,192,156,1) 0%, rgba(232,117,28,1) 100%);
	}
	.container-fluid.card {
    max-width: 850px;
    padding: 15px 15px;
	background: linear-gradient(180deg, rgba(222,228,235,1) 0%, rgba(69,174,207,1) 100%);
	}
	.button.card-container.card {
    max-width: 85px;
	background: linear-gradient(180deg, rgba(222,228,235,1) 0%, rgba(69,174,207,1) 100%);
	}
	</style>
	<div class="card card-container">                             
	<section id="registration">
	<h3 style="font-family:Georgia ;font-size:25px;color:#2F4F4F;" align="center">NEW EMPLOYEE REGISTRATION </h3>
		   <form align="center"class="form-signin" id="example-form" method="post" name="addemp">                              
     <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
		<div class="card card-container container-fluid">  
		   <div style="width:48%;float:left;">  
					<input placeholder="Employee ID" class="form-control" name="empcode" id="empcode" onBlur="checkAvailabilityEmpid()" type="text" autocomplete="off" required>
					<span id="empid-availability" style="font-size:12px;"></span> 
					<input placeholder="First Name" class="form-control" id="firstName" name="firstName" type="text" required>
					<input placeholder="Last Name" class="form-control" id="lastName" name="lastName" type="text" autocomplete="off" required>
					<input placeholder="Email ID" class="form-control" name="email" type="email" id="email" onBlur="checkAvailabilityEmailid()" autocomplete="off" required>
					<span id="emailid-availability" style="font-size:12px;"></span> 
					<input placeholder="Enter Password" class="form-control" id="password" name="password" type="password" autocomplete="off" required>
					<input placeholder="Confirm Password" class="form-control" id="confirm" name="confirmpassword" type="password" autocomplete="off" required>
					<input placeholder="Enter Mobile number" class="form-control" id="mobileno" name="mobileno" type="tel" maxlength="10" autocomplete="off" required>
					<br><select class="form-control" name="gender" autocomplete="off" required>
						<option value="">Gender...</option>                                          
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
					<span style="color:#103153;font-size:20px;font-weight: bold;">Date Of Birth</span> <input id="birthdate" name="dob" type="date" class="datepicker" autocomplete="off" required>
		</div>

		<div style="width:48%;float:right">
				<select  class="form-control"name="department" autocomplete="off" required>
				<option value="">Department...</option>
				<?php $sql = "SELECT DepartmentName from tbldepartments";
				$query = $dbh -> prepare($sql);
				$query->execute();
				$results=$query->fetchAll(PDO::FETCH_OBJ);
				$cnt=1;
				if($query->rowCount() > 0)
				{
				foreach($results as $result)
				{   ?>                                            
				<option value="<?php echo htmlentities($result->DepartmentName);?>"><?php echo htmlentities($result->DepartmentName);?></option>
				<?php }} ?>
				</select>
				<br><select class="form-control" id="designation" name="designation" autocomplete="off" required>
				<option value="">Designation</option>
				<option value="Assistant Professor">Assistant Professor</option>
				<option value="Associate Professor">Associate Professor</option>
				<option value="Professor">Professor</option>
				</select>
				<br>
				<input placeholder="Enter your address" class="form-control" id="address" placeholder="" class="form-control" name="address" type="text" autocomplete="off" required>
				<input placeholder="Enter your AADHAR number" class="form-control"id="adharno" name="adharno" type="text" maxlength="12" autocomplete="off" required>
				<input placeholder="Enter your PAN number" class="form-control" id="pancardno" name="pancardno" type="text" maxlength="10" autocomplete="off" required>
				<input placeholder="Enter your JNTU UID" class="form-control" id="jntu_uid" name="jntu_uid" type="text" maxlength="20" autocomplete="off" required>
				<input placeholder="Enter your AICTE ID" class="form-control" id="aicteid" name="aicteid" type="text" maxlength="20" autocomplete="off" required>
				<span style="color:#103153;font-size:20px;font-weight: bold;">Date Of Joining</span> <input id="dateofjoining" name="doj" type="date" class="datepicker" autocomplete="off" required>
			</div>
		</div>	
			<button type="submit" class="waves-effect waves-light btn indigo m-b-xs" style="margin:auto;width:150px;" name="add"  id="add" align="center" onclick="return valid();">SUBMIT</button>
		</form>
	</div>

<!-- Footer -->
		<?php
		require_once('footer.php');
		?>                                  
 </body>
</html>
<?php  ?> 