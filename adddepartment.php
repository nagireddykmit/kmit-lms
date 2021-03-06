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

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Add Department</title>
        
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
<body>
    <header>
	<!-- #nav-menu-container -->
		<?php
		require_once('adminheader.php');
		?>
     </header><!-- #header -->
	 <div class="container">
        <div class="card card-container">
           <h3 style="font-family:Georgia;color:#2F4F4F;" align="center">ADD DEPARTMENT</h3>
 
			<form class="form-signin" name="chngpwd" method="post">
			<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
			else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
			<br><input id="departmentname" placeholder="Department Name" type="text"  class="form-control" autocomplete="off" name="departmentname"  required>
			<br><input id="departmentshortname" placeholder="Department Short Name" type="text"  class="form-control" autocomplete="off" name="departmentshortname"  required>
			<br><input id="deptcode" type="text" placeholder="Department Code" name="deptcode" class="form-control" autocomplete="off" required>
			<br><button type="submit" name="add" class="waves-effect waves-light btn indigo m-b-xs" value="ADD">ADD</button>
			</form>
			</div>
		</div>
	<!--footer -->
		<?php
		require_once('footer.php');
		?>
    </bo	dy>
</html>
<?php } ?> 