<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{
// code for Inactive  employee    
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
    <head>
        
        <!-- Title -->
        <title>HOD | Manage Employees</title>
        
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
		require_once('hodheader.php');
		?>
     </header><!-- #header -->
<style>
.container{
	padding: 50px 5px;
}
</style>

      <div class="container">           
        
	<h2 style="font-family:Georgia;color:#000000;" align="center">MANAGE EMPLOYEES</h2>
	  <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
		<table class="table table-striped table-responsive table-bordered" id="example" cellspacing="0" style="table-layout: auto;width: 100%;" >
			<thead>
				<tr style="font-weight:bold;">
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">S NO</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Employee ID</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Employee Name</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Department</th>
					 <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Status</th>
					 <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Registered Date</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Update Status</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$dept=$_SESSION['dept'];
			 $sql = "SELECT EmpId,FirstName,LastName,Department,Status,RegDate,id from  tblemployees where Department=:dept order by FirstName";
			$query = $dbh -> prepare($sql);
			$query->bindParam(':dept',$dept,PDO::PARAM_STR);
			$query->execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);
			$cnt=1;
			if($query->rowCount() > 0)
			{
			foreach($results as $result)
			{               ?>  
					<tr class="item">
						<td style="font: small-caps 15px/30px Georgia, serif;" align="center"> <?php echo htmlentities($cnt);?></td>
						<td style="font: small-caps 15px/30px Georgia, serif;" align="center"><?php echo htmlentities($result->EmpId);?></td>
						<td style="font: small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->FirstName);?>&nbsp;<?php echo htmlentities($result->LastName);?></td>
						<td style="font: small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->Department);?></td>
						 <td style="font: small-caps 15px/30px Georgia, serif;"><?php $stats=$result->Status;
							if($stats){ ?>
							 <a class="waves-effect waves-green btn-flat m-b-xs">Active</a>
							 <?php } else { ?>
							 <a class="waves-effect waves-red btn-flat m-b-xs">Inactive</a>
							 <?php } ?>
						 </td>
						  <td style="font: small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->RegDate);?></td>
						<td style="font: small-caps 15px/30px Georgia, serif;" align="center"><!--<a href="editemployee.php?empid=<?php echo htmlentities($result->id);?>"><span class="glyphicon glyphicon-edit icon-update"></span></span></a>-->
					<?php if($result->Status==1)
{?>
<a href="manageemployee.php?inid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to inactive this Employe?');" > <span class="glyphicon glyphicon-remove icon-invalid"></span>
<?php } else {?>

						<a href="manageemployee.php?id=<?php echo htmlentities($result->id);?>" onclick="return confirm('Are you sure you want to active this employee?');""><span class="glyphicon glyphicon-ok icon-valid" align="center"></span>
						<?php } ?> </td>
					</tr>
					 <?php $cnt++;} }?>
				</tbody>
			</table>
		</div>
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
<?php } ?>