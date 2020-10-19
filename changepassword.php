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
echo 'window.location.href = "changepassword.php";';
echo '</script>';

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
  <title>ADMIN HOME PAGE</title>
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
		require_once('adminheader.php');
		?>
     </header><!-- #header -->
  
  
 
<!-- #header -->

  <!--==========================
    Hero Section
  ============================-->
    <div class="container">
	 <br><br><br><br><br><br><br><br>
      <h1 align="center" style="font-family:Bookman Old Style;">WELCOME TO ADMIN PORTAL</h1>
	  <h3 style="font-family:Constantia;color:#2F4F4F;" align="center">Employee Leave Management System </h3>
	 <br><br><br><br><br><br><br><br>
    </div>

  <main id="main">

    <!--==========================
      About change password
    ============================-->
    <section id="about">
      <div class="container wow fadeIn">
        <div class="card card-container">
           
	  <h3 style="font-family:Georgia;color:#2F4F4F;" align="center">Change Password</h3>
       <br>  
           <form class="form-signin" name="chngpwd" action="changepasswordadmin.php" method="post">
			   <?php if(isset($error1)){?> <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
				
				else if(isset($_SESSION['msg1'])){?><div class="successWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
				<br>
				<input id="password" type="password"  class="form-control" autocomplete="off" name="password" placeholder="Current Password" required>
				<input id="password" type="password" name="newpassword" class="form-control" autocomplete="off" placeholder="New Password" required>
				<input id="password" type="password" name="confirmpassword" class="form-control" autocomplete="off" placeholder="Confirm Password" required>
				<input type="submit" name="change" value="Change" onclick="return valid();" class="btn btn-lg btn-primary btn-block btn-signin">
            </form><!-- /form -->
       </div>
      </div>
                           
    
	 </section>
	 
<br><br><br><br><br><br>
	  
	  <!--==========================
      About add ccl's
    ============================-->
	  <section id="addemployeecclleaves">
	  <div class="container wow fadeIn">
	 <div class="card card-container">      
	  <h3 style="font-family:Georgia;color:#2F4F4F;" align="center">ADD CCL</h3>
	 <!--form -->
	 <form align="center" class="form-signin" name="adminleaves" method="post"  action="adminaddccls.php">
	   <?php if(isset($error1)){?> <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
					
    else if(isset($_SESSION['msg1'])){?><div class="successWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
		<br>
		
				<select name='lempid' class="form-control" id="lempid">
					<option selected="" disabled="">Select EmpID</option>
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
			<input placeholder="" id="mask1" class="form-control" name="date" class="masked" type="date" data-inputmask="'alias': 'date'" required>
				<br>

				<input class="form-control" type="number" name="leavecount" placeholder="CCL Count" min="1">
				<br>
				<input type="submit" name="addleaves" class="waves-effect waves-light btn indigo m-b-xs" value="ADD">
				<input type="reset" name="" class="waves-effect waves-light btn indigo m-b-xs" value="RESET">
		</form>
	</div>
	  </section>
<br><br><br><br><br><br>
	  <section id="quarterwiseleaves">
	  <br><br>
	  <div class="card card-container">      
	  <h3 style="font-family:Georgia;color:#2F4F4F;" align="center">Enter Quarter Wise Leaves</h3>
	  <p style="color:red;" align="center"><b><i> Update Leaves on 1<sup>st</sup> of January, Every New Year</i></b></p>
		<form align="center" class="form-signin" action="updateyear.php" method="POST">
			<input type="number" class="form-control" id="jfm" name="jfm" placeholder="Quarter-1 Leaves" width="100px" required /> 
			<br><input type="number"class="form-control" id="amj" name="amj" placeholder="Quarter-2 Leaves" width="100px" required /> 
			<br><input type="number" class="form-control" id="jas" name="jas" placeholder="Quarter-3 Leaves" width="100px" required /> 
			<br><input type="number" class="form-control" id="ond" name="ond" placeholder="Quarter-4 Leaves" width="100px" required />
			<br><input type="number"  class="form-control" id="al" name="al" placeholder="Academic Leaves" width="100px" required />
			<br><input type="submit" name="submit" class="waves-effect waves-light btn indigo m-b-xs" value="Submit"><br>
		</form>
	</div>
<br><br><br><br><br><br>
	  <section id="updatemonthlyleaves">
	  <div class="card card-container">      
	  <h3 style="font-family:Georgia;color:#2F4F4F;" align="center">Update Monthly Leaves</h3><br>
	  		<h4 style="color:red;" align="center"> Please Update Leaves on 1<sup>st</sup> of Every Month </h4>
			<h4 style="color:red;" align="center"> Please click 'Monthly Leaves' Button </h4><br>
		<form align="center" class="form-signin" action="updatemonthly.php" method="POST">
			<input type="submit" name="submit" class="waves-effect waves-light btn indigo m-b-xs" value="Monthly Leaves">
		</form>
	</div>
<br><br><br><br><br><br><br><br><br><br>
<!--<a href="javascript:ShowContent('abc')" id="anctag">View Document</a><br>
<iframe id="preview" style="display: none;" style="float:right;" src = "ViewerJS/docs/Vacation.pdf" width='600' height='300' allowfullscreen webkitallowfullscreen></iframe>

-->
<script type="text/javascript" language="JavaScript">
function HideContent(d) {
document.getElementById("preview").style.display = "none";
document.getElementById("anctag").href="javascript:ShowContent('abc')";
};
function ShowContent(d) {
document.getElementById("preview").style.display = "";
document.getElementById("anctag").href="javascript:HideContent('abc')";
};

function myFunction1() {	
	var date1 = new Date(); 
	var date2 = new Date(document.getElementById("from").value); 
	
	var Difference_In_Time = date2.getTime() - date1.getTime();  
	var days = Difference_In_Time / (1000 * 3600 * 24); 
	 if(days+1<0){
		alert("Please check From date");
		document.getElementById("from").value="dd-mm-yyyy";
	}
};

function myFunction2() {	
	var date1 = new Date(document.getElementById("from").value); 
	var date2 = new Date(document.getElementById("to").value); 
	
	var Difference_In_Time = date2.getTime() - date1.getTime();  
	var days = Difference_In_Time / (1000 * 3600 * 24); 
	if(isNaN(date1)){
			alert("Select From date");
			document.getElementById("from").value="dd-mm-yyyy";
	}
	else if(days<0){
		alert("Please check From & To dates properly");
		document.getElementById("from").value="dd-mm-yyyy";
		document.getElementById("to").value="dd-mm-yyyy";
	}
};
function Showtext() {
        var leavetype = document.getElementById("leavetype");
        var CasualLeave = document.getElementById("CasualLeave");
        CasualLeave.style.display = leavetype.value == "CasualLeave" ? "block" : "none";
		var SummerVacation = document.getElementById("SummerVacation");
        SummerVacation.style.display = leavetype.value == "SummerVacation" ? "block" : "none";
		var CCL = document.getElementById("CCL");
        CCL.style.display = leavetype.value == "CCL" ? "block" : "none";
		var OD = document.getElementById("OD");
        OD.style.display = leavetype.value == "OD" ? "block" : "none";
    }
</script>
	  
	  </div>
	  </section>
 </main>
<!-- Footer -->
		<?php
		require_once('footer.php');
		?>
</body>
</html>
