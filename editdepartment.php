<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
if(isset($_POST['update']))
{
$did=intval($_GET['deptid']);    
$deptname=$_POST['departmentname'];
$deptshortname=$_POST['departmentshortname'];
$deptcode=$_POST['deptcode'];   
$sql="update tbldepartments set DepartmentName=:deptname,DepartmentCode=:deptcode,DepartmentShortName=:deptshortname where id=:did";
$query = $dbh->prepare($sql);
$query->bindParam(':deptname',$deptname,PDO::PARAM_STR);
$query->bindParam(':deptcode',$deptcode,PDO::PARAM_STR);
$query->bindParam(':deptshortname',$deptshortname,PDO::PARAM_STR);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->execute();
$msg="Department updated Successfully";
}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
      <title>Admin | Edit Department</title>
        
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
		<h3 style="font-family:Georgia;color:#2F4F4F;" align="center">EDIT DEPARTMENT</h3>
 
                       
                                    <form class="form-signin" name="chngpwd" method="post">
                                          <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
<?php 
$did=intval($_GET['deptid']);
$sql = "SELECT * from tbldepartments WHERE id=:did";
$query = $dbh -> prepare($sql);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<br><input id="departmentname" placeholder="Department Name" type="text"  class="form-control" autocomplete="off" name="departmentname"  value="<?php echo htmlentities($result->DepartmentName);?>" required>
<br><input id="departmentshortname" placeholder="Department Short Name" type="text"  class="form-control" autocomplete="off" name="departmentshortname" value="<?php echo htmlentities($result->DepartmentShortName);?>" required>

<br><input id="deptcode" type="text" placeholder="Department Code" name="deptcode" class="form-control" class="validate" autocomplete="off" value="<?php echo htmlentities($result->DepartmentCode);?>" required>
          

<?php }} ?>
<button type="submit" name="update" class="waves-effect waves-light btn indigo m-b-xs">UPDATE</button>

</div>




                                        </div>
                                       
                                    </form>
                               
                          
                     
             
                   
                    </div>
                
                </div>
            <!--footer -->
		<?php
		require_once('footer.php');
		?>
        
    </body>
</html>
<?php } ?> 