<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from  tbldepartments  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$msg="Department record deleted";

}

    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Manage Departments</title>
        
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
	<h2 style="font-family:Georgia;color:#000000;" align="center">MANAGE DEPARTMENTS</h2>
		<?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
		<table class="table table-striped table-responsive table-bordered" id="example" cellspacing="0" style="table-layout: auto;width: 100%;" >
			<thead>
				<tr>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">S NO</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Department Name</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Dept Short Name</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Department Code</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Created Date</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php $sql = "SELECT * from tbldepartments";
			$query = $dbh -> prepare($sql);
			$query->execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);
			$cnt=1;
			if($query->rowCount() > 0)
			{
			foreach($results as $result)
			{               ?>  
				<tr class="item">
					<td style="font: small-caps 15px/30px Georgia, serif;"> <?php echo htmlentities($cnt);?></td>
					<td style="font: small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->DepartmentName);?></td>
					<td style="font: small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->DepartmentShortName);?></td>
					<td style="font: small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->DepartmentCode);?></td>
					<td style="font: small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->CreationDate);?></td>
					<td style="font: small-caps 15px/30px Georgia, serif;"><a href="editdepartment.php?deptid=<?php echo htmlentities($result->id);?>"><img src="edit.png" align="right"  width="50"  height="20"></a><a href="managedepartments.php?del=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you want to delete');"> <img src="delete.jpg" align="right"  width="30"  height="20"></a></td>
				</tr>
				 <?php $cnt++;} }?>
			</tbody>
		</table>
		<br><br><br><br>
	</div>
    <style>
	th {
	  font-size: 20px;
	  cursor: pointer;
	  background-color: coral;
	}
	</style>
	
	
<!-- Footer -->
		<?php
		require_once('footer.php');
		?>
    </body>
</html>
<?php } ?>