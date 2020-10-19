<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{
$eid=$_SESSION['emplogin'];
if(isset($_POST['update']))
{
$fname=$_POST['firstName'];
$lname=$_POST['lastName'];   
$gender=$_POST['gender']; 
$dob=$_POST['dob']; 
$doj=$_POST['doj']; 
$department=$_POST['department']; 
$address=$_POST['address']; 
$adharno=$_POST['adharno']; 
$pancardno=$_POST['pancardno'];
$jntu_uid=$_POST['jntu_uid']; 
$aicteid=$_POST['aicteid'];  
$designation=$_POST['designation'];
$email=$_POST['email'];
$mobileno=$_POST['mobileno']; 
$sql="update tblemployees set FirstName=:fname,LastName=:lname,Gender=:gender,Dob=:dob,doj=:doj,adharno=:adharno,pancardno=:pancardno,jntu_uid=:jntu_uid,aicteid=:aicteid,Department=:department,Address=:address,Phonenumber=:mobileno,Designation=:designation,EmailId=:email where EmailId=:eid";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':lname',$lname,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':doj',$doj,PDO::PARAM_STR);
$query->bindParam(':department',$department,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':adharno',$adharno,PDO::PARAM_STR);
$query->bindParam(':pancardno',$pancardno,PDO::PARAM_STR);
$query->bindParam(':jntu_uid',$jntu_uid,PDO::PARAM_STR);
$query->bindParam(':aicteid',$aicteid,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':designation',$designation,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
echo '<script type="text/javascript">'; 
echo 'alert("Employee record updated Successfully");'; 
echo 'window.location.href = "emp-changepassword.php";';
echo '</script>';
//$msg="Employee record updated Successfully";
}

 ?><!DOCTYPE html>
<html lang="en">
<head>
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
            <h3 style="font-family:Georgia ;font-size:25px;color:#2F4F4F;" align="center">UPDATE EMPLOYEE REGISTRATION </h3>
        <form class="form-signin" method="post" name="updatemp">
		<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
				<?php 
				$eid=$_SESSION['emplogin'];
				$sql = "SELECT * from  tblemployees where EmailId=:eid";
				$query = $dbh -> prepare($sql);
				$query -> bindParam(':eid',$eid, PDO::PARAM_STR);
				$query->execute();
				$results=$query->fetchAll(PDO::FETCH_OBJ);
				$cnt=1;
				if($query->rowCount() > 0)
				{
				foreach($results as $result)
				{               ?> 
            <div class="card card-container container-fluid">  
		   <div style="width:48%;float:left;"> 
				<span>EMPLOYEE ID<input class="form-control" name="empcode" id="empcode" value="<?php echo htmlentities($result->EmpId);?>" type="text" autocomplete="off" readonly required></span>
				<span>First Name<input class="form-control" id="firstName" name="firstName" value="<?php echo htmlentities($result->FirstName);?>"  type="text" readonly required></span>
				<span>Last Name<input  class="form-control" id="lastName" name="lastName" value="<?php echo htmlentities($result->LastName);?>" type="text" autocomplete="off" readonly  required></span>
				<span>EmailId<input class="form-control"  name="email" type="email" id="email" value="<?php echo htmlentities($result->EmailId);?>" autocomplete="off" required></span>
				<span>Mobile Number<input  class="form-control" id="phone" name="mobileno" type="tel" value="<?php echo htmlentities($result->Phonenumber);?>" maxlength="10" autocomplete="off" required></span>
				<span>Date of Joining<input class="form-control" id="doj" name="doj"  readonly class="datepicker" value="<?php echo htmlentities($result->doj);?>"></span>
				<span>Gender<input class="form-control"  name="gender" autocomplete="off" value="<?php echo htmlentities($result->Gender);?>" readonly></span>
			</div>
		   <div style="width:48%;float:right;"> 
						<span>Date of Birth<input class="form-control" id="birthdate" name="dob"  readonly class="datepicker" value="<?php echo htmlentities($result->Dob);?>"></span>
                       <span>Department<select class="form-control"  name="department" autocomplete="off" readonly>
						<option value="<?php echo htmlentities($result->Department);?>"><?php echo htmlentities($result->Department);?></option>
						<?php $sql = "SELECT Department from tblemployees where EmailId=:eid";
						$query = $dbh -> prepare($sql);
						$query->execute();
						$results=$query->fetchAll(PDO::FETCH_OBJ);
						$cnt=1;
						if($query->rowCount() > 0)
						{
						foreach($results as $result)
						{   ?>                                            
						<option value="<?php echo htmlentities($result->Department);?>"><?php echo htmlentities($result->Department);?></option>
						<?php }} ?>
						</select></span>
                    <span>Designation<input  class="form-control" id="designation" name="designation" type="text"  value="<?php echo htmlentities($result->Designation);?>" autocomplete="off" required></span>
					<span>Address<input class="form-control" id="address" name="address" type="text"  value="<?php echo htmlentities($result->Address);?>" autocomplete="off" required></span>
					<span>Aadhaar Number<input class="form-control" id="adharno" name="adharno" type="text"  value="<?php echo htmlentities($result->adharno);?>" autocomplete="off" required readonly></span>
                    <span>Pan Card Number<input class="form-control"  id="pancardno" name="pancardno" type="text"  value="<?php echo htmlentities($result->pancardno);?>" autocomplete="off" required readonly></span>
					<span>JNTU UID<input class="form-control"  id="jntu_uid" name="jntu_uid" type="text"  value="<?php echo htmlentities($result->jntu_uid);?>" autocomplete="off" required readonly></span>
					<span>AICTE ID<input class="form-control"  id="aicteid" name="aicteid" type="text"  value="<?php echo htmlentities($result->aicteid);?>" autocomplete="off" required readonly></span>
		              </div>
                </div>
				
	<?php }}?>
				<button type="submit" name="update"  id="update" class="waves-effect waves-light btn indigo m-b-xs" style="margin:auto;width:150px;">UPDATE</button>
        </form>
   			</div>
    </div>
	<!-- Footer -->
		<?php
		require_once('footer.php');
		?>    
	</body>
</html>
<?php } ?>