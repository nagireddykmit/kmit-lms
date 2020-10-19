<?php
session_start();
error_reporting(0);
include('includes/config.php');
	$leaveid=$_GET['leaveid'];
	$adjstatus=array("Pending", "Approved", "Rejected");
	$sql = "SELECT * from classadjustments where leaveid=:lid";
	$stmt = $dbh -> prepare($sql);
	$stmt->bindParam(':lid',$leaveid,PDO::PARAM_STR);
	$stmt->execute();
	$adjustments=$stmt->fetchAll(PDO::FETCH_OBJ);
	if($stmt->rowCount() > 0)
	{
		$cnt=1;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>HOD | Check Adjustments </title>
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
    </head>
    <body>
     <header>
<!-- #nav-menu-container -->
		<?php
		require_once('hodheader.php');
		?>
     </header><!-- #header -->              

<div class="container">
<h2 style="font-family:Georgia;color:#000000;" align="center">Class Adjustments</h2>

	<table class="table table-striped table-responsive table-bordered" id="" cellspacing="0" style="table-layout: auto;width: 100%;" >
			<thead>
				<tr>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">SNO</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">EmpID</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Employe Name</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">YEAR</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">DEPARTMENT</th> 
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">SECTION</th>
					 <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Hour</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Subject </th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Class Date</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Status</th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach($adjustments as $adjustment)
			{  ?>
					<tr>
						<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($cnt);?></td>
						<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($adjustment->empid);?></td>
						<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($adjustment->empname);?></td>
						<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($adjustment->Year);?></td>
						<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($adjustment->department);?></td>
						<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($adjustment->Section);?></td>
						<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($adjustment->Timings);?></td>
						<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($adjustment->Subject);?></td>
						<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($adjustment->classdate);?></td>
						<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php if($adjustment->actionstatus=='0')
									echo "Pending";
								else if($adjustment->actionstatus=='1')
									echo "Approved";
								else
									echo "Rejected";
							?></td>
					</tr>
	<?php $cnt++; }} ?>
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