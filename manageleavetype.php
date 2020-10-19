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
$sql = "delete from  tblleavetype  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$msg="Leave type record deleted";

}
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Manage Leave Type</title>
        
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
	<h2 style="font-family:Georgia;color:#000000;" align="center">MANAGE LEAVE TYPE</h2>                                
	<?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
		<table class="table table-striped table-responsive table-bordered" id="example" cellspacing="0" style="table-layout: auto;width: 100%;" >
			<thead>
				<tr>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">S NO</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Leave Type</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Description</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Created Date</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php $sql = "SELECT * from tblleavetype";
		$query = $dbh -> prepare($sql);
		$query->execute();
		$results=$query->fetchAll(PDO::FETCH_OBJ);
		$cnt=1;
		if($query->rowCount() > 0)
		{
		foreach($results as $result)
		{               ?>  
			<tr>
				<td style="font: small-caps 15px/30px Georgia, serif;"> <?php echo htmlentities($cnt);?></td>
				<td style="font: small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->LeaveType);?></td>
				<td style="font: small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->Description);?></td>
				<td style="font: small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->CreationDate);?></td>
				<td style="font: small-caps 15px/30px Georgia, serif;"><a href="editleavetype.php?lid=<?php echo htmlentities($result->id);?>"><span class="glyphicon glyphicon-edit icon-update"></span>
				<a href="manageleavetype.php?del=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you want to delete');"> <span class="glyphicon glyphicon-trash icon-delete"></span></a> </td>
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
	.icon-delete{
		color : #FF7F50;
	}
	.icon-update{
		color : #0000FF;
	}
	</style>
	
	
<!-- Footer -->
		<?php
		require_once('footer.php');
		?>
</body>
</html>
<?php } ?>